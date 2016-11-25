<div class="row">
    <div class="container">

<!--        <a href="<?php echo $fb_login_url; ?>"><img src="<?php echo DEFAULT_IMAGE_PATH . "facebook-sign-in.png" ?>" style="height:80px;width:225px;float: right;" /></a>-->
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 col-md-offset-3">

            <div class="signup_sec">
                <h2 class="wlcm_habby"><?php echo lang('Welcome to Habby'); ?></h2>
                <p class="cnnct_txt"><?php echo lang('Connect with friends and the world around you'); ?></p>
                <div class="clearfix signup_frm">
                    <form class="" role="form" method="post" action="<?php echo base_url() . "register" ?>">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('Display Name'); ?>" value="<?php echo set_value('name'); ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo lang('E-mail'); ?>" value="<?php echo set_value('email'); ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo lang('Password') . " " . lang('(min. 6 characters)'); ?>" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" id="re_password" name="re_password" placeholder="<?php echo lang('Confirm Password'); ?>" value="">
                            </div>
                        </div>
                        <div class="row form-group">
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
                        <div class="row form-group">
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
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <textarea class="form-control" id="bio" name="bio" placeholder="<?php echo lang('Enter your Bio'); ?>" rows="20" cols="20" ><?php echo set_value('bio'); ?></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <textarea class="form-control" id="hobby" name="hobby" placeholder="<?php echo lang('Enter your hobby seprate by comma'); ?>" rows="20" cols="20"><?php echo set_value('hobby'); ?></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <p class="policy_tag"><?php echo lang('By signing up, you agree to the'); ?> <a href="#"><?php echo lang('User Policy') ?></a></p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <div class="signbtnsec">
                                    <input type="submit" class="signupbtn" value="<?php echo lang('Sign Up for Habby'); ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="frm_tag"><span><?php echo lang('Create a Page'); ?></span> <?php echo lang('for a celebrity, band or bussiness.'); ?></p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="social">
                <ul>
<!--                    <li><a href="<?php echo $fb_login_url; ?>"><img src="<?php echo DEFAULT_IMAGE_PATH . "facebook.png" ?>" /></a></li>-->
                    <li><a href="<?php echo $fb_login_url; ?>" class="btn btn-block btn-fb"><i class="fa fa-facebook"></i>Sign Up With Facebook</a></li>
<!--                    <li><a href="<?php echo base_url() ?>/login/google_login"><img src="<?php echo DEFAULT_IMAGE_PATH . "google_plus.png" ?>" /></a></li>-->
                    <li> <a href="<?php echo base_url() ?>" class="btn btn-block btn-g-plus"><i class="fa fa-google-plus"></i>Sign Up With Google+</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>