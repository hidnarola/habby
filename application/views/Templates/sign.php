<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <?php
            if(isset($meta_data) && count($meta_data) > 0)
            {
                ?>
                <meta name='title' content="<?php echo $meta_data['meta_title'] ?>">
                <meta name='keywords' content="<?php echo $meta_data['meta_keyword'] ?>">
                <meta name='description' content="<?php echo $meta_data['meta_description'] ?>">
                <?php
            }
        ?>
        <title>Habby</title>
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "bootstrap.css" ?>"/>
<!--        <link href="<?php echo DEFAULT_CSS_PATH . "font-awesome.min.css" ?>" media="screen, projection" rel="stylesheet" type="text/css">-->
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto+Mono" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "style.css" ?>"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Philosopher:400,400i,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "narola.css" ?>"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../../assets/js/html5shiv.js"></script>
          <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bdy">
        <!--<div class="container-fluid">
                <div class="row">
                        <div class="container">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                </div>
                        </div>
                </div>
        </div>-->
        <!--Header Start-->
        <div class="container-fluid">
            <?php
            $language = $this->session->userdata('language');
//            echo $language;
            ?>
            <div class="row">
                <div class="hdr_sec1">
                    <div class="container">
                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                            <a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH . "logo.png" ?>" class="img-responsive logo_img2"></a>
                        </div>
                        <div class="col-lg-7 col-md-8 col-sm-7 col-xs-12">
                            <div class="row">

                                <div class="login_frm">
                                    <form class="" role="form" method="post" action="<?php echo base_url() . "login" ?>">

                                        <div class="form-group">
                                            <div class="col-sm-4 col-xs-12">
                                                <input type="text" class="form-control" name="login_email" id="login_email" placeholder="<?php echo lang('E-mail'); ?>" value="<?php echo set_value('login_email'); ?>">
                                            </div>
                                            <div class="col-sm-4 col-xs-12">
                                                <input type="password" class="form-control" name="password" id="pwd" placeholder="<?php echo lang('Password'); ?>">
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <input type="submit" class="login_btn" value="<?php echo lang('Login'); ?>">

                                            </div>

                                            <div class="col-sm-2 col-xs-12">
                                                <div class="lang_sec lang-change">
                                                    <select class="selectpicker" data-style="btn-info">
                                                        <option value="eng" <?php echo ($language == 'english') ? 'selected' : "" ?>><?php echo lang('English') ?></option>
                                                        <option value="fr" <?php echo ($language == 'french') ? 'selected' : "" ?>><?php echo lang('French') ?></option>
                                                        <option value="ru" <?php echo ($language == 'russian') ? 'selected' : "" ?>><?php echo lang('Russian') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-5 col-xs-12">
                                                <div class="checkbox logincheck">
                                                    <label class="keep_lgin">
                                                        <input type="checkbox" name="remember_me" value="1" > <?php echo lang('Keep me logged in'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-xs-12">
                                                <label class="forgt_lnk">
                                                    <a href="<?php echo base_url() . "user/forgot_password" ?>"><?php echo lang("I've forgotten my password"); ?> </a>
                                                </label>

                                            </div>
                                            <div class="col-sm-5 col-xs-12">
                                                <div class="social">
                                                    <ul>
                                                        <li><a href="<?php echo $fb_login_url; ?>"><img src="<?php echo DEFAULT_IMAGE_PATH . "facebook.png" ?>" /></a></li>
                                                        <li><a href="<?php echo base_url() ?>/login/google_login"><img src="<?php echo DEFAULT_IMAGE_PATH . "google_plus.png" ?>" /></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Header End-->

        <!--Slider Start -->

        <!--Slider End -->

        <!--Content Start-->
        <div class="container-fluid">
            <div class="alert-msg">
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
            </div>

            <?php
            if (isset($body) && !empty($body)) {
                echo $body;
            }
            ?>
        </div>
        <!--Content End-->
        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "jquery.min.js" ?>"></script>
        <script type="text/javascript" src="<?php echo DEFAULT_JS_PATH . "bootstrap.js" ?>"></script>
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

