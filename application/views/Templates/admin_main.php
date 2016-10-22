<!DOCTYPE html>
<?php
if (!empty($user_data['user_image'])) {

    $image = DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image'];
} else {

    $image = DEFAULT_IMAGE_PATH . "user-img.jpg";
}
?>
<html lang="en">
    <?php ?>
    <body>
        <?php $this->load->view('admin/layouts/layout_header'); ?>
        <!-- Main navbar -->
        <style>
            .thumb{
                display: table;
                width:100%;
            }
            .thumb-inner{
                display: table-cell;
                padding: 5px;
            } 
            .thumb-ul li a i {
                font-size: 20px;
            }
            .thumb-ul li a i {
                font-size: 20px;
            }
            .thumb-ul li {
                display: inline-block;
            }
            .thumb-ul li a{
                padding: 0 18px;
                color: #26A69A;
                text-align: center;
            }
            ul.thumb-ul {
                padding-left: 10px;
            }
            .padding-15{
                padding: 15px;
            }
            .media .thumb-ul li a {
                padding: 0;
                text-align: center;
                display: inline-block;
            }
            .media .thumb-ul li a i, .media .thumb-ul li a {
                font-size: 12px;
            }
            .media-list > li:nth-child(odd) {
                background-color: #f9f7f7;
            }
            .media .thumb-ul li a {
                padding: 0 8px 0 0;
                text-align: center;
                display: inline-block;
                color:#2196F3;
            }
        </style>  
        <div class="navbar navbar-inverse">
            <div class="navbar-header">
<!--                <a class="navbar-brand" href=""><img src="<?php echo DEFAULT_ADMIN_IMAGE_PATH . "logo_light.png"; ?>" alt=""></a>-->
                <h4><a href="<?php echo base_url() . "admin/dashboard" ?>" class="navbar-brand"><img src="<?php echo DEFAULT_IMAGE_PATH . "logo.png"; ?>"/></a></h4>

                <ul class="nav navbar-nav visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown dropdown-user">
                        <?php
                        if (!empty($user_data) && isset($user_data)) {
                            ?>
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $image ?>" alt="">
                                <span><?php echo $user_data['name']; ?></span>
                                <i class="caret"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="<?php echo base_url() . "admin/edit_profile" ?>"><i class="icon-user-plus"></i> My profile</a></li>
                                <li><a href="<?php echo base_url() . "admin/change_password" ?>"><i class="icon-comment-discussion"></i> Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url() . 'admin/logout'; ?>"><i class="icon-switch2"></i> Logout</a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navbar -->


        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main sidebar -->
                <div class="sidebar sidebar-main">
                    <div class="sidebar-content">

                        <!-- User menu -->
                        <div class="sidebar-user">
                            <div class="category-content">
                                <div class="media">

                                    <a href="#" class="media-left"><img src="<?php echo $image ?>" class="img-circle img-sm" alt=""></a>
                                    <div class="media-body">
                                        <span class="media-heading text-semibold"><?php echo $user_data['name']; ?></span>
                                        <div class="text-size-mini text-muted">
                                            <i class="icon-pin text-size-small"></i> &nbsp;<?php echo get_country_name($user_data['country']) ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /user menu -->


                        <!-- Main navigation -->
                        <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <?php
                                $controller = $this->router->fetch_class();
                                ?>
                                <ul class="navigation navigation-main navigation-accordion">

                                    <!-- Main -->
                                    <!--<li class="navigation-header"><span></span> <i class="icon-menu" title="Main pages"></i></li>-->
                                    <li class="<?php echo ($controller == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                    <li class="<?php echo ($controller == 'users') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/users'; ?>"><i class="icon-users4"></i> <span>Users</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'categories') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/categories'; ?>"><i class="icon-server"></i> <span>Post Categories</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'banners') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/banners'; ?>"><i class="icon-file-picture"></i> <span>Banner Images</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'posts') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/posts'; ?>"><i class="icon-magazine"></i> <span> Posts</span></a>
                                    </li>
<!--                                    <li class="<?php echo ($controller == 'users') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/users'; ?>"><i class="icon-users4"></i> <span>Topichat</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'users') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/users'; ?>"><i class="icon-users4"></i> <span>Soulmate</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'users') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/users'; ?>"><i class="icon-users4"></i> <span>Group Plan</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'users') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/users'; ?>"><i class="icon-users4"></i> <span>Challenges</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'users') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/users'; ?>"><i class="icon-users4"></i> <span>League and Alliance</span></a>
                                    </li>
                                    <li class="<?php echo ($controller == 'header_footer_control') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . 'admin/header_footer_control'; ?>"><i class="icon-stack2"></i> <span>Header/Footer Setting</span></a>-->
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url() . "admin/logout"; ?>"><i class="icon-switch2"></i> <span>Logout</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /main navigation -->
                    </div>
                </div>
                <!-- /main sidebar -->

                <!-- Main content -->
                <div class="content-wrapper">
                    <?php
                    if (isset($body) && !empty($body)) {
                        echo $body;
                    }
                    ?>

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->
        <!-- My script code -->
        <script>
            $('document').ready(function () {
                $('.flashmsg').fadeOut(6000);
            });
        </script>
    </body>
</html>
