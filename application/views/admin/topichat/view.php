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
                    <div class="col-lg-3 col-sm-12">
                        <h2 class="text-semibold no-margin-top">Topichat Details</h2>
                        <?php
                        if (isset($topichats) && !empty($topichats)) {
//                            pr($topichats);
                            ?>
                            <div class="thumbnail topi-chart-thumbnail">
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
                                    <h4 class="text-semibold">Group Users <span class="badge badge-success heading-text"><?php echo $topichats['Total_User'] ?></span></h4>
                                    <ul class="media-list padding-15 challenge-accepted-user-list">
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
                    <div class="col-lg-9">
                        <div class="tabbable">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="activity">
                                    <!-- Timeline -->
                                    <div class="col-lg-12 col-sm-12">
                                        <h2 class="text-semibold no-margin-top">Group Conversation</h2>
                                        <div class="panel panel-flat timeline-content group-conversation-wrapper topichat-group-conversation">
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
                                                                            <div class="media-content"><img src="<?php echo DEFAULT_CHAT_MEDIA_PATH . $message['media'] ?>" alt="" style="display: block;max-width:100% !important;max-height: 180px !important;"> </div>
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="media-body">
                                                                            <div class="media-content">
                                                                                <video controls="" src="<?php echo DEFAULT_CHAT_MEDIA_PATH . $message['media'] ?>" style="height:180px;"></video></div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                <?php } ?>
                                                            </li>
                                                            <?php
                                                        }
                                                    }else{
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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('document').ready(function () {
        last_msg = '<?php echo (count($messages) > 0) ? $messages[count($messages) - 1]['id'] : 0 ?>';
        $(".chat-list").animate({scrollTop: $('.chat-list').height() + 10000}, 1000);
        var load = true;
        var in_progress = false;
        $('.chat_area2').scroll(function () {
            if (load && !in_progress)
            {
                if ($('.chat_area2').scrollTop() == 0) {
                    loaddata();
                    in_process = true;
                }
            }
        });

        function loaddata()
        {
            $.ajax({
                url: base_url + 'topichat/load_more_msg/' + group_id,
                method: 'post',
                async: false,
                data: 'last_msg=' + last_msg,
                success: function (more) {
                    more = JSON.parse(more);
                    console.log(more);
                    if (more.status)
                    {
                        $('.chat_area2').prepend(more.view);
                        last_msg = more.last_msg_id;
                        $(".chat_area2").animate({scrollTop: 200}, 500);
                    } else
                    {
                        load = false;
                        $('.chat_area2').prepend('<div class="text-center">No more messages to show</div>');
                        $(".chat_area2").animate({scrollTop: 0}, 500);
                    }
                    in_progress = false;
                }
            });
        }
    });
</script>