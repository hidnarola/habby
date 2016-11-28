<?php
foreach ($event_post as $event) {
    ?>
    <!-- Group plan each section start here -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event_post " data-id="<?php echo $event['id'] ?>">
        <div class='grp_pln_sec'>
            <div class="event_profile_sec">
                <div class="usr_post_img">
                    <a href="<?php echo ($event['user_id'] == $this->session->user['id']) ? base_url() . 'home/profile' : base_url() . "user_profile/" . $event['user_id'] ?>"><img class="img-circle img-responsive event_user" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $event['user_image'] ?>"></a>
                </div>
                <div class="post_title">
                    <a href="<?php echo ($event['user_id'] == $this->session->user['id']) ? base_url() . 'home/profile' : base_url() . "user_profile/" . $event['user_id'] ?>"><span><label class="control-label"><?php echo $event['name']; ?></label></span></a>
                    creates an event "<?php echo $event['title']; ?>"
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
                                    <?php echo lang("Seems like your browser doesn't support video tag."); ?>
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
                <a href='<?php echo base_url() . 'events/details/' . urlencode(base64_encode($event['id'])) ?>' class='join_btn pstbtn'><?php echo lang("Enter"); ?></a>
            </div>
        </div>
    </div>
    <!-- Group plan each section end here -->
    <?php
}
?>