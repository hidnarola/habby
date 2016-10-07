<?php
?>
<div class="commnt_visit_sec clearfix">
    <div class="cmn_img">
        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $comment['user_image']; ?>" class="img-responsive">
    </div>
    <div class="cmn_dtl">
        <p class="cmnt_txt1"><span><?php echo $comment['name']; ?></span> Interesting</p>
        <ul class="cmnt_p clearfix">
            <li><a href="javascript:;"><span class="comment_like_cnt"><?php echo $comment['cnt_like']; ?></span> Like</a></li>
            <li><a href="javascript:;"><span class="comment_like_cnt"><?php echo $comment['cnt_reply']; ?></span> Reply</a></li>
            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
            <li class="stlnon"><span><?php echo $comment['created_date'] ?></span></li>
        </ul>
        <p class="cmmnt_para"><?php echo $comment['comment']; ?></p>
    </div>
</div>