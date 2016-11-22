$('document').ready(function () {

    // Like functionality on post
    $('.post_section').on('click', '.user_like', function () {
        var t = $(this);
        post_id = t.parents('.pst_full_sec').data('post_id');
        $.ajax({
            url: base_url + 'user/post/add_like/' + post_id,
            success: function (str) {
                var like = parseInt(t.find('.like_cnt').html());
                if (str == 1)
                {
                    // User liked images
                    t.find('.like_cnt').html((like + 1));
                    t.find('.like_img').attr('src', base_url + 'public/front/img/liked_img.png');
                }
                else if (str == -1)
                {
                    // User disliked the post
                    t.find('.like_cnt').html((like - 1));
                    t.find('.like_img').attr('src', base_url + 'public/front/img/like_img.png');
                }
                else
                {
                    // like failed
//                    console.log('fail');
                }
            }
        });
    });

    // Save post to user's IP page
    $('.post_section').on('click', '.pstbtn', function () {
        var t = $(this);
        post_id = t.parents('.pst_full_sec').data('post_id');
        $.ajax({
            url: base_url + 'user/post/save_post/' + post_id,
            success: function (str) {
                if (str == 1)
                {
                    t.html(saved)
                }
                else
                {
                    t.html(save_failed);
                }
            }
        });
    });

    // Give coin to user post
    $('.post_section').on('click', '.user_coin', function () {
        var t = $(this);
        post_id = t.parents('.pst_full_sec').data('post_id');
        $.ajax({
            url: base_url + 'user/post/add_coin/' + post_id,
            success: function (str) {
                var coin = parseInt(t.find('.coin_cnt').html());
                if (str == 1)
                {
                    t.find('.coin_cnt').html((coin + 1));
                    t.find('.img-coin').attr('src', base_url + 'public/front/img/coined_icon.png');
                }
                else if (str == 2)
                {
                    alert(cannot_take_back);
                    // t.find('.coin_cnt').html((coin - 1));
                    t.find('.img-coin').attr('src', base_url + 'public/front/img/coined_icon.png');
                }
                else if (str == 3)
                {
                    alert(enough_coin);
                }
                else
                {
//                    console.log('fail');
                }
            }
        });
    });

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        $('.image_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html(no_selected_file);
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                if (/^image/.test(files[key].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        // $('#imagePreview').addClass('imagePreview');
                        $('.image_wrapper').show();
                        $('.message').hide();
                        $('.image_wrapper').append("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                        $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                        ++i;
                    }
                }
                else
                {
                    $('.message').html(proper_image);
                    $('.message').show();
//                    this.files = '';
                }
            }
        }
    });

    // Video uploading script
    $('#uploadVideo').on("change", function () {
        $('.message').html();
        $('.video_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html(no_selected_file);
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files)
        {
            if (/^video/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.video_wrapper').show();
                    $('.message').hide();
                    $('.video_wrapper').append("<img class='videoPreview" + i + "' id='imagePreview' src='" + $('.video_wrapper').data('default_image') + "'/>");
//                    $('.videoPreview'+i).css("background-image", ;
                    ++i;
                }
            }
            else
            {
                $('.message').html(proper_video);
                $('.message').show();
            }
        }
    });

    // Add comment to the post
    $(".post_section").on("keypress", ".comment", function (e) {
        var key = e.keyCode;
        var t = $(this);
        // If the user has pressed enter
        if (key == 13) {
            var msg = $.trim($(this).val());
            if (msg != "")
            {
                var post_id = $(this).parents('.pst_full_sec').data('post_id');
                $.ajax({
                    url: 'user/post/add_comment/' + post_id,
                    method: 'post',
                    data: 'msg=' + msg,
                    success: function (str) {
                        if (str != 0)
                        {
                            t.after(str);
                            t.parent().children('.no_comment').remove();
                            var cmt_cnt = t.parents('.post_leftsec').find('.comment_cnt');
                            console.log(cmt_cnt);
                            cmt_cnt.html(parseInt(cmt_cnt.html()) + 1);
                        }
                    }
                });
                $(this).val('');
            }

            return false;
        }
    });

    // Add like to the post comment
    $('.post_section').on('click', '.comment_like_cnt', function () {
        var t = $(this);
        var post_comment_id = t.parents('.commnt_visit_sec').data('post_comment_id');
        $.ajax({
            url: base_url + 'user/post/add_postcomment_like/' + post_comment_id,
            success: function (str) {
                var like = parseInt(t.find('.post_comment_like').html());
                if (str == 1)
                {
                    // User liked images
                    t.find('.post_comment_like').html((like + 1));
                    t.find('.post_comment_text').html('Unlike');
                }
                else if (str == -1)
                {
                    // User disliked the post
                    t.find('.post_comment_like').html((like - 1));
                    t.find('.post_comment_text').html('Like');
                }
                else
                {
                    // like failed
//                    console.log('fail');
                }
            }
        });
    });

    // Display comment reply
    $(".post_section").on('click', '.post_comment_reply', function () {
        var $t = $(this).parents('.cmn_dtl').find('.reply_dtl');
        if ($t.is(':visible')) {
            $t.slideUp();
            // Other stuff to do on slideUp
        } else {
            var t = $(this);
            var post_comment_id = t.parents('.commnt_visit_sec').data('post_comment_id');
            $.ajax({
                url: base_url + 'user/post/display_comment_reply/' + post_comment_id,
                success: function (str) {
                    t.parents('.cmn_dtl').find('.reply_dtl').html(str);
                    $t.slideDown();
                }
            });
        }
    });

    // Add reply for the post comment
    $('.post_section').on('keypress', '.comment_reply', function (e) {
        var key = e.keyCode;
        // If the user has pressed enter
        if (key == 13) {
            var t = $(this);
            var msg = $.trim($(this).val());
            if (msg != "")
            {
                var post_comment_id = $(this).parents('.commnt_visit_sec').data('post_comment_id');
                $.ajax({
                    url: 'user/post/add_comment_reply/' + post_comment_id,
                    method: 'post',
                    data: 'msg=' + msg,
                    success: function (str) {
                        if (str != 0)
                        {
                            t.before(str);
                            var reply = t.parents('.commnt_visit_sec').find('.comment_reply_cnt');
                            reply.html(parseInt(reply.html()) + 1);
                        }
                    }
                });
                $(this).val('');
            }
            return false;
        }
    });

    $('.post_section').on('click', '.share-link', function () {
        $(this).popover({
            html: true,
            content: function () {
                return $(this).siblings("#popover-content").html();
            }
        });
    });

    // Set post in two column format
    setTimeout(function () {
        $('.post_masonry_article').each(function () {
            if ($(this).offset().left > 250)
            {
                $(this).addClass('right');
            }
        });
    }, 1500);
});