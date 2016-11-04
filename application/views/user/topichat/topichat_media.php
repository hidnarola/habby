<div class="row">
    <div class="container topic_2cntnr mble_pd_0">
        <p class="mr_p visible-xs" >
            <a href="#" class="pstbtn" id="more_rate"><?php echo lang('Files'); ?></a>
        </p>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- All files section start here -->
            <!--                <div class="panel panel-default popular_img_sec">
                                <div class="panel-heading"><b><?php echo lang('ALL FILES'); ?></b><span style="float: right"><i class="fa fa-angle-right" aria-hidden="true"></i></span></div>
                                <div class="panel-heading shrd_topc_sec"><b><?php echo lang('Shared'); ?></b> <span style="float: right"><a href="#"><b><?php echo lang('More'); ?></b></a></span></div>
                                <div class="panel-body">
                                    <div class="topic_frame">
                                        <a class="fancybox" data-type="iframe"  href="http://www.youtube.com/embed/WAZ5SmJd1To" data-fancybox-group="galleryshared1">
                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img2.jpg" class="img-responsive">
                                        </a>
                                    </div>
                                </div>
                            </div>-->
            <!-- All files section end here -->

            <?php
            if (count($recent_images) > 0 || count($recent_videos) > 0) {
                ?>
                <!-- popular image and video section start here -->
                <div class="panel panel-default popular_img_sec media">

                    <div class="panel-heading"><b><?php echo lang('UPLOAD'); ?></b></div>

                    <?php
                    if (count($recent_videos) > 0) {
                        ?>
                        <div class="panel-heading shrd_topc_sec"><b><?php echo lang('Videos'); ?></b></div>

                        <div class="panel-body video_wrapper">
                            <?php
                            foreach ($recent_videos_thumb as $key => $image) {
                                ?>
                                <div class="col-lg-3 topichat_media">
                                    <a class="fancybox video-w-icon" target="_blank" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $recent_videos[$key]; ?>" data-fancybox-group="gallery1">
                                        <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive ">
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    if (count($recent_images) > 0) {
                        ?>
                        <div class="panel-heading shrd_topc_sec brdr_top"><b><?php echo lang('Images'); ?></b> </div>

                        <div class="panel-body image_wrapper">
                            <?php
                            foreach ($recent_images as $image) {
                                ?>
                                <div class="col-lg-3 topichat_media">
                                    <a class="fancybox"  href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" data-fancybox-group="gallery1">
                                        <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive topi_image topi_images">
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- popular image and video section End here -->
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!--Topichat Popular section start here -->
<div class = "modal" id = "edit_grp">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-body">
                <div class = "panel-heading">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;
                    </button>
                    <b><?php echo lang('Edit Group'); ?></b>
                </div>
                <div class = "row pst_here_sec">
                    <!--post start here -->
                    <form class = "" role = "form" method = "post" action = "<?php echo base_url() . "topichat/update_group/" . urlencode(base64_encode($topichat['id'])); ?>" enctype = "multipart/form-data">
                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class = "panel panel-default">
                                <!--Upload images or video section start here -->
                                <div class = "panel-body1 clearfix">
                                    <div class = "topichat_txtarea">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class = "row">
                                                <div class = "form-group clearfix">
                                                    <label class = "col-lg-1 col-md-1 col-sm-2 col-xs-3 control-label"><?php echo lang('Topic'); ?> : </label>
                                                    <div class = "col-lg-11 col-md-11 col-sm-10 col-xs-9">
                                                        <textarea class = "form-control topichat_txtarea" rows = "3" id = "textArea" placeholder = "#<?php echo lang('Topic'); ?>" name = "topic_name" required = "required"><?php echo $topichat['topic_name']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class = "row">
                                                <div class = "form-group clearfix">
                                                    <label class = "col-lg-2 col-md-2 col-sm-2 col-xs-5 control-label"><?php echo lang('Number of People'); ?> :</label>
                                                    <div class = "col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                        <div class = "radio topchat_1_rdo edit_topichat_rdo">
                                                            <label>
                                                                <input type = "radio" name = "person_limit" id = "optionsRadios1" value = "-1" <?php echo ($topichat['person_limit'] == -1) ? 'checked' : '' ?>><?php echo lang('No limit'); ?></label>
                                                            <label>
                                                                <input type = "radio" name = "person_limit" id = "No_of_person" value = "Yes" <?php echo ($topichat['person_limit'] != -1) ? 'checked' : '' ?>>
                                                                <input type = "number" min="1" class = "form-control" id = "txt_No_of_person" name = "No_of_person" placeholder = "<?php echo lang('customise'); ?>" value="<?php echo ($topichat['person_limit'] != -1) ? $topichat['person_limit'] : '' ?>" <?php echo ($topichat['person_limit'] != -1) ? '' : 'disabled' ?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "panel-body">
                                    <div class = "message alert alert-danger" style = "display:none"></div>
                                    <div class = "upld_sec">
                                        <div class = "fileUpload up_img btn">
                                            <span><i class = "fa fa-picture-o" aria-hidden = "true"></i> <?php echo lang('Images');
            ?></span>
                                            <input type="file" name="group_cover" class="upload" id="uploadFile"/>
                                        </div>
                                    </div>
                                    <div class="image_wrapper">
                                        <div class="col-sm-6">
                                            <div class="panel-heading text-center">Existing Image </div>
                                            <img class="img-responsive" src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat['group_cover'] ?>" style="margin-top:9px;"/>
                                        </div>
                                        <div class="col-sm-6 new_image_wrapper" style="display:none">
                                            <div class="panel-heading text-center">New Image </div>
                                            <div id="imagePreview"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload images or video section end here -->

                                <!-- selectng "Post to" and Original section start here -->
                                <div class="panel-body1 clearfix chat_pnl_ftr">
                                    <div class="topichat_txtarea">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <label for="select" class="col-lg-1 col-md-1 col-sm-2 col-xs-3 control-label"><?php echo lang('Note'); ?> :</label>
                                                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-9">
                                                        <textarea class="form-control topichat_txtarea" rows="3" id="textArea" name="notes"><?php echo $topichat['notes']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="submit" class="pstbtn" value="<?php echo lang('Update') ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- selectng "Post to" and Original section end here -->
                            </div>
                        </div>
                    </form>
                    <!-- post end here -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Global variable for join_topichat.js -->
<script>
    data = '<?php echo json_encode($this->session->user); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    DEFAULT_IMAGE_PATH = '<?php echo DEFAULT_IMAGE_PATH; ?>';
    last_video = '<?php // echo (count($messages) > 0) ? $messages[count($messages) - 1]['id'] : 0  ?>';
    upload_path = '<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/topichat.js"></script>