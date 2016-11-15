<?php // pr($event,1)                ?>
<div class="row cont_top_1">
    <section class="event-page">
        <div class="row event-top-section">
            <div class="col-md-11">
                <h2 class="text-center"><?php echo $event['title']; ?></h2>
                <p class="text-center event-top-details">Details : <?php echo $event['details']; ?></p>
                <div style="float:right" class="close_info">
                    Event will be closed in 5 days
                    <a class="pstbtn" href="javascript:;">Close Event</a>
                </div>
            </div>
            <div class="col-md-1"><a class="pstbtn" href="javascript:;"  data-toggle="modal" data-target="#edit_event"><?php echo lang('Edit'); ?></a></div>
        </div>
        <div class="event-bottom-section">
            <div class="col-md-4 event-left-section">
                <div class="event_content">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#notes">Notes</a></li>
                        <li><a data-toggle="tab" href="#contacts">Contacts</a></li>
                        <li><a data-toggle="tab" href="#files">Files</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="notes" class="tab-pane fade in active">
                            <div class="content_description">
                                Notes content will display here
                            </div>
                        </div>
                        <div id="contacts" class="tab-pane fade">
                            <div class="add_contact col-md-12">
                                <span class="pull-right"><button class="btn btn-icon" data-toggle="modal" data-target="#contact_add"><i class="fa fa-plus"></i>Add Contact</button></span>
                            </div>
                            <div class="content_description">

                                <?php
                                if (count($event_contact) > 0) {
                                    foreach ($event_contact as $contact) {
                                        ?>
                                        <div class="contact_ul" data-id="<?php echo $contact['id'] ?>">
                                            <div class="row">
                                                <span class="first_span col-md-4">
                                                    <a href="javascript;">
                                                        Phone Number
                                                    </a>
                                                </span>
                                                <span class="col-md-6" id="phone_no_info"><?php echo $contact['phone_no'] ?></span>
                                                <span class="col-md-2 contact-plus"><button class="btn btn-icon"><i class="fa fa-edit"></i></button></span>
                                            </div>
                                            <div class="row">
                                                <span class="first_span col-md-4">
                                                    <a href="javascript;">
                                                        Email
                                                    </a>
                                                </span>
                                                <span class="col-md-8" id="email_info"><?php echo $contact['email'] ?></span>
                                            </div>
                                            <div class="row">
                                                <span class="first_span col-md-4">
                                                    <a href="javascript;">
                                                        Others
                                                    </a>
                                                </span>
                                                <span class="col-md-8" id="others_info"><?php echo $contact['others'] ?></span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    No Contact available
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div id="files" class="tab-pane fade">
                            <div class="content_description">
                                <div class="content_images">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Images 
                                            <?php
                                            if (count($recent_images) >= 3) {
                                                ?>
                                                <span class="load_more_image pull-right">More</span>
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
                                                No Images were uploaded.
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="content_videos">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Videos 
                                            <?php
                                            if (count($recent_videos_thumb) >= 3) {
                                                ?>
                                                <span class="load_more_image pull-right">More</span>
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
                                                No Videos were uploaded.
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
                        <h4>Events Members : </h4>
                        <?php
                        foreach ($event_members as $member) {
                            ?>
                            <ul class="list-unstyled revw_ul member_ul">
                                <li>
                                    <a href="javascript;">
                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . '/' . $member['user_image'] ?>" class="smlt_usrimg1 img-circle user_chat_thumb">
                                    </a>
                                    <span><?php echo $member['name'] ?></span>
                                </li>
                            </ul>
                            <?php
                        }
                    } else {
                        ?>
                        No Member available in this group
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-8 event-right-section">
                <div class="event-detail-content">
                    <label class="control-label">Number of seats : </label><span class="no_of_seats"><?php echo $event['limit']; ?></span>
                </div>
                <div class="event-detail-content">
                    <label class="control-label">Event Start Time : </label><span class="event_start_time"><?php echo $event['start_time']; ?></span>
                </div>
                <div class="event-detail-content">
                    <label class="control-label">Event End Time : </label><span class="event_end_time"><?php echo $event['end_time']; ?></span>
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
                                                        <span><img src="http://habby/public/front/img/type_symbol2.png" title="Upload image"></span>
                                                        <input type="file" id="uploadFile" class="upload" name="uploadfile[]">
                                                    </div>
                                                </span>
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img src="http://habby/public/front/img/video_record_img.png" title="Upload video"></span>
                                                        <input type="file" class="upload" name="upload_video" id="upload_video">
                                                    </div>
                                                </span>
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img src="http://habby/public/front/img/upload.png" title="Upload file"></span>
                                                        <input type="file" id="upload_files" class="upload" name="upload_files">
                                                    </div>
                                                </span>
                                                <span class="input-group-btn upld_icnpad">
                                                    <a data-placement="top" data-toggle="popover" data-container="body" id="emogis" href="javascript:void(0);" data-original-title="" title=""><img src="http://habby/public/front/img/type_symbol3.png"></a>
                                                </span>
                                                <span class="input-group-btn">
                                                    <input type="submit" value="Send" class="submit_btn chat_btn">
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
                <h4 class="modal-title">Add Contact</h4>
            </div>
            <form name="contact_form" action="<?php echo base_url() . '/events/add_contact/' . $group_id; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" name="phone" class="form-control" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="email" class="form-control" id="email" required="">
                    </div>
                    <div class="form-group">
                        <label for="phone">Others:</label>
                        <input type="text" name="others" class="form-control" id="others" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Submit</button>
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
                <h4 class="modal-title">Edit Contact</h4>
            </div>
            <form id="contact_edit_form" name="contact_edit_form" action="<?php echo base_url() . '/events/edit_contact/'; ?>" method="post">
                <input type="hidden" value="<?php echo $group_id; ?>" name="event_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="others">Others:</label>
                        <input type="text" name="others" id="edit_others" class="form-control" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Contact edit modal over -->

<!--Topichat Popular section start here -->
<div class = "modal" id = "edit_grp">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-body">
                <div class = "panel-heading">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;
                    </button>
                    <b><?php echo lang('Edit Group'); ?></b>
                </div>
                <div class = "row pst_here_sec">
                    <!--post start here -->
                    <form class = "" role = "form" method = "post" action = "<?php echo base_url() . "topichat/update_group/" . urlencode(base64_encode($topichat['id'])); ?>" enctype = "multipart/form-data">
                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class = "panel panel-default">
                                <!--Upload images or video section start here -->
                                <div class = "panel-body1 clearfix">
                                    <div class = "topichat_txtarea">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class = "row">
                                                <div class = "form-group clearfix">
                                                    <label class = "col-lg-1 col-md-1 col-sm-2 col-xs-3 control-label"><?php echo lang('Topic'); ?> : </label>
                                                    <div class = "col-lg-11 col-md-11 col-sm-10 col-xs-9">
                                                        <textarea class = "form-control topichat_txtarea" rows = "3" id = "textArea" placeholder = "#<?php echo lang('Topic'); ?>" name = "topic_name" required = "required"><?php echo $topichat['topic_name']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class = "row">
                                                <div class = "form-group clearfix">
                                                    <label class = "col-lg-2 col-md-2 col-sm-2 col-xs-5 control-label"><?php echo lang('Number of People'); ?> :</label>
                                                    <div class = "col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                        <div class = "radio topchat_1_rdo edit_topichat_rdo">
                                                            <label>
                                                                <input type = "radio" name = "person_limit" id = "optionsRadios1" value = "-1" <?php echo ($topichat['person_limit'] == -1) ? 'checked' : '' ?>><?php echo lang('No limit'); ?></label>
                                                            <label>
                                                                <input type = "radio" name = "person_limit" id = "No_of_person" value = "Yes" <?php echo ($topichat['person_limit'] != -1) ? 'checked' : '' ?>>
                                                                <input type = "number" min="1" class = "form-control" id = "txt_No_of_person" name = "No_of_person" placeholder = "<?php echo lang('customise'); ?>" value="<?php echo ($topichat['person_limit'] != -1) ? $topichat['person_limit'] : '' ?>" <?php echo ($topichat['person_limit'] != -1) ? '' : 'disabled' ?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "panel-body">
                                    <div class = "message alert alert-danger" style = "display:none"></div>
                                    <div class = "upld_sec">
                                        <div class = "fileUpload up_img btn">
                                            <span><i class = "fa fa-picture-o" aria-hidden = "true"></i> <?php echo lang('Images');
                            ?></span>
                                            <input type="file" name="group_cover" class="upload" id="uploadFile"/>
                                        </div>
                                    </div>
                                    <div class="image_wrapper">
                                        <div class="col-sm-6">
                                            <div class="panel-heading text-center">Existing Image </div>
                                            <img class="img-responsive" src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat['group_cover'] ?>" style="margin-top:9px;"/>
                                        </div>
                                        <div class="col-sm-6 new_image_wrapper" style="display:none">
                                            <div class="panel-heading text-center">New Image </div>
                                            <div id="imagePreview"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload images or video section end here -->

                                <!-- selectng "Post to" and Original section start here -->
                                <div class="panel-body1 clearfix chat_pnl_ftr">
                                    <div class="topichat_txtarea">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <label for="select" class="col-lg-1 col-md-1 col-sm-2 col-xs-3 control-label"><?php echo lang('Note'); ?> :</label>
                                                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-9">
                                                        <textarea class="form-control topichat_txtarea" rows="3" id="textArea" name="notes"><?php echo $topichat['notes']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="submit" class="pstbtn" value="<?php echo lang('Update') ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- selectng "Post to" and Original section end here -->
                            </div>
                        </div>
                    </form>
                    <!-- post end here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Global variable for join_topichat.js -->
<script>
    data = '<?php echo json_encode($this->session->user); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    DEFAULT_IMAGE_PATH = '<?php echo DEFAULT_IMAGE_PATH; ?>';
    last_msg = '<?php echo (count($messages) > 0) ? $messages[count($messages) - 1]['id'] : 0 ?>';
    upload_path = '<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/event/join_event.js"></script>
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/topichat.js"></script>
<script type="text/javascript">
    $('.contact-plus').click(function () {
        var contact_id = $(this).parents('.contact_ul').data('id');
        $('#contact_edit_form').attr('action', $('#contact_edit_form').attr('action') + '/' + contact_id);
        $('#contact_edit_form').find('#edit_phone').val($(this).parents('.contact_ul').find('#phone_no_info').html());
        $('#contact_edit_form').find('#edit_email').val($(this).parents('.contact_ul').find('#email_info').html());
        $('#contact_edit_form').find('#edit_others').val($(this).parents('.contact_ul').find('#others_info').html());
        $('#contact_edit').modal('show');
    });
</script>