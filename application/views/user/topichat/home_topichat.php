<?php $this->load->view('layouts/profile_common'); ?>
<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2><?php echo lang('Topichat');?></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
            <div class="prfl_cvr_sec prfl_cvr_sec_dvdr prfl_cvr_sec_dvdr2">
                <div class="row">
                    <?php
                        if($user_data['id'] == $this->session->user['id'])
                        {
                            ?>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 topi_prsnl">
                                <h2><?php echo lang('');?>Topic Notification :</h2>                        
                                <p><span class="by_spn">Topichat 1</span> <span>New Message By Jim</span></p>
                            </div>
                            <?php
                        }
                    ?>
                    <?php
                        if($user_data['id'] == $this->session->user['id'])
                        {
                            ?>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 ">
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <?php
                        }
                    ?>
                    
                        <h2><?php echo lang('Group');?></h2>
                        <div class="row grp_3sec">
                            <h2 class="subgroup"><?php echo lang('My Groups');?></h2>
                            <?php
                            if ($my_topichats != null && !empty($my_topichats)) {
                                foreach ($my_topichats as $my_topichat) {
                                    ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $my_topichat['topic_name'] ?></h2>
                                        </div>
                                        <p class="enter_btn"><a href="<?php echo base_url() . "topichat/details/" . urlencode(base64_encode($my_topichat['id'])) ?>"><?php echo lang('Enter');?></a></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p> <?php echo lang('No Groups.');?></p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <hr>
                        <div class="row grp_3sec">
                            <h2 class="subgroup"><?php echo lang('Joined Groups');?></h2>
                            <?php
                            if ($joined_topichats != null && !empty($joined_topichats)) {
                                foreach ($joined_topichats as $joined_topichat) {
                                    ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $joined_topichat['topic_name'] ?></h2>
                                        </div>
                                        <p class="enter_btn"><a href="<?php echo base_url() . "topichat/details/" . urlencode(base64_encode($joined_topichat['id'])) ?>"><?php echo lang('Enter');?></a></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p> <?php echo lang('No Groups.');?></p>
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
