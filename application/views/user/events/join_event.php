<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMB7rGcXMQgirVaq7epH6wS_usmzpdaPw"></script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMB7rGcXMQgirVaq7epH6wS_usmzpdaPw"></script>-->
<script type="text/javascript">
    var marker;
    var map;
    var event_lat = <?php echo $event['latitude']; ?>;
    var event_long = <?php echo $event['longitude']; ?>;
    function initMap() {
        var centerOfMap = new google.maps.LatLng(event_lat, event_long);
        var myLatLng = {lat: event_lat, lng: event_long};
        var options = {
            center: centerOfMap,
            zoom: 12
        };
        map = new google.maps.Map(document.getElementById('map'), options);
        marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            draggable: true,
        });
        marker.setMap(map);
        map.setCenter(myLatLng);
    }

//Load the map when the page has finished loading.
    google.maps.event.addDomListener(window, 'load', initMap);
    google.maps.event.addDomListener(window, "resize", resizingMap());
    $('#mapModal').on('show.bs.modal', function () {
        console.log('resixe calling');
        resizeMap();
    })

// Resizing is used to open map in Bootstrap modal
    function resizeMap() {
//        console.log('resize called');
        if (typeof map == "undefined")
            return;
        setTimeout(function () {
            resizingMap();
        }, 400);
    }

    function resizingMap() {
//        console.log('resizing');
        if (typeof map == "undefined")
            return;
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    }
</script>
<style>
    .bg-image{ height: 200px;}
    .row.cont_top_1{
        bottom: 0;
        left: 0;
        position: relative;
        right: 0;
        top: 0;
        padding-top: 0;
    }
    .event-chat-start .chat_2 video{
        float:right;
    }
    .event-chat-start .chat_2 #imagePreview_msg{
        background-position: right !important;
    }
    .event-chat-start .chat_1 #imagePreview_msg{
        background-position: left !important;
    }
    .chat_1 .img_media_wrapper{
        padding-left:40px;
    }
    .event-right-section .chat_area2{
        position: relative;
        bottom: 0 !important;
        height: 500px;
        top: 0;
    }
    .topich_chat_typesec{
        background-color: #ffffff;
        border: 1px solid #dcdee3;
        bottom: 0;
        margin-bottom: 0;
        position: relative;
        top: auto;
        width: 872px;
    }
    .event-bottom-section,.event-page{
        background-color: #ffffff; 
    }
    .event-detail-content:first-child{
        height:100px;
    }
    .event-detail-content:last-child
    {
        padding-top:5px;
        padding-bottom:5px;
        border-bottom:1px solid;
    }
    @media(min-width:991px){
        .event-page{
            width: 80%;
        }
        .event-chat-start .chat_area2, .event-chat-start .topich_chat_typesec{
            max-width: 100%;
            width: 100%;
        }
    }
</style>
<div class="row cont_top_1">
    <div class="row event-top-section">
        <div class="bg-image">
            <img class="image-responsive" src="<?php echo (isset($event_media) && !empty($event_media) ? DEFAULT_EVENT_MEDIA_PATH . $event_media[0]['media'] : '') ?>">
            <div class="heading-section">
                <div class-="row">
                    <div class="col-md-12">
                        <h2 class="text-center"><?php echo $event['title']; ?></h2>
                        <?php
                        if ($event['user_id'] == $this->session->user['id']) {
                            ?>
                            <div class="edit-btn"><a class="pstbtn" href="javascript:;"  data-toggle="modal" data-target="#edit_event"><?php echo lang('Edit'); ?></a></div>
                            <?php
                        }
                        ?>

                    </div>

                </div>
            </div>
            <div style="float:right" class="close_info bg_image_close_info">
                <?php
                if ($remaining_days < 0) {
                    ?>
                    <?php echo lang('Event closed') . " " . abs($remaining_days) . " " . lang('days ago'); ?> 
                    <?php
                } else {
                    ?>
                    <?php echo lang('Event will be closed in') . " " . $remaining_days . " " . lang('days'); ?> 
                    <?php
                    if ($event['user_id'] == $this->session->user['id']) {
                        ?>
                        <a class="pstbtn close_event_btn" href="javascript:;"><?php echo lang('Close Event'); ?></a>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <section class="event-page">
        <div class="event-bottom-section">
            <div class="col-md-5 event-left-section">
                <div class="event_content">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#notes"><?php echo lang("Notes"); ?></a></li>
                        <li><a data-toggle="tab" href="#contacts"><?php echo lang("Contacts"); ?></a></li>
                        <li><a data-toggle="tab" href="#files"><?php echo lang("Files"); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="notes" class="tab-pane fade in active">
                            <div class="content_description" style="height:100%;">
                                <div class="panel panel-default" style="min-height: 85%;">
                                    <div class="panel-heading"><?php echo lang("Notes Content"); ?>
                                        <span class="pull-right event_notes_edit"><i class="fa fa-edit"></i></span>
                                        <span class="pull-right event_notes_update" style="display: none"><button class="btn btn-primary update_notes"><?php echo lang("Update"); ?></button></span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="notes_content" id="notes_content">
                                            <?php
                                            if (empty($event['notes'])) {
                                                echo lang("No Content available");
                                            } else {
                                                echo $event['notes'];
                                            }
                                            ?>
                                        </div>
                                        <div class="notes_edit" id="notes_edit" style="display: none">
                                            <textarea class="form-control" id="edited_notes"><?php echo $event['notes']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="contacts" class="tab-pane fade">
                            <div class="add_contact col-md-12">
                                <span class="pull-right"><button class="btn btn-icon" data-toggle="modal" data-target="#contact_add"><i class="fa fa-plus"></i><?php echo lang("Add Contact"); ?></button></span>
                            </div>
                            <div class="content_description">

                                <?php
                                if (count($event_contact) > 0) {
                                    foreach ($event_contact as $contact) {
                                        ?>
                                        <div class="contact_ul" data-id="<?php echo $contact['id'] ?>">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <a href="javascript;">
                                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $contact['user_image'] ?>" class="smlt_usrimg1 img-circle user_chat_thumb">
                                                    </a>
                                                </div>
                                                <span class="first_span col-md-9"><?php echo $contact['name']; ?></span>
                                                <?php
                                                if ($contact['contact_user_id'] == $this->session->user['id']) {
                                                    ?>
                                                    <span class="col-md-2 contact-plus"><button class="btn btn-icon"><i class="fa fa-edit"></i></button></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="row">
                                                <span class="first_span col-md-4 col-md-offset-1">
                                                    <a href="javascript;">
                                                        <?php echo lang("Phone Number"); ?>
                                                    </a>
                                                </span>
                                                <span class="col-md-5" id="phone_no_info"><?php echo $contact['phone_no'] ?></span>

                                            </div>
                                            <div class="row">
                                                <span class="first_span col-md-4 col-md-offset-1">
                                                    <a href="javascript;">
                                                        <?php echo lang("Email"); ?>
                                                    </a>
                                                </span>
                                                <span class="col-md-7" id="email_info"><?php echo $contact['email'] ?></span>
                                            </div>
                                            <div class="row">
                                                <span class="first_span col-md-4 col-md-offset-1">
                                                    <a href="javascript;">
                                                        <?php echo lang("Others"); ?>
                                                    </a>
                                                </span>
                                                <span class="col-md-7" id="others_info"><?php echo $contact['others'] ?></span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <?php echo lang("No Contact available"); ?>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div id="files" class="tab-pane fade">
                            <div class="content_description">
                                <div class="content_images">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><?php echo lang("Images"); ?> 
                                            <?php
                                            if (count($recent_images) >= 3) {
                                                ?>
                                                <span class="load_more_image cursor_hand pull-right"><?php echo lang("More"); ?></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                            if (count($recent_images) > 0) {
                                                foreach ($recent_images as $image) {
                                                    ?>
                                                    <a class="fancybox col-sm-4" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" data-fancybox-group="gallery1">
                                                        <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive topi_image"/>
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <?php echo lang("No Images were uploaded."); ?>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="content_videos">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><?php echo lang("Videos"); ?> 
                                            <?php
                                            if (count($recent_videos_thumb) >= 3) {
                                                ?>
                                                <span class="load_more_video cursor_hand pull-right"><?php echo lang("More"); ?></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                            if (count($recent_videos_thumb) > 0) {
                                                foreach ($recent_videos_thumb as $key => $video) {
                                                    ?>
                                                    <a class="fancybox col-sm-4" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $recent_videos[$key]; ?>" target="_blank" data-fancybox-group="gallery1">
                                                        <div class="video-w-icon">
                                                            <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $video; ?>" class="img-responsive topi_image" />
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <?php echo lang("No Videos were uploaded."); ?>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="content_files">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><?php echo lang("Files"); ?> 
                                            <?php
                                            if (count($recent_shared_files) >= 3) {
                                                ?>
                                                <span class="load_more_file cursor_hand pull-right"><?php echo lang("More"); ?></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                            if (count($recent_shared_files) > 0) {
                                                foreach ($recent_shared_files as $file) {
                                                    ?>
                                                    <a class="col-sm-4" href="<?php echo base_url() . "user/download_file/" . $file ?>" target="_blank" data-fancybox-group="gallery1">
                                                        <div class="">
                                                            <img src="<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>" class="img-responsive topi_image" />
                                                            <span class="event_file_name"><?php echo $file ?></span>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <?php echo lang("No Files were uploaded."); ?>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event_members">
                    <?php
                    if (count($event_members) > 0) {
                        ?>
                        <h4><?php echo lang("Events Members"); ?> : </h4>
                        <?php
                        foreach ($event_members as $member) {
                            ?>
                            <ul class="list-unstyled revw_ul member_ul">
                                <li>
                                    <a href="<?php echo ($member['id'] == $this->session->user['id']) ? base_url() . 'home/profile' : base_url() . "user_profile/" . $member['id'] ?>">
                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . '/' . $member['user_image'] ?>" class="smlt_usrimg1 img-circle user_chat_thumb">
                                        <span><?php echo $member['name'] ?></span>
                                    </a>
                                </li>
                            </ul>
                            <?php
                        }
                    } else {
                        ?>
                        <?php echo lang("No Member available in this group"); ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-7 event-right-section">
                <div class="details">
                    <div class="event-detail-content">
                        <label class="control-label"><?php echo lang("Details"); ?> :  <span><?php echo $event['details'] ?></span></label>
                    </div>
                    <div class="event-detail-content">
                        <?php
                        $location = $event['location_name'];
                        ?>
                        <label class="control-label"><?php echo lang("Location"); ?> : </label><span class="location"><?php echo (isset($location) && !empty($location)) ? $location : 'No Lcation found'; ?></span><a href="javascript:;" class="map_btn pstbtn">map</a>
                    </div>
                    <div class="event-detail-content">
                        <label class="control-label"><?php echo lang("Event Time"); ?> : </label><span class="event_start_time"><?php echo $event['start_time']; ?> </span> to <span class="event_end_time"><?php echo $event['end_time']; ?></span>
                    </div>
                </div>
                <div class="row event-chat-start">
                    <!-- Chat area section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                        <div class="chat_area2 topichat_msg_sec">
                            <?php $this->load->view('user/partial/events/load_more_msg'); ?>
                        </div>
                    </div>
                    <!-- Chat area section end here -->

                    <!-- Type Chat section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="topich_chat_typesec">

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="topic_textarea">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div contenteditable="true" class="form-control" hidefocus="true" id="message_div"></div>
                                                <input type="hidden" class="form-control" name="message" id="message">
                                                <!--<span class="input-group-btn upld_icnpad">
                                                    <a href="#"><img src="http://habby/public/front/img/type_symbol1.png"></a>
                                                </span>-->
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img src="<?php echo DEFAULT_IMAGE_PATH . "type_symbol2.png"; ?>" title="Upload image"></span>
                                                        <input type="file" id="uploadFile" class="upload" name="uploadfile[]">
                                                    </div>
                                                </span>
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img src="<?php echo DEFAULT_IMAGE_PATH . "video_record_img.png"; ?>" title="Upload video"></span>
                                                        <input type="file" class="upload" name="upload_video" id="upload_video">
                                                    </div>
                                                </span>
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img src="<?php echo DEFAULT_IMAGE_PATH . "upload.png"; ?>" title="Upload file"></span>
                                                        <input type="file" id="upload_files" class="upload" name="upload_files">
                                                    </div>
                                                </span>
                                                <span class="input-group-btn upld_icnpad">
                                                    <a data-placement="top" data-toggle="popover" data-container="body" id="emogis" href="javascript:void(0);" data-original-title="" title=""><img src="<?php echo DEFAULT_IMAGE_PATH . "type_symbol3.png"; ?>"></a>
                                                </span>
                                                <span class="input-group-btn">
                                                    <input type="submit" value="<?php echo lang("Send"); ?>" class="submit_btn chat_btn">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Type area end here -->

                        </div>
                    </div>
                    <!-- Type Chat section end here -->
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </section>
</div>

<!-- Contact add modal -->
<div id="contact_add" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang("Add Contact"); ?></h4>
            </div>
            <form name="contact_form" action="<?php echo base_url() . '/events/add_contact/' . $group_id; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone"><?php echo lang("Phone Number"); ?>:</label>
                        <input type="text" name="phone" class="form-control" id="phone" pattern="^[0-9\+\-\(\)]{7,15}$" title="Enter Phone number only in numeric value. '+','-','(' and ')' are allowed.minimum 7 and maximum 15 characters are allowed" required/>
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo lang("Email"); ?>:</label>
                        <input type="email" name="email" class="form-control" id="email" required="">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?php echo lang("Others"); ?>:</label>
                        <input type="text" name="others" class="form-control" id="others" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
                    <button type="submit" class="btn btn-default"><?php echo lang("Submit"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Contact add modal over -->

<!-- Contact edit modal -->
<div id="contact_edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang("Edit Contact"); ?></h4>
            </div>
            <form id="contact_edit_form" name="contact_edit_form" action="<?php echo base_url() . '/events/edit_contact/'; ?>" method="post">
                <input type="hidden" value="<?php echo $group_id; ?>" name="event_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone"><?php echo lang("Phone Number"); ?>:</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control" required pattern="^[0-9\+\-\(\)]{7,15}$" title="Enter Phone number only in numeric value. '+','-','(' and ')' are allowed.minimum 7 and maximum 15 characters are allowed"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo lang("Email"); ?>:</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="others"><?php echo lang("Others"); ?>:</label>
                        <input type="text" name="others" id="edit_others" class="form-control" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
                    <button type="submit" class="btn btn-default"><?php echo lang("Submit"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Contact edit modal over -->

<!--Topichat Popular section start here -->
<div class = "modal" id = "edit_event">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <form class="" role="form" method="post" action="<?php echo base_url() . "events/update_event/" . $event['id']; ?>" enctype="multipart/form-data">
                <div class = "modal-body">
                    <div class = "panel-heading">
                        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;
                        </button>
                        <b><?php echo lang('Edit Group'); ?></b>
                    </div>
                    <div class ="row pst_here_sec">
                        <!--post start here -->

                        <div class="form-group clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="usr_post_img event_user_container col-md-3">
                                    <img class="img-circle img-responsive event_user" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $this->session->user['user_image'] ?>">
                                    <span><label class="control-label"><?php echo $this->session->user['name']; ?></label></span>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php echo $event['title']; ?>" placeholder="<?php echo lang('Event title'); ?>:" name="title" required="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea class="form-control" name="details" placeholder="<?php echo lang("Events details and who you are looking for"); ?>"><?php echo $event['details']; ?></textarea>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="panel-heading">
                                <?php echo lang("Existing media"); ?>
                            </div>
                            <div class="">
                                <?php
                                if (count($event_media) > 0) {
                                    foreach ($event_media as $media) {
                                        if ($media['media_type'] == "image") {
                                            ?>
                                            <div class="col-md-4 col-sm-6 col-xs-12 media_wrapper">
                                                <img src="<?php echo DEFAULT_EVENT_MEDIA_PATH . '/' . $media['media']; ?>" style="max-width: 100%;"/>
                                            </div>
                                            <?php
                                        } else if ($media['media_type'] == "video") {
                                            ?>
                                            <div class="col-md-4 col-sm-6 col-xs-12 media_wrapper">
                                                <video controls class="img-responsive center-block myvideo" >
                                                    <source src="<?php echo DEFAULT_EVENT_MEDIA_PATH . $media['media']; ?>"></source>
                                                    <?php echo lang("Seems like your browser doesn't support video tag."); ?>
                                                </video>
                                            </div>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <?php echo lang("No media added."); ?>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Upload images or video section start here -->
                        <div class="panel-body">
                            <div class="message alert alert-danger" style="display:none"></div>
                            <div class="upld_sec">
                                <div class="fileUpload up_img btn">
                                    <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
                                    <input type="file" name="uploadfile[]" class="upload" id="uploadFile"/>
                                </div>
                                <!--                                <div class="fileUpload up_img btn">
                                                                    <span><i class="fa fa-video-camera" aria-hidden="true"></i> <?php echo lang('Videos'); ?></span>
                                                                    <input type="file" name="videofile[]" id="uploadVideo" class="upload" multiple="multiple"/>
                                                                </div>-->
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
                                    <input type='text' class="form-control" value="<?php echo $event['start_time']; ?>" name="start_time" required/>
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
                                    <input type='text' class="form-control" name="end_time" value="<?php echo $event['end_time'] ?>" required/>
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
                                <input type="number" class="form-control" min="1" name="limit" value="<?php echo $event['limit']; ?>" required="true">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-3">
                                <label class="control-label"><?php echo lang("Approval needed"); ?></label>
                            </div>
                            <div class="col-md-9">
                                <input type="radio" class="" style="margin-right: 5px;" name="approval" <?php echo ($event['approval_needed']) ? 'checked' : '' ?> value="Yes"><?php echo lang("Yes"); ?>
                                <input type="radio" class="" name="approval" value="No" <?php echo ($event['approval_needed']) ? '' : 'checked' ?> style="margin:0px 5px;"><?php echo lang("No"); ?>
                            </div>
                        </div>
                        <!-- post end here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo lang("Update"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Load more Image popup -->
<div id="load_more_image" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang("More Images"); ?></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Load more popup -->
<div id="load_more_video" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang("More Videos"); ?></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Load more popup -->
<div id="load_more_file" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang("More Files"); ?></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for display map -->
<!-- Modal -->
<div id="mapModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang("Event Location"); ?></h4>
            </div>
            <div class="modal-body">
                <div id="map" style="height:250px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
            </div>
        </div>

    </div>
</div>
<!-- Map Modal over-->
<?php
$myuserdata = array(
    'id' => $this->session->user['id'],
    'name' => $this->session->user['name'],
    'user_image' => $this->session->user['user_image'],
    'email' => $this->session->user['email']
);
//    $myuserdata['bio'] = str_replace(array("\r\n","\n"),"\\\\n",$myuserdata['bio']);
?>
<!-- Global variable for join_topichat.js -->
<script>
    data = '<?php echo json_encode($myuserdata); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    DEFAULT_IMAGE_PATH = '<?php echo DEFAULT_IMAGE_PATH; ?>';
    last_msg = '<?php echo (count($messages) > 0) ? $messages[count($messages) - 1]['id'] : 0 ?>';
    upload_path = '<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/moment.min.js"></script>
<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo USER_JS ?>/event/join_event.js"></script>
<script type="text/javascript">
    $('.contact-plus').click(function () {
        var contact_id = $(this).parents('.contact_ul').data('id');
        $('#contact_edit_form').attr('action', $('#contact_edit_form').attr('action') + '/' + contact_id);
        $('#contact_edit_form').find('#edit_phone').val($(this).parents('.contact_ul').find('#phone_no_info').html());
        $('#contact_edit_form').find('#edit_email').val($(this).parents('.contact_ul').find('#email_info').html());
        $('#contact_edit_form').find('#edit_others').val($(this).parents('.contact_ul').find('#others_info').html());
        $('#contact_edit').modal('show');
    });
    
    $('.event_notes_edit').click(function () {
        $(this).hide();
        $('.event_notes_update').show();
        $('#notes_content').hide();
        $('#notes_edit').show();
    });

    $('.update_notes').click(function () {
        $('.event_notes_update').hide();
        $('.event_notes_edit').show();
        if ($('#edited_notes').val() != "")
        {
            $('#notes_content').html($('#edited_notes').val());
        } else
        {
            $('#notes_content').html(no_content);
        }
        $.ajax({
            url: base_url + '/events/update_notes/' + group_id,
            data: 'notes=' + $('#edited_notes').val(),
            method: 'post',
            success: function (str) {

            }
        });
        $('#notes_edit').hide();
        $('#notes_content').show();
    });

    $('#start_time').datetimepicker({
        locale: 'en',
        useCurrent: false,
        format: 'YYYY-MM-DD HH:mm:SS'
    });
    $('#end_time').datetimepicker({
        locale: 'en',
        useCurrent: false,
        format: 'YYYY-MM-DD HH:mm:SS'
    });

    $("#start_time").on("dp.hide", function(e) {
        $('#end_time').data("DateTimePicker").minDate(e.date);
    });
    $("#end_time").on("dp.hide", function (e) {
        $('#start_time').data("DateTimePicker").maxDate(e.date);
    });

    // Image uploading script
    $("#edit_event").on("change", "#uploadFile", function ()
    {
        $('.message').html();
        $('.image_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html(no_selected_file);
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        var i = 0;
        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                if (/^image/.test(files[key].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        // $('#imagePreview').addClass('imagePreview');
                        $('.message').hide();
                        $('.image_wrapper').show();
                        $('.image_wrapper').append("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                        $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                        ++i;
                    }
                } else
                {
                    this.files = '';
                    $('.message').html(proper_image);
                    $('.message').show();
                }
            }
        }
    });

    $('.load_more_image').click(function () {
        $('#load_more_image').modal('show');
        $.ajax({
            url: base_url + '/events/load_more_images/' + group_id,
            success: function (str) {
                $('#load_more_image').find('.modal-body').html(str);
            }
        });
    });

    $('.load_more_video').click(function () {
        $('#load_more_video').modal('show');
        $.ajax({
            url: base_url + '/events/load_more_videos/' + group_id,
            success: function (str) {
                $('#load_more_video').find('.modal-body').html(str);
            }
        });
    });

    $('.load_more_file').click(function () {
        $('#load_more_file').modal('show');
        $.ajax({
            url: base_url + '/events/load_more_files/' + group_id,
            success: function (str) {
                $('#load_more_file').find('.modal-body').html(str);
            }
        });
    });

    $('.close_event_btn').click(function () {
        $.ajax({
            url: base_url + 'events/close_event/' + group_id,
            success: function (str) {
                if (str != 0)
                {
                    $('.close_info').html(str);
                }
            }
        });
    });

    $('.map_btn').click(function () {
        $('#mapModal').modal('show');
        resizeMap();
    });

</script>