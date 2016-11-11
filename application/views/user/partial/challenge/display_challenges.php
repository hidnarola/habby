<?php
if ($Challenges != "" && !empty($Challenges)) {
    foreach ($Challenges as $Challenge) {
//                            pr($Challenge);
        ?>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
            <div class="challenge_sec" data-challenge_id="<?php echo $Challenge['id']; ?>">
                <!-- Challenge header section start here -->
                <div class="challenge_cont_sec row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3 chlng_pflsec">
                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Challenge['user_image']; ?>" class="img-responsive center-block ">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                        <h2 class="chlng_hdg"><?php echo $Challenge['name']; ?> <img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>" class="pull-right"></h2>
                    </div>
                </div>
                <!-- Challenge header section end here -->

                <!-- Challenge content section start here -->

                <div class="challenge_cont_sec2 row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                        <div id="field">
                            <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH;
        echo ($Challenge['is_ranked'] && $Challenge['given_rank'] == 1) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png"; ?>"></button>
                            <input type="text" id="1" value="<?php echo $Challenge['average_rank']; ?>"  class="field rank_rate" />
                            <button type="button" id="sub" class="sub smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH;
        echo ($Challenge['is_ranked'] && $Challenge['given_rank'] == 0) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png"; ?>"></button>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8 pad_lft0">
                        <p class="chlng_para">
        <?php echo $Challenge['description'] ?>
                        </p>
                    </div>
                </div>

                <!-- Challenge content section end here -->

                <!-- Challenge buttons section start here -->
                <div class="challenge_cont_sec3 row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="list-inline chlng_ul2">
                            <li><span title="Rewards"><img class="reward_img" src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png" ?>"/><?php echo $Challenge['rewards'] ?></span></li>
                            <li class="winner">
                                <a class="pstbtn others_rank" data-toggle="modal" data-target="#rank_modal" data-id="<?php echo $Challenge['id']; ?>">
                                    Winners
                                </a>
                            </li>
                            <?php
                            if (isset($Challenge['is_applied']) && $Challenge['is_applied']) {
                                ?>
                                <li><a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($Challenge['id'])) ?>" class="pstbtn">Enter</a></li>
                                <?php
                            } else {
                                ?>
                                <li><a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Challenge['id'])) ?>" class="pstbtn">Accept</a></li>
                                    <?php
                                }
                                ?>
                        </ul>

                    </div>
                </div>
                <!-- Challenge buttons section end here -->
            </div>
        </div>
        <!-- Challenge each section end here -->
        <?php
    }
}
?>