<div class="row home_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
</div>
<div class="row cont_sec1">
    <div class="home_lg_sec">
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 col-lg-offset-1 post_section ">
            <?php
            if ($this->session->msg) {
                ?>
                <div class="alert alert-info text-center flashmsg">
                    <?php echo $this->session->msg; ?>
                </div>
                <?php
            }
            ?>
            <section class="post_masonry_section grid challenge_post_display">
                <?php
                if (count($posts) > 0) {
                    foreach ($posts as $post) {
                        ?>
                        <!-- Each Rank section start here-->
                        <div class="rank_lg_sec grid-item" data-challenge_id="<?php echo $post['id']; ?>" data-post_id="<?php echo $post['challange_post_id']; ?>">
                            <div class="cmnt_newsec_row">
                                <div class="challange_info">
                                    <div class="challenge_header row">
                                        <div class="col-xs-2">
                                            <img class="img-circle user_chat_thumb" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . '/' . $post['challange_user_image']; ?>" title="<?php echo $post['challange_user'] ?>">
                                        </div>
                                        <div class="col-xs-10">
                                            <?php echo $post['name']; ?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="challenge_intro">
                                        <?php echo $post['description'] ?>
                                    </div>
                                </div>

                                <div class="rank_box">
                                    <div class="row">
                                        <div class="text-center">
                                            <div class="col-xs-2">
                                                <img class="img-circle user_chat_thumb" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . '/' . $post['post_user_image']; ?>" title="<?php echo $post['post_user'] ?>">
                                            </div>
                                            <div class="col-lg-8 col-sm-10 col-xs-10">
                                                <?php echo lang('1st Rank'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="rank-post">
                                                <?php
                                                if ($post['media_type'] == 'image') {
                                                    ?>
                                                    <a class="fancybox" href="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . '/' . $post['media']; ?>" data-fancybox-group="galleryrate1">
                                                        <img src="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . '/' . $post['media']; ?>" class="img-responsive center-block">
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="fancybox post_images"  href="javascript:;" data-fancybox-group="gallery">
                                                        <video controls class="img-responsive center-block">
                                                            <source src="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . '/' . $post['media']; ?>">
                                                            </source>
                                                            <?php echo lang("Seems like your browser doesn't support video tag.") ?>
                                                        </video>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rank_box2">
                                    <div class="row">
                                        <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-11 col-md-11 col-sm-11 col-xs-12 pad_lft0">
                                            <ul class="list-inline winr_ul rank_ul2 chellange_options">
                                                <li>
                                                    <button class="btn btn-primary others_rank" data-toggle="modal" data-target="#rank_modal">
                                                        <?php echo lang("Others"); ?>
                                                    </button>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" class="user_coin">
                                                        <img class="img-coin" src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($post['is_coined']) ? 'coined_icon.png' : 'coin_icon.png';
                                                        ?>"/><br/>
                                                        <span class="coin_cnt"><?php echo $post['tot_coin'] ?></span> <?php echo lang("Coins"); ?>
                                                    </a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="javascript:;" class="user_like">
                                                        <img src="<?php
                                                        echo DEFAULT_IMAGE_PATH;
                                                        echo ($post['is_liked']) ? 'liked_img.png' : 'like_img.png'
                                                        ?>" class="like_img"><br/>
                                                        <span>
                                                            <span class="like_cnt"><?php echo $post['tot_like'] ?></span> <?php echo lang("Likes"); ?>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" class="cmnt_winner">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>comment_icon.png"><br/>
                                                        <span> 
                                                            <span class="comment_cnt"><?php echo $post['tot_comment'] ?></span> <?php echo lang("Comments"); ?>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li style="position: relative;">
                                                    <a href="javascript:void(0);"  class="share-link" data-id="<?php echo $post['challange_post_id'] ?>">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>share_icon.png"><br>
                                                        <span>
                                                            <?php //echo $post['post_share']  ?> <?php echo lang("Shares"); ?>
                                                        </span>
                                                    </a>
                                                    <div id="" class="hide popover-content-custom">
                                                        <div class="arrow" style="left: 79.3706%;"></div>
                                                        <ul class="share-icon-list">
                                                            <li>

                                                                <?php
                                                                $media_url = (isset($post['media'])) ? $post['media'] : '';
                                                                $media = "st_via='habby' st_image='" . base_url() . "uploads/challenge_post/" . $media_url . "'";
                                                                $sharethis_content = "st_url='" . base_url() . "post/display_challenge_post/" . $post['challange_post_id'] . "' st_title='" . $post['description'] . "' " . $media;
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
                                            <div class="winner-comnt">
                                                <p class="cmn_txtnw"> <?php echo lang("Comment Here"); ?></p>
                                                <textarea class="form-control comment" rows="3" id="comment"></textarea>

                                                <?php
                                                if (isset($post['comments']) && count($post['comments']) > 0) {
                                                    foreach ($post['comments'] as $comment) {
                                                        ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="commnt_visit_sec clearfix" data-post_comment_id="<?php echo $comment['id']; ?>">
                                                                <div class="cmn_img">
                                                                    <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $comment['user_image']; ?>" class="img-responsive user_chat_thumb img-circle">
                                                                    <p class="cmnt_txt1"><span><?php echo $comment['name']; ?></span></p>
                                                                </div>
                                                                <div class="cmn_dtl">
                                                                    <p class="cmmnt_para"><?php echo $comment['comment_description']; ?></p>
                                                                    <p class=""><?php echo $comment['created_date'] ?></p>
                                                                    <ul class="cmnt_p clearfix">
                                                                        <li class="stlnon"><span></span></li>
                                                                        <li class="comment_like_cnt"><a href="javascript:;"><span class="post_comment_like"><?php echo $comment['cnt_like']; ?></span> <?php echo lang("Like"); ?></a></li>
                                                                        <li class="post_reply"><a href="javascript:;"><span class="comment_reply_cnt"><?php echo $comment['cnt_reply']; ?></span> <?php echo lang("Reply"); ?></a></li>
                                                                        <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>

                                                                    </ul>
                                                                    <div class="reply_dtl" style="display:none"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="commnt_visit_sec clearfix no_comment">
                                                        <?php echo lang("No comments available"); ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Each Rank section end here-->
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-info text-center">
                        <?php echo lang("No challenge post available."); ?>
                    </div>
                    <?php
                }
                ?>
            </section>
        </div>
    </div>
</div>

<!-- Rank modal -->
<div id="rank_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Rank modal over -->
<!-- Share this scripts -->
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
    stLight.options({publisher: "9d14d1f6-a827-4af0-87fe-f41eaa3ce220", doNotHash: false, doNotCopy: false, hashAddressBar: false});
</script>
<!-- Share this scripts over -->
<script type="text/javascript" src="<?php echo USER_JS; ?>challenge/challenge_post.js"></script>