<?php
foreach ($messages as $message) {
    if ($message['user_id'] == $this->session->user['id']) {
        ?>
        <p class="chat_2 clearfix">
            <span class="wdth_span">
                <?php
                    if(is_null($message['media']))
                    {
                        ?>
                        <span><?php echo $message['message']; ?></span>
                        <?php
                    }
                    else
                    {
                        ?>
                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH.$message['media'] ?>")' id='imagePreview_msg'></span>
                        <?php
                    }
                ?>
            </span>
        </p>
        <?php
    } else {
        ?>
        <p class="chat_1 clearfix">
            <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'> 
            <span class="wdth_span">
                <?php
                    if(is_null($message['media']))
                    {
                        ?>
                        <span><?php echo $message['message']; ?></span>
                        <?php
                    }
                    else
                    {
                        ?>
                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH.$message['media'] ?>")' id='imagePreview_msg'></span>
                        <?php
                    }
                ?>
            </span>
        </p>
        <?php
    }
}
?>