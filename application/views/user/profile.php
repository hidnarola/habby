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
<!--  Edit Profile Detail form modal start here -->
<div class="modal mdl_frm" id="edit-profile" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
                    <b>Edit Your Profile</b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "register" ?>">
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('Display Name'); ?>" value="<?php echo set_value('name'); ?>">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo lang('E-mail'); ?>" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <select name="country" class="form-control" id="country" >
                                <?php
                                if (!empty($all_countries)) {
                                    foreach ($all_countries as $a_country) {
                                        ?>
                                        <option value="<?php echo $a_country['id']; ?>" <?php echo set_select('country', $a_country['id']); ?>>
                                            <?php echo $a_country['nicename']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Male" <?php echo set_radio('gender', 'Male', TRUE); ?>><?php echo lang('Male'); ?>
                                </label>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Female" <?php echo set_radio('gender', 'Female'); ?>><?php echo lang('Female'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <textarea class="form-control" id="bio" name="bio" placeholder="<?php echo lang('Enter your Bio'); ?>" rows="20" cols="20" ><?php echo set_value('bio'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <textarea class="form-control" id="hobby" name="hobby" placeholder="<?php echo lang('Enter your hobby seprate by comma'); ?>" rows="20" cols="20"><?php echo set_value('hobby'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <p class="policy_tag"><?php echo lang('By signing up, you agree to the'); ?> <a href="#"><?php echo lang('User Policy') ?></a></p>
                        </div>
                    </div>
                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12">
                            <div class="signbtnsec">
                                <input type="submit" class="signupbtn" value="<?php echo lang('Sign Up for Habby'); ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  Edit Profile Detail form modal end here -->