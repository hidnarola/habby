<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/posts'); ?>"><i class="icon-magazine position-left"></i> Posts</a></li>
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
                            <label class="col-lg-3 control-label">Post Description <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <textarea id="description" name="description" placeholder="Enter Description" class="form-control"><?php echo (isset($post_datas['description'])) ? $post_datas['description'] : set_value('description'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">Post Images</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="uploadfile[]" id="uploadFile" multiple="multiple" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Images</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">Post Videos</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="videofile[]" id="uploadVideo" multiple="multiple" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Videos</span>
                                </div>
                            </div>
                        </div>

                        <?php
//                        pr($post_datas);
                        if (isset($post_datas['media']) && !empty($post_datas['media'])) {
                            ?>
                            <div class="col-lg-12 col-sm-12">
                                <div class="thumbnail manage-thumbnail-wrapper">
                                    <div class="thumb grid">
                                        <div class="grid-sizer"></div>
                                        <?php
                                        foreach ($post_datas['media'] as $post_media) {
//                                            pr($post_media);
                                            if ($post_media['media_type'] == 'image') {
                                                ?>
                                                <div class="thumb-inner grid-item" id="post_media_<?php echo $post_media['id']; ?>">
                                                    <img src="<?php echo DEFAULT_POST_IMAGE_PATH . $post_media['media']; ?>" alt="">
                                                    <div class="caption-overflow">
                                                        <span>
                                                            <a href="javascript:void(0)" data-id="<?php echo $post_media['id']; ?>" data-type="image" data-popup="lightbox" class="btn text-white btn-flat btn-icon delete-post"><i class="icon-close2"></i></a>

                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="thumb-inner grid-item" id="post_media_<?php echo $post_media['id']; ?>">
                                                    <video controls class="img-responsive center-block">
                                                        <source src="<?php echo DEFAULT_POST_IMAGE_PATH . $post_media['media']; ?>"></source>
                                                    </video>
                                                    <div class="caption-overflow">
                                                        <span>
                                                            <a href="javascript:void(0)" data-id="<?php echo $post_media['id']; ?>" data-type="video" data-popup="lightbox" class="btn text-white btn-flat btn-icon delete-post"><i class="icon-close2"></i></a>

                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="image_wrapper" style="display:none">

                        </div>
                        <div class="video_wrapper" style="display:none" data-default_image="<?php echo DEFAULT_IMAGE_PATH . "video_thumbnail.png" ?>">
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
    $(function () {
        $('.delete-post').click(function () {
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Post Media!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {

                            $.ajax({
                                url: '<?php echo base_url() . "admin/posts/del_post"; ?>',
                                type: 'POST',
                                data: {post_media_id: id},
                                success: function (data) {
                                    $('#post_media_' + id).fadeOut(1000, function () {
                                        swal("Deleted!", "Your Post Media has been deleted.", "success");
                                    });
                                    setTimeout(function () {
                                        $('.grid').masonry({
                                            // set itemSelector so .grid-sizer is not used in layout
                                            itemSelector: '.grid-item',
                                            // use element for option
                                            columnWidth: '.grid-sizer',
                                            percentPosition: true
                                        });
                                    }, 3000);
                                }
                            });
                        } else {
                            swal("Cancelled", "Your Post Media is safe :)", "error");
                        }
                    });
        });
    });

</script>