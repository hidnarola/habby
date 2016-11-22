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
                            <a class="post_images" href="javascript:;">
                                <img src="<?php echo DEFAULT_EVENT_MEDIA_PATH . $value['media']; ?>" class="img-responsive center-block">
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="post_images" href="javascript:;">
                                <video controls class="img-responsive center-block myvideo" >
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
            <div class='event_seat' data-start="<?php echo $event['start_time'] ?>" data-end="<?php echo $event['end_time'] ?>">
                <span class="seat_details"><?php echo lang("Number of seat") . " : " . $event['limit']; ?></span>
                <a href="javascript:;" class="view_details pstbtn"><?php echo lang('View Details') ?></a>
                <?php
                if ($event['is_joined']) {
                    ?>
                    <a href='<?php echo base_url() . 'events/details/' . urlencode(base64_encode($event['id'])) ?>' class='join_btn pstbtn'><?php echo lang("Enter");?></a>
                    <?php
                } else if ($event['is_requested']) {
                    ?>
                    <a href='javascript:;' class='join_btn pstbtn'><?php echo lang("Requested");?></a>
                    <?php
                } else {
                    ?>
                    <a href='javascript:;' class='join_btn pstbtn event_join'><?php echo lang("Join");?></a>
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="event_profile_sec">

                </div>
            </div>
            <div class="modal-body">

                <div class="event_post_details"></div>
                <div class="event_media"></div>
                <div class="event_seat">
                    <span class="seat_details"></span>
                    <a class="join_btn pstbtn" href=""></a><br/>
                    <span class="start_time"></span><br/>
                    <span class="end_time"></span>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $('document').ready(function () {
        $('.event_post').on('click', '.view_details', function (str) {
            var modal = $("#myModal");
            var event_post = $(this).parents('.event_post');

            modal.find('.event_profile_sec').html(event_post.find('.event_profile_sec').html());
            modal.find('.event_post_details').html(event_post.find('.event_post_details').html());
            modal.find('.event_media').html(event_post.find('.event_media').html());
            modal.find('.seat_details').html(event_post.find('.seat_details').html());
            modal.find('.join_btn').html(event_post.find('.join_btn').html());
            modal.find('.join_btn').attr('href', event_post.find('.join_btn').attr('href'));
            modal.find('.start_time').html('Event Start Time : ' + event_post.find('.event_seat').data('start'));
            modal.find('.end_time').html('Event End Time : ' + event_post.find('.event_seat').data('end'));
            modal.modal('show');
        });
    });
</script>