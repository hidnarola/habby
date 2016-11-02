<link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "bootstrap-datetimepicker.min.css" ?>"/>

<!-- Topicaht Post and bannner section end here -->

<div class="row topic_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#new_event"><?php echo lang('New'); ?> <br><?php echo lang('Event'); ?></a>
        <!-- New Group button end-->
    </div>

</div>
<!-- Topicaht Post and bannner section end here -->

<!-- filter titile start here -->
<div class="row filter_row">
    <div class="container">
        <div class="txt_white">
            <?php echo lang('Filters'); ?>
        </div>
    </div>
</div>
<!-- filter titile end here -->
<div id="FilterContainer">
    <?php
    $message = $this->session->flashdata('message');
    if (!empty($message) && isset($message)) {
        ($message['class'] != '') ? $message['class'] : '';
        echo '<div class="' . $message['class'] . '">' . $message['message'] . '</div>';
    }

    $all_errors = validation_errors();
    if (isset($all_errors) && !empty($all_errors)) {
        echo '<div class="alert alert-danger">' . $all_errors . '</div>';
    }
    $cnt = 0;
    ?>

    <!-- Soulmate #1 section and Newest Post area start here  -->
    <div class="row event_row flter_sec_row grp_pnl_row">
        <div class="container ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row event_container">
                    <?php
                    if (isset($event_posts) && !empty($event_posts)) {
                        $cnt = count($event_posts);
                        foreach ($event_posts as $event) {
                            ?>
                            <!-- Group plan each section start here -->
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 event_post " data-id="<?php echo $event['id'] ?>">
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
                                            if($event['is_joined'])
                                            {
                                                ?>
                                                <a href='javascript:;' class='pstbtn'>Enter</a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a href='javascript:;' class='pstbtn'>Join</a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Group plan each section end here -->
                            <?php
                        }
                    } else {
                        ?>
                        <div class="">
                            <?php echo lang('No Events found.'); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Group section container end here -->
    <?php
    if ($cnt >= 4) {
        ?>
        <div class = "row">
            <div class = "container">
                <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                    <a id = "loadMore" href = "javascript:;"><?php echo lang('Load More'); ?></a>
                    <p class = "totop">
                        <a href = "#top" style = "display: inline;"><img class = "img-responsive" src = "<?php echo DEFAULT_IMAGE_PATH . "upload.png" ?>"></a>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<!-- new Event popup start here -->
<div class="modal" id="new_event">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><?php echo lang('Create New Event'); ?></b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "events/add_event"; ?>" enctype="multipart/form-data">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="usr_post_img event_user_container col-md-3">
                                <img class="img-circle img-responsive event_user" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $this->session->user['user_image'] ?>">
                                <span><label class="control-label"><?php echo $this->session->user['name']; ?></label></span>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="<?php echo lang('Event title'); ?>:" name="title" required="true">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <textarea class="form-control" name="details" placeholder="<?php echo lang("Events details and who you are looking for"); ?>"></textarea>
                        </div>
                    </div>
                    <!-- Upload images or video section start here -->
                    <div class="panel-body">
                        <div class="message alert alert-danger" style="display:none"></div>
                        <div class="upld_sec">
                            <div class="fileUpload up_img btn">
                                <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
                                <input type="file" name="uploadfile[]" class="upload" id="uploadFile" multiple="multiple"/>
                            </div>
                            <div class="fileUpload up_img btn">
                                <span><i class="fa fa-video-camera" aria-hidden="true"></i> <?php echo lang('Videos'); ?></span>
                                <input type="file" name="videofile[]" id="uploadVideo" class="upload" multiple="multiple"/>
                            </div>

                        </div>
                        <div class="image_wrapper" style="display:none">

                        </div>
                        <div class="video_wrapper" style="display:none" data-default_image="<?php echo DEFAULT_IMAGE_PATH . "video_thumbnail.png" ?>">

                        </div>
                    </div>
                    <!-- Upload images or video section end here -->
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Event start time"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <div class='input-group date' id='start_time'>
                                <input type='text' class="form-control" name="start_time" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Event end time"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <div class='input-group date' id='end_time'>
                                <input type='text' class="form-control" name="end_time" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Number of people to join"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" min="1" name="limit" required="true">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Post release distance range"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <select class='form-control' name="distance_range" required="true" style="width:15%;display:inline-block;">
                                <?php
                                for ($i = 1; $i <= 10; ++$i) {
                                    ?>
                                    <option value='<?php echo $i; ?>'><?php echo $i; ?> Mile</option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label class="control-label"><?php echo lang("From current location"); ?></label>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Approval needed"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <input type="radio" class="" style="margin-right: 5px;" name="approval" checked="checked" value="Yes"><?php echo lang("Yes"); ?>
                            <input type="radio" class="" name="approval" value="No" style="margin:0px 5px;"><?php echo lang("No"); ?>
                        </div>
                    </div>
                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" class="pstbtn" value="<?php echo lang('Create') ?>"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/moment.min.js"></script>
<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo USER_JS; ?>event/event.js"></script>