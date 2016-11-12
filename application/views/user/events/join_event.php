<?php // pr($event,1)    ?>
<div class="row cont_top_1">
    <div class="container topic_2cntnr mble_pd_0">
        <div class="right_lg_sectopic">
            <!-- Note and topic edit area start here -->
            <div class="tittl_sec_lgrow">
                <div class="tittl_sec_lg">
                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-12">
                        <div class="tittl_sec">
                            <p><?php echo $event['title']; ?> <span></span></p>
                            <p>Details : <?php echo $event['details']; ?></p>

                        </div>
                        <div class="close_info" style="float:right">
                            Event will be closed in 5 days
                            <a href="javascript:;" class="pstbtn">Close Event</a>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                        <div class="tittl_sec2">
                            <p class="event_p">
                            <!--<button class="btn" data-toggle="model" data-target="#edit_grp"><?php echo lang('Edit'); ?></button>-->
                                <a href="javascript:;" class="pstbtn" data-toggle="modal" data-target="#edit_event"><?php echo lang('Edit'); ?></a>

                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Note and topic edit area end here -->

            <!-- Chat area and tupe section start here -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
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
                                <div class="content_description">
                                    Contact content will display here
                                </div>
                            </div>
                            <div id="files" class="tab-pane fade">
                                <div class="content_description">
                                    Files content will display here
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event_members">
                        <?php
                        if (count($event_members) > 0) {
                            ?>
                            <h3>Events Members : </h3>
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
                <div class="col-lg-8 col-md-8 col-sm-12">

                    <div class="col-lg-12 event_details">
                        <div class="">
                            <label class="control-label">Number of seats : </label><span class="no_of_seats"><?php echo $event['limit']; ?></span>
                        </div>
                        <div class="">
                            <label class="control-label">Event Start Time : </label><span class="event_start_time"><?php echo $event['start_time']; ?></span>
                        </div>
                        <div class="">
                            <label class="control-label">Event End Time : </label><span class="event_end_time"><?php echo $event['end_time']; ?></span>
                        </div>
                    </div>

                    <!-- Chat area section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                        <div class="chat_area2 event_msg_sec" style="top:270px;width:864px;bottom:42px">
<?php $this->load->view('user/partial/events/load_more_msg') ?>
                        </div>  
                    </div>
                    <!-- Chat area section end here -->

                    <!-- Type Chat section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="topich_chat_typesec">

                            <!-- Type area start here -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="topic_textarea">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div contenteditable="true" id='message_div' hidefocus="true" class="form-control"></div>
                                                <input type="hidden" id='message' name='message' class="form-control"/>
                                                <!--<span class="input-group-btn upld_icnpad">
                                                    <a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol1.png"></a>
                                                </span>-->
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img title="Upload image" src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol2.png"></span>
                                                        <input type="file" name="uploadfile[]" class="upload" id="uploadFile"/>
                                                    </div>
                                                </span>
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img title="Upload video" src="<?php echo DEFAULT_IMAGE_PATH; ?>video_record_img.png"></span>
                                                        <input type="file" id="upload_video" name="upload_video" class="upload" id="uploadFile"/>
                                                    </div>
                                                </span>
                                            <!--    <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img title="Upload file" src="<?php echo DEFAULT_IMAGE_PATH; ?>upload.png"></span>
                                                        <input type="file" name="upload_file" class="upload" id="uploadFile"/>
                                                    </div>
                                                </span>-->
                                                <span class="input-group-btn upld_icnpad">
                                                    <a href="javascript:void(0);"  id="emogis" data-container="body" data-toggle="popover" data-placement="top"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a>

                                                    <!-- 
                                                    <a href="#" data-toggle="modal" data-target="#emogis"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a> -->
                                                </span>
                                                <span class="input-group-btn">
                                                    <input class="submit_btn chat_btn" type="submit" value="<?php echo lang('Send'); ?>">
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
            <!-- Chat area and tupe section end here -->
        </div>
    </div>
</div>
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