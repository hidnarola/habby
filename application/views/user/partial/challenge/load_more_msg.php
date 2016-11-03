<?php
foreach ($messages as $message) {
    if ($message['user_id'] == $this->session->user['id']) {
        ?>
        <div class="chat_2 clearfix">
            <?php
            if (is_null($message['media'])) {
                ?>
                <span class="wdth_span">
                    <span><?php echo $message['message']; ?></span>
                </span>
                <?php
            } else {
                if ($message['media_type'] == "image") {
                    ?>
                    <span class="wdth_span">
                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>")' id='imagePreview_msg'></span>
                    </span>
                    <?php
                } else if ($message['media_type'] == "video") {
                    ?>
                    <span style="float: right">
                        <span class='imagePreview' id='imagePreview_msg'>
                            <video controls="" src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>" style="height:250px;"></video>
                        </span>
                    </span>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    } else {
        ?>
        <div class="chat_1 clearfix">
            <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'> 
            <?php
            if (is_null($message['media'])) {
                ?>
                <span class="wdth_span">
                    <span><?php echo $message['message']; ?></span>
                </span>
                <?php
            } else {
                if ($message['media_type'] == "image") {
                    ?>
                    <span class="wdth_span">
                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>")' id='imagePreview_msg'></span>
                    </span>
                    <?php
                } else if ($message['media_type'] == "video") {
                    ?>
                    <span>
                        <span class='imagePreview' id='imagePreview_msg'>
                            <video controls="" src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>" style="height:250px;"></video>
                        </span>
                    </span>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}
?>