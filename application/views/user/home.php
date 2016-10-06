<div class="row home_banner">
    <img src="uploads/banners/<?php echo $banner_image; ?>" class="img-responsive center-block">
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
	        <?php
	        if (count($posts) > 0) {
	            foreach ($posts as $post) {
	                ?>
	                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pst_full_sec" data-post_id="<?php echo $post['id']; ?>">
	                    <div class="cmnt_newsec_row">
	                        <div class="row">
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                                <div class="post_leftsec clearfix">

	                                    <!-- Comment window -->

	                                    <div class="post_leftsec_hddn post_leftsec_hddn1 hidden-xs">
	                                        <p class="cmn_txtnw"> Comment Here</p>
	                                        <textarea class="form-control" rows="3" id="textArea"></textarea>
	                                        <div class="commnt_visit_sec clearfix">
	                                            <div class="cmn_img">
	                                                <img src="images/likeimg.jpg" class="img-responsive">
	                                            </div>
	                                            <div class="cmn_dtl">
	                                                <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>
	                                                <ul class="cmnt_p clearfix">
	                                                    <li><a href="#">Like</a></li>
	                                                    <li><a href="#">Reply</a></li>
	                                                    <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
	                                                    <li class="stlnon"><span>- 10 October at 22:18</span></li>
	                                                </ul>
	                                                <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="mov_sec mov_sec1">
	                                        <div class="sav-n-orgnl clearfix">
	                                            <p class="sav_p">
	                                                <a href="javascript:;" class="pstbtn"><?php echo ($post['is_saved'])?'saved':'save'; ?></a>
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
	                                        	<?php
	                                        		if(isset($post['media']))
	                                        		{
	                                        			?>
			                                            <a class="fancybox"  href="uploads/user_post/<?php echo $post['media']; ?>" data-fancybox-group="gallery">
			                                                <img src="uploads/user_post/<?php echo $post['media']; ?>" class="img-responsive center-block">
			                                            </a>
	                                        			<?php
	                                        		}
	                                        	?>
	                                            <!-- image -->


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
	                                                            <img class="img-coin" src="<?php echo DEFAULT_IMAGE_PATH; echo ($post['is_coined'])?'coined_icon.png':'coin_icon.png'; ?>"/><br>
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
	                                                            <img src="<?php echo DEFAULT_IMAGE_PATH; echo ($post['is_liked'])?'liked_img.png':'like_img.png' ?>" class="like_img"><br>
	                                                            <span>
	                                                                <span class="like_cnt"><?php echo $post['post_like'] ?></span> Likes
	                                                            </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a role="button" id="chat1">
	                                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>comment_icon.png"><br>
	                                                            <span> 
	                                                                <?php echo $post['post_comment'] ?> Comments
	                                                            </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a href="#">
	                                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>share_icon.png"><br>
	                                                            <span>
	                                                                <?php echo $post['post_share'] ?> Shares
	                                                            </span>
	                                                        </a>
	                                                    </li>
	                                                </ul>
	                                            </div>

	                                            <div class="post_leftsec_hddn post_leftsec_hddn1 visible-xs">
	                                                <p class="cmn_txtnw"> Comment Here</p>
	                                                <textarea class="form-control" rows="3" id="textArea"></textarea>
	                                                <div class="commnt_visit_sec clearfix">
	                                                    <div class="cmn_img">
	                                                        <img src="images/likeimg.jpg" class="img-responsive">
	                                                    </div>
	                                                    <div class="cmn_dtl">
	                                                        <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>
	                                                        <ul class="cmnt_p clearfix">
	                                                            <li><a href="#">Like</a></li>
	                                                            <li><a href="#">Reply</a></li>
	                                                            <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
	                                                            <li class="stlnon"><span>- 10 October at 22:18</span></li>
	                                                        </ul>
	                                                        <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>
	                                                    </div>
	                                                </div>
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
	            <div class="alert alert-danger text-center">
	                No post available.
	            </div>
	            <?php
	        }
	        ?>
	    </div>
	</div>
</div>
<script type="text/javascript" src="<?php echo USER_JS; ?>post/post.js"></script>
