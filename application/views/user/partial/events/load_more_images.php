<?php
    foreach ($images as $image) {
        ?>
        <div class='col-sm-6 col-xs-12 load_more_event_image'>
            <img src='<?php echo DEFAULT_CHAT_IMAGE_PATH . $image; ?>' class="img-responsive"/>
        </div>
        <?php
    }
?>