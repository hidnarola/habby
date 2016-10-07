<?php
   foreach ($reply as $row) {
        ?>
        <div class="reply_wrapper">
            <div>
                <?php echo $row['name']; ?> : <?php echo $row['comment'] ?>
            </div>
        </div>
        <?php
    }
?>
<textarea id="comment_reply" class="comment_reply" placeholder="give your reply" rows="1"></textarea>