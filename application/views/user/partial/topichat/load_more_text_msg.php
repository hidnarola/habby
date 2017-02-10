<?php
foreach ($text_messages as $msg) {
    if ($msg['user_id'] == $this->session->user['id']) {
        // Display message on left side
        ?>
        <div class="messageHer">
            <!--<a href="javascript:void(0);">
                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $msg['user_image']; ?>" title='<?php echo $msg['name'] ?>'>
            </a> -->
            <span><?php echo $msg['message']; ?></span>
            <div class="clearFix"></div>
        </div>
        <?php
    } else {
        // Display message on right side
        ?>
        <div class="messageMe">
            <a href="<?php echo base_url() . 'user_profile/' . $msg['user_id']; ?>" class="messageMe-img">
                <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $msg['user_image']; ?>" title='<?php echo $msg['name'] ?>'>
            </a>
            <span><?php echo $msg['message']; ?></span>
            <div class="clearFix"></div>
        </div>
        <?php
    }
}
?>