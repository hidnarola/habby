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
                    <span class="post_comment_text"><?php echo lang("Like");?></span>
                </a>
            </li>
            <li class="post_comment_reply">
                <a href="javascript:;">
                    <span class="comment_reply_cnt">
                        <?php echo $comment['cnt_reply']; ?>
                    </span> <?php echo lang("Reply");?>
                </a>
            </li>
            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
        </ul>
        <div class="reply_dtl" style="display: none"></div>
    </div>
</div>