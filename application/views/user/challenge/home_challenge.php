<script>
    function setTimeOffset() {
        // Create all the dates necessary
        var now = later = d1 = d2 = new Date(),
                set = {'offset': now.getTimezoneOffset(), 'dst': 0}
        // Set time for how long the cookie should be saved - 1 year
        later.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);
        // Date one is set to January 1st of this year
        // Guaranteed not to be in DST for northern hemisphere and guaranteed to be in DST for southern hemisphere (If DST exists on client PC)
        d1.setDate(1);
        d1.setMonth(1);
        // Date two is set to July 1st of this year
        // Guaranteed to be in DST for northern hemisphere and guaranteed not to be in DST for southern hemisphere (If DST exists on client PC)
        d2.setDate(1);
        d2.setMonth(7);

        // DST exists for this time zone – check if it is currently active
        if (parseInt(d1.getTimezoneOffset()) != parseInt(d2.getTimezoneOffset())) {
            // Find out if we are on northern or southern hemisphere - Hemisphere is positive for northern, and negative for southern
            var hemisphere = parseInt(d1.getTimezoneOffset()) - parseInt(d2.getTimezoneOffset());

            if (
                    (hemisphere > 0 && parseInt(d1.getTimezoneOffset()) == parseInt(now.getTimezoneOffset())) ||
                    (hemisphere < 0 && parseInt(d2.getTimezoneOffset()) == parseInt(now.getTimezoneOffset()))
                    ) {
                // DST is active right now
                set.dst = 1;
            }
        }
        document.cookie = 'time_zone=' + JSON.stringify(set) + '; expires=' + later + '; path=/';
    }
    setTimeOffset();
</script>
<?php
    // Check for the time_zone cookie, if set then reset the default timezone
    if ( isset($_COOKIE['time_zone']) ) {
        $time_zone = json_decode( $_COOKIE['time_zone'], true );
        $timezone_name = timezone_name_from_abbr( '', -$time_zone['offset']*60, $time_zone['dst'] );
    }
    else
    {
        $timezone_name = "Europe/London";
    }
$this->load->view('layouts/profile_common');
?>
<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2><?php echo lang('Challenges') ?></h2>
        </div>
        <?php
        if ($user_data['id'] == $this->session->user['id']) {
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
                <div class="prfl_cvr_sec prfl_cvr_sec_dvdr">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 topi_prsnl topi_prsnl_btm">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 prsnl_sm_sec">
                                    <h2 class="nexttab_h2"><?php echo lang('Challenge accepted') ?> <span class="nexttab"><?php echo lang('Accepted date') ?></span></h2>
                                </div>
                                <?php
                                if ($challenge_accepted != null && !empty($challenge_accepted)) {
                                    foreach ($challenge_accepted as $challenge) {
//                                    pr($challenge);
                                        ?>
                                        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 prsnl_sm_sec">
                                            <p><?php echo $challenge['name'] . " " . lang("accepted by") . " " . $challenge['display_name'] ?> </p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 prsnl_sm_sec">

                                            <p><?php echo _date("d/m/Y H:i", strtotime($challenge['challange_date']), $timezone_name); ?></p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-12 alert alert-info">
                                        <?php echo lang('No Challenge notification available.') ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 topi_prsnl topi_prsnl_btm">
                            <div class="chalng_tbl_sec">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 prsnl_sm_sec">
                                        <h2><?php echo lang('Finished') ?>:</h2>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 prsnl_sm_sec">
                                        <h2><?php echo lang('Dates') ?></h2>
                                    </div>
                                </div>
                                <?php
                                if (isset($finish_challenges) && !empty($finish_challenges)) {
                                    foreach ($finish_challenges as $finish_challenge) {
                                        ?>
                                        <div class="row chalng_tblrow">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 prsnl_sm_sec">
                                                <p><?php echo $finish_challenge['name'] ?></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 prsnl_sm_sec">

                                                <p><?php echo _date("d/m/Y H:i", strtotime($finish_challenge['modified_date']), $timezone_name) ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class = "alert alert-info text-center">
                                        <?php echo lang('No Finished Challenge.') ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="row personal_act_sec">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <div class="prfl_cvr_sec">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row grp_3sec">
                            <h2 class="subgroup"><?php echo lang('My Challenges') ?></h2>
                            <?php
                            if ($my_challenges != null && !empty($my_challenges)) {
                                foreach ($my_challenges as $my_challenge) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $my_challenge['name'] ?></h2>
                                        </div>
                                        <p class="enter_btn">
                                            <?php
                                            if ($user_data['id'] == $this->session->user['id']) {
                                                ?>
                                                <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($my_challenge['id'])) ?>"><?php echo lang('Enter') ?> <?php echo ($my_challenge['is_finished'] == 1) ? "(" . lang('Finished') . ")" : "" ?></a>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-sm-12 alert alert-info">
                                    <?php echo lang("You haven't created your challenge.") ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <hr>
                        <div class="row grp_3sec">
                            <h2 class="subgroup"><?php echo lang('Accepted Challenges') ?></h2>
                            <?php
                            if ($joined_challenges != null && !empty($joined_challenges)) {
                                foreach ($joined_challenges as $joined_challenge) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $joined_challenge['name'] ?></h2>
                                        </div>
                                        <p class="enter_btn">
                                            <?php
                                            if ($user_data['id'] == $this->session->user['id']) {
                                                ?>
                                                <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($joined_challenge['id'])) ?>"><?php echo lang('Enter') ?> <?php echo ($joined_challenge['is_finished'] == 1) ? "(" . lang('Finished') . ")" : "" ?></a>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-sm-12 alert alert-info">
                                    <?php echo lang("You havan't joined any challenge.") ?>
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

