<?php
foreach ($recent_links as $links) {
//    pr($links);
    $media = json_decode($links['media']);
    if ($links['youtube_video'] != Null) {
        ?>
        <div class="col-lg-6 topichat_media">
            <div class='topichat_link_wrapper links'>
                <div class = "fileshare">
                    <?php
                    if (isset($media->thumbnail_url) && $media->thumbnail_url != null) {
                        echo $links['youtube_video'];
                        ?>
            <!--                        <div class="videoPreview" data-toggle="modal" data-target="#linkModal" data-id='<?php echo $links['id']; ?>'>
                                <img class = "thumb" src = "<?php echo $media->thumbnail_url ?>"></img>
                                <div class="youtube-icon"><img src="<?php echo DEFAULT_IMAGE_PATH ?>youtube-icon.png"/></div>
                            </div>-->
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="col-lg-6 topichat_media">
            <div class='topichat_link_wrapper links'>
                <div class = "fileshare">
                    <div class = "">
                        <?php
                        if (isset($media->thumbnail_url) && $media->thumbnail_url != null) {
                            ?>
                            <div class = "large-3 columns">
                                <img class = "thumb" src = "<?php echo $media->thumbnail_url ?>"></img>
                            </div>
                            <?php
                        }
                        ?>
                        <div class = "large-9 column">
                            <a href = "<?php echo (isset($media->original_url)) ? $media->original_url : ""; ?>" target="_blank"><?php echo (isset($media->title)) ? $media->title : ""; ?></a>
                            <p><?php echo (isset($media->description)) ? $media->description : ""; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>