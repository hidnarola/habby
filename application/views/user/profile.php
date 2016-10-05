<div class="row personal_act_sec">
    <?php
    if (isset($user_data) && !empty($user_data)) {
//        pr($user_data);
        ?>
        <div class="container prsna_coner personal_cntner">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="prfl_cvr_sec">
                    <div class="row">
                        <!-- Profile section start here -->
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                    <div class="pfl_imgsec">
                                        <img src="<?php echo DEFAULT_IMAGE_PATH . $user_data['user_image']; ?>" class="img-responsive center-block">
                                        <div class="pfl_imgsec_innr">
                                            <div class="upld_sec">
                                                <div class="fileUpload up_img btn">
                                                    <span><i class="fa fa-camera" aria-hidden="true"></i> UPLOAD PROFILE PICTURE</span>
                                                    <input type="file" class="upload">
                                                </div>
                                            </div>
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                                    <div class="prfl_details">
                                        <p>Name : <?php echo $user_data['name'] ?></p>	
                                        <p>Gender : <?php echo $user_data['gender'] ?></p>	
                                        <p>Country : <?php echo get_country_name($user_data['country']) ?></p>
                                        <p>Self-introduction : <?php echo $user_data['bio'] ?></p>	
                                        <p>Interest/Hobby : <?php echo $user_data['hobby'] ?></p>
                                        <p class="editprfl_p"><a href="#" data-toggle="modal" data-target="#edit-profile" class="pstbtn">Edit Profile</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Profile section end here -->

                        <!-- Follow and follower sections start here -->

                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1 pad_lft0">
                            <div class="follower_sec follow_sec">
                                <h2>Follower</h2>
                                <ul class="list-inline">
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                </ul>
                                <ul class="list-inline">
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#">+more</a></li>
                                </ul>
                            </div>
                            <div class="follow_sec2 follow_sec">
                                <h2>Follow</h2>
                                <ul class="list-inline">
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="images/pst_prfl_icon.png"></a></li>
                                    <li><a href="#">+more</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Follow and follower sections end here -->
                    </div>

                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<!-- Personal Account submenu start here -->
<div class="row personal_act_sec">
    <div class="container personal_cntner sub_menusec">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad_lft_rit0">
            <ul class="list-inline submenu_ul">
                <li><a href="personal_account.html">IP</a></li>
                <li><a href="personal_Topichat.html">Topichat</a></li>
                <li><a href="personal_soulmate.html">Soulmate</a></li>
                <li><a href="personal_group_plan.html">Group Plan</a></li>
                <li><a href="personal_challenge.html">Challenge</a></li>
                <li><a href="personal_league.html">League and alliance</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Personal Account submenu end here -->

<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">
        <!-- Personal Account Title  start here -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2>Information Posts</h2>
        </div>
        <!-- Personal Account Title  end here -->

        <!-- Personal Account content  start here -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
            <div class="row">

                <!-- Personal Account Posts start here -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <h2>Posted</h2>
                    <ul class="list-inline info_ul">
                        <li>
                            <a class="fancybox" href="images/recent_post_img1.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img1.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img2.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img2.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img3.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img3.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img4.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img4.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img5.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img5.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img6.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img6.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img7.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img7.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img8.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img8.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img9.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img9.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img10.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img10.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img11.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img11.jpg">
                            </a>
                        </li>
                        <li>
                            <a class="fancybox" href="images/recent_post_img12.jpg" data-fancybox-group="gallery1">
                                <img src="images/recent_post_img12.jpg">
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Personal Account Posts end here -->

                <!-- Personal Account Saved start here -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <h2>Saved</h2>
                    <ul class="list-inline info_ul">
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img1.jpg">
                            </a>
                        </li>

                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img2.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img3.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img4.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img5.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img6.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img7.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img8.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img9.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img10.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img11.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="#saved-posts" data-toggle="modal">
                                <img src="images/recent_post_img12.jpg">
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Personal Account Saved end here -->
            </div>
        </div>
        <!-- Personal Account content  ennd here -->
    </div>
</div>