<?php
foreach ($recent_images as $image) {
    ?>
    <div class="col-lg-3 topichat_media">
        <div class="topichat_media_wrapper">
            <a class="fancybox"  href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image['media']; ?>" data-fancybox-group="gallery1">
                <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image['media']; ?>" class="img-responsive topi_image topi_images">
            </a>
        </div>
    </div>
    <?php
}?>