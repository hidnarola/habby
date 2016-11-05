<?php
foreach ($recent_videos_thumb as $key => $image) {
    ?>
    <div class="col-lg-3 topichat_media">
        <a class="fancybox video-w-icon" target="_blank" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $recent_videos[$key]['media']; ?>" data-fancybox-group="gallery1">
            <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive ">
        </a>
    </div>
    <?php
}
?>