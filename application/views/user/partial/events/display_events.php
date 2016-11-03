<?php
foreach ($event_posts as $event) {
    ?>
    <!-- Group plan each section start here -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 event_post " data-id="<?php echo $event['id'] ?>">
        <div class='grp_pln_sec'>
            <div class="event_profile_sec">
                <div class="usr_post_img">
                    <img class="img-circle img-responsive event_user" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $event['user_image'] ?>">
                    <span><label class="control-label"><?php echo $event['name']; ?></label></span>
                </div>
                <div class="post_title">
                    <?php echo $event['title']; ?>
                </div>
            </div>
            <div class='event_post_details'>
                <?php echo $event['details']; ?>
            </div>
            <div class='event_media'>
                <?php
                if (isset($event['media']) && is_array($event['media']) && count($event['media']) > 0) {
                    foreach ($event['media'] as $value) {
                        ?>
                        <?php
                        if ($value['media_type'] == "image") {
                            ?>
                            <a class="fancybox post_images"  href="<?php echo DEFAULT_EVENT_MEDIA_PATH . $value['media']; ?>" data-fancybox-group="gallery">
                                <img src="<?php echo DEFAULT_EVENT_MEDIA_PATH . $value['media']; ?>" class="img-responsive center-block">
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="fancybox post_images"  href="javascript:;" data-fancybox-group="gallery">
                                <video controls class="img-responsive center-block">
                                    <source src="<?php echo DEFAULT_EVENT_MEDIA_PATH . $value['media']; ?>"></source>
                                    Seems like your browser doesn't support video tag.
                                </video>
                            </a>
                            <?php
                        }
                        ?>
                        <?php
                    }
                }
                ?>
            </div>
            <div class='event_seat'>
                <span><?php echo lang("Number of seat") . " : " . $event['limit']; ?></span>
                <?php
                if ($event['is_joined']) {
                    ?>
                    <a href='javascript:;' class='pstbtn'>Enter</a>
                    <?php
                } else {
                    ?>
                    <a href='javascript:;' class='pstbtn event_join'>Join</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Group plan each section end here -->
    <?php
}
?>