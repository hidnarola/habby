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
                                    <div class="pfl_imgsec" style="height: 140px;max-width: 216px;">
                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image']; ?>" class="img-responsive center-block user_image" style="height: 100%;max-width: 100%;">
                                        <div class="pfl_imgsec_innr">
                                            <div class="upld_sec">
                                                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url() . "home/profile_upload" ?>" id="upload_user_image">
                                                    <div class="fileUpload up_img btn">
                                                        <span><i class="fa fa-camera" aria-hidden="true"></i> <?php echo lang('UPLOAD PROFILE PICTURE'); ?></span>
                                                        <input type="file" class="upload" name="user_image">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                                    <div class="prfl_details">
                                        <p><?php echo lang('Name'); ?> : <?php echo $user_data['name'] ?></p>	
                                        <p><?php echo lang('Gender'); ?> : <?php echo $user_data['gender'] ?></p>	
                                        <p><?php echo lang('Country'); ?> : <?php echo get_country_name($user_data['country']) ?></p>
                                        <p><?php echo lang('Self-introduction'); ?> : <?php echo $user_data['bio'] ?></p>	
                                        <p><?php echo lang('Interest/Hobby'); ?> : <?php echo $user_data['hobby'] ?></p>
                                        <p class="editprfl_p"><a href="#" data-toggle="modal" data-target="#edit-profile" class="pstbtn">Edit Profile</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Profile section end here -->

                        <!-- Follow and follower sections start here -->

                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1 pad_lft0">
                            <div class="follower_sec follow_sec">
                                <h2><?php echo lang('Follower'); ?></h2>
                                <ul class="list-inline">
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                </ul>
                                <ul class="list-inline">
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#">+<?php echo lang('more'); ?></a></li>
                                </ul>
                            </div>
                            <div class="follow_sec2 follow_sec">
                                <h2><?php echo lang('Follow'); ?></h2>
                                <ul class="list-inline">
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png"></a></li>
                                    <li><a href="#">+<?php echo lang('more'); ?></a></li>
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
                <li><a href="<?php echo base_url() . "home/profile" ?>"><?php echo lang('IP'); ?></a></li>
                <li><a href="<?php echo base_url() . "home/topichat" ?>"><?php echo lang('Topichat'); ?></a></li>
                <li><a href="<?php echo base_url() . "home/soulmate" ?>"><?php echo lang('Soulmate'); ?></a></li>
                <li><a href="<?php echo base_url() . "home/groupplan" ?>"><?php echo lang('Group Plan'); ?></a></li>
                <li><a href="<?php echo base_url() . "home/challenges" ?>"><?php echo lang('Challenge'); ?></a></li>
                <li><a href="<?php echo base_url() . "home/league" ?>"><?php echo lang('League and alliance'); ?></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Personal Account submenu end here -->
<!--  Edit Profile Detail form modal start here -->
<div class="modal mdl_frm" id="edit-profile" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
                    <b><?php echo lang('edit your profile') ?></b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "home/profile" ?>">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $name = (set_value('name') == false) ? $user_data['name'] : set_value('name'); ?>
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('Display Name'); ?>" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $email = (set_value('email') == false) ? $user_data['email'] : set_value('email'); ?>
                            <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo lang('E-mail'); ?>" value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Male" <?php
                                    if ($user_data['gender'] == 'Male') {
                                        echo 'checked';
                                    }
                                    ?>><?php echo lang('Male'); ?>
                                </label>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Female" <?php
                                    if ($user_data['gender'] == 'Female') {
                                        echo 'checked';
                                    }
                                    ?>><?php echo lang('Female'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $bio = (set_value('bio') == false) ? $user_data['bio'] : set_value('bio'); ?>
                            <textarea class="form-control" id="bio" name="bio" placeholder="<?php echo lang('Enter your Bio'); ?>" rows="20" cols="20" ><?php echo $bio; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $hobby = (set_value('hobby') == false) ? $user_data['hobby'] : set_value('hobby'); ?>
                            <textarea class="form-control" id="hobby" name="hobby" placeholder="<?php echo lang('Enter your hobby seprate by comma'); ?>" rows="20" cols="20"><?php echo $hobby; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" class="pstbtn" value="<?php echo lang('Save'); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  Edit Profile Detail form modal end here -->
<script>
    $("#country").val('<?php echo $user_data['country']; ?>');
    $(function () {
        $('.upload').change(function () {
            $('#upload_user_image').submit();
        });
    });
</script>