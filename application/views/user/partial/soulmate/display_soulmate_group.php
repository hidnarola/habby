<?php
if (isset($soulmate_groups) && !empty($soulmate_groups)) {
    $i = 1;
    foreach ($soulmate_groups as $soulmate_group) {
//                            pr($soulmate_group);
        ?>
        <!-- Group section start here -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php echo (($i % 2 != 0) ? "" : "col-sm-push-6") ?> pad_lft_rit0">
                <div class="soulmate_left_sec">
                    <p class="soulmate_txt1"><?php echo $soulmate_group['name'] ?> </p>
                    <p class="soulmate_txt2"><?php echo $soulmate_group['slogan'] ?></p>
                    <p class="soulmate_txt3"><?php echo $soulmate_group['introduction'] ?></p>
                    <p class="soulmate_txt4"><?php echo $soulmate_group['display_name'] ?> Created Group</p>
                    <ul class="list-inline soulmate_ul">
                        <li><?php echo date("d-m-Y", strtotime($soulmate_group['created_date'])); ?></li>
                        <li>
                            <?php if ($soulmate_group['Is_Requested'] != 0) { ?>
                                <a href="javascript:void(0);" class="pstbtn requested">Requested</a>
                            <?php } else if ($soulmate_group['is_joined'] == 1) {
                                ?>
                                <a href="<?php echo base_url() . "soulmate/details/" . urlencode(base64_encode($soulmate_group['id'])) ?>" class="pstbtn requested"><?php echo lang('Joined'); ?></a>
                                <?php
                            } else {
                                ?>
                                <a href="<?php echo base_url() . "soulmate/join/" . urlencode(base64_encode($soulmate_group['id'])) ?>" class="pstbtn smlt_btn"><?php echo lang('Join'); ?></a>
                            <?php }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php echo (($i % 2 != 0) ? "" : "col-sm-pull-6") ?> pad_lft_rit0">
                <div class="soulmate_right_sec">
                    <a href="#" data-toggle="modal" data-target="#soulmate1post" data-title="<?php echo $soulmate_group['name'] ?>" data-image="<?php echo DEFAULT_SOULMATE_IMAGE_PATH . $soulmate_group['group_cover'] ?>" data-user="<?php echo $soulmate_group['display_name'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $soulmate_group['user_image'] ?>">
                        <img src="<?php echo DEFAULT_SOULMATE_IMAGE_PATH . $soulmate_group['group_cover'] ?> " class="img-responsive center-block">	
                    </a>
                </div>
            </div>
        </div>
        <!-- Group section end here -->
        <?php
        $i++;
    }
}
?>