<!-- Mobile Toggle Menu start here -->
<?php
$language = $this->session->userdata('language');
?>
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <div class="clearfix nav_logo">
        <ul Class="list-inline mobile_chatsec">
            <li class="pull-left"><a href=""><img src="<?php echo DEFAULT_IMAGE_PATH . "logo.png" ?>" class="mobil_logo"></a></li>
            <li class="pull-right "><button id="close_nav"> <img src="<?php echo DEFAULT_IMAGE_PATH . "nav-close-icon.png" ?>" class="cls_img"></button></li>
        </ul>
    </div>
    <a href="smile-share.html"><?php echo lang('Smile Share'); ?></a>
    <a href="home-challenge.html"><?php echo lang('Challenge'); ?></a>
    <a href="treehole.html"><?php echo lang('Live life'); ?></a>
    <a href="<?php echo base_url() . "home/log_out" ?>"><i class="fa fa-power-off" aria-hidden="true"></i> <?php echo lang('Log Out'); ?></a>
</nav>
<!-- Mobile Toggle Menu end here -->

<!--Heaer Start-->
<div class="container-fluid">

    <div class="row navbar-fixed-top">
        <div class="hdr_sec1">
            <div class="container my_nav">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
                    <?php
                    if (isset($user_data) && !empty($user_data)) {
                        ?>
                        <ul class="list-inline hdr_ul1 home-list-inline">
                            <li><img src="<?php echo DEFAULT_IMAGE_PATH . "logo.png" ?>" class="img-responsive"></li>
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="user-thumb-sm">
                                        <img src="<?php echo ($user_data['user_image'] != null) ? DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image'] : DEFAULT_IMAGE_PATH . "nav_profile_img.png" ?>"></span>
                                    <?php echo $user_data['name'] ?>
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo base_url() . "home/profile" ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo lang('Profile'); ?></a></li>
                                    <li><a href="<?php echo base_url() . "home/log_out" ?>"><i class="fa fa-power-off" aria-hidden="true"></i> <?php echo lang('Log Out'); ?></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#msg_here">
                                    <img src="<?php echo DEFAULT_IMAGE_PATH . "chat_icon.png" ?>">
                                    <?php echo lang('Chat'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#post_here">
                                    <img src="<?php echo DEFAULT_IMAGE_PATH . "pst_img.png" ?>">
                                    <?php echo lang('Post'); ?>
                                </a>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="my_nav">
                        <!-- Desktop and Tab Header start here -->
                        <nav class="navbar navbar-default navcust hidden-xs">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->							
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav custnav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle active  disabled" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('Home'); ?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="home/smile_share"><?php echo lang('Smile Share'); ?></a></li>
                                            <li><a href="home/challenge"><?php echo lang('Challenge'); ?></a></li>
                                        </ul>
                                    </li>


                                    <li class="dropdown">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('Social Network'); ?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo base_url() . "topichat" ?>"><?php echo lang('Topichat'); ?></a></li>
                                            <li><a href="<?php echo base_url() . "soulmate" ?>"><?php echo lang('Soulmate'); ?></a></li>
                                            <li><a href="<?php echo base_url() . "groupplan" ?>"><?php echo lang('Group Plan'); ?></a></li>
                                            <li><a href="<?php echo base_url() . "challenge" ?>"><?php echo lang('Challenge'); ?></a></li>
                                            <li><a href="<?php echo base_url() . "league" ?>"><?php echo lang('League and alliance'); ?></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="treehole.html"><?php echo lang('Live life'); ?></a></li>

                                </ul>
                                <ul class="list-unstyled srch_sec hidden-xs">
                                    <li class="dropdown dropdown2">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php echo DEFAULT_IMAGE_PATH . "search_icon.png" ?>" class="img-responsive center-block"></a>
                                        <ul class="dropdown-menu" role="menu" id="srchdrp">
                                            <li>
                                                <div id="custom-search-input">
                                                    <div class="input-group">
                                                        <input type="text" class="  search-query form-control" placeholder="Search">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="lang_sec lang-change">
                                    <select class="selectpicker" data-style="btn-info">
                                        <option value="eng" <?php echo ($language == 'english') ? 'selected' : "" ?>><?php echo lang('English') ?></option>
                                        <option value="fr" <?php echo ($language == 'french') ? 'selected' : "" ?>><?php echo lang('French') ?></option>
                                        <option value="ru" <?php echo ($language == 'russian') ? 'selected' : "" ?>><?php echo lang('Russian') ?></option>
                                    </select>
                                </div>
                            </div><!-- /.navbar-collapse -->
                        </nav>
                        <!-- Desktop and Tab Header end here -->

                        <!-- Mobile Header Section start here -->
                        <div class="visible-xs">
                            <div class="main">
                                <section class="buttonset">
                                    <!-- Class "cbp-spmenu-open" gets applied to menu and "cbp-spmenu-push-toleft" or "cbp-spmenu-push-toright" to the body -->
                                    <ul Class="list-inline mobile_chatsec">
                                        <li><a href="personal_account.html"><img src="<?php echo DEFAULT_IMAGE_PATH . "nav_profile_img.png" ?>"> <br> Lorem Ipsum</a></li>
                                    </ul>

                                    <ul Class="list-inline mobile_chatsec">
                                        <li><button id="showLeftPush"><i class="fa fa-bars" aria-hidden="true"></i>menu</button></li>

                                        <li class="dropdown">
                                            <a href="" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false">Social Network <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="topichat.html"><?php echo lang('Topichat'); ?></a></li>
                                                <li><a href="soulmate.html"><?php echo lang('Soulmate'); ?></a></li>
                                                <li><a href="group_plan.html"><?php echo lang('Group Plan'); ?></a></li>
                                                <li><a href="challenge_1.html"><?php echo lang('Challenge'); ?></a></li>
                                                <li><a href="league-and-alliance.html"><?php echo lang('League and Alliance'); ?></a></li>
                                            </ul>
                                        </li>


                                        <li class="dropdown dropdown3">
                                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php echo DEFAULT_IMAGE_PATH . "search_icon.png" ?>" class="img-responsive center-block"></a>
                                            <ul class="dropdown-menu" role="menu" id="srchdrp2">

                                                <li>
                                                    <div id="custom-search-input">
                                                        <div class="input-group">
                                                            <input type="text" class="  search-query form-control" placeholder="Search">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>

                                    </ul>
                                </section>
                            </div>
                        </div>
                        <!-- Mobile Header Section end here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="empty_divrqrd">
    </div>
    <div class="row">
        <div class="hdr_sec1">
            <div class="container">
                <div class="col-xs-12 visible-xs">
                    <ul Class="list-inline mobile_chatsec">
                        <li><a href="#" data-toggle="modal" data-target="#post_here"> <i class="fa fa-clipboard" aria-hidden="true"></i></a></li>
                        <li><a href="#" data-toggle="modal" data-target="#msg_here"> <i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Header End-->