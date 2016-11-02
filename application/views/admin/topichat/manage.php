<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/topichat'); ?>"><i class="icon-magazine position-left"></i> Topichat Groups</a></li>
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
            <form class="form-horizontal form-validate" action="" id="post_info" method="POST" enctype="multipart/form-data">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="message alert alert-danger" style="display:none"></div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Topic Name <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <textarea id="description" name="topic_name" placeholder="Enter Topic Name" class="form-control"><?php echo (isset($Topichats['topic_name'])) ? $Topichats['topic_name'] : set_value('topic_name'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">No. of People</label>
                            <label class="radio-inline">
                                <input type="radio" name="person_limit" id="optionsRadios1" value="-1" <?php echo (isset($Topichats['person_limit']) && $Topichats['person_limit'] < 0) ? "checked" : "" ?>> No limit
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="person_limit" id="No_of_person" value="Yes" <?php echo (isset($Topichats['person_limit']) && $Topichats['person_limit'] > 0 ) ? "checked" : "" ?>>
                                <input type="number" class="form-control" id="txt_No_of_person" name="No_of_person" value="<?php echo (isset($Topichats['person_limit']) && $Topichats['person_limit'] > 0) ? intval($Topichats['person_limit']) : "Customise" ?>" placeholder="<?php echo (isset($Topichats['person_limit']) && $Topichats['person_limit'] > 0) ? intval($Topichats['person_limit']) : "Customise" ?>" disabled min="1">
                            </label>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">Topichat Image</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="group_cover" id="uploadFile" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Images</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Notes </label>
                            <div class="col-lg-7">
                                <textarea id="description" name="notes" placeholder="Enter Notes" class="form-control"><?php echo (isset($Topichats['notes'])) ? $Topichats['notes'] : set_value('notes'); ?></textarea>
                            </div>
                        </div>
                        <?php
//                        pr($post_datas['media']);
                        if (isset($Topichats['group_cover']) && !empty($Topichats['group_cover'])) {
                            ?>
                            <div class="col-lg-12 col-sm-12">
                                <div class="thumbnail">
                                    <div class="thumb">
                                        <div class="thumb-inner">
                                            <img src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $Topichats['group_cover']; ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="image_wrapper" style="display:none">
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