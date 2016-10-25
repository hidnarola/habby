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
                    console.log('fail');
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

    // Add comment to the post
    $(".comment").on("keypress", function (e) {
        var key = e.keyCode;
        var t = $(this);
        // If the user has pressed enter
        if (key == 13) {
            var msg = $.trim($(this).val());
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
                    console.log('fail');
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

    // Lazy loading for post

    var page = 2;
    var load = true;
    $('#loadMore_post').click(function () {
        if (load)
        {
            loaddata();
        }
    });

    function loaddata()
    {
        // user id declared on profile page
        $.ajax({
            url: base_url+'user/home/load_user_post/'+user_id+'/'+page,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('#users_post').append("<div class='col-sm-12 alert alert-info text-center'>No more post found</div>");
                    $('#loadMore_post').remove();
                }
                else
                {
                    $('#users_post').append(data.view);
                }
            }
        });
        page++;
    }

    // Lazy loading for saved post loadMore_saved

    var save_page = 2;
    var save_load = true;
    $('#loadMore_saved').click(function () {
        if (save_load)
        {
            save_loaddata();
        }
    });

    function save_loaddata()
    {
        // user id declared on profile page
        $.ajax({
            url: base_url+'user/home/load_user_savepost/'+user_id+'/'+save_page,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    save_load = false;
                    $('#saved_post').append("<div class='col-sm-12 alert alert-info text-center'>No more saved post found</div>");
                    $('#loadMore_saved').remove();
                }
                else
                {
                    $('#saved_post').append(data.view);
                }
            }
        });
        save_page++;
    }
});