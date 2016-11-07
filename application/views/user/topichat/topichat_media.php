<div class="row">
    <div class="container topic_2cntnr mble_pd_0">
        <p class="mr_p visible-xs" >
            <a href="#" class="pstbtn" id="more_rate"><?php echo lang('Files'); ?></a>
        </p>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                            $this->load->view('user/partial/topichat/load_more_video');
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
                            $this->load->view('user/partial/topichat/load_more_image');
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
//pr($recent_videos);
//echo $recent_videos[count($recent_videos) - 1]['id'];
?>
<!-- Global variable for join_topichat.js -->
<script>
    data = '<?php echo json_encode($this->session->user); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    DEFAULT_IMAGE_PATH = '<?php echo DEFAULT_IMAGE_PATH; ?>';
    last_video = '<?php echo (count($recent_videos) > 0) ? $recent_videos[count($recent_videos) - 1]['id'] : 0 ?>';
    last_image = '<?php echo (count($recent_images) > 0) ? $recent_images[count($recent_images) - 1]['id'] : 0 ?>';
    upload_path = '<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/topichat.js"></script>