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
<?php
pr($recent_videos);
echo $recent_videos[count($recent_videos) - 1]['id'];
?>
<!-- Global variable for join_topichat.js -->
<script>
    data = '<?php echo json_encode($this->session->user); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    DEFAULT_IMAGE_PATH = '<?php echo DEFAULT_IMAGE_PATH; ?>';
    last_video = '<?php echo (count($recent_videos) > 0) ? $recent_videos[count($recent_videos) - 1]['id'] : 0 ?>';
    upload_path = '<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/topichat.js"></script>