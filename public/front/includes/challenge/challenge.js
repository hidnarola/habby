$('document').ready(function () {
    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
    var load = true;
    var in_progress = false;
    $('.chat_area2').scroll(function () {
        if (load && !in_progress)
        {
            if ($('.chat_area2').scrollTop() == 0) {
                loaddata();
                in_process = true;
            }
        }
    });
    function loaddata()
    {
        $.ajax({
            url: base_url + 'challenge/load_more_msg/' + group_id,
            method: 'post',
            async: false,
            data: 'last_msg=' + last_msg,
            success: function (more) {
                more = JSON.parse(more);
                if (more.status)
                {
                    $('.chat_area2').prepend(more.view);
                    last_msg = more.last_msg_id;
                    $(".chat_area2").animate({scrollTop: 200}, 500);
                }
                else
                {
                    load = false;
                    $('.chat_area2').prepend('<div class="text-center">No more messages to show</div>');
                    $(".chat_area2").animate({scrollTop: 0}, 500);
                }
                in_progress = false;
            }
        });
    }

// upload challange post
    var selected = false;
    $('.upload_image').change(function () {
        selected = true;
        $(".type").val("image");
        $('.media_name').html($(this).val());
        $('.upload_btn').removeClass('make_disabled');
    });
    $('.upload_video').change(function () {
        selected = true;
        $(".type").val("video");
        $('.media_name').html($(this).val());
        $('.upload_btn').removeClass('make_disabled');
    });
    $("#media_form").submit(function () {
        if (selected)
        {
            return true;
        }
        return false;
    });
    // give coin to challenge post
    $('.chlng2_past_rank_sec').on('click', '.user_coin', function () {
        var t = $(this);
        post_id = t.parents('.rank_lg_sec').data('post_id');
        $.ajax({
            url: base_url + 'user/challenge/add_coin/' + post_id,
            success: function (str) {
                var coin = parseInt(t.find('.coin_cnt').html());
                if (str == 1)
                {
                    t.find('.coin_cnt').html((coin + 1));
                    t.find('.img-coin').attr('src', base_url + 'public/front/img/coined_icon.png');
                }
                else if (str == 2)
                {
                    alert("You can't take back given coin");
                    // t.find('.coin_cnt').html((coin - 1));
                    t.find('.img-coin').attr('src', base_url + 'public/front/img/coined_icon.png');
                }
                else if (str == 3)
                {
                    alert("You don't have enough coin to give");
                }
                else
                {
                    console.log('fail');
                }
            }
        });
    });
    // Like functionality on post
    $('.chlng2_past_rank_sec').on('click', '.user_like', function () {
        var t = $(this);
        post_id = t.parents('.rank_lg_sec').data('post_id');
        $.ajax({
            url: base_url + 'user/challenge/add_like/' + post_id,
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
                    console.log('fail');
                }
            }
        });
    });
    // Open comment part when user click on comment
    $('.chlng2_past_rank_sec').on('click', '.cmnt_winner', function () {
        $(this).parents('.rank_lg_sec').find('.winner-comnt').slideToggle(1000);
    });
    // Add comment to the post
    $(".comment").on("keypress", function (e) {
        var key = e.keyCode;
        var t = $(this);
        // If the user has pressed enter
        if (key == 13) {
            var msg = $.trim($(this).val());
            var post_id = $(this).parents('.rank_lg_sec').data('post_id');
            $.ajax({
                url: 'user/challenge/add_comment/' + post_id,
                method: 'post',
                data: 'msg=' + msg,
                success: function (str) {
                    if (str != 0)
                    {
                        t.after(str);
                        t.parent().children('.no_comment').remove();
                        var cmt_cnt = t.parents('.rank_lg_sec').find('.comment_cnt');
                        console.log(cmt_cnt);
                        cmt_cnt.html(parseInt(cmt_cnt.html()) + 1);
                    }
                }
            });
            $(this).val('');
            return false;
        }
    });
    // Add like to the post comment
    $('.chlng2_past_rank_sec').on('click', '.comment_like_cnt', function () {
        var t = $(this);
        var post_comment_id = t.parents('.commnt_visit_sec').data('post_comment_id');
        $.ajax({
            url: base_url + 'user/challenge/add_postcomment_like/' + post_comment_id,
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
                    console.log('fail');
                }
            }
        });
    });

    // Display comment reply
    $(".chlng2_past_rank_sec").on('click', '.post_reply', function () {

        var $t = $(this).parents('.cmn_dtl').find('.reply_dtl');

        if ($t.is(':visible')) {
            $t.slideUp();
            // Other stuff to do on slideUp
        } else {
            // Other stuff to down on slideDown
            var t = $(this);
            var post_comment_id = t.parents('.commnt_visit_sec').data('post_comment_id');
            $.ajax({
                url: base_url + 'user/challenge/display_comment_reply/' + post_comment_id,
                success: function (str) {
                    t.parents('.cmn_dtl').find('.reply_dtl').html(str);
                    $t.slideDown();
                }
            });
        }
    });

    // Add reply for the post comment
    $('.chlng2_past_rank_sec').on('keypress', '.comment_reply', function (e) {
        var key = e.keyCode;
        // If the user has pressed enter
        if (key == 13) {
            var t = $(this);
            var msg = $.trim($(this).val());
            var post_comment_id = $(this).parents('.commnt_visit_sec').data('post_comment_id');
            $.ajax({
                url: 'user/challenge/add_comment_reply/' + post_comment_id,
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
            return false;
        }
    });


});
