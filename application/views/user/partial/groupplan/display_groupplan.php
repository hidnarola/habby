<?php
if (isset($Group_plans) && !empty($Group_plans)) {
    foreach ($Group_plans as $Group_plan) {
//                            pr($Group_plan);
        ?>
        <!-- Group plan each section start here -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 grp_cl6">
            <div class="grp_pln_sec ">
                <div class="grp_pln_img_sec">
                    <a href="#" data-toggle="modal" data-target="#groupplan1post" data-title="<?php echo $Group_plan['name'] ?>" data-image="<?php echo DEFAULT_GROUPPLAN_IMAGE_PATH . $Group_plan['group_cover'] ?>" data-user="<?php echo $Group_plan['display_name'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Group_plan['user_image'] ?>">
                        <img src="<?php echo DEFAULT_GROUPPLAN_IMAGE_PATH . $Group_plan['group_cover'] ?> " class="img-responsive center-block">	
                    </a>
                </div>
                <div class="grp_pln_cont_sec">
                    <p class="soulmate_txt1"><?php echo $Group_plan['name'] ?> </p>
                    <p class="soulmate_txt2"><?php echo $Group_plan['slogan'] ?></p>
                    <p class="soulmate_txt3"><?php echo $Group_plan['introduction'] ?></p>
                    <p class="soulmate_txt4"><?php echo $Group_plan['display_name'] ?> Created Group</p>
                    <ul class="list-inline soulmate_ul">
                        <li><span><?php echo $Group_plan['Total_User'] . "/" . $Group_plan['user_limit'] ?> users</span></li>
                        <li><?php if ($Group_plan['Is_Requested'] == 0) { ?>

                                <a href="<?php echo base_url() . "groupplan/join/" . urlencode(base64_encode($Group_plan['id'])) ?>" class="pstbtn join">Join</a>
                            <?php } else {
                                ?>
                                <a href="javascript:void(0);" class="pstbtn requested">Requested</a>
                            <?php }
                            ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Group plan each section end here -->
        <?php
    }
}
?>