<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/league'); ?>"><i class="icon-magazine position-left"></i> Leagues Groups</a></li>
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
                            <label class="col-lg-3 control-label">League Name <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <textarea id="description" name="name" placeholder="Enter Name" class="form-control"><?php echo (isset($Leagues['name'])) ? $Leagues['name'] : set_value('name'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">League Introduction <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <textarea id="description" name="introduction" placeholder="Enter Introduction" class="form-control"><?php echo (isset($Leagues['introduction'])) ? $Leagues['introduction'] : set_value('introduction'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Group user limit <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <input type="text" id="user_limit" name="user_limit" placeholder="Enter Group user Limit" class="form-control" value="<?php echo (isset($Leagues['user_limit'])) ? $Leagues['user_limit'] : set_value('user_limit'); ?>">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Requirements <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <textarea id="description" name="requirements" placeholder="Enter Requirements" class="form-control"><?php echo (isset($Leagues['requirements'])) ? $Leagues['requirements'] : set_value('requirements'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">League Logo</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="league_logo" id="uploadLogo" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Logo</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">League Image</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="league_image" id="uploadFile" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Images</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 league_images">
                            <?php
//                        pr($post_datas['media']);
                            if (isset($Leagues['league_logo']) && !empty($Leagues['league_logo'])) {
                                ?>
                                <div class="league_inner">
                                    <h6> League Logo</h6>
                                    <div class="thumbnail">
                                        <div class="thumb">
                                            <div class="thumb-inner">
                                                <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $Leagues['league_logo']; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
//                        pr($post_datas['media']);
                            if (isset($Leagues['league_image']) && !empty($Leagues['league_image'])) {
                                ?>
                                <div league_inner>
                                    <h6> League Image</h6>
                                    <div class="thumbnail">
                                        <div class="thumb">
                                            <div class="thumb-inner">
                                                <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $Leagues['league_image']; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-12 col-sm-12 league_images">
                            <div class="logo_wrapper" style="display:none">
                                <h6> League New Logo</h6>
                            </div>
                            <div class="image_wrapper" style="display:none">

                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
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
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.image_wrapper').show();
                    $('.message').hide();
                    $('.image_wrapper').append("<h6> League New Image</h6><div class='imagePreview" + i + "' id='imagePreview'></div>");
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
    $('#uploadLogo').on("change", function () {
        $('.message').html();
        $('.logo_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files)
        {
            if (/^image/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.logo_wrapper').show();
                    $('.message').hide();
                    $('.logo_wrapper').append("<h6> League New Logo</h6><div class='logPreview" + i + "' id='logPreview'></div>");
                    $('.logPreview' + i).css("background-image", "url(" + this.result + ")");
                    ++i;
                }
            } else
            {
                $('.message').html("Please select proper image Logo");
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