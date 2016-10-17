<div class="row solmate_lg_row">
    <div class="container topic_2cntnr">
        <p class="mr_p visible-xs" >
            <a href="#" class="pstbtn" id="more_rate">Files</a>
        </p>

        <!-- make a challenge to public sec start here -->

        <!-- make a challenge to public sec end here -->

        <!-- Challenge left lg section start here -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pd-right-chlng-0">
            <div class="chalng_lg_lft_sec">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="chalng_descpn">
                            <p><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="smlt_usrimg1">
                                Introduction / Description
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 chalng_upld_col">
                        <div class="chalng_upld clearfix">
                            <div class="upld_sec">
                                <div class="fileUpload up_img btn">
                                    <span><i class="fa fa-picture-o" aria-hidden="true"></i> Images</span>
                                    <input type="file" class="upload">
                                </div>
                                <div class="fileUpload up_img btn">
                                    <span><i class="fa fa-video-camera" aria-hidden="true"></i> Videos</span>
                                    <input type="file" class="upload">
                                </div>

                            </div>

                            <p class="text-right"><a href="#" class="pstbtn">Post</a></p>
                        </div>
                    </div>
                </div>

                <div class="row chlng2_usr_row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="chlng_user_2">
                            <div class="tdy_pln_btn tdy_pln_btn">
                                <p class="usr_p"><span>Member</span> </p>
                                <div class="dropdownpln">
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <ul class="list-unstyled revw_ul member_ul">
                                                <?php
                                                if ($challenge_users != null && !empty($challenge_users)) {
                                                    foreach ($challenge_users as $challenge_user) {
                                                        ?>
                                                        <li><a href="javascript;"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $challenge_user['user_image']; ?>" class="smlt_usrimg1 img-circle"></a> <span><?php echo $challenge_user['display_name'] ?></span></li>
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
                        <p class="text-right"><a href="#" class="pstbtn">Quit</a></p>
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
                        <div class="topich_chat_typesec_slmt topich_chat_typesec_chalnge2">
                            <!-- Smily icon and profile secton start here -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="topic_prfle_icon_sec">

                                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-3">
                                            <a href="personal_account.html"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="img-responsive cht_pfl_img"></a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-9">
                                            <ul class="list-inline type_icon_ul">
                                                <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol1.png"></a></li>
                                                <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol2.png"></a></li>
                                                <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a></li>
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
                                                <input type="text" class="form-control" placeholder="Type Here...">
                                                <span class="input-group-btn">
                                                    <input class="chat_btn" type="submit" value="Send">
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
                                    <span ><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $challenge['user_image']; ?>" class="smlt_usrimg1 img-circle"> "<?php echo $challenge['display_name'] ?>"</span>
                                    <span>  makes a challenge to public</span>
                                </h2>
                                <div class="mak_chlng_sec_innr">
                                    <div class="chlng2_cnt">
                                        <p><?php echo $challenge['description'] ?></p>
                                    </div>

                                    <div class="row rwrds_chlng2">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <p>Rewards: <span><?php echo $challenge['rewards'] ?></span> Coins</p>
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
                                Rank
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Soulmate past Due section start here -->
            <div class="soulmate_past_due_sec chlng2_past_rank_sec">

                <div class="row soulmate_past_due_sec2">
                    <!-- Each Rank section start here-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng">
                        <div class="rank_box">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <ul class="list-inline rank_ul1">
                                        <li><img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank_1.png"></li>
                                        <li><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></li>
                                    </ul>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 pad_lft0">
                                    <div class="rank-post">
                                        <a class="fancybox" href="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img1.jpg" data-fancybox-group="galleryrate1">
                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img1.jpg" class="img-responsive center-block">
                                        </a>
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
                                        <li><a href="#"><span> Coins </span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                <span>Likes  </span>
                                            </a>
                                            <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </li>
                                        <li><a role="button" class="cmnt_winner"><span> Comments  </span></a></li>
                                    </ul>
                                    <div class="winner-comnt">

                                        <p class="cmn_txtnw"> Comment Here</p>
                                        <textarea class="form-control" rows="3" id="textArea"></textarea>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="commnt_visit_sec clearfix">
                                                    <div class="cmn_img">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                    </div>
                                                    <div class="cmn_dtl">

                                                        <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                        <ul class="cmnt_p clearfix">
                                                            <li><a href="#">Like</a></li>
                                                            <li><a href="#">Reply</a></li>
                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                            <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                        </ul>

                                                        <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="commnt_visit_sec clearfix">
                                                    <div class="cmn_img">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                    </div>
                                                    <div class="cmn_dtl">

                                                        <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                        <ul class="cmnt_p clearfix">
                                                            <li><a href="#">Like</a></li>
                                                            <li><a href="#">Reply</a></li>
                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                            <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                        </ul>

                                                        <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Each Rank section end here-->

                    <!-- Each Rank section start here-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng">
                        <div class="rank_box">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <ul class="list-inline rank_ul1">
                                        <li><img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank_1.png"></li>
                                        <li><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></li>
                                    </ul>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 pad_lft0">
                                    <div class="rank-post">
                                        <a class="fancybox" href="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img2.jpg" data-fancybox-group="galleryrate1">
                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img2.jpg" class="img-responsive center-block">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rank_box2">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">

                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 pad_lft0">
                                    <ul class="list-inline winr_ul rank_ul2">
                                        <li><a href="#"><span> Coins </span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                <span>Likes  </span>
                                            </a>
                                            <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </li>
                                        <li><a role="button" class="cmnt_winner"><span> Comments  </span></a></li>
                                    </ul>
                                    <div class="winner-comnt">

                                        <p class="cmn_txtnw"> Comment Here</p>
                                        <textarea class="form-control" rows="3" id="textArea"></textarea>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="commnt_visit_sec clearfix">
                                                    <div class="cmn_img">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                    </div>
                                                    <div class="cmn_dtl">

                                                        <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                        <ul class="cmnt_p clearfix">
                                                            <li><a href="#">Like</a></li>
                                                            <li><a href="#">Reply</a></li>
                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                            <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                        </ul>

                                                        <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="commnt_visit_sec clearfix">
                                                    <div class="cmn_img">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                    </div>
                                                    <div class="cmn_dtl">

                                                        <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                        <ul class="cmnt_p clearfix">
                                                            <li><a href="#">Like</a></li>
                                                            <li><a href="#">Reply</a></li>
                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                            <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                        </ul>

                                                        <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Each Rank section end here-->

                    <!-- Each Rank section start here-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng">
                        <div class="rank_box">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <ul class="list-inline rank_ul1">
                                        <li><img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank_1.png"></li>
                                        <li><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></li>
                                    </ul>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 pad_lft0">
                                    <div class="rank-post">
                                        <a class="fancybox" href="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img3.jpg" data-fancybox-group="galleryrate1">
                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img3.jpg" class="img-responsive center-block">
                                        </a>	
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rank_box2">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">

                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 pad_lft0">
                                    <ul class="list-inline winr_ul rank_ul2">
                                        <li><a href="#"><span> Coins </span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                <span>Likes  </span>
                                            </a>
                                            <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </li>
                                        <li><a role="button" class="cmnt_winner"><span> Comments  </span></a></li>
                                    </ul>
                                    <div class="winner-comnt">

                                        <p class="cmn_txtnw"> Comment Here</p>
                                        <textarea class="form-control" rows="3" id="textArea"></textarea>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="commnt_visit_sec clearfix">
                                                    <div class="cmn_img">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                    </div>
                                                    <div class="cmn_dtl">

                                                        <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                        <ul class="cmnt_p clearfix">
                                                            <li><a href="#">Like</a></li>
                                                            <li><a href="#">Reply</a></li>
                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                            <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                        </ul>

                                                        <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="commnt_visit_sec clearfix">
                                                    <div class="cmn_img">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                    </div>
                                                    <div class="cmn_dtl">

                                                        <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                        <ul class="cmnt_p clearfix">
                                                            <li><a href="#">Like</a></li>
                                                            <li><a href="#">Reply</a></li>
                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                            <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                        </ul>

                                                        <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Each Rank section end here-->
                </div>

            </div>

            <!-- Soulmate past Due section end here -->
        </div>
    </div>
</div>
<script>
    data = '<?php echo json_encode($this->session->user); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    last_msg = '<?php echo (count($messages) > 0) ? $messages[count($messages) - 1]['id'] : 0 ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/challenge/join_challenge.js"></script>
<!-- Lazy loading -->
<script>
    $('document').ready(function () {
        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
        var load = true;
        var in_progress = false;
        $('.chat_area2').scroll(function () {
            if (load && !in_progress)
            {
                if ($('.chat_area2').scrollTop() == 0) {
                    loaddata();
                    in_process = true;
                }
            }
        });

        function loaddata()
        {
            $.ajax({
                url: base_url + 'challenge/load_more_msg/' + group_id,
                method: 'post',
                async: false,
                data: 'last_msg=' + last_msg,
                success: function (more) {
                    more = JSON.parse(more);
                    if (more.status)
                    {
                        $('.chat_area2').prepend(more.view);
                        last_msg = more.last_msg_id;
                        $(".chat_area2").animate({scrollTop: 200}, 500);
                    } else
                    {
                        load = false;
                        $('.chat_area2').prepend('<div class="text-center">No more messages to show</div>');
                        $(".chat_area2").animate({scrollTop: 0}, 500);
                    }
                    in_progress = false;
                }
            });

        }
    });
</script>