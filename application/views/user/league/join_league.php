<?php
echo "jidskfjdoi";
if ($league != "" && !empty($league)) {
    pr($league);
}
?>
<div class="row solmate_lg_row">
    <div class="container topic_2cntnr">
        <p class="mr_p visible-xs" >
            <a href="#" class="pstbtn" id="more_rate" onclick = "displayFileBox()">Files</a> <a href="#" class="pstbtn" id="member_show" onclick = "displayLoginBox()">Member</a>
        </p>

        <!-- Challenge left lg section start here -->
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
                                        <p><img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH.$league['league_logo']; ?>" class="leag_logo"><?php echo $league['name'] ?></p>
                                    </div>

                                    <div class="leag_intro leagu_section1">
                                        <p><?php echo $league['introduction']; ?></p>	
                                    </div>

                                </div>
                                <!--  League introduction content section end here -->

                                <!--  League introduction footer section start here -->

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section2">
                                    <p>Created Date: <span><?php echo date('d-m-Y',strtotime($league['created_date'])); ?></span></p>	
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section2">
                                    <p class="text-right">Rank: <span>100</span></p>
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
                                    <p>Meetings</p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section3">
                                    <p class="text-right"><a href="#" data-toggle="modal" data-target="#league_meeting">+ more</a></p>
                                </div>
                            </div>
                            <!--  League Meeting section header end here -->

                            <!--  League Meeting each content section start here -->
                            <div class="row leagu_section4row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 leagu_section4">
                                    <p>
                                        Date:
                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>grn_check.png">
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 leagu_section4_2">
                                    <p>Meeting details </p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 leagu_section4_3">
                                    <p><a href="#" class="pstbtn">Join</a></p>
                                </div>
                            </div>
                            <!--  League Meeting each content section end here -->

                            <!--  League Meeting each content section start here -->
                            <div class="row leagu_section4row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 leagu_section4">
                                    <p>
                                        Date:

                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 leagu_section4_2">
                                    <p>Meeting details </p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 leagu_section4_3">
                                    <p><a href="#" class="pstbtn">Join</a></p>
                                </div>
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
                            <p>Member</p>
                        </div>

                    </div>
                    <!--  League Meeting section header end here -->
                    <div class="slmat2date_sec grp2date_sec chalng2_league2 mmbr_sec login_Box_Div">

                        <!--  League Meeting each content section start here -->
                        <div class="row leagu_section4row scrol_mmbr">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leagu_section4 name">
                                <?php
                                    if(count($league_members) > 0)
                                    {
                                        foreach($league_members as $member)
                                        {
                                            ?>
                                            <p>
                                                <a href="personal_account.html">
                                                    <?php echo $member['name'] ?>
                                                    <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH.$member['user_image']; ?>">
                                                </a>
                                            </p>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <p>
                                            No member available
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
                                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol2.png"></a></li>
                                                    <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>type_symbol3.png"></a></li>
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
                                                    <input type="text" id="message" class="form-control" placeholder="Type Here...">
                                                    <span class="input-group-btn">
                                                        <input class="chat_btn submit_btn" type="submit" value="Send">
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
                                    <p>Events</p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leagu_section3">
                                    <p class="text-right"><a href="#"  data-toggle="modal" data-target="#league_events">+ more</a></p>
                                </div>
                            </div>
                            <!-- Event section header end here -->

                            <!-- Event section content start here -->
                            <div class="row event_sect">
                                <!-- Event Each content start here -->
                                <div class="row event_section_sm">

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 leagu_section4_2 event_name">
                                        <p class="text-left"><a href="#" data-toggle="modal" data-target="#league_events_2">Events Details</a> </p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 leagu_section4_2">
                                        <p class="text-right"> 12/04/2016</p>
                                    </div>

                                </div>
                                <!-- Event Each content end here -->

                                <!-- Event Each content start here -->
                                <div class="row event_section_sm">

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 leagu_section4_2 event_name">
                                        <p class="text-left"><a href="#" data-toggle="modal" data-target="#league_events_2">Events Details</a> </p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 leagu_section4_2">
                                        <p class="text-right"> 12/04/2016</p>
                                    </div>

                                </div>
                                <!-- Event Each content end here -->

                                <!-- Event Each content start here -->
                                <div class="row event_section_sm">

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 leagu_section4_2 event_name">
                                        <p class="text-left"><a href="#" data-toggle="modal" data-target="#league_events_2">Events Details</a> </p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 leagu_section4_2">
                                        <p class="text-right"> 12/04/2016</p>
                                    </div>

                                </div>
                                <!-- Event Each content end here -->								

                                <!-- Event Each content start here -->
                                <div class="row event_section_sm">

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 leagu_section4_2 event_name">
                                        <p class="text-left"><a href="#" data-toggle="modal" data-target="#league_events_2">Events Details</a> </p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 leagu_section4_2">
                                        <p class="text-right"> 12/04/2016</p>
                                    </div>

                                </div>
                                <!-- Event Each content end here -->

                                <!-- Event Each content start here -->
                                <div class="row event_section_sm">

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 leagu_section4_2 event_name">
                                        <p class="text-left"><a href="#" data-toggle="modal" data-target="#league_events_2">Events Details</a> </p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 leagu_section4_2">
                                        <p class="text-right"> 12/04/2016</p>
                                    </div>

                                </div>
                                <!-- Event Each content end here -->

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
                            <p class="text-left">Achieve</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad_lft_rit0">
                        <div class="leagu_section_acv leagu_section3">
                            <p class="text-right"><a href="#" data-toggle="modal" data-target="#league_events2">+ more</a></p>
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
<!-- Global variable for join_topichat.js -->
<script>
    data = '<?php echo json_encode($this->session->user); ?>';
    group_id = '<?php echo $group_id; ?>';
    DEFAULT_PROFILE_IMAGE_PATH = '<?php echo DEFAULT_PROFILE_IMAGE_PATH; ?>';
    last_msg = '<?php echo (count($messages) > 0)?$messages[count($messages) - 1]['id']:0 ?>';
</script>
<script type="text/javascript" src="<?php echo USER_JS ?>/league/join_league.js"></script>
<!-- Lazy loading -->
<script>
    $('document').ready(function () {
        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
        var load = true;
        var in_progress = false;
        $('.chat_area2').scroll(function () {
            if(load && !in_progress)
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
                url : base_url+'league/load_more_msg/'+group_id,
                method: 'post',
                async: false,
                data : 'last_msg='+last_msg,
                success : function(more){
                    more = JSON.parse(more);
                    if(more.status)
                    {
                        $('.chat_area2').prepend(more.view);
                        last_msg = more.last_msg_id;
                        $(".chat_area2").animate({scrollTop: 200 }, 500);
                    }
                    else
                    {
                        load = false;
                        $('.chat_area2').prepend('<div class="text-center">No more messages to show</div>');
                        $(".chat_area2").animate({scrollTop: 0 }, 500);
                    }
                    in_progress = false;
                }
            });
            
        }
    });
</script>