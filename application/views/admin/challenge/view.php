<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Admin</span> - Challenge Group Details</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home2 position-left"></i> Admin</a></li>
            <li><a href="<?php echo base_url() . "admin/challenge" ?>"><i class="icon-users4 position-left"></i> Challenges</a></li>
            <li><i class="icon-users4 position-left"></i> Details</li>
        </ul>
    </div>
</div>
<!-- /page header -->

<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    if (!empty(validation_errors())) {
        ?>
        <div class="content pt0 flashmsg">
            <div class = "alert alert-danger">
                <a class="close" data-dismiss="alert">X</a>
                <strong><?php echo validation_errors(); ?></strong>       
            </div>
        </div>
        <?php
    }
}
?>
<!-- Content area -->
<div class="content">
    <!-- /content area -->
    <div class="content">
        <div class="panel panel-flat">
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-sm-12">
                        <h2 class="text-semibold no-margin-top">Challenge Details</h2>
                        <?php
                        if (isset($challenges) && !empty($challenges)) {
//                            pr($challenges);
                            ?>
                            <div class="thumbnail challenge-details-thumbnail">
                                <h3><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $challenges['user_image']; ?>"> <?php echo $challenges['user_name']; ?></h3>
                                <div class="caption">
                                    <h6 class="no-margin-top"><span class="text-semibold">Name : </span><span class="word-break"><?php echo $challenges['name'] ?></span></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">Description : </span><?php echo $challenges['description'] ?></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">Date : </span><?php echo date('d-m-Y h:i a', strtotime($challenges['created_date'])) ?></h6>
                                </div>
                                <div>
                                    <h4 class="text-semibold">Challenge Accepted User</h4>
                                    <ul class="media-list padding-15 challenge-accepted-user-list">
                                        <?php
                                        if (isset($challenges['joined_user']) && !empty($challenges['joined_user'])) {
                                            foreach ($challenges['joined_user'] as $join_user) {
                                                ?>
                                                <li class="media">
                                                    <div class="media-left">
                                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $join_user['joined_user_image']; ?>" class="img-circle img-xs" alt=""> <?php echo $join_user['joined_user_name'] ?>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        } else {
                                            echo "No Joined User.";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-lg-9">
                        <div class="tabbable">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="activity">
                                    <!-- Timeline -->
                                    <div class="col-lg-12 col-sm-12">
                                        <h2 class="text-semibold no-margin-top">Group Conversation</h2>
                                        <div class="panel panel-flat timeline-content group-conversation-wrapper">


                                            <div class="panel-body chat_area2">
                                                <ul class="media-list chat-list ">
                                                    <?php
                                                    if (isset($messages) && !empty($messages)) {
                                                        foreach ($messages as $message) {
//                                                                pr($message);
                                                            ?>
                                                            <li class="media">
                                                                <div class="media-left">
                                                                    <a title="<?php echo $message['name'] ?>">
                                                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image'] ?>" class="img-circle" alt="">
                                                                    </a>
                                                                </div>
                                                                <?php if ($message['message'] != null) { ?>
                                                                    <div class="media-body">
                                                                        <div class="media-content"><?php echo $message['message'] ?></div>
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    if ($message['media'] != null && $message['media_type'] == 'image') {
                                                                        ?>
                                                                        <div class="media-body" style='position: relative;height: 180px;'>
                                                                            <div class="media-content">
                                                                                <img src="<?php echo DEFAULT_CHAT_MEDIA_PATH . $message['media'] ?>" alt="" style="display: block;max-width:100% !important;max-height: 100% !important;">
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="media-body">
                                                                            <div class="media-content">
                                                                                <video controls="" src="<?php echo DEFAULT_CHAT_MEDIA_PATH . $message['media'] ?>" style="height:180px;"></video>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                <?php } ?>
                                                            </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "No Message";
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /messages -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <h2 class="text-semibold no-margin-top">Challenge Post</h2>
                    <?php
                    if (isset($challenges['challenge_post']) && !empty($challenges['challenge_post'])) {
                        foreach ($challenges['challenge_post'] as $challenge_post) {
//                            pr($challenge_post);
                            ?>
                            <div class="challenge_post col-sm-4">
                                <div class="thumbnail c_post_thumbnail">
                                    <h3><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $challenge_post['post_user_image']; ?>"> <?php echo $challenge_post['post_user_name']; ?></h3>

                                    <div class="thumb">
                                        <?php
                                        if ($challenge_post['media_type'] == 'image') {
                                            ?>
                                            <div class="thumb-inner">
                                                <img src="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . $challenge_post['media']; ?>" alt="">
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="thumb-inner">
                                                <video controls class="img-responsive center-block">
                                                    <source src="<?php echo DEFAULT_CHALLENGE_IMAGE_PATH . $challenge_post['media']; ?>"></source>
                                                </video>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="caption">
                                        <h6 class="no-margin-top"><span class="text-semibold">Average Rank : </span><?php echo $challenge_post['positive_rank'] - $challenge_post['negetive_rank']; ?></h6>
                                    </div>
                                    <div>
                                        <ul class="thumb-ul">
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="icon-coins"></i>
                                                    <br><span class="coins-count"><?php echo $challenge_post['tot_coin'] ?> coins</span> </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="icon-thumbs-up3"></i>
                                                    <br><span class="likes-count"><?php echo $challenge_post['tot_like'] ?> Likes</span> 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="icon-comments"></i>
                                                    <br><span class="comments-count"><?php echo $challenge_post['tot_comment'] ?> comments</span> 
                                                </a>
                                            </li>
                                        </ul>
                                        <ul class="media-list padding-15">
                                            <?php
                                            if (isset($challenge_post['comments']) && !empty($challenge_post['comments'])) {
                                                foreach ($challenge_post['comments'] as $post_cmt) {
                                                    ?>
                                                    <li class="media">
                                                        <div class="media-left">
                                                            <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $post_cmt['user_image']; ?>" class="img-circle img-xs" alt="">
                                                        </div>

                                                        <div class="media-body">
                                                            <a href="#">
                                                                <?php echo $post_cmt['name']; ?>
                                                                <span class="media-annotation pull-right"><?php echo date('h i', strtotime($post_cmt['created_date'])); ?></span>
                                                            </a>

                                                            <span class="display-block text-muted"> <?php echo $post_cmt['comment_description']; ?></span>      
                                                            <ul class="thumb-ul">
                                                                <li>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="icon-thumbs-up3"></i>
                                                                        <br><span class="likes-count"> <?php echo $post_cmt['cnt_like']; ?> Likes</span> 
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="icon-comments"></i>
                                                                        <br><span class="comments-count"> <?php echo $post_cmt['cnt_reply']; ?> comments</span> 
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <?php
                                                            if (isset($post_cmt['comment_replies']) && !empty($post_cmt['comment_replies'])) {
                                                                foreach ($post_cmt['comment_replies'] as $cmt_reply) {
//                                                                pr($cmt_reply);
                                                                    ?>
                                                                    <ul class="media-list padding-15">
                                                                        <li class="media">
                                                                            <div class="media-left">
                                                                                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $cmt_reply['user_image']; ?>" class="img-circle img-xs" alt="">
                                                                            </div>

                                                                            <div class="media-body">
                                                                                <a href="#">
                                                                                    <?php echo $cmt_reply['name']; ?>
                                                                                    <span class="media-annotation pull-right reply_time"><?php echo date('h i', strtotime($cmt_reply['created_date'])); ?></span>
                                                                                </a>

                                                                                <span class="display-block text-muted"><?php echo $cmt_reply['reply_text']; ?></span>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>