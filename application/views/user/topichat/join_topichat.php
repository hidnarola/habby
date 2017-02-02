<div class="row cont_top_1 join_topichat_unique">
    <div class="container topic_2cntnr mble_pd_0">
        <p class="mr_p visible-xs" >
            <a href="<?php echo base_url() . "topichat/media/" . $Id ?>" class="pstbtn" id="more_rate"><?php echo lang('Files'); ?></a>
        </p>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 topichat_left_sec">
            <div class="rate_lg_sec topichat_msg_sec">

                <!-- Top rate section start here -->
                <div class="panel panel-default top_rate_panel votepnl">

                    <!-- Top rate heading section start here -->
                    <div class="panel-heading">
                        <b><?php echo lang('TOP RATE'); ?></b>
                        <span style="float: right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </div>
                    <!-- Top rate heading section end here -->

                    <?php
                    if ($top_rank_post) {
                        foreach ($top_rank_post as $post) {
                            ?>
                            <div class="panel-body">
                                <div class="row vote_row topichat_media_post" data-chat_id="<?php echo $post['id'] ?>">
                                    <!-- vote section start here -->
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 vot1">
                                        <div id="field" class="topichat_media_rank">
                                            <button type="button" id="add" class="add add_btn smlr_btn">
                                                <img src="<?php
                                                echo DEFAULT_IMAGE_PATH;
                                                echo (($post['is_ranked'] && $post['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                                ?>"/>
                                            </button>
                                            <span class="rank_rate"><?php echo $post['positive_rank'] - $post['negetive_rank']; ?></span>
                                            <button type="button" id="sub" class="sub smlr_btn">
                                                <img src="<?php
                                                echo DEFAULT_IMAGE_PATH;
                                                echo (($post['is_ranked'] && $post['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                                ?>"/>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- vote section end here -->
                                    <div class="col-lg-2 col-md-1 col-sm-2 col-xs-2 pad_lft0 vot2">
                                        <div class="topc_2prflicn">
                                            <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $post['user_image']; ?>" class="img-responsive center-block top_rank_profile">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10 vot3">
                                        <?php
                                        if ($post['media_type'] == "image") {
                                            ?>
                                            <a data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $post['media'] ?>" data-type="image" >
                                                <!--class="fancybox" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $post['media']; ?>" data-fancybox-group="gallerytopichat1"-->
                                                <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $post['media']; ?>" class="img-responsive center-block ">
                                            </a>
                                            <?php
                                        } else if ($post['media_type'] == "video") {
                                            ?>
                                            <a data-toggle="modal" data-target="#mediaModal" class="video-w-icon" data-image="<?php echo $post['media'] ?>" data-type="video" >
                                                <!--class="video-w-icon fancybox " target="_blank" href="<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>" data-fancybox-group="gallerytopichat1"-->
                                                <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . explode(".", $post['media'])[0] . "_thumb.png"; ?>" class="img-responsive center-block ">
                                            </a>
                                            <?php
                                        } else if ($post['media_type'] == "files") {
                                            ?>
                                            <a class="files" href="<?php echo base_url() . "user/download_file/" . $post['media'] ?>" data-fancybox-group="gallerytopichat1">
                                                <img src="<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>" class="img-responsive center-block file_icon">
                                                <span class="filename"><?php echo $post['media'] ?></span>
                                            </a>
                                            <?php
                                        } else if ($post['media_type'] == "links") {
                                            $media = json_decode($post['media']);
                                            ?>
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
                                                        <!--<p><?php echo (isset($media->description)) ? $media->description : ""; ?></p>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class='panel-body'>
                            <div class='col-sm-12'>
                                <?php echo lang('No top rated post found.'); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- Top rate vote panel body section start here -->

                    <!-- Top rate vote panel body section end here -->

                </div>

                <!-- Top rate section start here -->

                <!--All files section start here--> 
                <?php
                ?>
                <div class="panel panel-default popular_img_sec">
                    <div class="panel-heading"><b><?php echo lang('ALL FILES'); ?></b><span style="float: right"><i class="fa fa-angle-right" aria-hidden="true"></i></span></div>
                    <div class="panel-heading shrd_topc_sec"><b><?php echo lang('Shared'); ?></b> <span style="float: right"><a href="<?php echo base_url() . "topichat/media/" . $Id ?>"><b><?php echo lang('More'); ?></b></a></span></div>
                    <div class="panel-body">
                        <div class="topic_frame">
                            <?php
                            if (isset($recent_links) && !empty($recent_links)) {
                                foreach ($recent_links as $key => $recent_link) {
                                    $media = json_decode($recent_link['media']);
                                    if ($recent_link['youtube_video'] != null) {
                                        ?>
                                        <div class = "fileshare">
                                            <?php
                                            if (isset($media->images[0]->url) && $media->images[0]->url != null) {
                                                ?>
                                                <div class="videoPreview" data-toggle="modal" data-target="#linkModal" data-type="links" data-id='<?php echo $recent_link['id']; ?>'>
                                                    <img class = "thumb" src = "<?php echo $media->images[0]->url ?>"></img>
                                                    <div class="youtube-icon"><img src="<?php echo DEFAULT_IMAGE_PATH ?>youtube-icon.png"/></div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
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
                                                    <!--<p><?php echo (isset($media->description)) ? $media->description : ""; ?></p>-->
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <div class='col-sm-12'>
                                    <?php echo lang('No shared link available.'); ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php ?>
                <!--All files section end here--> 


                <!-- popular image and video section start here -->
                <div class="panel panel-default popular_img_sec">

                    <div class="panel-heading"><b><?php echo lang('UPLOAD'); ?></b> <span style="float: right"><a href="<?php echo base_url() . "topichat/media/" . $Id ?>"><b><?php echo lang('More'); ?></b></a></span></div>

                    <?php ?>
                    <div class="panel-heading shrd_topc_sec"><b><?php echo lang('Videos'); ?></b></div>

                    <div class="panel-body">
                        <ul class="photo_vdo_ul topichat_video_ul">
                            <?php
                            if (count($recent_videos) > 0) {
                                foreach ($recent_videos_thumb as $key => $image) {
                                    ?>
                                    <li class="topi_image_li">
                                        <a data-toggle="modal" data-target="#mediaModal" class="video-w-icon" data-image="<?php echo $recent_videos[$key] ?>" data-type="video" >
                                            <!--href="<?php // echo DEFAULT_CHAT_IMAGE_PATH . $recent_videos[$key];                                                        ?>"-->
                                            <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive topi_image">
                                        </a>

                                    </li>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class='col-sm-12'><?php echo lang("No Videos were uploaded."); ?></div>
                                <?php
                            }
                            ?>
                        </ul>

                    </div>
                    <?php ?>

                    <?php ?>
                    <div class="panel-heading shrd_topc_sec brdr_top"><b><?php echo lang('Images'); ?></b> </div>

                    <div class="panel-body">
                        <ul class="photo_vdo_ul topichat_image_ul">
                            <?php
                            if (count($recent_images) > 0) {
                                foreach ($recent_images as $image) {
                                    ?>
                                    <li class="topi_image_li">
                                        <a data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $image ?>" data-type="image" >
                                            <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive topi_image">
                                        </a>
                                    </li>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class='col-sm-12'><?php echo lang("No Images were uploaded."); ?></div>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php ?>
                </div>
                <!-- popular image and video section End here -->
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pad_lft0 topic_right_lg_sec">
            <div class="right_lg_sectopic">
                <?php
                $message = $this->session->flashdata('message');
                if (!empty($message) && isset($message)) {
                    ($message['class'] != '') ? $message['class'] : '';
                    echo '<div class="' . $message['class'] . '">' . $message['message'] . '</div>';
                }
                ?>
                <!-- Note and topic edit area start here -->
                <div class="tittl_sec_lgrow">
                    <div class="tittl_sec_lg">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="tittl_sec">
                                <p><?php echo $topichat['topic_name']; ?> <span></span></p>
                                <p class="topichat_notes"><?php echo lang('Note') . " :" . $topichat['notes']; ?> </p>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="tittl_sec2">
                                <p class="topchat_p">
                                    <a href="javascript:;" class="pstbtn" data-toggle="modal" data-target="#edit_grp"><?php echo lang('Edit'); ?></a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="tittl_sec2">
                                <p class="topchat_p">
                                    <a href="javascript:;" id="topic_group_subscribe" class="pstbtn" data-is_subscribe="<?php echo ($is_subscribed) ? 'yes' : 'no'; ?>"><?php echo ($is_subscribed) ? lang('Unsubscribe') : lang('Subscribe'); ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Note and topic edit area end here -->

                <!-- Chat area and tupe section start here -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                        <div class="chat_area2 topichat_msg_sec chat_area_updated">
                            <div class="text-right chat_area_updated-top">
                                <label>Short By:</label>
                                <select class="form-control">
                                    <option>1</option>
                                    <option>1</option>
                                    <option>1</option>
                                </select>
                            </div>
                            
                            <div class="total_views_wrapper">
                                <div class="total_views_inner">
                                    <?php $this->load->view('user/partial/topichat/load_more_msg') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Type Chat section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mainchatarea">
                        <div class="topich_chat_typesec">
                            <!-- Smily icon and profile secton start here -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="chat-area-text-box">
                                        <input class="text" id="link_title" name="link_title" placeholder="type title description" class="form-control">
                                    </div>
                                    <div class="topic_prfle_icon_sec topc_link_sharesec">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topic_textarea pad_lft_rit0">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><a href="<?php echo base_url() . "home/profile" ?>"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image'] ?>" class="user_chat_thumb"></a></span>	
                                                    <input type="text" class="form-control" placeholder="Copy Link Here" id="url" name="url">
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="https://www.google.co.in/" target="_blank"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>google_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="https://www.youtube.com/" target="_blank"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>youtube_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="https://plus.google.com/" target="_blank"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>google_plus_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="https://twitter.com/" target="_blank"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>twitter_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <input class="chat_btn share_btn" type="submit" value="<?php echo lang('Share'); ?>">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="topic_prfle_icon_sec-bottom">
                                        <div class="chat-window-wrapper">
                                            <div class="fb-chat-window">
                                                <div class="panel panel-chat mini">
                                                    <div class="panel-heading">
                                                        <a href="#" class="chatMinimize" onclick="return false"><span>Chats</span></a>
                                                        <!--<a href="#" class="chatClose" onclick="return false"><i class="glyphicon glyphicon-remove"></i></a> -->
                                                        <div class="clearFix"></div>
                                                    </div>
                                                    <div class="panel-body" style="height:0;display: none">
                                                        
                                                        <?php $this->load->view('user/partial/topichat/load_more_text_msg'); ?>
                                                        <div class="clearFix"></div>
                                                    </div>
                                                    <div class="panel-footer" style="height:0;display: none">
                                                        <div contenteditable="true" id='message_div' hidefocus="true" class="form-control"></div>
                                                 <input type="hidden" id='message' name='message' class="form-control"/>
                                                 <span class="input-group-btn-span">
                                                 <span class="input-group-btn upld_icnpad">
                                                     <a href="javascript:void(0);"  id="emogis" data-container="body" data-toggle="popover" data-placement="top"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a>
                                                 </span>
                                                 <span class="input-group-btn">
                                                     <input class="submit_btn chat_btn" type="submit" value="<?php echo lang('Send'); ?>">
                                                 </span>
                                                 </span>
                                                    </div>
                                                </div>
                                                <!-- <a class="chat-window-link">Chats</a> -->
                                            </div>
                                            <div class="topic_prfle_icon_sec-bottom-upload-control" data-toggle="modal" data-target="#upload_file_section">
                                                <span class="">Upload Files</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Smily icon and profile secton end here -->

                            <!-- Type area start here -- >
                            <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="topic_textarea">
                                         <div class="form-group">
                                             <div class="input-group">
                                                 <div contenteditable="true" id='message_div' hidefocus="true" class="form-control"></div>
                                                 <input type="hidden" id='message' name='message' class="form-control"/>

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
                                                 <span class="input-group-btn upld_icnpad">
                                                     <div class="fileUpload up_img btn">
                                                         <span><img title="Upload file" src="<?php echo DEFAULT_IMAGE_PATH; ?>upload.png"></span>
                                                         <input type="file" name="upload_files" class="upload" id="upload_files"/>
                                                     </div>
                                                 </span>
                                                 <span class="input-group-btn upld_icnpad">
                                                     <a href="javascript:void(0);"  id="emogis" data-container="body" data-toggle="popover" data-placement="top"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a>
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
                <!-- Chat area and tupe section end here -->
            </div>
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
                    <form class = "update_form" role = "form" method = "post" action = "<?php echo base_url() . "topichat/update_group/" . urlencode(base64_encode($topichat['id'])); ?>" enctype = "multipart/form-data">
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
                                                        <textarea class = "form-control topichat_txtarea" rows = "3" id = "topic_name" placeholder = "#<?php echo lang('Topic'); ?>" name = "topic_name" required = "required"><?php echo $topichat['topic_name']; ?></textarea>
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
                                                                <input type = "number" min="<?php echo $joined_user; ?>" class = "form-control" id = "txt_No_of_person" name = "No_of_person" placeholder = "<?php echo lang('customise'); ?>" value="<?php echo ($topichat['person_limit'] != -1) ? $topichat['person_limit'] : '' ?>" <?php echo ($topichat['person_limit'] != -1) ? '' : 'disabled' ?>>
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
                                            <div class="panel-heading text-center"><?php echo lang('Existing Image') ?> </div>
                                            <img class="img-responsive" src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat['group_cover'] ?>" style="margin-top:9px;"/>
                                        </div>
                                        <div class="col-sm-6 new_image_wrapper" style="display:none">
                                            <div class="panel-heading text-center"><?php echo lang('New Image') ?> </div>
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
                                                        <textarea class="form-control topichat_txtarea" rows="3" id="notes" name="notes"><?php echo $topichat['notes']; ?></textarea>
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
<div class="modal fade in" id="mediaModal" role="dialog">
    <div class="modal-dialog topichat_media_modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="usr_post_img usr_post_img_modal">
                            <img class="img-circle img-responsive topichat_media_user" src="">
                        </div>
                        <div class="topichat_media_details">

                        </div>
                        <div class="event_media event_media_modal topichat_msg_sec">
                            <div class="row topichat_media_post topichat_media_post_modal" data-chat_id="123">
                                <div class="col-md-1 rank_button_modal">
                                    <div id="field" class="topichat_media_rank topichat_media_rank_modal">

                                    </div>
                                </div>
                                <div class="col-md-11 topichat_media_popup">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="usr_post_img user_post_image_right">

                        </div>
                        <div class="row">

                            <!-- Chat area section start here -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                                <div class="chat_area2 topichat_msg_sec topichat_msg_sec_modal">                                    
                                </div>
                            </div>
                            <!-- Chat area section end here -->

                            <!-- Type Chat section start here -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="topich_chat_typesec topich_chat_typesec_modal">

                                    <!-- Type area start here -->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="topic_textarea">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><a href="<?php echo base_url() . "home/profile" ?>"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image'] ?>" class="user_chat_thumb"></a></span>
                                                        <div contenteditable="true" id="message_div" hidefocus="true" class="form-control"></div>
                                                        <input type="hidden" id="message" name="message" class="form-control">
                                                        <span class="input-group-btn upld_icnpad">
                                                            <a href="javascript:void(0);" id="emogis" data-container="body" data-toggle="popover" data-placement="top" data-original-title="" title=""><img src="<?php echo DEFAULT_IMAGE_PATH; ?>/type_symbol3.png"></a>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <input class="submit_btn chat_btn" type="submit" value="<?php echo lang('Send') ?>">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close') ?></button>
            </div>   
        </div>


    </div>
</div>
<div class="modal fade in" id="linkModal" role="dialog">
    <div class="modal-dialog topichat_media_modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="usr_post_img usr_post_img_modal">
                            <img class="img-circle img-responsive topichat_media_user" src="">
                        </div>
                        <div class="topichat_media_details">

                        </div>
                        <div class="event_media event_media_modal topichat_msg_sec">
                            <div class="row topichat_media_post topichat_media_post_modal" data-chat_id="123">
                                <div class="col-md-1 rank_button_modal">
                                    <div id="field" class="topichat_media_rank topichat_media_rank_modal">

                                    </div>
                                </div>
                                <div class="col-md-11 topichat_media_popup">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="usr_post_img user_post_image_right">


                        </div>
                        <div class="row">

                            <!-- Chat area section start here -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                                <div class="chat_area2 topichat_msg_sec topichat_msg_sec_modal">                                    
                                </div>
                            </div>
                            <!-- Chat area section end here -->

                            <!-- Type Chat section start here -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="topich_chat_typesec topich_chat_typesec_modal">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="topic_textarea">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><a href="<?php echo base_url() . "home/profile" ?>"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image'] ?>" class="user_chat_thumb"></a></span>
                                                        <div contenteditable="true" id="message_div" hidefocus="true" class="form-control"></div>
                                                        <input type="hidden" id="message" name="message" class="form-control">
                                                        <span class="input-group-btn upld_icnpad">
                                                            <a href="javascript:void(0);" id="emogis" data-container="body" data-toggle="popover" data-placement="top" data-original-title="" title=""><img src="<?php echo DEFAULT_IMAGE_PATH; ?>/type_symbol3.png"></a>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <input class="submit_btn chat_btn" type="submit" value="<?php echo lang('Send') ?>">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Topichat post modal -->
<div class="modal fade in" id="postModal" role="dialog">
    <div class="modal-dialog topichat_media_modal">
        <div class="modal-content">
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="usr_post_img usr_post_img_modal">
                            <!-- User image comes here using jquery -->
                            <img class="img-circle img-responsive topichat_media_user" src="">
                        </div>
                        <div class="topichat_media_details">
                            <!-- User name comes here with shared title -->
                        </div>
                        <div class="event_media event_media_modal topichat_msg_sec">
                            <div class="row topichat_media_post topichat_media_post_modal" data-chat_id="">
                                <div class="col-md-1 rank_button_modal">
                                    <div id="field" class="topichat_media_rank topichat_media_rank_modal">

                                    </div>
                                </div>
                                <div class="col-md-11 topichat_media_popup">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="usr_post_img user_post_image_right">

                        </div>
                        <div class="row">
                            <!-- Chat area section start here -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                                <div class="chat_area2 topichat_msg_sec topichat_msg_sec_modal">                                    
                                </div>
                            </div>
                            <!-- Chat area section end here -->

                            <!-- Type Chat section start here -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="topich_chat_typesec topich_chat_typesec_modal">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="topic_textarea">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><a href="<?php echo base_url() . "home/profile" ?>"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image'] ?>" class="user_chat_thumb"></a></span>
                                                        <div contenteditable="true" id="message_div" hidefocus="true" class="form-control"></div>
                                                        <input type="hidden" id="message" name="message" class="form-control">
                                                        <span class="input-group-btn upld_icnpad">
                                                            <a href="javascript:void(0);" id="emogis" data-container="body" data-toggle="popover" data-placement="top" data-original-title="" title=""><img src="<?php echo DEFAULT_IMAGE_PATH; ?>/type_symbol3.png"></a>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <input class="submit_btn chat_btn" type="submit" value="<?php echo lang('Send') ?>">
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
                
            </div>
        </div>
    </div>
</div>
<!-- Topichat post modal over-->


<!--  Post modal section start here -->
<div class="modal upload-modal" id="upload_file_section">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="Profl_addsec home_post">
                    <div class="row pst_here_sec">
                        <!-- post start here -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <!-- tittle or short description section satrt here -->
                                <div class="panel-heading"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                                    <div class="jst_txt usr_post_img">
                                        <img class='img-circle' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $this->session->user['user_image'] ?>"> <?php echo lang('title /short description'); ?> 
                                    </div>
                                    <textarea class="form-control" rows="3" id="media_description" name="media_description" required></textarea>
                                </div>
                                <!-- tittle or short description section end here -->

                                <!-- Upload images or video section start here -->
                                <div class="panel-body">
                                    <div class="message alert alert-danger" style="display:none"></div>
                                    <div class="upld_sec">
                                        <div class="fileUpload up_img btn">
                                            <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
                                            <input type="file" name="uploadfile[]" class="upload" id="uploadFile"/>
                                        </div>
                                        <div class="fileUpload up_img btn">
                                            <span><i class="fa fa-video-camera" aria-hidden="true"></i> <?php echo lang('Videos'); ?></span>
                                            <input type="file" id="upload_video" name="upload_video" class="upload" id="uploadFile"/>
                                        </div>
                                        <div class="fileUpload up_img btn">
                                            <span><i class="fa fa-upload" aria-hidden="true"></i> <?php echo lang('Files'); ?></span>
                                            <input type="file" name="upload_files" class="upload" id="upload_files"/>
                                        </div>
                                    </div>
                                    <div class="upload_image_wrapper" style="display:none" data-video_image="<?php echo DEFAULT_IMAGE_PATH . "video_thumbnail.png" ?>" data-file_image="<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>">

                                    </div>
                                </div>
                                <!-- Upload images or video section end here -->

                                <!-- selectng "Post to" and Original section start here -->

                                <div class="panel-body pnl_ftr">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button type="button" id="topi_media_upload" class="pstbtn"><?php echo lang('Post'); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- selectng "Post to" and Original section end here -->
                            </div>
                        </div>
                        <!-- post end here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Post modal section end here -->

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
    last_text_msg = '<?php echo (count($text_messages) > 0) ? $text_messages[count($text_messages) - 1]['id'] : 0 ?>';
    upload_path = '<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/join_topichat.js"></script>
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/topichat.js"></script>
<script type="text/javascript">
    $('document').ready(function () {
        
        // Phase 2 changes for open and close chat window
        $(".panel.panel-chat > .panel-heading > .chatMinimize").click(function(){
            if($(this).parent().parent().hasClass('mini'))
            {
                $(this).parent().parent().removeClass('mini').addClass('normal');
                $('.panel.panel-chat > .panel-body').animate({height: "250px"}, 500).show();
                $('.panel.panel-chat > .panel-footer').animate({height: "75px"}, 500).show();
                $(".panel-body").scrollTop(2500);
            }
            else
            {
                $(this).parent().parent().removeClass('normal').addClass('mini');
                $('.panel.panel-chat > .panel-body').animate({height: "0"}, 500);
                $('.panel.panel-chat > .panel-footer').animate({height: "0"}, 500);
                
                setTimeout(function() {
                    $('.panel.panel-chat > .panel-body').hide();
                    $('.panel.panel-chat > .panel-footer').hide();
                }, 500);
            }
        });
        // Changes over
        
        setTimeout(function () {
            $(".fancybox").fancybox({
                'width': 300, // set the width
                'height': 300, // set the height
                'type': 'iframe'       // tell the script to create an iframe
            });
        }, 100);

        $('#mediaModal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
            $(this).find('form').trigger('reset');
            if ($(this).find('.topichat_media_popup').find('video').length > 0)
            {
                $(this).find('.topichat_media_popup').find('video')[0].pause();
            }
        });
        $('#linkModal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
            if ($(this).find('.topichat_media_popup').find('iframe').length > 0)
            {
                var iframe = $(this).find('.topichat_media_popup').find('iframe');
                iframe.contents().find('video').each(function ()
                {
                    this.pause();
                });
            }
        });
        $('#edit_grp').on('hidden.bs.modal', function () {
            modal = $(this);
            modal.find('#uploadFile').val('');
            modal.find('#topic_name').val("<?php echo $topichat['topic_name'] ?>");
<?php
if ($topichat['person_limit'] == -1) {
    ?>
                modal.find('[name="person_limit"][value="-1"]').prop('checked', true);
                modal.find('#txt_No_of_person').prop('disabled', true);
    <?php
} else {
    ?>
                modal.find('[name="person_limit"][value="Yes"]').prop('checked', true);
                modal.find('#txt_No_of_person').prop('disabled', false);
                modal.find('#txt_No_of_person').val('<?php echo $topichat['person_limit']; ?>');
    <?php
}
?>
            modal.find('#imagePreview').attr("style", "");
            modal.find('.new_image_wrapper').hide();
            modal.find("#notes").val("<?php echo $topichat['notes']; ?>");
        });
    });
</script>
