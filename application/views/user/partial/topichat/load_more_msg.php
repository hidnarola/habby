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

                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>")' id='imagePreview_msg' data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $message['media'] ?>" data-type="image"></span>
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
                        <span class='imagePreview' id='imagePreview_msg' data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $message['media'] ?>" data-type="video">
                            <video controls="" src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>" style="height:180px;"></video>
                        </span>
                    </div>
                </div>
                <?php
            } else if ($message['media_type'] == "files") {
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
                        <span class='imagePreview file_download' style='background-image:url("<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>")' id='' data-file='<?php echo $message['media'] ?>'>
                        </span>
                        <a href="<?php echo base_url() . "user/download_file/" . $message['media'] ?>"><span class="filename"><?php echo $message['media'] ?></span></a>
                    </div>
                </div>
                <?php
            } else if ($message['media_type'] == "links") {
                ?>
                <div class = "share_2 clearfix topichat_media_post <?php echo ($message['youtube_video'] != Null) ? "youtube_video" : "" ?>" data-chat_id="<?php echo $message['id'] ?>">
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
                    <?php
                    if ($message['youtube_video'] != Null) {
                        ?>
                        <div class = "fileshare">
                            <?php
                            if (isset($media->thumbnail_url) && $media->thumbnail_url != null) {
                                ?>
                                <div class="videoPreview" data-toggle="modal" data-target="#mediaModal" data-type="links" data-id='<?php echo $message['id']; ?>'>
                                    <img class = "thumb" src = "<?php echo $media->thumbnail_url ?>"></img>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        $media = json_decode($message['media']);
                        ?>
                        <div class = "fileshare">
                            <div class = "">
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
                                    <a href = "<?php echo (isset($media->original_url)) ? $media->original_url : ""; ?>" target="_blank"><?php echo (isset($media->title)) ? $media->title : ""; ?></a>
                                    <p><?php echo (isset($media->description)) ? $media->description : ""; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
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

                        <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>")' id='imagePreview_msg' data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $message['media'] ?>" data-type="image"></span>
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

                        <span class='imagePreview' id='imagePreview_msg' data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $message['media'] ?>" data-type="video">
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
                        <span class='imagePreview file_download' style='background-image:url("<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>")' id='' data-file='<?php echo $message['media'] ?>'></span><a href="<?php echo base_url() . "user/download_file/" . $message['media'] ?>"><span class="filename"><?php echo $message['media'] ?></span></a>
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
            } else if ($message['media_type'] == "links") {
                $media = json_decode($message['media']);
                ?>
                <div class = "share_1 clearfix topichat_media_post <?php echo ($message['youtube_video'] != Null) ? "youtube_video" : "" ?>" data-chat_id="<?php echo $message['id'] ?>">
                    <img class = "user_chat_thumb" src = "<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title="<?php echo $message['name'] ?>">
                    <?php
                    if ($message['youtube_video'] != Null) {
                        ?>
                        <div class = "fileshare" >
                            <?php
                            if (isset($media->thumbnail_url) && $media->thumbnail_url != null) {
                                ?>
                                <div class="videoPreview" data-toggle="modal" data-target="#mediaModal" data-type="links" data-id='<?php echo $message['id']; ?>'>
                                    <img class = "thumb" src = "<?php echo $media->thumbnail_url ?>"></img>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class = "fileshare">
                            <div class = "">
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
                                    <a href = "<?php echo (isset($media->original_url)) ? $media->original_url : ""; ?>" target="_blank"><?php echo (isset($media->title)) ? $media->title : ""; ?></a>
                                    <p><?php echo (isset($media->description)) ? $media->description : ""; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
            }
        }
    }
}
?>