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
                        <!-- <li><?php echo ($topichat_group['person_limit'] == -1) ? $topichat_group['Total_User'] : "<span>" . $topichat_group['Total_User'] . "/" . $topichat_group['person_limit'] . "</span>"; ?><span> <?php echo lang('Users'); ?></span></li> -->
                        
                        <!-- Changes made by "ar" dated on 14th Feb -->
                        <li><?php echo $topichat_group['Total_User']  ?><span> <?php echo lang('Users')." ".lang('Joining'); ?></span></li>
                        
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
}?>