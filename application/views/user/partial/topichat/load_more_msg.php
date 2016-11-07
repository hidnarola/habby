<?php
foreach ($messages as $message) {
    if ($message['user_id'] == $this->session->user['id']) {
        ?>
        <div class="chat_2 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>" style="float:right;clear:right">
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
                    <div class="wdth_span media_wrapper">
                        <div id="field" class="topichat_media_rank">
                            <button type="button" id="add" class="add add_btn smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                            <span class="rank_rate"><?php echo $message['positive_rank'] - $message['negetive_rank']; ?></span>
                            <button type="button" id="sub" class="sub smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                        </div>

                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>")' id='imagePreview_msg'></span>
                    </div>
                    <?php
                } else if ($message['media_type'] == "video") {
                    ?>
                    <div style="float: right" class="media_wrapper">
                        <div id="field" class="topichat_media_rank">
                            <button type="button" id="add" class="add add_btn smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                            <span class="rank_rate"><?php echo $message['positive_rank'] - $message['negetive_rank']; ?></span>
                            <button type="button" id="sub" class="sub smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                        </div>
                        <span class='imagePreview' id='imagePreview_msg'>
                            <video controls="" src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>" style="height:180px;"></video>
                        </span>
                    </div>
                    <?php
                } else if ($message['media_type'] == "files") {
                    ?>
                    <div class="wdth_span media_wrapper">
                        <span class='imagePreview file_download' style='background-image:url("<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>")' id='' data-file='<?php echo $message['media'] ?>'></span><a href="<?php echo base_url() . "topichat/download_file/" . $message['media'] ?>"><span class="filename"><?php echo $message['media'] ?></span></a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    } else {
        ?>
        <div class="chat_1 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>"  style="float:left;clear:left">
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
                    <div class="wdth_span media_wrapper img_media_wrapper">

                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>")' id='imagePreview_msg'></span>
                        <div id="field" class="topichat_media_rank">
                            <button type="button" id="add" class="add add_btn smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                            <span class="rank_rate"><?php echo $message['positive_rank'] - $message['negetive_rank']; ?></span>
                            <button type="button" id="sub" class="sub smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                        </div>
                    </div>
                    <?php
                } else if ($message['media_type'] == "video") {
                    ?>
                    <div class="media_wrapper" style="float: left">

                        <span class='imagePreview' id='imagePreview_msg'>
                            <video controls="" src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>" style="height:180px;"></video>
                        </span>
                        <div id="field" class="topichat_media_rank">
                            <button type="button" id="add" class="add add_btn smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                            <span class="rank_rate"><?php echo $message['positive_rank'] - $message['negetive_rank']; ?></span>
                            <button type="button" id="sub" class="sub smlr_btn">
                                <img src="<?php
                                echo DEFAULT_IMAGE_PATH;
                                echo (($message['is_ranked'] && $message['rank']) ? 'challeng_arrow_ranked.png' : 'challeng_arrow.png');
                                ?>" class="rank_img_sec"/>
                            </button>
                        </div>
                    </div>
                    <?php
                } else if ($message['media_type'] == "files") {
                    ?>
                    <div class="wdth_span media_wrapper img_media_wrapper">
                        <span class='imagePreview file_download' style='background-image:url("<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>")' id='' data-file='<?php echo $message['media'] ?>'></span><a href="<?php echo base_url() . "topichat/download_file/" . $message['media'] ?>"><span class="filename"><?php echo $message['media'] ?></span></a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}
?>