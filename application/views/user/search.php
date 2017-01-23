<?php ?>
<div class="search-page-unique">
    <!--    <div class="col-sm-12">
            <form class="custom-search-form">
                <input type="text" placeholder="Search here..." class="form-control" required>
            </form>
        </div> -->
    <div class="col-sm-12">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#events" aria-controls="home" role="tab" data-toggle="tab">Events</a></li>
                <li role="presentation"><a href="#groups" aria-controls="profile" role="tab" data-toggle="tab">Topichat Groups</a></li>
                <li role="presentation"><a href="#c_group" aria-controls="settings" role="tab" data-toggle="tab">Challenge Group</a></li>
                <li role="presentation" id="load_post_tab"><a href="#ss_post" aria-controls="messages" role="tab" data-toggle="tab">Smile-share post</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="events">
                    <div class="panel-body event_container">
                        <?php
                        if (isset($event_posts) && !empty($event_posts)) {
                            $this->load->view('user/partial/events/display_events');
                        } else {
                            ?>
                            <div class="alert alert-info text-center">
                                <?php echo lang('No Events found.'); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                        if(isset($event_posts) && count($event_posts) >= $event_limit)
                        {
                            ?>
                            <div class = "row">
                                <div class = "container">
                                    <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                                        <a id="loadMore" class="event_loadmore" href = "javascript:;"><?php echo lang('Load More'); ?></a>
                                        <p class = "totop">
                                            <a href = "#top" style = "display: inline;"><img class = "img-responsive" src = "<?php echo DEFAULT_IMAGE_PATH . "upload.png" ?>"></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="groups">
                    <div class="panel-body">
                        <?php
                        if (isset($topichat_groups) && !empty($topichat_groups)) {
                            $cnt = count($topichat_groups);
                            foreach ($topichat_groups as $topichat_group) {
                                ?>
                                <!-- Topichat #1 each section start here -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 grp_cl6">
                                    <div class="grp_pln_sec ">

                                        <div class="grp_pln_img_sec">
                                            <a href="#" data-toggle="modal" data-target="#topichat1post" data-title="<?php echo $topichat_group['topic_name'] ?>" data-image="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat_group['group_cover'] ?>" data-user="<?php echo $topichat_group['display_name'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $topichat_group['user_image'] ?>">
                                                <div class="grp_plan_img">
                                                    <img src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat_group['group_cover'] ?> " class="img-responsive center-block" style="">
                                                </div>
                                            </a>
                                        </div>

                                        <div class="grp_pln_cont_sec">
                                            <p class="topichat_txt1"><?php echo $topichat_group['topic_name'] ?> </p>
                                            <?php echo ($topichat_group['notes'] != NULL) ? '<p class="topichat_txt2">' . $topichat_group['notes'] . '</p>' : ""; ?>
                                            <ul class="list-inline soulmate_ul">
                                                <li><?php echo ($topichat_group['person_limit'] == -1) ? $topichat_group['Total_User'] : "<span>" . $topichat_group['Total_User'] . "/" . $topichat_group['person_limit'] . "</span>"; ?><span> <?php echo lang('Users'); ?></span></li>
                                                <li>
                                                    <?php
                                                    if (isset($topichat_group['is_joined']) && $topichat_group['is_joined']) {
                                                        ?>
                                                        <a href="<?php echo base_url() . "topichat/details/" . urlencode(base64_encode($topichat_group['id'])) ?>" class="pstbtn"><?php echo lang('Joined'); ?></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?php echo base_url() . "topichat/join/" . urlencode(base64_encode($topichat_group['id'])) ?>" class="pstbtn"><?php echo lang('Join'); ?></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </li>
                                                            <!--<li><button class="join pstbtn" id="<?php echo md5($topichat_group['id']); ?>">Join</button></li>-->
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <!-- Topichat #1 each section start here -->
                                <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-info text-center">
                                <?php echo lang('No Topichat found.'); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="c_group">
                    <div class="panel-body">
                        <?php 
                            if(isset($Challenges) && !empty($Challenges))
                            {
                                $this->load->view('user/partial/challenge/display_challenges', $Challenges); 
                            }
                            else 
                            {
                                ?>
                                <div class="alert alert-info text-center">
                                    <?php echo lang('No Challenge found.'); ?>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="ss_post">
                    <div class="panel-body post_section">
                        <?php 
                            if(isset($posts) && !empty($posts))
                            {
                                $this->load->view('user/partial/load_post_data', $posts); 
                            }
                            else 
                            {
                                ?>
                                <div class="alert alert-info text-center">
                                    <?php echo lang('No post available.'); ?>
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

<!-- Rank modal -->
<div id="rank_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Rank modal over -->

<!-- Share this scripts -->
<script type="text/javascript" src="https://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
    stLight.options({publisher: "9d14d1f6-a827-4af0-87fe-f41eaa3ce220", doNotHash: false, doNotCopy: false, hashAddressBar: false});
    var search_keyword = '<?php echo $search_keyword; ?>';
</script>
<!-- Share this scripts over -->
<script type="text/javascript" src="<?php echo USER_JS; ?>search/search.js"></script>
<script type="text/javascript" src="<?php echo USER_JS; ?>challenge/challenge_popup.js"></script>