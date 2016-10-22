<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Admin</span> - Post Details</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home2 position-left"></i> Admin</a></li>
            <li><a href="<?php echo base_url() . "admin/posts" ?>"><i class="icon-users4 position-left"></i> Posts</a></li>
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

                <style>
                    .thumb{
                        display: table;
                        width:100%;
                    }
                    .thumb-inner{
                        display: table-cell;
                        padding: 5px;
                    } 
                    .thumb-ul li a i {
                        font-size: 20px;
                    }
                    .thumb-ul li a i {
                        font-size: 20px;
                    }
                    .thumb-ul li {
                        display: inline-block;
                    }
                    .thumb-ul li a{
                        padding: 0 18px;
                        color: #26A69A;
                        text-align: center;
                    }
                    ul.thumb-ul {
                        padding-left: 10px;
                    }
                    .padding-15{
                        padding: 15px;
                    }
                    .media .thumb-ul li a {
                        padding: 0;
                        text-align: center;
                        display: inline-block;
                    }
                    .media .thumb-ul li a i, .media .thumb-ul li a {
                        font-size: 12px;
                    }
                    .media-list > li:nth-child(odd) {
                        background-color: #f9f7f7;
                    }
                    .media .thumb-ul li a {
                        padding: 0 8px 0 0;
                        text-align: center;
                        display: inline-block;
                        color:#2196F3;
                    }
                </style>  
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <?php
                        if (isset($posts) && !empty($posts)) {
                            pr($posts);
                            ?>
                            <div class="thumbnail">
                                <div class="thumb">
                                    <?php
                                    foreach ($posts['media'] as $post_media) {
                                        if ($post_media['media_type'] == 'image') {
                                            ?>
                                            <div class="thumb-inner">
                                                <img src="<?php echo DEFAULT_POST_IMAGE_PATH . $post_media['media']; ?>" alt="">
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="thumb-inner">
                                                <video controls class="img-responsive center-block">
                                                    <source src="<?php echo DEFAULT_POST_IMAGE_PATH . $post_media['media']; ?>"></source>
                                                </video>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="caption">
                                    <h6 class="no-margin-top text-semibold"><a href="#" class="text-default">For ostrich much</a> <a href="#" class="text-muted"><i class="icon-download pull-right"></i></a></h6>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                </div>
                                <div>
                                    <ul class="thumb-ul">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="icon-coins"></i>
                                                <br><span class="coins-count"><?php echo $posts['post_coin'] ?> coins</span> </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="icon-thumbs-up3"></i>
                                                <br><span class="likes-count"><?php echo $posts['post_like'] ?> Likes</span> 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="icon-comments"></i>
                                                <br><span class="comments-count"><?php echo $posts['post_comment'] ?> comments</span> 
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="media-list padding-15">
                                        <?php
                                        foreach ($posts['comments'] as $post_cmt) {
                                            ?>
                                            <li class="media">
                                                <div class="media-left">
                                                    <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $post_cmt['user_image']; ?>" class="img-circle img-xs" alt="">
                                                </div>

                                                <div class="media-body">
                                                    <a href="#">
                                                        <?php echo $post_cmt['name']; ?>
                                                        <span class="media-annotation pull-right"><?php echo date('h i',strtotime($post_cmt['created_date'])); ?></span>
                                                    </a>

                                                    <span class="display-block text-muted"> <?php echo $post_cmt['comment']; ?></span>      
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
<!--                                                    <ul class="media-list padding-15">
                                                        <li class="media">
                                                            <div class="media-left">
                                                                <img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt="">

                                                            </div>

                                                            <div class="media-body">
                                                                <a href="#">
                                                                    Margo Baker
                                                                    <span class="media-annotation pull-right">12:16</span>
                                                                </a>

                                                                <span class="display-block text-muted">Pinched a well more moral chose goodness...</span>
                                                            </div>
                                                        </li>
                                                    </ul>-->
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
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