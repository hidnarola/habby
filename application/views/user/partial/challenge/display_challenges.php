<?php
if ($Challenges != "" && !empty($Challenges)) {
    foreach ($Challenges as $Challenge) {
//                            pr($Challenge);
        ?>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
            <div class="challenge_sec ">
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
                            <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
                            <input type="text" id="1" value="<?php echo $Challenge['average_rank']; ?>" class="field" />
                            <button type="button" id="sub" class="sub smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>"></button>
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
                            <li><span>Rewards</span></li>
                            <li class="winner winner_btn" id="winner<?php echo $Challenge['id']; ?>" data-id="<?php echo $Challenge['id']; ?>">
                                <a class="pstbtn">Winners</a>
                            </li>
                            <li><a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Challenge['id'])) ?>" class="pstbtn">Accept</a></li>
                        </ul>

                    </div>
                </div>
                <!-- Challenge buttons section end here -->

                <!-- Winner Popup start here -->
                <div class="dropdownpln">
                    <div class="winner_popup winner_popup<?php echo $Challenge['id']; ?>" role="menu">

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