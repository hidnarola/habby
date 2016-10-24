<!-- Topicaht Post and bannner section end here -->

<div class="row topic_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#new_grp">New <br>Challenge</a>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <!-- Challenge Title Section section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="list-inline clng_ttl_ul">
                            <li>Newest</li>
                            <li><a href="<?php echo base_url() . "challenge/challenges?ch=newest" ?>" class="pstbtn more_challenge">More</a></li>
                        </ul>
                    </div>
                    <!-- Challenge Title Section section end here -->
                </div>
                <div class="row">
                    <?php
                    if ($Newest_Challenges != "" && !empty($Newest_Challenges)) {
                        foreach ($Newest_Challenges as $Newest_Challenge) {
//                        pr($Newest_Challenge);
                            ?>

                            <!-- Challenge each section start here -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                <div class="challenge_sec ">
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
                                                <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
                                                <input type="text" id="1" value="<?php echo $Newest_Challenge['average_rank']; ?>" class="field" />
                                                <button type="button" id="sub" class="sub smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
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
                                                <li><span>Rewards<?php // echo $Newest_Challenge['rewards']                             ?></span></li>
                                                <li class="winner winner_n_btn" id="winner<?php echo $Newest_Challenge['id']; ?>" data-id="<?php echo $Newest_Challenge['id']; ?>">
                                                    <a class="pstbtn">Winners</a>
                                                </li>
                                                <li>
                                                    <?php
                                                    if ($Newest_Challenge['is_applied']) {
                                                        ?>
                                                        <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($Newest_Challenge['id'])) ?>" class="pstbtn">Enter</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Newest_Challenge['id'])) ?>" class="pstbtn">Accept</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <!-- Challenge buttons section end here -->

                                    <!-- Winner Popup start here -->
                                    <div class="dropdownpln">
                                        <div class="winner_popup winner_popup_n_<?php echo $Newest_Challenge['id']; ?>" role="menu">

                                            <div class="winner_hdg_sec">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <h2 class="winner_hdg">Winner</h2>
                                                </div>
                                            </div>

                                            <div class="dicrp_section">
                                                <div class="dicrp_sectioninr">

                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "challenge-prfl.jpg"; ?>" class="img-responsive center-block ">
                                                    </div>

                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                        <!-- <h2 class="chlng_hdg">Work description</h2> -->
                                                        <p class="chlng_para">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </p>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_pstr">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "grp_pln_img4.jpg"; ?>">
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_cmnt">

                                                        <ul class="list-inline winr_ul">
                                                            <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png"; ?>"><br><span> 10 </span></a></li>
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                                    <img src="<?php echo DEFAULT_IMAGE_PATH . "like_img.png"; ?>"><br><span>20 Likes  </span>
                                                                </a>
                                                                <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                                    <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a role="button" class="cmnt_winner"><img src="<?php echo DEFAULT_IMAGE_PATH . "comment_icon.png"; ?>"><br><span> Comments  </span></a></li>
                                                        </ul>

                                                        <div class="winner-comnt">

                                                            <p class="cmn_txtnw"> Comment Here</p>
                                                            <textarea class="form-control" rows="3" id="textArea"></textarea>

                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Winner Popup start here -->
                                </div>
                            </div>
                            <!-- Challenge each section end here -->
        <?php
    }
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
                            <li><a href="<?php echo base_url() . "challenge/challenges?ch=popular" ?>" class="pstbtn more_challenge">More</a></li>
                        </ul>
                    </div>
                    <!-- Challenge Title Section section end here -->
                </div>
                <div class="row">				
<?php
if ($Popular_Challenges != "" && !empty($Popular_Challenges)) {
    foreach ($Popular_Challenges as $Popular_Challenge) {
        ?>

                            <!-- Challenge each section start here -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                <div class="challenge_sec ">
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
                                                <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
                                                <input type="text" id="1" value="<?php echo $Popular_Challenge['average_rank'] ?>" class="field" />
                                                <button type="button" id="sub" class="sub smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
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
                                                <li><span>Rewards</span></li>
                                                <li class="winner winner_p_btn" id="winner<?php echo $Popular_Challenge['id'] ?>"  data-id="<?php echo $Popular_Challenge['id']; ?>">
                                                    <a class="pstbtn">Winners</a>
                                                </li>
                                                <li>
        <?php
        if ($Popular_Challenge['is_applied']) {
            ?>
                                                        <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($Popular_Challenge['id'])) ?>" class="pstbtn">Enter</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Popular_Challenge['id'])) ?>" class="pstbtn">Accept</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Challenge buttons section end here -->

                                    <!-- Winner Popup start here -->
                                    <div class="dropdownpln">
                                        <div class="winner_popup winner_popup_p_<?php echo $Popular_Challenge['id'] ?>" role="menu">

                                            <div class="winner_hdg_sec">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <h2 class="winner_hdg">Winner</h2>
                                                </div>
                                            </div>

                                            <div class="dicrp_section">
                                                <div class="dicrp_sectioninr">

                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "challenge-prfl.jpg"; ?>" class="img-responsive center-block ">
                                                    </div>


                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                        <!-- <h2 class="chlng_hdg">Work description</h2> -->
                                                        <p class="chlng_para">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </p>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_pstr">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "grp_pln_img4.jpg"; ?>">
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_cmnt">

                                                        <ul class="list-inline winr_ul">
                                                            <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png"; ?>"><br><span> 10 </span></a></li>
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                                    <img src="<?php echo DEFAULT_IMAGE_PATH . "like_img.png"; ?>"><br><span>20 Likes  </span>
                                                                </a>
                                                                <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                                    <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a role="button" class="cmnt_winner"><img src="<?php echo DEFAULT_IMAGE_PATH . "comment_icon.png"; ?>"><br><span> Comments  </span></a></li>
                                                        </ul>

                                                        <div class="winner-comnt">

                                                            <p class="cmn_txtnw"> Comment Here</p>
                                                            <textarea class="form-control" rows="3" id="textArea"></textarea>

                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Winner Popup start here -->
                                </div>
                            </div>
                            <!-- Challenge each section end here -->

        <?php
    }
}
?>
                </div>
                <!-- Challenge row section end here -->


                <!-- Challenge row section start here -->

                <div class="row">
                    <!-- Challenge Title Section section start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="list-inline clng_ttl_ul">
                            <li>Recommended</li>
                            <li><a href="<?php echo base_url() . "challenge/challenges?ch=recommended" ?>" class="pstbtn more_challenge">More</a></li>
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
                                <div class="challenge_sec ">
                                    <!-- Challenge header section start here -->
                                    <div class="challenge_cont_sec row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3 chlng_pflsec">
                                            <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Recom_Challenge['user_image'] ?>" class="img-responsive center-block ">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                            <h2 class="chlng_hdg">Makes a challenge <img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>" class="pull-right"></h2>
                                        </div>
                                    </div>
                                    <!-- Challenge header section end here -->

                                    <!-- Challenge content section start here -->

                                    <div class="challenge_cont_sec2 row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                            <div id="field">
                                                <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
                                                <input type="text" id="1" value="<?php echo $Recom_Challenge['average_rank'] ?>" class="field" />
                                                <button type="button" id="sub" class="sub smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
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
                                                <li><span>Rewards</span></li>
                                                <li class="winner winner_r_btn" id="winner<?php echo $Recom_Challenge['id'] ?>" data-id="<?php echo $Recom_Challenge['id']; ?>">
                                                    <a class="pstbtn">Winners</a>
                                                </li>
                                                <li>
        <?php
        if ($Recom_Challenge['is_applied']) {
            ?>
                                                        <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($Recom_Challenge['id'])) ?>" class="pstbtn">Enter</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Recom_Challenge['id'])) ?>" class="pstbtn">Accept</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <!-- Challenge buttons section end here -->

                                    <!-- Winner Popup start here -->
                                    <div class="dropdownpln">
                                        <div class="winner_popup winner_popup_r_<?php echo $Recom_Challenge['id'] ?>" role="menu">

                                            <div class="winner_hdg_sec">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <h2 class="winner_hdg">Winner</h2>
                                                </div>
                                            </div>

                                            <div class="dicrp_section">
                                                <div class="dicrp_sectioninr">

                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "challenge-prfl.jpg"; ?>" class="img-responsive center-block ">
                                                    </div>

                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                        <!-- <h2 class="chlng_hdg">Work description</h2> -->
                                                        <p class="chlng_para">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </p>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_pstr">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "grp_pln_img4.jpg"; ?>">
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_cmnt">

                                                        <ul class="list-inline winr_ul">
                                                            <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png"; ?>"><br><span> 10 </span></a></li>
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                                    <img src="<?php echo DEFAULT_IMAGE_PATH . "like_img.png"; ?>"><br><span>20 Likes  </span>
                                                                </a>
                                                                <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                                    <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a role="button" class="cmnt_winner"><img src="<?php echo DEFAULT_IMAGE_PATH . "comment_icon.png"; ?>"><br><span> Comments  </span></a></li>
                                                        </ul>

                                                        <div class="winner-comnt">

                                                            <p class="cmn_txtnw"> Comment Here</p>
                                                            <textarea class="form-control" rows="3" id="textArea"></textarea>

                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Winner Popup start here -->
                                </div>
                            </div>
                            <!-- Challenge each section end here -->
        <?php
    }
}
?>
                </div>
                <!-- Challenge row section end here -->
            </div>
        </div>
    </div>
    <!-- Soulmate #1 section and Newest Post area end here  -->
    <!-- Group section container end here -->

    <!--    <div class="row">
            <div class="container">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                    <a href="#" id="loadMore">Load More</a>
    
                    <p class="totop"> 
                        <a href="#top"><img src="images/upload.png" class="img-responsive"></a> 
                    </p>
                </div>
            </div>
        </div>-->
</div>
<!-- Soulmate new group form popup start here -->
<div class="modal" id="new_grp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b>CREATE NEW CHALLENGE</b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "challenge/add_group"; ?>" enctype="multipart/form-data">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="name" placeholder="Challenge:" name="name" required="true">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="description" placeholder="Required Details : " name="description">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="rewards" placeholder="Rewards: " name="rewards">
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
<!-- Soulmate new group form popup end here -->
<script type="text/javascript">
    $('#groupplan1post').on('show.bs.modal', function (e) {

        //get data-id attribute of the clicked element
        var title = $(e.relatedTarget).data('title');
        var image = $(e.relatedTarget).data('image');
        var user = $(e.relatedTarget).data('user');
        var uimage = $(e.relatedTarget).data('uimage');

        $('#modal_title').text(title);
        $('#modal_user').text(user);
        $('#m_image').attr('src', image);
        $('#m_user_image').attr('src', uimage);
    });
    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        //        console.log('on change fired');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }


        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                $('.message').hide();
                $('.image_wrapper').show();
                $("#imagePreview").css("background-image", "url(" + this.result + ")");
            }
        } else {
            $('.message').html("Please select proper image");
            $('.message').show();
        }
    });

    $(".filterby").change(function () {
        $("#filterby_form").submit();
    });
    $(".find_topic").click(function () {
        $("#search_form").submit();
    });

    $(".more_challenge").click(function () {
        $("#more_ch_form").submit();
    })
</script>
<script>
    $(function () {
        $("div.soulmate_con2").slice(0, 5).show();
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $("div.soulmate_con2:hidden").slice(0, 5).slideDown();
            if ($("div.soulmate_con2:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().top
            }, 1500);
        });
    });

    $('a[href=#top]').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.totop a').fadeIn();
        } else {
            $('.totop a').fadeOut();
        }
    });
</script>
<script>
    $(document).ready(function () {
        $(".winner_n_btn").click(function () {
            var id = $(this).data('id');
            $(".winner_popup_n_" + id).slideToggle(1000);
        });
        $(".winner_p_btn").click(function () {
            var id = $(this).data('id');
            $(".winner_popup_p_" + id).slideToggle(1000);
        });
        $(".winner_r_btn").click(function () {
            var id = $(this).data('id');
            $(".winner_popup_r_" + id).slideToggle(1000);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".cmnt_winner").click(function () {
            $(".winner-comnt").slideToggle(1000);
        });
    });
</script>

<!-- vote section jquery start here -->
<script>
    $('.add').click(function () {
        $(this).next().val(+$(this).next().val() + 1);
    });
    $('.sub').click(function () {
        if ($(this).prev().val() > 0)
            $(this).prev().val(+$(this).prev().val() - 1);
    });
</script>