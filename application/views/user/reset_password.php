<div class="row">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-md-offset-3 col-sm-offset-2">
            <div class="signup_sec">
                <h2 class="wlcm_habby"><?php echo lang('Reset Password'); ?></h2>
                <div class="clearfix signup_frm">
                    <form class="" role="form" method="post" action="<?php echo base_url() . "user/reset_password/" . $token ?>">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo lang('New Password'); ?>" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" id="re_password" name="re_password" placeholder="<?php echo lang('Repeat Password'); ?>" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <div class="signbtnsec">
                                    <input type="submit" class="signupbtn" value="<?php echo lang('Reset Password'); ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="frm_tag"> <a href="<?php echo base_url() . 'login'; ?>"><span>  <?php echo lang('Not a member yet?'); ?></span></a> </p>
            </div>
        </div>
    </div>
</div>