<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/challenge'); ?>"><i class="icon-magazine position-left"></i> Challenges</a></li>
            <li class="active"><?php echo $heading; ?></li>
        </ul>
    </div>
</div>
<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    if (!empty(validation_errors())) {
        ?>
        <div class="content pt0 flashmsg">
            <div class = "alert alert-danger">
                <a class="close" data-dismiss="alert">X</a>
                <strong><?php echo validation_errors(); ?></strong>       
            </div>
        </div>
        <?php
    }
}
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal form-validate" action="" id="post_info" method="POST">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="message alert alert-danger" style="display:none"></div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Challenge Name <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" placeholder="Enter Challenge Name" name="name" value="<?php echo (isset($Challenges['name'])) ? $Challenges['name'] : set_value('name'); ?>"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Challenge Description</label>
                            <div class="col-lg-7">
                                <textarea id="introduction" name="description" placeholder="Enter Challenge Description" class="form-control"><?php echo (isset($Challenges['description'])) ? $Challenges['description'] : set_value('description'); ?></textarea>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Rewards</label>
                            <div class="col-lg-7">
                                <input type="number" class="form-control" min="1" max="10" placeholder="Enter Challenge Rewards" name="rewards" value="<?php echo (isset($Challenges['rewards'])) ? $Challenges['rewards'] : set_value('rewards'); ?>" required> 
                            </div>
                        </div> 
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .image_wrapper{
        height:auto;
        width:auto;
    }
    #imagePreview {
        width: 400px;
        height: 180px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        float: left;
        margin: 9px;
    }

    #imagePreview_msg {
        width: 100%;
        height: 180px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    }
</style>
<script>
    var base_url = '<?php echo base_url(); ?>';

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        $('.image_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files) {
            if (/^image/.test(files[key].type)) { // only image file
                console.log(files);
                console.log(key);
                console.log(files[key].type);
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.image_wrapper').show();
                    $('.message').hide();
                    $('.image_wrapper').append("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                    $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                    ++i;
                }
            } else {
//                this.files = '';
                $('.message').html("Please select proper image");
                $('.message').show();
            }
        }
    });

    // Video uploading script
    $('#uploadVideo').on("change", function () {
        $('.message').html();
        $('.video_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files)
        {
            if (/^video/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.video_wrapper').show();
                    $('.message').hide();
                    $('.video_wrapper').append("<img class='videoPreview" + i + "' id='imagePreview' src='" + $('.video_wrapper').data('default_image') + "'/>");
//                    $('.videoPreview'+i).css("background-image", ;
                    ++i;
                }
            } else
            {
                $('.message').html("Please select proper image");
                $('.message').show();
            }
        }
    });

    $('input:radio[name="person_limit"]').change(function () {
        if ($(this).is(":checked") && $(this).val() == 'Yes')
            $("#txt_No_of_person").removeAttr("disabled");
        else
            $("#txt_No_of_person").attr("disabled", "disabled");
    });
</script>