<?php //print_r($post);die; ?>
<html>
    <head>
        <meta property="og:title" content="<?php echo $post['description']; ?>" />
        <?php
            if($page=="challenge")
            {
                ?>
                <meta property="og:url" content="<?php echo base_url() . 'post/display_challenge_post/' . $post['id'] ?>" />
                <?php
            }
            else
            {
                ?>
                <meta property="og:url" content="<?php echo base_url() . 'post/display_post/' . $post['id'] ?>" />
                <?php
            }
        ?>
        <meta property="fb:app_id" content="1090796097706335" />
        <?php
        if (isset($post['media']) && is_array($post['media']) && count($post['media']) > 0) {
            foreach ($post['media'] as $value) {
                if ($value['media_type'] == "image") {
                    if($page=="challenge")
                    {
                        ?>
                        <meta property="og:image" content="<?php echo base_url() . 'uploads/challenge_post/'.$value['media'] ?>" />
                        <?php
                    }
                    else
                    {
                        ?>
                        <meta property="og:image" content="<?php echo base_url() . 'uploads/user_post/'.$value['media'] ?>" />
                        <?php
                    }
                } else {
                    if($page=="challenge")
                    {
                        ?>
                        <meta property="og:video" content="<?php echo base_url() . 'uploads/challenge_post/'.$value['media'] ?>" />
                        <?php
                    }
                    else
                    {
                        ?>
                        <meta property="og:video" content="<?php echo base_url() . 'uploads/user_post/'.$value['media'] ?>" />
                        <?php
                    }
                }
            }
    } else if (isset($post['media']) && !empty($post['media'])) {
        if($page=="challenge")
        {
            ?>
            <meta property="og:image" content="<?php echo base_url() . 'uploads/challenge_post/'.$post['media'] ?>" />
            <?php
        }
        else
        {
            ?>
            <meta property="og:image" content="<?php echo base_url() . 'uploads/user_post/'.$post['media'] ?>" />
            <?php
        }
    }
    ?>
    <meta property="og:description" content="<?php echo $post['description']; ?>" />
    <meta property="og:site_name" content="Habby" />
</head>
<body>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pst_full_sec" data-post_id="<?php echo $post['id']; ?>">
        <div class="cmnt_newsec_row">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="post_leftsec clearfix">
                        <div class="mov_sec mov_sec1">
                            <div class="sav-n-orgnl clearfix">
                                <p class="sav_p">

                                </p>
                            </div>

                            <p class="sml_txt">
                                <?php
                                if ($post['description'] != '') {
                                    echo $post['description'];
                                }
                                ?>
                            </p>
                            <div class="pst_inrsec">
                                <!-- image -->
                                <?php
                                if (isset($post['media']) && is_array($post['media']) && count($post['media']) > 0) {
                                    foreach ($post['media'] as $value) {
                                        ?>
                                        <?php
                                        if ($value['media_type'] == "image") {
                                            if($page=="challenge")
                                            {
                                                ?>
                                                <a class="fancybox post_images"  href="<?php echo base_url(); ?>uploads/challenge_post/<?php echo $value['media']; ?>" data-fancybox-group="gallery">
                                                    <img src="<?php echo base_url(); ?>uploads/challenge_post/<?php echo $value['media']; ?>" class="img-responsive center-block">
                                                </a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a class="fancybox post_images"  href="<?php echo base_url(); ?>uploads/user_post/<?php echo $value['media']; ?>" data-fancybox-group="gallery">
                                                    <img src="<?php echo base_url(); ?>uploads/user_post/<?php echo $value['media']; ?>" class="img-responsive center-block">
                                                </a>
                                                <?php
                                            }
                                        } else {
                                            if($page=="challenge")
                                            {
                                                ?>
                                                <a class="fancybox post_images"  href="javascript:;" data-fancybox-group="gallery">
                                                    <video controls class="img-responsive center-block">
                                                        <source src="<?php echo base_url(); ?>uploads/challenge_post/<?php echo $value['media']; ?>"></source>
                                                        <?php echo lang("Seems like your browser doesn't support video tag."); ?>
                                                    </video>
                                                </a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a class="fancybox post_images"  href="javascript:;" data-fancybox-group="gallery">
                                                    <video controls class="img-responsive center-block">
                                                        <source src="<?php echo base_url(); ?>uploads/user_post/<?php echo $value['media']; ?>"></source>
                                                        <?php echo lang("Seems like your browser doesn't support video tag."); ?>
                                                    </video>
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                    }
                                } else if (isset($post['media']) && !empty($post['media'])) {
                                    if($page=="challenge")
                                    {
                                        ?>
                                        <a class="fancybox"  href="<?php echo base_url(); ?>uploads/challenge_post/<?php echo $post['media']; ?>" data-fancybox-group="gallery">
                                            <img src="<?php echo base_url(); ?>uploads/challenge_post/<?php echo $post['media']; ?>" class="img-responsive center-block">
                                        </a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="fancybox"  href="<?php echo base_url(); ?>uploads/user_post/<?php echo $post['media']; ?>" data-fancybox-group="gallery">
                                            <img src="<?php echo base_url(); ?>uploads/user_post/<?php echo $post['media']; ?>" class="img-responsive center-block">
                                        </a>
                                        <?php
                                    }
                                }
                                ?>

                                <div class="cmnt_newsec">
                                    <ul class="post_opn_ul list-inline">
                                        <li class="pull-left">
                                            <a href="#" class="usr_post_img">
                                                <?php
                                                if (empty($post['post_user_profile'])) {
                                                    ?>
                                                    <img class="img-circle" src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" alt="profile image"/>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>uploads/user_profile/<?php echo $post['post_user_profile'] ?>" class="img-circle" alt="profile image"/>
                                                    <?php
                                                }
                                                ?>
                                                <?php echo $post['post_user'] ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="user_coin">
                                                <img class="img-coin" src="<?php
                                                echo DEFAULT_IMAGE_PATH . 'coin_icon.png';
                                                ?>"/><br>
                                                <span class="coin_cnt">
                                                    <?php echo $post['post_coin'] ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <!-- Like and dislike toggle -->
                                            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>like_img.png"><br>
                                                    <span>
                                            <?php echo $post['post_like'] ?> Likes
                                                    </span>
                                            </a>
                                            <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                    <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                            </ul>
                                            -->
                                            <a href="javascript:;" class="user_like">
                                                <img src="<?php
                                                echo DEFAULT_IMAGE_PATH . 'like_img.png'
                                                ?>" class="like_img"><br>
                                                <span>
                                                    <span class="like_cnt"><?php echo $post['post_like'] ?></span> <?php echo lang("Likes"); ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a role="button" id="chat1" class="chat1">
                                                <img src="<?php echo DEFAULT_IMAGE_PATH; ?>comment_icon.png"><br>
                                                <span> 
                                                    <span class="comment_cnt"><?php echo $post['post_comment'] ?></span> <?php echo lang("Comments"); ?>
                                                </span>
                                            </a>
                                        </li>                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        if($page == 'challenge')
        {
            ?>
            <script>
                window.location = '<?php echo base_url(); ?>/home/challenge';
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                window.location = '<?php echo base_url(); ?>';
            </script>
            <?php
        }
    ?>
</body>
</html>