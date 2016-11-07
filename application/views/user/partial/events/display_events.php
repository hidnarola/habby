<?php
foreach ($event_posts as $event) {
    ?>
    <!-- Group plan each section start here -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 event_post " data-id="<?php echo $event['id'] ?>">
        <div class='grp_pln_sec'>
            <div class="event_profile_sec">
                <div class="usr_post_img">
                    <img class="img-circle img-responsive event_user" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $event['user_image'] ?>">
                </div>
                <div class="post_title">
                    <span><label class="control-label"><?php echo $event['name']; ?></label></span>
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
                            <a class="post_images" data-toggle="modal" data-target="#myModal1"  >
                                <img src="<?php echo DEFAULT_EVENT_MEDIA_PATH . $value['media']; ?>" class="img-responsive center-block">
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="post_images" data-toggle="modal" data-target="#myModal1"  href="javascript:;">
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
                    <a href='<?php echo base_url() . '/events/details/' . urlencode(base64_encode($event['id'])) ?>' class='pstbtn'>Enter</a>
                    <?php
                } else if ($event['is_requested']) {
                    ?>
                    <a href='javascript:;' class='pstbtn'>Requested</a>
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
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="event_profile_sec">
                    <div class="usr_post_img">
                        <img src="http://habby/uploads/user_profile/6e981ab23e7a6d6b3e6f17ad6b2d75d6.jpg" class="img-circle img-responsive event_user">
                    </div>
                    <div class="post_title">
                        <span><label class="control-label">Ashish Rana</label></span>
                        creates an event "last post"
                    </div>
                </div>
            </div>
            <div class="modal-body">

                <div class="event_post_details">
                    testing post having image of car            </div>
                <div class="event_media">
                    <a data-target="#myModal1" data-toggle="modal" class="post_images">
                        <img class="img-responsive center-block" src="http://habby/uploads/event_post/e26e60f247862da3970b832169c643b1.jpg">
                    </a>

                </div>
                <div class="event_seat">
                    <span>Number of seat : 150</span>
                    <a class="pstbtn event_join" href="javascript:;">Join</a><br/>
                     <span>monday</span><br/>
                     <span>07-11-2016</span><br>
                    <span>15:07</span>
                </div>
            </div>
        </div>

    </div>
</div>