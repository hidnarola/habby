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
                    echo $links['youtube_video'];
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
                        if (isset($media->images[0]->url) && $media->images[0]->url != null) {
                            ?>
                            <div class = "large-3 columns">
                                <img class = "thumb" src = "<?php echo $media->images[0]->url ?>"></img>
                            </div>
                            <?php
                        }
                        ?>
                        <div class = "large-9 column">
                            <a href = "<?php echo (isset($media->url)) ? $media->url : ""; ?>" target="_blank"><?php echo (isset($media->title)) ? $media->title : ""; ?></a>
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