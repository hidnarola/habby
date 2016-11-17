<?php
foreach ($recent_videos_thumb as $key=>$video) {
    ?>
    <div class='col-sm-6 col-xs-12 load_more_event_image'>
        <a class="col-sm-12" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $videos[$key]; ?>" target="_blank">
            <div class="video-w-icon">
                <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $video; ?>" class="img-responsive" />
            </div>
        </a>
    </div>
    <?php
}
?>