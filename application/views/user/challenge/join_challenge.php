<div class="row solmate_lg_row solmate_lg_row_custom">
    <div class="container topic_2cntnr">
        <p class="mr_p visible-xs" >
            <a href="javascript:;" class="pstbtn" id="more_rate"><?php echo lang('Files'); ?></a>
        </p>

        <!-- make a challenge to public sec start here -->

        <!-- make a challenge to public sec end here -->
        <div class="col-lg-12 col-md-12">
            <?php
            if ($this->session->msg) {
                ?>
                <div class="alert alert-info text-center flashmsg"><?php echo $this->session->msg; ?></div>
                <?php
            }
            ?>
        </div>
        <!-- Challenge left lg section start here -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pd-right-chlng-0">
            <div class="chalng_lg_lft_sec">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="chalng_descpn">
                            <p><?php echo lang("Upload Challenge Post"); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 chalng_upld_col">
                        <div class="chalng_upld">
                            <?php
                            if ($challenge != null && !empty($challenge)) {
                                if ($challenge['is_finished'] == 0) {
                                    ?>
                                    <form method="post" enctype="multipart/form-data" id="media_form" action="challenge/upload_media/<?php echo urlencode(base64_encode($group_id)); ?>">
                                        <input type="hidden" name="type" class="type" value=""/>
                                        <div class="upld_sec">
                                            <div class="fileUpload up_img btn upload_file_img">
                                                <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
                                                <input type="file" id="image_upload" class="upload upload_image" name="image_upload">
                                            </div>
                                            <div class="fileUpload up_img btn">
                                                <span><i class="fa fa-video-camera" aria-hidden="true"></i> <?php echo lang('Videos'); ?></span>
                                                <input type="file" id="video_upload" class="upload upload_video" name="video_upload">
                                            </div>
                                        </div>
                                        <div class="upld_sec">
                                            <p class="media_name select_file_name"><?php echo lang("No media selected"); ?></p>
                                            <p class="text-right post_btn "><button type="submit" class="pstbtn upload_btn make_disabled">Post</button></p>
                                        </div>
                                    </form>
                                    <?php
                                } else {
                                    ?>
                                    <div class="upld_sec finised">
                                        <span><?php echo lang("Challenge has been Finished."); ?></span>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row chlng2_usr_row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="chlng_user_2">
                            <div class="tdy_pln_btn tdy_pln_btn">
                                <p class="usr_p"><span><?php echo lang("Member"); ?></span> </p>
                                <div class="dropdownpln">
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <ul class="list-unstyled revw_ul member_ul">
                                                <?php
                                                if ($challenge_users != null && !empty($challenge_users)) {
                                                    foreach ($challenge_users as $challenge_user) {
                                                        ?>
                                                        <li><a href="<?php echo ($challenge_user['user_id'] == $this->session->user['id']) ? base_url() . 'home/profile' : base_url() . "user_profile/" . $challenge_user['user_id'] ?>"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $challenge_user['user_image']; ?>" class="smlt_usrimg1 img-circle user_chat_thumb"> <span><?php echo $challenge_user['display_name'] ?></span></a></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>	
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?php
                        if ($challenge != null && !empty($challenge)) {
                            if ($user_data['id'] == $challenge['user_id']) {
                                if ($challenge['is_finished'] == 0) {
                                    ?>
                                    <p class="text-right"><a href="<?php echo base_url() . "challenge/finish_challenge/" . $challenge['id'] ?>" class="pstbtn"><?php echo lang("Finish"); ?></a></p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="text-right"><a href="javascript:void(0)" class="pstbtn"><?php echo lang("Finished"); ?></a></p>
                                    <?php
                                }
                            } else {
                                ?>
                                <p class="text-right"><a href="<?php echo base_url() . "challenge/quit_challenge/" . $challenge['id'] ?>" class="pstbtn"><?php echo lang("Quit"); ?></a></p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="slmt_grp">
                            <ul class="list-inline rcrd_ul">
                                <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>video_record_img.png"></a></li>
                                <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>voice_record_img.png"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Chat area and tupe section start here -->
                <div class="row chat_msg_sec">

                    <!-- Chat area section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                        <div class="chat_area_solmat chat_area_chalnge2 chat_area2">
                            <?php $this->load->view('user/partial/challenge/load_more_msg') ?>
                        </div>
                    </div>
                    <!-- Chat area section end here -->

                    <!-- Type Chat section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        if ($challenge != null && !empty($challenge)) {
                            if ($challenge['is_finished'] == 0) {
                                ?>
                                <div class="topich_chat_typesec_slmt topich_chat_typesec_chalnge2">
                                    <!-- Smily icon and profile secton start here -->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="topic_prfle_icon_sec">

                                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-3">
                                                    <a href="javascript:;"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $challenge['user_image']; ?>" class="img-responsive cht_pfl_img user_chat_thumb"></a>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-9">
                                                    <ul class="list-inline type_icon_ul">
                                                        <!--<li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol1.png"></a></li>-->
                                                        <li>
                                                            <div class="fileUpload up_img btn">
                                                                <span><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol2.png"></span>
                                                                <input type="file" name="uploadfile[]" class="upload" id="uploadFile"/>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="fileUpload up_img btn">
                                                                <span><img title="Upload video" src="<?php echo DEFAULT_IMAGE_PATH; ?>video_record_img.png"></span>
                                                                <input type="file" id="upload_video" name="upload_video" class="upload" id="uploadFile"/>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"  id="emogis" data-container="body" data-toggle="popover" data-placement="top"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a>
                                                        </li>
                                                    </ul>
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
                                                        <span class="input-group-btn">
                                                            <input class="chat_btn submit_btn" type="submit" value="Send">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Type area end here -->
                                <?php
                            } else {
                                ?>
                                <div class="topich_chat_typesec_slmt topich_chat_typesec_chalnge2 finised"></div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- Type Chat section end here -->
                </div>
                <!-- Chat area and tupe section end here -->

            </div>
        </div>
        <!-- Challenge left lg section end here -->

        <!-- Challenge right lg section end here -->

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pd-lft-chlng-0 bdr-right-clng">
            <div class="whit_wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        if ($challenge != null && !empty($challenge)) {
//                            pr($challenge);
                            ?>
                            <div class="mak_chlng_sec">
                                <h2 class="chlng_ttl">
                                    <span ><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $challenge['user_image']; ?>" class="smlt_usrimg1 img-circle user_chat_thumb"> "<?php echo $challenge['display_name'] ?>"</span>
                                    <span><?php echo " " . lang("makes a challenge to public"); ?></span>
                                </h2>
                                <div class="mak_chlng_sec_innr">
                                    <div class="chlng2_cnt">
                                        <p><?php echo $challenge['description'] ?></p>
                                    </div>

                                    <div class="row rwrds_chlng2">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <p><?php echo lang("Rewards"); ?>: <span><?php echo $challenge['rewards'] ?></span> <?php echo lang("Coins"); ?></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <p><?php echo date('d/m/Y', strtotime($challenge['created_date'])) ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="chalng_descpn chalng_descpn2">
                            <p>
                                <?php echo lang("Rank"); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Soulmate past Due section start here -->
            <div class="soulmate_past_due_sec chlng2_past_rank_sec">

                <div class="row soulmate_past_due_sec2">
                    <?php
                    foreach ($challenge_post as $post) {
                        ?>
                        <!-- Each Rank section start here-->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng" data-post_id="<?php echo $post['id']; ?>">
                            <div class="rank_box">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <ul class="list-inline rank_ul1">
                                            <li><img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank_1.png"></li>
                                            <li><img class="img-circle user_chat_thumb" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . '/' . $post['user_image']; ?>" title="<?php echo $post['name'] ?>"></li>
                                        </ul>
                                        <div id="field">
                                            <button type="button" id="add" class="add add_btn smlr_btn">
                                                <img src="<?php
                                                echo DEFAULT_IMAGE_PATH;
                                                echo (($post['is_ranked'] && $post['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png')
                                                ?>">
                                            </button>
                                            <span class="rank_rate"><?php echo $post['positive_rank'] - $post['negetive_rank']; ?></span>
                                            <button type="button" id="sub" class="sub smlr_btn">
                                                <img src="<?php
                                                echo DEFAULT_IMAGE_PATH;
                                                echo (($post['is_ranked'] && !$post['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png')
                                                ?>">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 pad_lft0">
                                        <div class="rank-post">
                                            <?php
                                            if ($post['media_type'] == 'image') {
                                                ?>
                                                <a class="fancybox" href="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . '/' . $post['media']; ?>" data-fancybox-group="galleryrate1">
                                                    <img src="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . '/' . $post['media']; ?>" class="img-responsive center-block">
                                                </a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="fancybox post_images"  href="javascript:;" data-fancybox-group="gallery">
                                                    <video controls class="img-responsive center-block">
                                                        <source src="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . '/' . $post['media']; ?>">
                                                        </source>
                                                        <?php echo lang("Seems like your browser doesn't support video tag."); ?>
                                                    </video>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rank_box2">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pad_lft0">
                                        <ul class="list-inline winr_ul rank_ul2">
                                            <li>
                                                <a href="javascript:;" class="user_coin">
                                                    <img class="img-coin" src="<?php
                                                    echo DEFAULT_IMAGE_PATH;
                                                    echo ($post['is_coined']) ? 'coined_icon.png' : 'coin_icon.png';
                                                    ?>"/><br/>
                                                    <span class="coin_cnt"><?php echo $post['tot_coin'] ?></span> <?php echo lang("Coins"); ?>
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="javascript:;" class="user_like">
                                                    <img src="<?php
                                                    echo DEFAULT_IMAGE_PATH;
                                                    echo ($post['is_liked']) ? 'liked_img.png' : 'like_img.png'
                                                    ?>" class="like_img"><br/>
                                                    <span>
                                                        <span class="like_cnt"><?php echo $post['tot_like'] ?></span> <?php echo lang("Likes"); ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a role="button" class="cmnt_winner">
                                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>comment_icon.png"><br/>
                                                    <span> 
                                                        <span class="comment_cnt"><?php echo $post['tot_comment'] ?></span> <?php echo lang("Comments"); ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php
                                                if($post['user_id'] == $this->session->user['id'])
                                                {
                                                    ?>
                                                    <li class="pull-right">
                                                        <button class="btn btn-default challenge_delete_btn">Delete this post</button>
                                                    </li>
                                                    <?php
                                                }
                                            ?>
                                        </ul>
                                        <div class="winner-comnt">
                                            <p class="cmn_txtnw"> <?php echo lang("Comment Here"); ?></p>
                                            <textarea class="form-control comment" rows="3" id="comment"></textarea>

                                            <?php
                                            if (isset($post['comments']) && count($post['comments']) > 0) {
                                                foreach ($post['comments'] as $comment) {
                                                    ?>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="commnt_visit_sec clearfix" data-post_comment_id="<?php echo $comment['id']; ?>">
                                                            <div class="cmn_img">
                                                                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $comment['user_image']; ?>" class="img-responsive user_chat_thumb img-circle">
                                                                <p class="cmnt_txt1"><span><?php echo $comment['name']; ?></span></p>
                                                            </div>
                                                            <div class="cmn_dtl">
                                                                <p class="cmmnt_para"><?php echo $comment['comment_description']; ?></p>
                                                                <p class=""><?php echo $comment['created_date'] ?></p>
                                                                <ul class="cmnt_p clearfix">
                                                                    <li class="stlnon"><span></span></li>
                                                                    <li class="comment_like_cnt"><a href="javascript:;"><span class="post_comment_like"><?php echo $comment['cnt_like']; ?></span> <?php echo lang("Like"); ?></a></li>
                                                                    <li class="post_reply"><a href="javascript:;"><span class="comment_reply_cnt"><?php echo $comment['cnt_reply']; ?></span> <?php echo lang("Reply"); ?></a></li>
                                                                    <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                                <div class="reply_dtl" style="display:none"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="commnt_visit_sec clearfix no_comment">
                                                    <?php echo lang("No comments available"); ?>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Each Rank section end here-->
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!-- Soulmate past Due section end here -->
        </div>
    </div>
</div>
<?php 
    $myuserdata = array(
        'id'=>$this->session->user['id'],
        'name'=>$this->session->user['name'],
        'user_image'=>$this->session->user['user_image'],
        'email'=>$this->session->user['email']
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
<script type="text/javascript" src="<?php echo USER_JS ?>/challenge/join_challenge.js"></script>
<script type="text/javascript" src="<?php echo USER_JS ?>/challenge/challenge.js"></script>