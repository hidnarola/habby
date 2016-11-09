<?php
foreach ($messages as $message) {
    if ($message['user_id'] == $this->session->user['id']) {
        ?>

        <?php
        if (is_null($message['media'])) {
            ?>
            <div class="chat_2 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>" style="float:right;clear:right">
                <span class="wdth_span">
                    <span><?php echo $message['message']; ?></span>
                </span>
            </div>
            <?php
        } else {
            if ($message['media_type'] == "image") {
                ?>
                <div class="chat_2 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>" style="float:right;clear:right">
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
                </div>
                <?php
            } else if ($message['media_type'] == "video") {
                ?>
                <div class="chat_2 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>" style="float:right;clear:right">
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
                </div>
                <?php
            } else if ($message['media_type'] == "files") {
                ?>
                <div class="chat_2 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>" style="float:right;clear:right">
                    <div class="wdth_span media_wrapper">
                        <span class='imagePreview file_download' style='background-image:url("<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>")' id='' data-file='<?php echo $message['media'] ?>'></span><a href="<?php echo base_url() . "topichat/download_file/" . $message['media'] ?>"><span class="filename"><?php echo $message['media'] ?></span></a>
                    </div>
                </div>
                <?php
            } else if ($message['media_type'] == "links") {
                $media = json_decode($message['media']);
//                pr($media);
                ?>
                <div class = "share_2 clearfix" data-chat_id="<?php echo $message['id'] ?>">
                    <div class = "fileshare">
                        <div class = "row">
                            <?php
                            if (isset($media->thumbnail_url) && $media->thumbnail_url != null) {
                                ?>
                                <div class = "large-3 columns">
                                    <img class = "thumb" src = "<?php echo $media->thumbnail_url ?>"></img>
                                </div>
                                <?php
                            }
                            ?>
                            <div class = "large-9 column">
                                <a href = "<?php echo $media->original_url ?>"><?php echo $media->title ?></a>
                                <p><?php echo $media->description ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <?php
    } else {
        ?>

        <?php
        if (is_null($message['media'])) {
            ?>
            <div class="chat_1 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>"  style="float:left;clear:left">
                <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'> 
                <span class="wdth_span">
                    <span><?php echo $message['message']; ?></span>
                </span>
            </div>
            <?php
        } else {
            if ($message['media_type'] == "image") {
                ?>
                <div class="chat_1 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>"  style="float:left;clear:left">
                    <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'> 
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
                </div>
                <?php
            } else if ($message['media_type'] == "video") {
                ?>
                <div class="chat_1 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>"  style="float:left;clear:left">
                    <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'> 
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
                </div>
                <?php
            } else if ($message['media_type'] == "files") {
                ?>
                <div class="chat_1 clearfix topichat_media_post" data-chat_id="<?php echo $message['id'] ?>"  style="float:left;clear:left">
                    <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'> 
                    <div class="wdth_span media_wrapper img_media_wrapper">
                        <span class='imagePreview file_download' style='background-image:url("<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>")' id='' data-file='<?php echo $message['media'] ?>'></span><a href="<?php echo base_url() . "topichat/download_file/" . $message['media'] ?>"><span class="filename"><?php echo $message['media'] ?></span></a>
                    </div>
                </div>
                <?php
            } else if ($message['media_type'] == "links") {
                $media = json_decode($message['media']);
                ?>
                <div class = "share_1 clearfix" data-chat_id="<?php echo $message['id'] ?>">
                    <img class = "user_chat_thumb" src = "<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title="<?php echo $message['name'] ?>">
                    <div class = "fileshare">
                        <div class = "row">
                            <div class = "large-3 columns">
                                <img class = "thumb" src = "<?php echo $media->thumbnail_url ?>"></img>
                            </div>
                            <div class = "large-9 column">
                                <a href = "<?php echo $media->original_url ?>"><?php echo $media->title ?></a>
                                <p><?php echo $media->description ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}
?>