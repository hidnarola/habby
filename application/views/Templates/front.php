<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <base href="<?php echo base_url(); ?>"></base>
        <title>Habby</title>
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "bootstrap.css" ?>"/>
        <!--<link href="<?php echo DEFAULT_CSS_PATH . "flexnav.css" ?>" media="screen, projection" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "jquery.fancybox.css" ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "component.css" ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "style.css" ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "narola.css" ?>"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Philosopher:400,400i,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,300,400,500,600,700,800,900" rel="stylesheet">
        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "jquery.min.js" ?>"></script>
<!--        <script src="https://cdn.webrtc-experiment.com/firebase.js"></script>
        <script src="<?php echo DEFAULT_JS_PATH . "chat/RTCPeerConnection-v1.5.js" ?>"></script>
        <script src="<?php echo DEFAULT_JS_PATH . "chat/hangout.js" ?>"></script>
        <script src="<?php echo DEFAULT_JS_PATH . "chat/hangout-ui.js" ?>"></script>-->

        <!--<script src="https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js"></script>-->
       
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../../assets/js/html5shiv.js"></script>
          <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
        
        <!-- Share this scripts -->
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">
            stLight.options({publisher: "9d14d1f6-a827-4af0-87fe-f41eaa3ce220", doNotHash: false, doNotCopy: false, hashAddressBar: false});
        </script>
        <!-- Share this scripts over -->
    </head>
    <body class="cbp-spmenu-push">
        <!--<div class="container-fluid">
                <div class="row">
                        <div class="container">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                </div>
                        </div>
                </div>
        </div>-->

        <!--Header Start -->
        <?php $this->load->view('layouts/header'); ?>
        <!--Header End-->

        <!--Content Start-->
        <div class="container-fluid">
            <?php
            if (isset($body) && !empty($body)) {
                echo $body;
            }
            ?>
        </div>

        <!-- Mobile version design start here -->

        <!-- Mobile version design end here -->
        <!--Content End-->
        <!--Footer content section Start here-->
        <div class="container-fluid">
            <!-- Footer content section 1 Start here -->
            <div class="row ftr_sec1">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="ftrtxt3"><?php echo lang('Follow us'); ?> </p>
                        <ul class="list-inline ftr_ul">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Footer content section 1 end here -->

            <!-- Footer content section 2 start here -->
            <div class="row ftr_sec2">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="cpy_txt"><?php echo lang('Habby, LLC'); ?>  &copy; <?php echo lang('All rights reserved.'); ?></p>
                    </div>
                </div>
            </div>
            <!-- Footer content section 2 end here -->
        </div>
        <!--Footer content section end here-->


        <!--  Post modal section start here -->
        <div class="modal" id="post_here">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="Profl_addsec home_post">
                            <div class="row pst_here_sec">
                                <!-- post start here -->
                                <form method="post" action="home/add_post" enctype="multipart/form-data">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">

                                            <!-- tittle or short description section satrt here -->
                                            <div class="panel-heading"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                                                <div class="jst_txt">
                                                    <img src="<?php echo DEFAULT_IMAGE_PATH . "pst_prfl_icon.png" ?>"> <?php echo lang('title /short description'); ?> 
                                                </div>
                                                <textarea class="form-control" rows="3" id="description" name="description" required></textarea>
                                            </div>
                                            <!-- tittle or short description section end here -->

                                            <!-- Upload images or video section start here -->
                                            <div class="panel-body">
                                                <div class="message alert alert-danger" style="display:none"></div>
                                                <div class="upld_sec">
                                                    <div class="fileUpload up_img btn">
                                                        <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
                                                        <input type="file" name="uploadfile[]" class="upload" id="uploadFile" multiple="multiple"/>
                                                    </div>
                                                    <div class="fileUpload up_img btn">
                                                        <span><i class="fa fa-video-camera" aria-hidden="true"></i> <?php echo lang('Videos'); ?></span>
                                                        <input type="file" name="videofile[]" id="uploadVideo" class="upload" multiple="multiple"/>
                                                    </div>
                                                    
                                                </div>
                                                <div class="image_wrapper" style="display:none">
                                                    
                                                </div>
                                                <div class="video_wrapper" style="display:none" data-default_image="<?php echo DEFAULT_IMAGE_PATH."video_thumbnail.png" ?>">
                                                    
                                                </div>
                                            </div>
                                            <!-- Upload images or video section end here -->

                                            <!-- selectng "Post to" and Original section start here -->

                                            <div class="panel-body pnl_ftr">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <button type="submit" class="pstbtn"><?php echo lang('Post'); ?></button>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- selectng "Post to" and Original section end here -->
                                        </div>
                                    </div>
                                </form>
                                <!-- post end here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Post modal section end here -->

        <!--  Message modal section start here -->
        <div class="modal" id="msg_here">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="Profl_addsec home_post">
                            <div class="row pst_here_sec">
                                <!-- message section start here -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">

                                        <!-- message tittle section start here -->
                                        <div class="panel-heading">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                                            <b><?php echo lang('TYPE YOUR MESSAGE'); ?></b>
                                        </div>
                                        <!-- message tittle section end here -->

                                        <!-- message form section start here -->
                                        <form>
                                            <div class="panel-body">
                                                <textarea class="form-control border0" rows="3" id="textArea" placeholder="<?php echo lang('What�s happening...'); ?>"></textarea>
                                            </div>
                                            <div class="panel-body pnl_ftr">
                                                <a href="#" class="pstbtn"><?php echo lang('Send Message'); ?></a>
                                            </div>
                                        </form>
                                        <!-- message form section end here -->

                                    </div>
                                </div>
                                <!-- message section start here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Message modal section end here -->


        <!--  Fixed chat box section start here -->
        <div class="chat_lgsec hidden-xs">
            <div class="panel panel-default">
                <!--  chat box header start-->
                <div class="panel-heading">
                    <p class="text-center show_chat"><img src="<?php echo DEFAULT_IMAGE_PATH . "ftr_chat_icon.png" ?>"> <?php echo lang('Chats'); ?></p>
                </div>
                <!--  chat box header end-->

                <!--  chat box chat display section start-->
                <div class="panel-body chat_smlr">

                </div>
                <!--  chat box chat display section end-->

                <!--  chat box type and send section start-->
                <div class="panel-footer chat_smlr">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="<?php echo lang('Write here...'); ?>">
                            <span class="input-group-btn">
                                <input class="chat_btn" type="submit" value="<?php echo lang('Send') ?>">
                            </span>
                        </div>
                    </div>
                </div>
                <!--  chat box type and send section start-->
            </div>
        </div>
        <!--  Fixed chat box section end here -->

        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "bootstrap.js" ?>"></script>
        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "jquery.fancybox.js" ?>"></script>
        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "classie.js" ?>" ></script>
        <!--
        <script>
            $('.post_section').masonry({
                itemSelector: '.pst_full_sec',
                columnWidth: 100
            });
        </script> -->
        <script>
            var menuLeft = document.getElementById('cbp-spmenu-s1'),
                    showLeftPush = document.getElementById('showLeftPush'),
                    body = document.body;
            showLeftPush.onclick = function () {
                classie.toggle(this, 'active');
                classie.toggle(body, 'cbp-spmenu-push-toright');
                classie.toggle(menuLeft, 'cbp-spmenu-open');
                disableOther('showLeftPush');
            };
            function disableOther(button) {

                if (button !== 'showLeftPush') {
                    classie.toggle(showLeftPush, 'disabled');
                }

            }
            var menuLeft = document.getElementById('cbp-spmenu-s1'),
                    showLeftPush = document.getElementById('close_nav'),
                    body = document.body;
            close_nav.onclick = function () {
                classie.toggle(this, 'active');
                classie.toggle(body, 'cbp-spmenu-push-toright');
                classie.toggle(menuLeft, 'cbp-spmenu-open');
                disableOther('close_nav');
            };
            function disableOther(button) {

                if (button !== 'close_nav') {
                    classie.toggle(close_nav, 'disabled');
                }

            }

        </script>
        <script>
            // $(".flexnav").flexNav();
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                /*
                 *  Simple image gallery. Uses default settings
                 */

                $('.fancybox').fancybox();

                /*
                 *  Different effects
                 */
            });
        </script>
        <script>
            $('ul.hdr_ul1 li.dropdown, ul.nav li.dropdown').hover(function () {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
            }, function () {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
            });
        </script>
        <script>
            if (window.matchMedia('(max-width: 767px)').matches)
                $('ul.nav li.dropdown').click(function () {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
                }, function () {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
                });
        </script>
        <script>
            $(document).ready(function () {
                $(".show_chat").click(function () {
                    $(".chat_smlr").slideToggle(1000);
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('.dropdown2 .dropdown-toggle').click(function () {
                    $('#srchdrp').toggle('');
                });
            });
            $(document).ready(function () {
                $('.dropdown3 .dropdown-toggle').click(function () {
                    $('#srchdrp2').toggle('');
                });
            });

        </script>
        <script>

            $('.chat1').on('click', function () {
                $(this).parents(".post_leftsec").children(".post_leftsec_hddn1").toggleClass('clicked');
                $(this).closest(".mov_sec1").toggleClass('clicked2');
            });

            $('#chat2').on('click', function () {
                $(".post_leftsec_hddn2").toggleClass('clicked');
                $(".mov_sec2").toggleClass('clicked2');
            });
            $('#chat3').on('click', function () {
                $(".post_leftsec_hddn3").toggleClass('clicked');
                $(".mov_sec3").toggleClass('clicked2');
            });
            $('#chat4').on('click', function () {
                $(".post_leftsec_hddn4").toggleClass('clicked');
                $(".mov_sec4").toggleClass('clicked2');
            });

        </script> 
        <script>
            /*
             $(function () {
             $("div.soulmate_con2").slice(0, 3).show();
             $("#loadMore").on('click', function (e) {
             e.preventDefault();
             $("div.soulmate_con2:hidden").slice(0, 2).slideDown();
             if ($("div.soulmate_con2:hidden").length == 0) {
             $("#load").fadeOut('slow');
             }
             $('html,body').animate({
             scrollTop: $(this).offset().top
             }, 1500);
             });
             });
             */
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
                $("#more_rate").click(function () {
                    $(".topichat_left_sec").slideToggle("");
                });
            });
        </script>
        <!-- My script code -->
        <script>
            $('document').ready(function () {
                $('.flashmsg').fadeOut(6000);
            });
        </script>
        <script type="text/javascript">
            $(function () {
                $('.lang-change select').change(function () {
                    var lang = $(this).val();
                    $.ajax({
                        url: '<?php echo base_url() . "login/change_lang"; ?>',
                        type: 'POST',
                        data: {lang: lang},
                        success: function (data) {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>

    </body>
</html>

