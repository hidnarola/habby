<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                <li class="comment_like_cnt"><a href="javascript:;"><span class="post_comment_like"><?php echo $comment['cnt_like']; ?></span> Like</a></li>
                <li class="post_reply"><a href="javascript:;"><span class="comment_reply_cnt"><?php echo $comment['cnt_reply']; ?></span> Reply</a></li>
                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
            </ul>
            <div class="reply_dtl" style="display:none"></div>
        </div>
    </div>
</div>