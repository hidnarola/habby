<!-- Topicaht Post and bannner section end here -->

<div class="row topic_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#new_grp"><?php echo lang("New"); ?> <br><?php echo lang("Challenge"); ?></a>
        <!-- New Group button end-->
    </div>

</div>
<!-- Topicaht Post and bannner section end here -->
<div id="FilterContainer">
    <?php
    $message = $this->session->flashdata('message');
    if (!empty($message) && isset($message)) {
        ($message['class'] != '') ? $message['class'] : '';
        echo '<div class="' . $message['class'] . '">' . $message['message'] . '</div>';
    }

    $all_errors = validation_errors();
    if (isset($all_errors) && !empty($all_errors)) {
        echo '<div class="alert alert-danger">' . $all_errors . '</div>';
    }
    ?>
    <!-- Soulmate #1 section and Newest Post area start here  -->
    <div class="row grp_pnl_row newest-post flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 challenge_container">

                <?php
                if (count($Newest_Challenges) > 0) {
                    ?>

                    <div class="row">
                        <!-- Challenge Title Section section start here -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="list-inline clng_ttl_ul">
                                <li>Newest</li>
                                <li><a href="<?php echo base_url() . "challenge/challenges?ch=newest" ?>" class="pstbtn more_challenge"><?php echo lang("More"); ?></a></li>
                            </ul>
                        </div>
                        <!-- Challenge Title Section section end here -->
                    </div>
                    <div class="row challenge_container">
                        <?php
                        if ($Newest_Challenges != "" && !empty($Newest_Challenges)) {
                            foreach ($Newest_Challenges as $Newest_Challenge) {
//                        pr($Newest_Challenge);
                                ?>

                                <!-- Challenge each section start here -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                    <div class="challenge_sec" data-challenge_id="<?php echo $Newest_Challenge['id']; ?>">
                                        <!-- Challenge header section start here -->
                                        <div class="challenge_cont_sec row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3 chlng_pflsec">
                                                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Newest_Challenge['user_image']; ?>" class="img-responsive center-block ">
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                <h2 class="chlng_hdg"><?php echo $Newest_Challenge['name']; ?> <img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>" class="pull-right"></h2>
                                            </div>
                                        </div>
                                        <!-- Challenge header section end here -->

                                        <!-- Challenge content section start here -->

                                        <div class="challenge_cont_sec2 row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                <div id="field">
                                                    <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($Newest_Challenge['is_ranked'] && $Newest_Challenge['given_rank'] == 1) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png";
                                                        ?>"></button>
                                                    <input type="text" id="1" value="<?php echo $Newest_Challenge['average_rank']; ?>" class="field rank_rate" />
                                                    <button type="button" id="sub" class="sub smlr_btn"><img src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($Newest_Challenge['is_ranked'] && $Newest_Challenge['given_rank'] == 0) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png";
                                                        ?>"></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8 pad_lft0">
                                                <p class="chlng_para">
                                                    <?php echo $Newest_Challenge['description'] ?>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Challenge content section end here -->

                                        <!-- Challenge buttons section start here -->
                                        <div class="challenge_cont_sec3 row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <ul class="list-inline chlng_ul2">
                                                    <li><span title="Rewards"><img class="reward_img" src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png" ?>"/><?php echo $Newest_Challenge['rewards'] ?></span></li>
                                                    <li class="winner">
                                                        <a class="pstbtn others_rank" data-toggle="modal" data-target="#rank_modal" data-id="<?php echo $Newest_Challenge['id']; ?>">
                                                            <?php echo lang("Winners"); ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <?php
                                                        if ($Newest_Challenge['is_applied']) {
                                                            ?>
                                                            <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($Newest_Challenge['id'])) ?>" class="pstbtn"><?php echo lang("Enter"); ?></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Newest_Challenge['id'])) ?>" class="pstbtn"><?php echo lang("Accept"); ?></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        <!-- Challenge buttons section end here -->
                                    </div>
                                </div>
                                <!-- Challenge each section end here -->
                                <?php
                            }
                        } else {
                            ?>
                            <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                <p> <?php echo lang("No Newest Challenge."); ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Challenge row section end here -->

                    <!-- Challenge row section start here -->

                    <div class="row">
                        <!-- Challenge Title Section section start here -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="list-inline clng_ttl_ul">
                                <li>Popular</li>
                                <li><a href="<?php echo base_url() . "challenge/challenges?ch=popular" ?>" class="pstbtn more_challenge"><?php echo lang("More"); ?></a></li>
                            </ul>
                        </div>
                        <!-- Challenge Title Section section end here -->
                    </div>
                    <div class="row challenge_container">				
                        <?php
                        if ($Popular_Challenges != "" && !empty($Popular_Challenges)) {
                            foreach ($Popular_Challenges as $Popular_Challenge) {
                                ?>

                                <!-- Challenge each section start here -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                    <div class="challenge_sec" data-challenge_id="<?php echo $Popular_Challenge['id']; ?>">
                                        <!-- Challenge header section start here -->
                                        <div class="challenge_cont_sec row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3 chlng_pflsec">
                                                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Popular_Challenge['user_image'] ?>" class="img-responsive center-block ">
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                <h2 class="chlng_hdg"><?php echo $Popular_Challenge['name'] ?> <img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>" class="pull-right"></h2>
                                            </div>
                                        </div>
                                        <!-- Challenge header section end here -->

                                        <!-- Challenge content section start here -->

                                        <div class="challenge_cont_sec2 row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                <div id="field">
                                                    <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($Popular_Challenge['is_ranked'] && $Popular_Challenge['given_rank'] == 1) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png";
                                                        ?>"></button>
                                                    <input type="text" id="1" value="<?php echo $Popular_Challenge['average_rank'] ?>" class="field rank_rate" />
                                                    <button type="button" id="sub" class="sub smlr_btn"><img src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($Popular_Challenge['is_ranked'] && $Popular_Challenge['given_rank'] == 0) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png";
                                                        ?>"></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8 pad_lft0">
                                                <p class="chlng_para">
                                                    <?php echo $Popular_Challenge['description'] ?>
                                                </p>
                                            </div>

                                        </div>

                                        <!-- Challenge content section end here -->

                                        <!-- Challenge buttons section start here -->
                                        <div class="challenge_cont_sec3 row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <ul class="list-inline chlng_ul2">
                                                    <li><span title="<?php lang('Rewards') ?>"><img class="reward_img" src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png" ?>"/><?php echo $Popular_Challenge['rewards'] ?></span></li>
                                                    <li class="winner">
                                                        <a class="pstbtn others_rank" data-toggle="modal" data-target="#rank_modal" data-id="<?php echo $Popular_Challenge['id']; ?>">
                                                            <?php echo lang("Winners"); ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <?php
                                                        if ($Popular_Challenge['is_applied']) {
                                                            ?>
                                                            <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($Popular_Challenge['id'])) ?>" class="pstbtn"><?php echo lang("Enter"); ?></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Popular_Challenge['id'])) ?>" class="pstbtn"><?php echo lang("Accept"); ?></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Challenge buttons section end here -->
                                    </div>
                                </div>
                                <!-- Challenge each section end here -->

                                <?php
                            }
                        } else {
                            ?>
                            <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                <p> <?php echo lang("No Popular Challenge."); ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Challenge row section end here -->


                    <!-- Challenge row section start here -->

                    <div class="row">
                        <!-- Challenge Title Section section start here -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="list-inline clng_ttl_ul">
                                <li><?php echo lang("Recommended"); ?></li>
                                <?php
                                if (($Recom_Challenges != "" && !empty($Recom_Challenges))) {
                                    if (count($Recom_Challenges) > 0) {
                                        ?>
                                        <li><a href="<?php echo base_url() . "challenge/challenges?ch=recommended" ?>" class="pstbtn more_challenge"><?php echo lang("More"); ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- Challenge Title Section section end here -->
                    </div>
                    <div class="row">					
                        <?php
                        if ($Recom_Challenges != "" && !empty($Recom_Challenges)) {
                            foreach ($Recom_Challenges as $Recom_Challenge) {
                                ?>

                                <!-- Challenge each section start here -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                    <div class="challenge_sec" data-challenge_id="<?php echo $Recom_Challenge['id']; ?>">
                                        <!-- Challenge header section start here -->
                                        <div class="challenge_cont_sec row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3 chlng_pflsec">
                                                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Recom_Challenge['user_image'] ?>" class="img-responsive center-block ">
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                <h2 class="chlng_hdg"><?php echo $Recom_Challenge['name'] ?><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>" class="pull-right"></h2>
                                            </div>
                                        </div>
                                        <!-- Challenge header section end here -->

                                        <!-- Challenge content section start here -->

                                        <div class="challenge_cont_sec2 row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                <div id="field">
                                                    <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($Recom_Challenge['is_ranked'] && $Recom_Challenge['given_rank'] == 1) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png";
                                                        ?>"></button>
                                                    <input type="text" id="1" value="<?php echo $Recom_Challenge['average_rank'] ?>" class="field rank_rate" />
                                                    <button type="button" id="sub" class="sub smlr_btn"><img src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($Recom_Challenge['is_ranked'] && $Recom_Challenge['given_rank'] == 0) ? 'challeng_arrow_ranked.png' : "challeng_arrow.png";
                                                        ?>"></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8 pad_lft0">
                                                <p class="chlng_para">
                                                    <?php echo $Recom_Challenge['description'] ?>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Challenge content section end here -->

                                        <!-- Challenge buttons section start here -->
                                        <div class="challenge_cont_sec3 row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <ul class="list-inline chlng_ul2">
                                                    <li><span title="Rewards"><img class="reward_img" src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png" ?>"/><?php echo $Recom_Challenge['rewards'] ?></span></li>
                                                    <li class="winner">
                                                        <a class="pstbtn others_rank" data-toggle="modal" data-target="#rank_modal" data-id="<?php echo $Recom_Challenge['id']; ?>">
                                                            <?php echo lang('Winners'); ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Recom_Challenge['id'])) ?>" class="pstbtn"><?php echo lang('Accept') ?></a>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        <!-- Challenge buttons section end here -->
                                    </div>
                                </div>
                                <!-- Challenge each section end here -->
                                <?php
                            }
                        } else {
                            ?>
                            <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                <p> <?php echo lang("No Recommended Challenge."); ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Challenge row section end here -->
                    <?php
                } else {
                    ?>
                    <div class='alert alert-info text-center'>
                        <?php echo lang("No Challenge available."); ?>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
    <!-- Soulmate #1 section and Newest Post area end here  -->
    <!-- Group section container end here -->
</div>
<!-- Soulmate new group form popup start here -->
<div class="modal" id="new_grp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><?php echo lang("CREATE NEW CHALLENGE"); ?></b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "challenge/add_group"; ?>" enctype="multipart/form-data">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="name" placeholder="<?php echo lang("Challenge"); ?>:" name="name" required="true">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="description" placeholder="<?php echo lang("Required Details"); ?> : " name="description" required="">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="number" class="form-control" id="rewards" placeholder="<?php echo lang("Rewards"); ?>: <?php echo lang("(Rewards must be between 1 to 10 coin)"); ?>" min="1" max="10" name="rewards" required>
                        </div>
                    </div>
                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" class="pstbtn" value="<?php echo lang('Create') ?>"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="groupplan1post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p id="modal_title"></p>
                <h4 class="modal-title">
                    <span id="modal_title"></span>
                </h4>
            </div>
            <div class="modal-body">
                <p class="modl_ttl"><img src="" class="cht_pfl_img" id="m_image" style="height: 275px;width: 560px;"></p>
                <div class="grp_pln_img_sec">
                    <img src="" class="img-responsive center-block" id="m_user_image" style="height: 34px;width: 34px;display: inline-block;padding-right:5px"><span id="modal_user"></span>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Rank modal -->
<div id="rank_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Rank modal over -->

<script>
    DEFAULT_IMAGE_PATH = '<?php echo DEFAULT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS; ?>challenge/challenge_list.js"></script>
<script type="text/javascript" src="<?php echo USER_JS; ?>challenge/challenge_popup.js"></script>
<script>
    $(function () {
        $('#new_grp').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
            $(this).find('form').trigger('reset');
            $('#name').val('').empty();
            $('#description').val('').empty();
            $('#rewards').val('').empty();
        });
    });
</script>