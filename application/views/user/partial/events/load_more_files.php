<?php
foreach ($files as $file) {
    ?>
    <div class='col-sm-4 col-xs-12 load_more_event_file'>
        <a class="" href="<?php echo base_url() . "user/download_file/" . $file ?>" target="_blank">
            <img src="<?php echo DEFAULT_IMAGE_PATH . "filedownload.jpg" ?>" class="img-responsive" />
            <span class="event_file_name"><?php echo $file ?></span>
        </a>
    </div>
    <?php
}
?>