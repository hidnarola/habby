<?php $this->load->view('layouts/profile_common'); ?>
<!-- Personal Account submenu end here -->
<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2><?php echo lang("League and alliance"); ?></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
            <div class="prfl_cvr_sec">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topi_prsnl">
                    <h2 class="leag-res"><?php echo lang("My league and alliance"); ?></h2>
                </div>
                <div class="row">
                    <?php
                    if ($my_leagues != null && !empty($my_leagues)) {
                        foreach ($my_leagues as $my_league) {
//                            pr($my_league);
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topi_prsnl">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 topi_prsnl">
                                    <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $my_league['league_logo']; ?>" class="img-responsive center-block">	
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 league_prsnl">
                                    <p><?php echo $my_league['name']; ?></p>
                                    <p><?php echo lang("Role in League"); ?> : <?php echo lang("Owner"); ?> </p>
                                    <p><?php echo date('d/m/y', strtotime($my_league['created_date'])); ?></p>
                                    <p><?php echo $my_league['introduction']; ?></p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 league_prsnl">
                                    <p class="enter_btn">
                                        <?php
                                            if ($user_data['id'] == $this->session->user['id'])
                                            {
                                                ?>
                                                <a href="<?php echo base_url() . "league/details/" . urlencode(base64_encode($my_league['id'])) ?>"><?php echo lang("Enter in League"); ?></a>
                                                <?php
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <?php
                        }
                    }
                    ?>
                </div>
                <hr/>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topi_prsnl">
                    <h2 class="leag-res"><?php echo lang("Applied league and alliance"); ?></h2>
                </div>
                <div class="row">
                    <?php
                    if ($joined_leagues != null && !empty($joined_leagues)) {
                        foreach ($joined_leagues as $joined_league) {
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topi_prsnl">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 topi_prsnl">
                                    <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $joined_league['league_logo']; ?>" class="img-responsive center-block">	

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 league_prsnl">
                                    <p><?php echo $joined_league['name']; ?></p>
                                    <p><?php echo lang("Role in League"); ?> : <?php echo lang('User'); ?> </p>
                                    <p><?php echo date('d/m/y', strtotime($joined_league['created_date'])); ?></p>
                                    <p><?php echo $joined_league['introduction']; ?></p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 league_prsnl">
                                    <p class="enter_btn">
                                        <?php
                                            if ($user_data['id'] == $this->session->user['id'])
                                            {
                                                ?>
                                                <a href="<?php echo base_url() . "league/details/" . urlencode(base64_encode($joined_league['id'])) ?>"><?php echo lang("Enter in League"); ?></a>
                                                <?php
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Content End-->