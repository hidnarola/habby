<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Admin</span> - Event Details</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home2 position-left"></i> Admin</a></li>
            <li><a href="<?php echo base_url() . "admin/event" ?>"><i class="icon-users4 position-left"></i> Event</a></li>
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
                <h2 class="text-semibold no-margin-top">Event Details</h2>
                <div class="row thumbnail">
                    <div class="col-sm-12">
                        <div class="col-sm-8">
                            <h3><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $events['user_image']; ?>"> <?php echo $events['username']; ?></h3>
                            <div class="caption">
                                <div class="col-sm-12">
                                    <h6 class="no-margin-top"><span class="text-semibold">Event Title : </span><?php echo $events['title'] ?></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">Details :  </span><?php echo $events['details'] ?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="no-margin-top "><span class="text-semibold">Person Limit : </span><?php echo $events['limit']; ?></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">Start Time : </span><?php echo date('d-m-Y h:i a', strtotime($events['start_time'])) ?></h6>
                                    <h6 class="no-margin-top "><span class="text-semibold">Approval needed : </span><?php echo ($events['approval_needed']) ? 'Yes' : 'No'; ?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="no-margin-top "><span class="text-semibold">Release Distance Range : </span><?php echo $events['release_distance_range']; ?></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">End Time : </span><?php echo date('d-m-Y h:i a', strtotime($events['end_time'])) ?></h6>
                                    <h6 class="no-margin-top"><span class="text-semibold">Creation Time : </span><?php echo date('d-m-Y h:i a', strtotime($events['created_date'])) ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            Event Cover : 
                            <div class="thumb">
                                <div class="thumb-inner">
                                    <img src="<?php echo DEFAULT_EVENT_MEDIA_PATH . $events['media']; ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="thumbnail challenge-details-thumbnail">
                            <div>
                                <h4 class="text-semibold">Event User</h4>
                                <ul class="media-list padding-15 challenge-accepted-user-list">
                                    <?php
                                    if (isset($event_member) && !empty($event_member)) {
                                        foreach ($event_member as $join_user) {
                                            ?>
                                            <li class="media">
                                                <div class="media-left">
                                                    <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $join_user['user_image']; ?>" class="img-circle img-xs" alt=""> <?php echo $join_user['name'] ?>
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
                            <div class="caption">
                                <h4 class="text-semibold">Notes</h4>
                                <p class="event_notes"><?php echo (empty($events['notes'])) ? 'No Content available' : $events['notes']; ?></p>
                            </div>
                            <div class="caption">
                                <h4 class="text-semibold">Contacts</h4>
                                <div class="event_contact_wrapper">
                                    <?php
                                    if (count($event_contact) > 0) {
                                        foreach ($event_contact as $contact) {
                                            ?>
                                            <div class="contact_ul" data-id="<?php echo $contact['id'] ?>">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <a href="javascript;">
                                                            <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $contact['user_image'] ?>" class="smlt_usrimg1 img-circle img-xs">
                                                        </a>
                                                    </div>
                                                    <span class="first_span col-md-9"><?php echo $contact['name']; ?></span>
                                                </div>
                                                <div class="row">
                                                    <span class="first_span col-md-4 col-md-offset-2">
                                                        <a href="javascript;">
                                                            Phone Number
                                                        </a>
                                                    </span>
                                                    <span class="col-md-6" id="phone_no_info"><?php echo $contact['phone_no'] ?></span>
                                                </div>
                                                <div class="row">
                                                    <span class="first_span col-md-4 col-md-offset-2">
                                                        <a href="javascript;">
                                                            Email
                                                        </a>
                                                    </span>
                                                    <span class="col-md-6" id="email_info"><?php echo $contact['email'] ?></span>
                                                </div>
                                                <div class="row">
                                                    <span class="first_span col-md-4 col-md-offset-2">
                                                        <a href="javascript;">
                                                            Others
                                                        </a>
                                                    </span>
                                                    <span class="col-md-6" id="others_info"><?php echo $contact['others'] ?></span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <p>No Contact available</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="tabbable">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="activity">
                                    <!-- Timeline -->
                                    <div class="col-lg-12 col-sm-12">
                                        <h2 class="text-semibold no-margin-top">Event Conversation</h2>
                                        <div class="panel panel-flat timeline-content group-conversation-wrapper topichat-group-conversation">
                                            <div class="panel-body chat_area2">
                                                <ul class="media-list chat-list ">
                                                    <?php
                                                    if (isset($messages) && !empty($messages)) {
                                                        foreach ($messages as $message) {
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
                                                                }
                                                                ?>
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