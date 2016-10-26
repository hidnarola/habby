<div class="row cont_top_1">
    <div class="container topic_2cntnr mble_pd_0">
        <p class="mr_p visible-xs" >
            <a href="#" class="pstbtn" id="more_rate"><?php echo lang('Files'); ?></a>
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
                    foreach ($top_rank_post as $post) {
                        ?>
                        <div class="panel-body">
                            <div class="row vote_row topichat_media_post" data-chat_id="<?php echo $post['id'] ?>">
                                <!-- vote section start here -->
                                <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 vot1">
                                    <div id="field" class="topichat_media_rank">
                                        <button type="button" id="add" class="add add_btn smlr_btn">
                                            <img src="<?php echo DEFAULT_IMAGE_PATH;
                    echo (($post['is_ranked'] && $post['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png'); ?>"/>
                                        </button>
                                        <span class="rank_rate"><?php echo $post['positive_rank'] - $post['negetive_rank']; ?></span>
                                        <button type="button" id="sub" class="sub smlr_btn">
                                            <img src="<?php echo DEFAULT_IMAGE_PATH;
                    echo (($post['is_ranked'] && $post['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png'); ?>"/>
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
                                        <a class="fancybox" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $post['media']; ?>" data-fancybox-group="gallerytopichat1">
                                            <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $post['media']; ?>" class="img-responsive center-block ">
                                        </a>
                                        <?php
                                    } else if ($post['media_type'] == "video") {
                                        ?>
                                        <a class="fancybox" target="_blank" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $post['media']; ?>" data-fancybox-group="gallerytopichat1">
                                            <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . explode(".", $post['media'])[0] . "_thumb.png"; ?>" class="img-responsive center-block ">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- Top rate vote panel body section start here -->

                    <!-- Top rate vote panel body section end here -->

                </div>

                <!-- Top rate section start here -->

                <!-- All files section start here -->
                <div class="panel panel-default popular_img_sec">
                    <div class="panel-heading"><b><?php echo lang('ALL FILES'); ?></b><span style="float: right"><i class="fa fa-angle-right" aria-hidden="true"></i></span></div>
                    <div class="panel-heading shrd_topc_sec"><b><?php echo lang('Shared'); ?></b> <span style="float: right"><a href="#"><b><?php echo lang('More'); ?></b></a></span></div>
                    <div class="panel-body">
                        <div class="topic_frame">
                            <a class="fancybox" data-type="iframe"  href="http://www.youtube.com/embed/WAZ5SmJd1To" data-fancybox-group="galleryshared1">
                                <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img2.jpg" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- All files section end here -->

                <?php
                if (count($recent_images) > 0 || count($recent_videos) > 0) {
                    ?>
                    <!-- popular image and video section start here -->
                    <div class="panel panel-default popular_img_sec">

                        <div class="panel-heading"><b><?php echo lang('UPLOAD'); ?></b> <span style="float: right"><a href="#"><b><?php echo lang('More'); ?></b></a></span></div>

                        <?php
                        if (count($recent_videos) > 0) {
                            ?>
                            <div class="panel-heading shrd_topc_sec"><b><?php echo lang('Videos'); ?></b></div>

                            <div class="panel-body">
                                <ul class="photo_vdo_ul">
                                    <?php
                                    foreach ($recent_videos_thumb as $key => $image) {
                                        ?>
                                        <li class="topi_image_li">
                                            <a class="fancybox" target="_blank" href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $recent_videos[$key]; ?>" data-fancybox-group="gallery1">
                                                <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive topi_image">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>

                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        if (count($recent_images) > 0) {
                            ?>
                            <div class="panel-heading shrd_topc_sec brdr_top"><b><?php echo lang('Images'); ?></b> </div>

                            <div class="panel-body">
                                <ul class="photo_vdo_ul">
                                    <?php
                                    foreach ($recent_images as $image) {
                                        ?>
                                        <li class="topi_image_li">
                                            <a class="fancybox"  href="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" data-fancybox-group="gallery1">
                                                <img src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>" class="img-responsive topi_image">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- popular image and video section End here -->
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pad_lft0 topic_right_lg_sec">
            <div class="right_lg_sectopic">
                <!-- Note and topic edit area start here -->
                <div class="tittl_sec_lgrow">
                    <div class="tittl_sec_lg">
                        <div class="col-lg-11 col-md-11 col-sm-10 col-xs-12">
                            <div class="tittl_sec">
                                <p><?php echo $topichat['topic_name']; ?> <span></span></p>
                                <p>Note : <?php echo $topichat['notes']; ?> </p>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                            <div class="tittl_sec2">
                                <p class="topchat_p">
                                    <a href="#" class="pstbtn"><?php echo lang('Edit'); ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Note and topic edit area end here -->

                <!-- Chat area and tupe section start here -->
                <div class="row chat_msg_sec">

                    <!-- Chat area section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                        <div class="chat_area2 topichat_msg_sec">
<!--                            <p class="notifctn"><b>Mike</b> Changed topic.</p> -->
                            <?php $this->load->view('user/partial/topichat/load_more_msg') ?>
                        </div>
                    </div>
                    <!-- Chat area section end here -->

                    <!-- Type Chat section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="topich_chat_typesec">
                            <!-- Smily icon and profile secton start here -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="topic_prfle_icon_sec topc_link_sharesec">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topic_textarea pad_lft_rit0">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="cht_pfl_img"></a></span>	
                                                    <input type="text" class="form-control" placeholder="Copy Link Here">
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>google_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>youtube_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>google_plus_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn scl_mda_img">
                                                        <a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>twitter_img.jpg"></a>
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <input class="chat_btn" type="submit" value="<?php echo lang('Share'); ?>">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Smily icon and profile secton end here -->

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
                                                <span class="input-group-btn upld_icnpad">
                                                    <div class="fileUpload up_img btn">
                                                        <span><img title="Upload file" src="<?php echo DEFAULT_IMAGE_PATH; ?>upload.png"></span>
                                                        <input type="file" name="upload_file" class="upload" id="uploadFile"/>
                                                    </div>
                                                </span>
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
                <!-- Chat area and tupe section end here -->
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
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/join_topichat.js"></script>
<script type="text/javascript" src="<?php echo USER_JS ?>/topichat/topichat.js"></script>