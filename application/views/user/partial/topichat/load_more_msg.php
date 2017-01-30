<?php
foreach ($messages as $message) {
    ?>
    <!-- chat_area_updated_list -->
    <div class="topichat_media_post chat_area_updated_list" data-chat_id="<?php echo $message['id']; ?>">
        <div class="chat_area_updated_list_top">
            <h4>Total x is Watching</h4>
            <div class="total_views_list">
                <ul>
                    <li>
                        <a href="javascript:void(0);">A</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">B</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">C</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="more_views">3 More</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="chat_area_updated_list_middle">
            <div class="chat_area_updated_list_middle_left">
                <div class="topichat_media_thumb">
                    <a href="javascript:void(0);">
                        <img class='user_chat_thumb' src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $message['user_image']; ?>" title='<?php echo $message['name'] ?>'>
                    </a>
                </div>
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
            <div class="chat_area_updated_list_middle_right">
                <div class="chat_area_updated_list_middle_head">
                    <h4><?php echo $message['message']; ?></h4>
                </div>
                <div class="chat_area_updated_list_middle_middle">
                    <?php
                        if ($message['media_type'] == "image") {
                            ?>
                            <div class="wdth_span media_wrapper img_media_wrapper">

                                <span class='imagePreview' style='background-image:url("<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>")' id='imagePreview_msg' data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $message['media'] ?>" data-type="image">
                                </span>
                            </div>
                            <?php
                        }
                        else if ($message['media_type'] == "video") {
                            ?>
                            <div class="media_wrapper" style="float: left">
                                <span class='imagePreview' id='imagePreview_msg' data-toggle="modal" data-target="#mediaModal" data-image="<?php echo $message['media'] ?>" data-type="video">
                                    <video controls="" src="<?php echo DEFAULT_CHAT_IMAGE_PATH . $message['media'] ?>" style="height:180px;"></video>
                                </span>
                            </div>
                            <?php
                        }
                        else if ($message['media_type'] == "files") {
                            ?>
                            <div class="wdth_span media_wrapper img_media_wrapper">
                                <span class='imagePreview file_download' style='background-image:url("<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>")' id='' data-file='<?php echo $message['media'] ?>'>
                                </span>
                                <a href="<?php echo base_url() . "user/download_file/" . $message['media'] ?>">
                                    <span class="filename">
                                        <?php echo $message['media'] ?>
                                    </span>
                                </a>
                            </div>
                            <?php
                        }
                        else if ($message['media_type'] == "links") {
                            $media = json_decode($message['media']);
                            if ($message['youtube_video'] != Null) {
                                ?>
                                <div class = "fileshare" >
                                    <?php
                                        if (isset($media->images[0]->url) && $media->images[0]->url != null) {
                                            ?>
                                            <div class="videoPreview" data-toggle="modal" data-target="#linkModal" data-id='<?php echo $message['id']; ?>'>
                                                <img class = "thumb" src = "<?php echo $media->images[0]->url ?>"></img>
                                                <div class="youtube-icon"><img src="<?php echo DEFAULT_IMAGE_PATH ?>youtube-icon.png"/></div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class = "fileshare">
                                    <div class = "">
                                        <?php
                                            if (isset($media->images[0]->url) && $media->images[0]->url != null) {
                                                ?>
                                                <div class = "large-3 columns">
                                                    <img class = "thumb" src = "<?php echo $media->images[0]->url ?>"></img>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        <div class = "large-9 column">
                                            <a href = "<?php echo (isset($media->url)) ? $media->url : ""; ?>" target="_blank"><?php echo (isset($media->title)) ? $media->title : ""; ?></a>
                                            <p><?php echo (isset($media->description)) ? $media->description : ""; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- //chat_area_updated_list -->
    <?php
}
?>