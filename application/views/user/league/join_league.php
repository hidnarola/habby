
<div class="row solmate_lg_row">
    <div class="container topic_2cntnr">
        <p class="mr_p visible-xs" >
            <a href="#" class="pstbtn" id="more_rate" onclick = "displayFileBox()"><?php echo lang('Files'); ?></a> <a href="#" class="pstbtn" id="member_show" onclick = "displayLoginBox()"><?php echo lang("Member"); ?></a>
        </p>

        <!-- Challenge left lg section start here -->
        <?php
        $message = $this->session->flashdata('message');
        if (!empty($message) && isset($message)) {
            ($message['class'] != '') ? $message['class'] : '';
            echo '<div class="' . $message['class'] . ' flashmsg">' . $message['message'] . '</div>';
        }
        ?>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 pd-right-chlng-0">

            <div class="chalng2_lg_lft_sec">

                <!--  League introduction section start here -->

                <div class="row chalng2_league_sec_1">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="slmat2date_sec grp2date_sec chalng2_league">
                            <div class="row">
                                <!--  League introduction content section start here -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div class="leag_name leagu_section1">
                                        <p><img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $league['league_logo']; ?>" class="leag_logo"><?php echo $league['name'] ?></p>
                                    </div>

                                    <div class="leag_intro leagu_section1">
                                        <p><?php echo $league['introduction']; ?></p>	
                                    </div>

                                </div>
                                <!--  League introduction content section end here -->

                                <!--  League introduction footer section start here -->

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section2">
                                    <p><?php echo lang("Created Date"); ?>: <span><?php echo date('d/m/Y', strtotime($league['created_date'])); ?></span></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section2">
                                    <p class="text-right"><?php echo lang("Rank"); ?>: <span>100</span></p>
                                </div>

                                <!--  League introduction footer section start here -->
                            </div>
                        </div>

                    </div>

                </div>

                <!--  League introduction section end here -->

                <!--  League Meeting section start here -->
                <div class="row chalng2_league_sec_1">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="slmat2date_sec grp2date_sec chalng2_league2">

                            <!--  League Meeting section header start here -->
                            <div class="row meeting_sec">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section3">
                                    <p><?php echo lang("Meetings"); ?></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section3">
                                    <p class="text-right"><a href="#" data-toggle="modal" data-target="#league_meeting">+ <?php echo lang('more') ?></a></p>
                                </div>
                            </div>
                            <!--  League Meeting section header end here -->

                            <!--  League Meeting each content section start here -->
                            <div class="meeting_section">
                                <?php
                                if ($league_meetings != null && !empty($league_meetings)) {
                                    foreach ($league_meetings as $league_meeting) {
                                        ?>
                                        <div class="row leagu_section4row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 leagu_section4">
                                                <p class="meeting_date">
                                                    <?php echo lang('Date') . " : " . date('d/m/Y', strtotime($league_meeting['meeting_date'])) ?>
                                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>grn_check.png">
                                                </p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 leagu_section4_2">
                                                <p><?php echo $league_meeting['meeting_details'] ?></p>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 leagu_section4_3">
                                                <p><a href="#" class="pstbtn"><?php echo lang('Join'); ?></a></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="row leagu_section4row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 leagu_section4">
                                            <p class="meeting_date"><?php echo lang('No New Meetings.'); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--  League Meeting each content section end here -->
                        </div>

                    </div>

                </div>
                <!--  League Meeting section end here -->
            </div>

            <div class="row mmber_chat_row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pad_lft_rit0">
                    <!--  League Meeting section header start here -->
                    <div class="row meeting_sec mmbr_hdg login_Box_Div">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leagu_section3">
                            <p><?php echo lang("Member"); ?></p>
                        </div>

                    </div>
                    <!--  League Meeting section header end here -->
                    <div class="slmat2date_sec grp2date_sec chalng2_league2 mmbr_sec login_Box_Div">

                        <!--  League Meeting each content section start here -->
                        <div class="row leagu_section4row scrol_mmbr">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leagu_section4 name">
                                <?php
                                if (count($league_members) > 0) {
                                    foreach ($league_members as $member) {
                                        ?>
                                        <p>
                                            <a href="personal_account.html">
                                                <?php echo $member['name'] ?>
                                                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $member['user_image']; ?>">
                                            </a>
                                        </p>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <p>
                                        <?php echo lang("No member available"); ?>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!--  League Meeting each content section end here -->



                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="row chat_msg_sec">

                        <!-- Chat area section start here -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mble_pd_0">
                            <div class="chat_area_solmat chat_area_league2 chat_area2">
                                <?php $this->load->view('user/partial/league/load_more_msg') ?>
                            </div>
                        </div>
                        <!-- Chat area section end here -->

                        <!-- Type Chat section start here -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="topich_chat_typesec_slmt topich_chat_typesec_league2">
                                <!-- Smily icon and profile secton start here -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="topic_prfle_icon_sec">

                                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-3">
                                                <a href="personal_account.html"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="img-responsive cht_pfl_img"></a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-9">
                                                <ul class="list-inline type_icon_ul">
                                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol1.png"></a></li>
                                                    <li>
                                                        <div class="fileUpload up_img btn">
                                                            <span><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol2.png"></span>
                                                            <input type="file" name="uploadfile[]" class="upload" id="uploadFile"/>
                                                        </div>
                                                    </li>
                                                    <li><a href="#"  data-toggle="modal" data-target="#emogis"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Smily icon and profile secton end here -->

                                <!-- Type area start here -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="topic_textarea">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div contenteditable="true" id='message_div' hidefocus="true" class="form-control"></div>
                                                    <input type="hidden" id='message' name='message' class="form-control"/>
                                                    <span class="input-group-btn">
                                                        <input class="chat_btn submit_btn" type="submit" value="<?php echo lang("Send"); ?>">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Type area end here -->

                            </div>
                        </div>
                        <!-- Type Chat section end here -->
                    </div>
                </div>
            </div>

        </div>
        <!-- Challenge left lg section end here -->

        <!-- Challenge right lg section end here -->

        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 bdr-right-clng pad_lft0">
            <div class="achieve_right_sec">
                <!-- Event section start  here -->
                <div class="row chalng2_league_sec_1">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="slmat2date_sec grp2date_sec chalng2_league2">
                            <!-- Event section header start here -->
                            <div class="row meeting_sec">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section3">
                                    <p><?php echo lang("Events"); ?></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section3">
                                    <p class="text-right"><a href="#"  data-toggle="modal" data-target="#league_events">+ <?php echo lang("more"); ?></a></p>
                                </div>
                            </div>
                            <!-- Event section header end here -->

                            <!-- Event section content start here -->
                            <div class="events_section">
                                <div class="row event_sect">
                                    <?php
                                    if ($league_events != null && !empty($league_events)) {
                                        foreach ($league_events as $league_event) {
                                            ?>
                                            <!-- Event Each content start here -->
                                            <div class="row event_section_sm">

                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 leagu_section4_2 event_name">
                                                    <p class="text-left"><a href="#" data-toggle="modal" data-target="#league_details" data-title="<?php echo $league_event['event_title'] ?>" data-details="<?php echo $league_event['event_text'] ?>"><?php echo $league_event['event_title'] ?></a></p>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 leagu_section4_2">
                                                    <p class="text-right"> <?php echo date('d/m/Y', strtotime($league_event['event_date'])) ?></p>
                                                </div>

                                            </div>
                                            <!-- Event Each content end here -->
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="row event_section_sm">
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 leagu_section4_2 event_name">
                                                <p class="meeting_date"><?php echo lang('No New Events.'); ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- Event section content end here -->
                        </div>

                    </div>

                </div>
                <!-- Event section end  here -->

                <!-- Achieve section header start here -->
                <div class="row chalng2_league_sec_1">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad_lft_rit0">
                        <div class="leagu_section_acv leagu_section3">
                            <p class="text-left"><?php echo lang("Achieve"); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad_lft_rit0">
                        <div class="leagu_section_acv leagu_section3">
                            <p class="text-right"><a href="#" data-toggle="modal" data-target="#league_details_2">+ <?php echo lang("more"); ?></a></p>
                        </div>
                    </div>
                </div>
                <!-- Achieve section header end here -->
            </div>
            <!-- Achieve section content start here -->
            <div class="soulmate_past_due_sec league_achieve_sec">

                <div class="row soulmate_past_due_sec2">

                    <!-- Achieve each section content start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng">

                        <div class="row achieve_box">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 achiv_txt">
                                <p><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="img-circle"> Name</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pad_lft0">
                                <div class="rank-post">
                                    <a class="fancybox" href="<?php echo DEFAULT_IMAGE_PATH; ?>League-Alliance2_img1.jpg" data-fancybox-group="gallery1">
                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>League-Alliance2_img1.jpg" class="img-responsive center-block ">
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Achieve each section content end here -->

                    <!-- Achieve each section content start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng">

                        <div class="row achieve_box">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 achiv_txt">
                                <p><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="img-circle"> Name</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pad_lft0">
                                <div class="rank-post">
                                    <a class="fancybox" href="<?php echo DEFAULT_IMAGE_PATH; ?>League-Alliance2_img2.jpg" data-fancybox-group="gallery1">
                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>League-Alliance2_img2.jpg" class="img-responsive center-block ">
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Achieve each section content end here -->

                    <!-- Achieve each section content start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng">

                        <div class="row achieve_box">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 achiv_txt">
                                <p><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="img-circle"> Name</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pad_lft0">
                                <div class="rank-post">
                                    <a class="fancybox" href="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img2.jpg" data-fancybox-group="gallery1">
                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img2.jpg" class="img-responsive center-block ">
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Achieve each section content end here -->

                    <!-- Achieve each section content start here -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rank_lg_sec bdr-right-clng">

                        <div class="row achieve_box">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 achiv_txt">
                                <p><img src="<?php echo DEFAULT_IMAGE_PATH; ?>pst_prfl_icon.png" class="img-circle"> Name</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pad_lft0">
                                <div class="rank-post">
                                    <a class="fancybox" href="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img3.jpg" data-fancybox-group="gallery1">
                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img3.jpg" class="img-responsive center-block ">
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Achieve each section content end here -->

                </div>

            </div>
            <!-- Achieve section content end here -->

        </div>
    </div>
</div>
<!-- New Events form popup start here -->
<div class="modal mdl_frm" id="league_events">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><?php echo lang("Add New Event"); ?></b>
                </div>
                <div class="event">
                    <form action="<?php echo base_url() . 'league/add_event' ?>" method="post">
                        <div class="form-group clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" id="event_title" name="event_title" placeholder="<?php echo lang('Enter Title'); ?> :" required="true">
                                <input  type="hidden" class="form-control" name="id" id="id" value="<?php echo $this->uri->segment(3) ?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" name="Event-date" id="Event-date" placeholder="<?php echo lang('Event Date'); ?> :" required="true"/>
                            </div>
                        </div>
                        <p><?php echo lang('Event Details'); ?> :</p>
                        <div class="chalng_upld clearfix">
                            <div class="upld_sec">
                                <div class="fileUpload up_img btn">
                                    <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
                                    <input type="file" class="upload">
                                </div>
                                <div class="fileUpload up_img btn">
                                    <span><i class="fa fa-video-camera" aria-hidden="true"></i> <?php echo lang('Videos'); ?></span>
                                    <input type="file" class="upload">
                                </div>
                                <input type="text" class="form-control" id="event_text" name="event_text" placeholder="<?php echo lang('Enter Details'); ?>" required="true"/>
                            </div>	
                            <p class="text-right"><button type="submit" class="pstbtn"><?php echo lang('Add'); ?></button></p>
                        </div>
                    </form>	
                </div>
            </div>
        </div>
    </div>
</div>
<!-- New Events form popup end here -->
<!-- New Meetings form popup start here -->
<div class="modal mdl_frm" id="league_meeting">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><?php echo lang('Add New Meeting'); ?></b>
                </div>
                <div class="event clearfix">
                    <form action="<?php echo base_url() . "league/add_meeting" ?>" method="post">
                        <div class="form-group clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input  type="text" class="form-control" name="Meeting-date" id="Meeting-date" placeholder="<?php echo lang('Meeting Date'); ?>" required="true"/>
                                <input  type="hidden" class="form-control" name="id" id="id" value="<?php echo $this->uri->segment(3) ?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" id="Meeting-details" name="Meeting-details" placeholder="<?php echo lang('Meeting Details'); ?>" required="true">
                            </div>
                        </div>
                        <p class="text-right"><button type="submit" class="pstbtn"><?php echo lang('Add'); ?></button></p>
                    </form>	
                </div>
            </div>
        </div>
    </div>
</div>
<!-- New Meetings form popup end here -->

<!-- New Meetings form popup start here -->
<div class="modal mdl_frm" id="league_details">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><span id="modal_title"></span></b>
                </div>
                <div class="evntpopup row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>rank-img2.jpg" class="img-responsive center-block">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p><span id="modal_details"></span></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Global variable for join_topichat.js -->
<script>
    data = '<?php echo json_encode($this->session->user); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    last_msg = '<?php echo (count($messages) > 0) ? $messages[count($messages) - 1]['id'] : 0 ?>';
    upload_path = '<?php echo DEFAULT_CHAT_IMAGE_PATH; ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/league/join_league.js"></script>
<!-- Lazy loading -->
<script>
    $('document').ready(function () {
        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
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
                url: base_url + 'league/load_more_msg/' + group_id,
                method: 'post',
                async: false,
                data: 'last_msg=' + last_msg,
                success: function (more) {
                    more = JSON.parse(more);
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

        var dateToday = new Date();
        $('#Meeting-date').datepicker({
            minDate: dateToday,
        });
        $("#Meeting-date").attr("placeholder", "<?php echo lang('Meeting Date') ?>");
        $('#Event-date').datepicker({
            minDate: dateToday,
        });

        //triggered when modal is about to be shown
        $('#league_details').on('show.bs.modal', function (e) {

            //get data-id attribute of the clicked element
            var title = $(e.relatedTarget).data('title');
            var details = $(e.relatedTarget).data('details');

            $('#modal_title').text(title);
            $('#modal_details').text(details);
        });
    });
</script>
