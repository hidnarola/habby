<?php
if (isset($league) && !empty($league)) {
    foreach ($league as $league_row) {
        ?>

        <!-- League and alliance each section start here -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 aliance_cl_6">
            <div class="grp_pln_sec">
                <div class="grp_pln_img_sec">
                    <a href="#" data-toggle="modal" data-target="#league1post" data-title="<?php echo $league_row['name'] ?>" data-image="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $league_row['league_image'] ?>" data-user="<?php echo $league_row['created_user'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $league_row['user_image'] ?>">
                        <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $league_row['league_image'] ?>" class="img-responsive center-block">
                    </a>
                </div>

                <div class="row alliance_cont_sec">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                        <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $league_row['league_logo'] ?>" class="img-responsive center-block league_logo">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
                        <p class="alinc_txt"><span><?php echo $league_row['total_user'] ?></span><span>/<?php echo $league_row['user_limit'] ?> users</span></p>
                        <p class="alinc_txt"><?php echo $league_row['name'] ?></p>
                    </div>
                </div>

                <div class="alliance_cont_sec2">
                    <p class="alinc_txt text-center"><?php echo $league_row['introduction'] ?></p>
                </div>

                <div class="alliance_cont_sec3">
                    <ul class="list-inline alliance_btn_ul">
                        <li><a href="javascript:;" class="requirements" data-requirement="<?php echo $league_row['requirements'] ?>"><?php echo lang('Requirement') ?></a></li>
                        <li><a id="winner13"><?php echo lang('Achieve'); ?></a></li>
                        <li><a href="league/apply/<?php echo $league_row['id'] ?>"><?php echo lang('Apply'); ?></a></li>
                    </ul>
                </div>
                <div class="dropdownpln">
                    <div class="winner_popup winner_popup13" role="menu">

                        <div class="winner_hdg_sec">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="winner_hdg">Achieve</h2>
                            </div>
                        </div>

                        <div class="dicrp_section">
                            <div class="dicrp_sectioninr">

                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>challenge-prfl.jpg" class="img-responsive center-block ">
                                </div>

                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                    <!-- <h2 class="chlng_hdg">Work description</h2> -->
                                    <p class="chlng_para">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_pstr">
                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>grp_pln_img4.jpg">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_cmnt">

                                    <ul class="list-inline winr_ul">
                                        <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>coin_icon.png"><br><span> 10 </span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                <img src="<?php echo DEFAULT_IMAGE_PATH; ?>like_img.png"><br><span>20 Likes  </span>
                                            </a>
                                            <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </li>
                                        <li><a role="button" class="cmnt_winner"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>comment_icon.png"><br><span> Comments  </span></a></li>
                                    </ul>

                                    <div class="winner-comnt">

                                        <p class="cmn_txtnw"> Comment Here</p>
                                        <textarea class="form-control" rows="3" id="textArea"></textarea>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="commnt_visit_sec clearfix">
                                                    <div class="cmn_img">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
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
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
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

            </div>
        </div>
        <!-- League and alliance each section end here -->
        <?php
    }
}
?>