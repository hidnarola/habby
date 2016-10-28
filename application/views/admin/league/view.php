<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Admin</span> - Topichat Group Details</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home2 position-left"></i> Admin</a></li>
            <li><a href="<?php echo base_url() . "admin/topichat" ?>"><i class="icon-users4 position-left"></i> Topichat</a></li>
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
                    <div class="col-lg-12 col-sm-12">
                        <?php
                        if (isset($topichats) && !empty($topichats)) {
//                            pr($topichats);
                            ?>
                            <div class="thumbnail">
                                <h3><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $topichats['user_image']; ?>"> <?php echo $topichats['name']; ?></h3>
                                <div class="thumb">
                                    <div class="thumb-inner">
                                        <img src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichats['group_cover']; ?>" alt="">
                                    </div>
                                </div>
                                <div class="caption">
                                    <h6 class="no-margin-top"><span class="text-semibold">Topic Name : </span><?php echo $topichats['topic_name'] ?></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">Notes :  </span><?php echo $topichats['notes'] ?></h6>
                                    <h6 class="no-margin-top "><span class="text-semibold">Group Limit : </span><?php echo ($topichats['person_limit'] != -1) ? $topichats['person_limit'] : "No Limit" ?></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">Date : </span><?php echo date('d-m-Y h:i a', strtotime($topichats['created_date'])) ?></h6>
                                </div>
                                <div>
                                    <h4 class="text-semibold">Group Users (<?php echo $topichats['Total_User'] ?>)</h4>
                                    <ul class="media-list padding-15">
                                        <?php
                                        if (isset($topichats['joined_user']) && !empty($topichats['joined_user'])) {
                                            foreach ($topichats['joined_user'] as $joined_user) {
                                                ?>
                                                <li class="media">
                                                    <div class="media-left">
                                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $joined_user['joined_user_image']; ?>" class="img-circle img-xs" alt=""> <?php echo $joined_user['joined_user_name'] ?>
                                                    </div>
                                                </li>
                                                <?php
                                            }
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