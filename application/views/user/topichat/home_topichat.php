<?php $this->load->view('layouts/profile_common'); ?>
<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2>Topichat</h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
            <div class="prfl_cvr_sec prfl_cvr_sec_dvdr prfl_cvr_sec_dvdr2">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 topi_prsnl">
                        <h2>Topic Notification :</h2>
                        <p><span class="by_spn">Topichat 1</span> <span>New Message By Jim</span></p>
                        <p><span class="by_spn">Topichat 2</span> <span>New Message By Meera</span></p>
                        <p><span class="by_spn">Topichat 3</span> <span>New Message By Jing</span></p>
                        <p><span class="by_spn">Topichat 4</span> <span>New Message By Jim</span></p>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 ">
                        <h2>Group</h2>
                        <div class="row grp_3sec">
                            <?php
                            if ($topichats != null && !empty($topichats)) {
                                foreach ($topichats as $topichat) {
                                    ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $topichat['topic_name'] ?></h2>
                                        </div>
                                        <p class="enter_btn"><a href="<?php echo base_url() . "topichat/details/" . urlencode(base64_encode($topichat['id'])) ?>">Enter</a></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
