<?php $this->load->view('layouts/profile_common'); ?>
<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2>Challenges</h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
            <div class="prfl_cvr_sec prfl_cvr_sec_dvdr">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 topi_prsnl topi_prsnl_btm">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 prsnl_sm_sec">
                                <h2 class="nexttab_h2">Challenge accepted <span class="nexttab">Accepted date</span></h2>
                            </div>
                            <?php
                            if ($challenge_accepted != null && !empty($challenge_accepted)) {
                                foreach ($challenge_accepted as $challenge) {
//                                    pr($challenge);
                                    ?>
                                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 prsnl_sm_sec">
                                        <p><?php echo $challenge['name'] . " accepted by " . $challenge['display_name'] ?> </p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 prsnl_sm_sec">
                                        <p><?php echo date('d/m/Y h:i', strtotime($challenge['challange_date'])); ?></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 topi_prsnl topi_prsnl_btm">
                        <div class="chalng_tbl_sec">

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 prsnl_sm_sec">
                                    <h2>Finished:</h2>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 prsnl_sm_sec">
                                    <h2 class="text-center">Updated files</h2>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3  col-xs-offset-1 prsnl_sm_sec">
                                    <h2>Dates</h2>
                                </div>
                            </div>

                            <div class="row chalng_tblrow">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 prsnl_sm_sec">
                                    <p>Challenge #3</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 prsnl_sm_sec">
                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>recent_post_img4.jpg" class="img-responsive center-block">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3  col-xs-offset-1 prsnl_sm_sec">
                                    <p>8/09/2016</p>
                                </div>
                            </div>

                            <div class="row chalng_tblrow">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 prsnl_sm_sec">
                                    <p>Challenge #4</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 prsnl_sm_sec">
                                    <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3  col-xs-offset-1 prsnl_sm_sec">
                                    <p>20/09/2016</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row personal_act_sec">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <div class="prfl_cvr_sec">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row grp_3sec">
                            <h2 class="subgroup">My Challenges</h2>
                            <?php
                            if ($my_challenges != null && !empty($my_challenges)) {
                                foreach ($my_challenges as $my_challenge) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $my_challenge['name'] ?></h2>
                                        </div>
                                        <p class="enter_btn"><a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($my_challenge['id'])) ?>">Enter</a></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p> No Challenges.</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <hr>
                        <div class="row grp_3sec">
                            <h2 class="subgroup">Accepted Challenges</h2>
                            <?php
                            if ($joined_challenges != null && !empty($joined_challenges)) {
                                foreach ($joined_challenges as $joined_challenge) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $joined_challenge['name'] ?></h2>
                                        </div>
                                        <p class="enter_btn"><a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($joined_challenge['id'])) ?>">Enter</a></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p> No Challenges.</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
