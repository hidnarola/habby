<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <?php
        if (isset($meta_data) && count($meta_data) > 0) {
            ?>
            <meta name='title' content="<?php echo $meta_data['meta_title'] ?>">
            <meta name='keywords' content="<?php echo $meta_data['meta_keyword'] ?>">
            <meta name='description' content="<?php echo $meta_data['meta_description'] ?>">
            <?php
        }
        ?>
        <base href="<?php echo base_url(); ?>"/>
        <title>Habby</title>
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "bootstrap.css" ?>"/>
        <!--<link href="<?php echo DEFAULT_CSS_PATH . "flexnav.css" ?>" media="screen, projection" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="<?php echo DEFAULT_CSS_PATH . "jquery-ui.css"; ?>" rel="stylesheet" />
        <link href="<?php echo DEFAULT_CSS_PATH . "bootstrap-datepicker.css"; ?>" rel="stylesheet" />
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
        <script src="<?php echo DEFAULT_JS_PATH . "jquery-ui.min.js" ?>"></script>
        <script src="https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_EMOGI_PATH . "emoticons.css" ?>"/>
        <script src="<?php echo DEFAULT_EMOGI_PATH . "emoticons.js" ?>"></script>
        <script src="<?php echo DEFAULT_EMOGI_PATH . "emoticons_details.js" ?>"></script>
<!--        <script src="https://cdn.webrtc-experiment.com/firebase.js"></script>
        <script src="<?php echo DEFAULT_JS_PATH . "chat/RTCPeerConnection-v1.5.js" ?>"></script>
        <script src="<?php echo DEFAULT_JS_PATH . "chat/hangout.js" ?>"></script>
        <script src="<?php echo DEFAULT_JS_PATH . "chat/hangout-ui.js" ?>"></script>-->
        <script src="<?php echo DEFAULT_CHAT_DOC_PATH . "fancywebsocket.js" ?>"></script>
        <script src="https://cdn.embed.ly/jquery.embedly-3.0.5.min.js" type="text/javascript"></script>
        <script src="https://cdn.embed.ly/jquery.preview-0.3.2.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo DEFAULT_CSS_PATH . "preview.css" ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_ADMIN_CSS_PATH . "sweetalert.css"; ?>">
        <script src="<?php echo DEFAULT_ADMIN_JS_PATH . "sweetalert.min.js"; ?>"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
<script src="../../assets/js/html5shiv.js"></script>
<script src="../../assets/js/respond.min.js"></script>
<![endif]-->
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var socket_server = '<?php echo WS_SOCKET_SERVER ?>';
        </script>
    </head>
    <body class="cbp-spmenu-push">
        <div class="loader"></div>
        <!--<div class="container-fluid">
                <div class="row">
                        <div class="container">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                </div>
                        </div>
                </div>
        </div>-->

        <?php $this->load->view('layouts/header'); ?>

        <!--Slider Start -->

        <!--Slider End -->

        <!--Content Start-->
        <div class="container-fluid">
            <?php
            if (isset($body) && !empty($body)) {
                echo $body;
            }
            ?>
        </div>
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
                                                <div class="jst_txt usr_post_img">
                                                    <img class='img-circle' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $this->session->user['user_image'] ?>"> <?php echo lang('title /short description'); ?> 
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
                                                <div class="video_wrapper" style="display:none" data-default_image="<?php echo DEFAULT_IMAGE_PATH . "video_thumbnail.png" ?>">

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
        <!--        <div class="chat_lgsec hidden-xs">
                    <div class="panel panel-default">
                          chat box header start
                        <div class="panel-heading">
                            <p class="text-center show_chat"><img src="<?php echo DEFAULT_IMAGE_PATH . "ftr_chat_icon.png" ?>"> <?php echo lang('Chats'); ?></p>
                        </div>
                          chat box header end
        
                          chat box chat display section start
                        <div class="panel-body chat_smlr">
        
                        </div>
                          chat box chat display section end
        
                          chat box type and send section start
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
                          chat box type and send section start
                    </div>
                </div>-->
        <!--  Fixed chat box section end here -->

        <!--  Emogies modal section start here -->

        <div id="popover-content" class="hide">
            <form>
                <div class="">
                    <div id="overview"><span class="emoticon emoticon-smile" title="Smile">:)</span><span class="emoticon emoticon-sad-smile" title="Sad Smile">:(</span><span class="emoticon emoticon-big-smile" title="Big Smile">:D</span><span class="emoticon emoticon-cool" title="Cool">8)</span><span class="emoticon emoticon-wink" title="Wink">:o</span><span class="emoticon emoticon-crying" title="Crying">;(</span><span class="emoticon emoticon-sweating" title="Sweating">(sweat)</span><span class="emoticon emoticon-speechless" title="Speechless">:|</span><span class="emoticon emoticon-kiss" title="Kiss">:*</span><span class="emoticon emoticon-tongue-out" title="Tongue Out">:P</span><span class="emoticon emoticon-blush" title="Blush">(blush)</span><span class="emoticon emoticon-wondering" title="Wondering">:^)</span><span class="emoticon emoticon-sleepy" title="Sleepy">|-)</span><span class="emoticon emoticon-dull" title="Dull">|(</span><span class="emoticon emoticon-in-love" title="In love">(inlove)</span><span class="emoticon emoticon-evil-grin" title="Evil grin">]:)</span><span class="emoticon emoticon-talking" title="Talking">(talk)</span><span class="emoticon emoticon-yawn" title="Yawn">(yawn)</span><span class="emoticon emoticon-puke" title="Puke">(puke)</span><span class="emoticon emoticon-doh!" title="Doh!">(doh)</span><span class="emoticon emoticon-angry" title="Angry">:@</span><span class="emoticon emoticon-it-wasnt-me" title="It wasn't me">(wasntme)</span><span class="emoticon emoticon-party" title="Party!!!">(party)</span><span class="emoticon emoticon-worried" title="Worried">:S</span><span class="emoticon emoticon-mmm" title="Mmm...">(mm)</span><span class="emoticon emoticon-nerd" title="Nerd">8-|</span><span class="emoticon emoticon-lips-sealed" title="Lips Sealed">:x</span><span class="emoticon emoticon-hi" title="Hi">(hi)</span><span class="emoticon emoticon-call" title="Call">(call)</span><span class="emoticon emoticon-devil" title="Devil">(devil)</span><span class="emoticon emoticon-angel" title="Angel">(angel)</span><span class="emoticon emoticon-envy" title="Envy">(envy)</span><span class="emoticon emoticon-wait" title="Wait">(wait)</span><span class="emoticon emoticon-bear" title="Bear">(bear)</span><span class="emoticon emoticon-make-up" title="Make-up">(makeup)</span><span class="emoticon emoticon-covered-laugh" title="Covered Laugh">(giggle)</span><span class="emoticon emoticon-clapping-hands" title="Clapping Hands">(clap)</span><span class="emoticon emoticon-thinking" title="Thinking">(think)</span><span class="emoticon emoticon-bow" title="Bow">(bow)</span><span class="emoticon emoticon-rofl" title="Rolling on the floor laughing">(rofl)</span><span class="emoticon emoticon-whew" title="Whew">(whew)</span><span class="emoticon emoticon-happy" title="Happy">(happy)</span><span class="emoticon emoticon-smirking" title="Smirking">(smirk)</span><span class="emoticon emoticon-nodding" title="Nodding">(nod)</span><span class="emoticon emoticon-shaking" title="Shaking">(shake)</span><span class="emoticon emoticon-punch" title="Punch">(punch)</span><span class="emoticon emoticon-emo" title="Emo">(emo)</span><span class="emoticon emoticon-yes" title="Yes">(y)</span><span class="emoticon emoticon-no" title="No">(n)</span><span class="emoticon emoticon-handshake" title="Shaking Hands">(handshake)</span><span class="emoticon emoticon-skype" title="Skype">(skype)</span><span class="emoticon emoticon-heart" title="Heart">(h)</span><span class="emoticon emoticon-broken-heart" title="Broken heart">(u)</span><span class="emoticon emoticon-mail" title="Mail">(e)</span><span class="emoticon emoticon-flower" title="Flower">(f)</span><span class="emoticon emoticon-rain" title="Rain">(rain)</span><span class="emoticon emoticon-sun" title="Sun">(sun)</span><span class="emoticon emoticon-time" title="Time">(o)</span><span class="emoticon emoticon-music" title="Music">(music)</span><span class="emoticon emoticon-movie" title="Movie">(~)</span><span class="emoticon emoticon-phone" title="Phone">(mp)</span><span class="emoticon emoticon-coffee" title="Coffee">(coffee)</span><span class="emoticon emoticon-pizza" title="Pizza">(pizza)</span><span class="emoticon emoticon-cash" title="Cash">(cash)</span><span class="emoticon emoticon-muscle" title="Muscle">(muscle)</span><span class="emoticon emoticon-cake" title="Cake">(^)</span><span class="emoticon emoticon-beer" title="Beer">(beer)</span><span class="emoticon emoticon-drink" title="Drink">(d)</span><span class="emoticon emoticon-dance" title="Dance">(dance)</span><span class="emoticon emoticon-ninja" title="Ninja">(ninja)</span><span class="emoticon emoticon-star" title="Star">(*)</span><span class="emoticon emoticon-mooning" title="Mooning">(mooning)</span><span class="emoticon emoticon-finger" title="Finger">(finger)</span><span class="emoticon emoticon-bandit" title="Bandit">(bandit)</span><span class="emoticon emoticon-drunk" title="Drunk">(drunk)</span><span class="emoticon emoticon-smoking" title="Smoking">(smoking)</span><span class="emoticon emoticon-toivo" title="Toivo">(toivo)</span><span class="emoticon emoticon-rock" title="Rock">(rock)</span><span class="emoticon emoticon-headbang" title="Headbang">(headbang)</span><span class="emoticon emoticon-bug" title="Bug">(bug)</span><span class="emoticon emoticon-fubar" title="Fubar">(fubar)</span><span class="emoticon emoticon-poolparty" title="Poolparty">(poolparty)</span><span class="emoticon emoticon-swearing" title="Swearing">(swear)</span><span class="emoticon emoticon-tmi" title="TMI">(tmi)</span><span class="emoticon emoticon-heidy" title="Heidy">(heidy)</span><span class="emoticon emoticon-myspace" title="MySpace">(MySpace)</span><span class="emoticon emoticon-malthe" title="Malthe">(malthe)</span><span class="emoticon emoticon-tauri" title="Tauri">(tauri)</span><span class="emoticon emoticon-priidu" title="Priidu">(priidu)</span></div>
                </div>
            </form>
        </div>

        <!--
        <div class="modal" id="emogis">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="Profl_addsec home_post">
                            <div class="row pst_here_sec">
        <!-- message section start here 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">

        <!-- message tittle section start here 
        <div class="panel-heading">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
            <b><?php echo "Select any Emogy"; ?></b>
        </div>
        <!-- message tittle section end here 

        <!-- message form section start here 
        
        <!-- message form section end here 
    </div>
</div>
        <!-- message section start here 
    </div>
</div>
</div>
</div>
</div>
</div>
        <!--  Emogies modal section end here -->

        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "bootstrap.js" ?>"></script>
        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "jquery.fancybox.js" ?>"></script>
        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "classie.js" ?>" ></script>
        <script>
            $('.post_section').masonry({
                itemSelector: '.pst_full_sec',
                columnWidth: 100
            });
        </script>
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
                $('.cbp-spmenu-push').on('click', '.emoticon', function () {
                    if ($("#mediaModal").data('bs.modal') && $('#mediaModal').data('bs.modal').isShown) {
                        $('#mediaModal').find('#message_div').append($.emoticons.replace($(this).html()));
                        $('#mediaModal').find('#emogis').popover('hide');
                    } else {
                        $('#message_div').append($.emoticons.replace($(this).html()));
                        $('#emogis').popover('hide');
                    }
                });

            });
        </script>

        <script type="text/javascript">
            $(function () {
                // Image uploading script for post creation
                $("#uploadFile").on("change", function ()
                {
                    $('.message').html();
                    $('.image_wrapper').html('');
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) {
                        $('.message').html("No file selected.");
                        $('.message').show();
                        return; // no file selected, or no FileReader support
                    }

                    var i = 0;
                    for (var key in files)
                    {
                        if (key != "length" && key != "item")
                        {
                            if (/^image/.test(files[key].type)) { // only image file
                                var reader = new FileReader(); // instance of the FileReader
                                reader.readAsDataURL(files[key]); // read the local file

                                reader.onloadend = function () { // set image data as background of div
                                    // $('#imagePreview').addClass('imagePreview');
                                    $('.image_wrapper').show();
                                    $('.message').hide();
                                    $('.image_wrapper').append("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                                    $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                                    ++i;
                                }
                            } else
                            {
                                //                                this.files = '';
                                $('.message').html("Please select proper image");
                                $('.message').show();
                            }
                        }
                    }
                });

                // Video uploading script for post creation
                $('#uploadVideo').on("change", function () {
                    $('.message').html();
                    $('.video_wrapper').html('');
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) {
                        $('.message').html("No file selected.");
                        $('.message').show();
                        return; // no file selected, or no FileReader support
                    }

                    var i = 0;
                    for (var key in files)
                    {
                        if (/^video/.test(files[key].type)) { // only image file
                            var reader = new FileReader(); // instance of the FileReader
                            reader.readAsDataURL(files[key]); // read the local file

                            reader.onloadend = function () { // set image data as background of div
                                // $('#imagePreview').addClass('imagePreview');
                                $('.video_wrapper').show();
                                $('.message').hide();
                                $('.video_wrapper').append("<img class='videoPreview" + i + "' id='imagePreview' src='" + $('.video_wrapper').data('default_image') + "'/>");
                                //                    $('.videoPreview'+i).css("background-image", ;
                                ++i;
                            }
                        } else
                        {
                            $('.message').html("Please select proper video");
                            $('.message').show();
                        }
                    }
                });
            });
            $(function () {
                $('#post_here').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                    $(this).find('form').trigger('reset');
                    $('#description').val('').empty();
                    $('.image_wrapper').html('');
                    $('.video_wrapper').html('');
                });
            });
        </script>
    </body>
</html>