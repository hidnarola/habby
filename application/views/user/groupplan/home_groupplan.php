<?php $this->load->view('layouts/profile_common'); ?>
<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2>Group Plan </h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
            <div class="prfl_cvr_sec prfl_cvr_sec_dvdr prfl_cvr_sec_dvdr2">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 topi_prsnl">
                        <h2>Group Plan Notification :</h2>
                        <p><span class="by_spn">Group Plan 1</span> <span>New Message By Jim</span></p>
                        <p><span class="by_spn">Group Plan 2</span> <span>New Message By Meera</span></p>
                        <p><span class="by_spn">Group Plan 3</span> <span>New Message By Jing</span></p>
                        <p><span class="by_spn">Group Plan 4</span> <span>New Message By Jim</span></p>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 topi_prsnl soulmate_reqs">
                        <h2 id="h2_soulmate">Group Plan Request :</h2>
                        <?php
                        if ($groupplan_reqs != null && !empty($groupplan_reqs)) {
                            foreach ($groupplan_reqs as $groupplan_req) {
//                                pr($soulmate_req);
                                ?>
                                <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 soulmate_<?php echo $groupplan_req['group_id'] ?>" id="soulmate_req">
                                    <p class="accept_req"><span class="by_spn"><?php echo $groupplan_req['name']; ?></span> <span>New Request By <?php echo $groupplan_req['display_name']; ?></span></p>
                                    <span class="accept_btn" id="accept_btn_<?php echo $groupplan_req['id']; ?>"><a href="javascript:void(0)" data-id="<?php echo $groupplan_req['id']; ?>" data-action="accept">Accept</a>
                                        <a class="" href="javascript:void(0)" data-id="<?php echo $groupplan_req['id']; ?>" data-action="cancel">Cancel</a></span>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <p> No New Request.</p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row personal_act_sec">
    <div class="container prsna_coner personal_cntner">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <h2>Group Plans </h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_sec">
            <div class="prfl_cvr_sec">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row grp_3sec">
                            <h2 class="subgroup">My Groups</h2>
                            <?php
                            if ($my_groupplans != null && !empty($my_groupplans)) {
                                foreach ($my_groupplans as $my_groupplan) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $my_groupplan['name'] ?></h2>
                                        </div>
                                        <p class="enter_btn"><a href="<?php echo base_url() . "groupplan/details/" . urlencode(base64_encode($my_groupplan['id'])) ?>">Enter</a></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p> No Groups.</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <hr>
                        <div class="row grp_3sec">
                            <h2 class="subgroup">Joined Groups</h2>
                            <?php
                            if ($joined_groupplans != null && !empty($joined_groupplans)) {
                                foreach ($joined_groupplans as $joined_groupplan) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="grp_prsnl_innr">
                                            <h2><?php echo $joined_groupplan['name'] ?></h2>
                                        </div>
                                        <p class="enter_btn"><a href="<?php echo base_url() . "soulmate/details/" . urlencode(base64_encode($joined_groupplan['id'])) ?>">Enter</a></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p> No Groups.</p>
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
<script type="text/javascript">
    $(function () {
        $(".accept_btn a").on('click', function () {
            var t = $(this);
            var id = $(this).data('id');
            var action = $(this).data('action');
            $.ajax({
                url: '<?php echo base_url() . "soulmate/request_action"; ?>',
                type: 'POST',
                data: {id: id, action: action},
                success: function (data) {
                    if (action === 'accept') {
                        $(t).parents('.soulmate_reqs').find('.soulmate_' + data.trim()).fadeOut(1000);
                        $('#h2_soulmate').after("<h2 class='req_msg'>Request Accepted. </h2>");
                        $('.req_msg').fadeOut(5000);
                    } else {
                        $(t).parents('#soulmate_req').fadeOut(1000);
                        $('#h2_soulmate').after("<h2 class='req_msg'>Request Canceled. </h2>");
                        $('.req_msg').fadeOut(5000);
                    }
                }
            });
        });
    });
</script>