<div class="row home_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
</div>
<div class="row cont_sec1">
    <div class="home_lg_sec">
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 col-lg-offset-1 post_section">
            <?php
            if ($this->session->msg) {
                ?>
                <div class="alert alert-info text-center flashmsg">
                    <?php echo $this->session->msg; ?>
                </div>
                <?php
            }
            ?>
            <section class="post_masonry_section">
                <?php
                if (count($posts) > 0) {
                    foreach ($posts as $post) {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pst_full_sec post_masonry_article" data-post_id="<?php echo $post['id']; ?>">
                            <div class="cmnt_newsec_row">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="post_leftsec clearfix">

                                            <!-- Comment window -->
                                            <div class="post_leftsec_hddn post_leftsec_hddn1 hidden-xs">
                                                <p class="cmn_txtnw"> <?php echo lang('Comment Here'); ?></p>
                                                <textarea class="form-control comment" rows="3" id="comment"></textarea>
                                                <!-- Comment portion -->
                                                <?php
                                                if (isset($post['comments']) && count($post['comments']) > 0) {
                                                    foreach ($post['comments'] as $comment) {
                                                        ?>
                                                        <div class="commnt_visit_sec clearfix" data-post_comment_id="<?php echo $comment['id']; ?>">
                                                            <div class="cmn_img">
                                                                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $comment['user_image']; ?>" class="img-responsive user_chat_thumb img-circle">
                                                                <p class="cmnt_txt1"><span><?php echo $comment['name']; ?></span></p>
                                                            </div>
                                                            <div class="cmn_dtl">

                                                                <p class="cmmnt_para"><?php echo $comment['comment']; ?></p>
                                                                <p class=""><?php echo $comment['created_date'] ?></p>

                                                                <ul class="cmnt_p clearfix">
                                                                    <li class="comment_like_cnt">
                                                                        <a href="javascript:;">
                                                                            <span class="post_comment_like">
                                                                                <?php echo $comment['cnt_like']; ?>
                                                                            </span> 
                                                                            <span class="post_comment_text"><?php echo ($comment['is_liked']) ? lang('Unlike') : lang('Like'); ?></span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="post_comment_reply">
                                                                        <a href="javascript:;">
                                                                            <span class="comment_reply_cnt">
                                                                                <?php echo $comment['cnt_reply']; ?>
                                                                            </span> <?php echo lang("Reply"); ?>
                                                                        </a>
                                                                    </li>
                                                                    <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                                <div class="reply_dtl" style="display: none"></div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="commnt_visit_sec clearfix no_comment">
                                                        <?php echo lang("No comments available"); ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="mov_sec mov_sec1">
                                                <div class="sav-n-orgnl clearfix">
                                                    <p class="sav_p">
                                                        <a href="javascript:;" class="pstbtn"><?php echo ($post['is_saved']) ? 'saved' : 'save'; ?></a>
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
                                                                ?>
                                                                <a class="fancybox post_images"  href="uploads/user_post/<?php echo $value['media']; ?>" data-fancybox-group="gallery">
                                                                    <img src="uploads/user_post/<?php echo $value['media']; ?>" class="img-responsive center-block">
                                                                </a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a class="fancybox post_images"  href="javascript:;" data-fancybox-group="gallery">
                                                                    <video controls class="img-responsive center-block">
                                                                        <source src="uploads/user_post/<?php echo $value['media']; ?>"></source>
                                                                        <?php echo lang("Seems like your browser doesn't support video tag."); ?>
                                                                    </video>
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                    } else if (isset($post['media']) && !empty($post['media'])) {
                                                        ?>
                                                        <a class="fancybox"  href="uploads/user_post/<?php echo $post['media']; ?>" data-fancybox-group="gallery">
                                                            <img src="uploads/user_post/<?php echo $post['media']; ?>" class="img-responsive center-block">
                                                        </a>
                                                        <?php
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
                                                                        <img src="uploads/user_profile/<?php echo $post['post_user_profile'] ?>" class="img-circle" alt="profile image"/>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <?php echo $post['post_user'] ?>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" class="user_coin">
                                                                    <img class="img-coin" src="<?php
                                                                    echo DEFAULT_IMAGE_PATH;
                                                                    echo ($post['is_coined']) ? 'coined_icon.png' : 'coin_icon.png';
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
                                                                    echo DEFAULT_IMAGE_PATH;
                                                                    echo ($post['is_liked']) ? 'liked_img.png' : 'like_img.png'
                                                                    ?>" class="like_img"><br>
                                                                    <span>
                                                                        <span class="like_cnt"><?php echo $post['post_like'] ?></span> <?php echo lang('Likes'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a role="button" id="chat1" class="chat1">
                                                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>comment_icon.png"><br>
                                                                    <span> 
                                                                        <span class="comment_cnt"><?php echo $post['post_comment'] ?></span> <?php echo lang('Comments'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="btn_popover_head">
                                                                <a href="javascript:void(0);"  class="share-link" data-id="<?php echo $post['id'] ?>">
                                                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>share_icon.png"><br>
                                                                    <span>
                                                                        <?php // echo $post['post_share'] ?> <?php echo lang('Shares'); ?>
                                                                    </span>
                                                                </a>

                                                                <div id="popover-content" class="hide">
                                                                    <ul class="share-icon-list">
                                                                        <li>
                                                                            <?php
                                                                            $media_url = (isset($post['media']) && is_array($post['media']) && count($post['media']) > 0) ? $post['media'][0]['media'] : '';
                                                                            $media = " st_via='habby' st_image='" . base_url() . "uploads/user_post/" . $media_url . "'";
                                                                            $sharethis_content = "st_url='" . base_url() . "post/display_post/" . $post['id'] . "' st_title='" . $post['description'] . "' " . $media;
                                                                            ?>
                                                                            <span class='st_facebook' displayText='' <?php echo $sharethis_content ?>></span>
                                                                            <span class='st_twitter' displayText='' <?php echo $sharethis_content ?>></span>
                                                                            <span class='st_linkedin' displayText='' <?php echo $sharethis_content ?>></span>
                                                                            <span class='st_pinterest' displayText='' <?php echo $sharethis_content ?>></span>
                                                                            <span class='st_googleplus' displayText='' <?php echo $sharethis_content ?>></span>
                                                                            <span class='st_reddit' displayText='' <?php echo $sharethis_content ?>></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="post_leftsec_hddn post_leftsec_hddn1 visible-xs">
                                                        <p class="cmn_txtnw"> <?php echo lang('Comment Here') ?></p>
                                                        <textarea class="form-control comment" rows="3" id="comment"></textarea>
                                                        <?php
                                                        if (isset($post['comments']) && count($post['comments']) > 0) {
                                                            foreach ($post['comments'] as $comment) {
                                                                ?>
                                                                <div class="commnt_visit_sec clearfix">
                                                                    <div class="cmn_img">
                                                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $comment['user_image']; ?>" class="img-responsive">
                                                                    </div>
                                                                    <div class="cmn_dtl">
                                                                        <p class="cmnt_txt1"><span><?php echo $comment['name']; ?></span> Interesting</p>
                                                                        <ul class="cmnt_p clearfix">
                                                                            <li><a href="javascript:;"><span class="comment_like_cnt"><?php echo $comment['cnt_like']; ?></span> <?php echo lang('Like') ?></a></li>
                                                                            <li><a href="javascript:;"><span class="comment_like_cnt"><?php echo $comment['cnt_reply']; ?></span> <?php echo lang('Reply') ?></a></li>
                                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                            <li class="stlnon"><span><?php echo $comment['created_date'] ?></span></li>
                                                                        </ul>
                                                                        <p class="cmmnt_para"><?php echo $comment['comment']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="commnt_visit_sec clearfix no_comment">
                                                                <?php echo lang("No comments available"); ?>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-info text-center">
                        <?php echo lang("No post available."); ?>
                    </div>
                    <?php
                }
                ?>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Lazy loading on scroll event for post
    var page = 2;
    var load = true;
    $(window).scroll(function () {
        if (load)
        {
            if ($(window).scrollTop() == ($(document).height() - $(window).height())) {
                loaddata();
                setTimeout(function () {
                    $('.post_masonry_article').each(function () {
                        if ($(this).offset().left > 250)
                        {
                            $(this).addClass('right');
                        }
                    });
                }, 1500);
//                       $('.post_section').masonry({
//                            itemSelector: '.pst_full_sec',
//                             columnWidth: 100
//                        });

            }
        }
    });

    // Fetch extra post for lazy loading
    function loaddata()
    {
        $.ajax({
            url: base_url + 'user/home/smile_share/' + page,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('.post_section').append("<div class='col-sm-12 alert alert-info text-center'><?php echo lang('No more data found'); ?></div>");
                } else
                {
                    $('.post_section').append(data.view);
                }
                $('.share-link').popover({
                    html: true,
                    content: function () {
                        return $(this).siblings("#popover-content").html();
                    }
                });
                stButtons.locateElements();
// or if you want to be a bit defensive about whether the lib has been
// loaded or not:
                if (window.stButtons) {
                    stButtons.locateElements();
                } // Parse ShareThis markup
            }
        });
        page++;
        stButtons.locateElements();
// or if you want to be a bit defensive about whether the lib has been
// loaded or not:
        if (window.stButtons) {
            stButtons.locateElements();
        } // Parse ShareThis markup

    }
    $('.share-link').click(function () {
        setTimeout(function () {
            console.log('called');
            stButtons.locateElements();
            if (window.stButtons) {
                stButtons.locateElements();
            } // Parse ShareThis markup
        }, 2000);

    });

    $('.post_masonry_section').on('click', '.share-link', function () {
        var t = $(this);
        $(this).popover({
            html: true,
            content: function () {
                return t.parent().find('#popover-content').html();
            },
            placement: 'top',
            callback: function () {
                stButtons.locateElements();
            }
        });
    });
</script>