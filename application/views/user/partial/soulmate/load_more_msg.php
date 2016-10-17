<?php
foreach ($messages as $message) {
    if ($message['user_id'] == $this->session->user['id']) {
        ?>
        <p class="chat_2 clearfix">
            <span class="wdth_span">
                <span><?php echo $message['message']; ?></span>
            </span>
        </p>
        <?php
    } else {
        ?>
        <p class="chat_1 clearfix">
            <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'> 
            <span class="wdth_span">
                <span><?php echo $message['message']; ?></span>
            </span>
        </p>
        <?php
    }
}
?>