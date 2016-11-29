$('document').ready(function () {

    // give coin to challenge post
    $('.post_masonry_section,#rank_modal').on('click', '.user_coin', function () {
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
                } else if (str == 2)
                {
                    alert(cannot_take_back);
                    // t.find('.coin_cnt').html((coin - 1));
                    t.find('.img-coin').attr('src', base_url + 'public/front/img/coined_icon.png');
                } else if (str == 3)
                {
                    alert(enough_coin);
                } else
                {
//                    console.log('fail');
                }
            }
        });
    });

    // Like functionality on post
    $('.post_masonry_section,#rank_modal').on('click', '.user_like', function () {
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
                } else if (str == -1)
                {
                    // User disliked the post
                    t.find('.like_cnt').html((like - 1));
                    t.find('.like_img').attr('src', base_url + 'public/front/img/like_img.png');
                } else
                {
                    // like failed
//                    console.log('fail');
                }
            }
        });
    });

    // Open comment part when user click on comment
    $('.post_masonry_section,#rank_modal').on('click', '.cmnt_winner', function () {
        $(this).parents('.rank_lg_sec').find('.winner-comnt').slideToggle(1000);
    });

    // Add comment to the post
    $(".post_masonry_section,#rank_modal").on("keypress", ".comment", function (e) {
        var key = e.keyCode;
        var t = $(this);
        // If the user has pressed enter
        if (key == 13) {
            var msg = $.trim($(this).val());
            if (msg != '')
            {
                var post_id = $(this).parents('.rank_lg_sec').data('post_id');
                $.ajax({
                    url: 'user/challenge/add_comment/' + post_id,
                    method: 'post',
                    data: {
                        msg: msg
                    },
                    success: function (str) {
                        if (str != 0)
                        {
                            t.after(str);
                            t.parent().children('.no_comment').remove();
                            var cmt_cnt = t.parents('.rank_lg_sec').find('.comment_cnt');
//                            console.log(cmt_cnt);
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
    $('.post_masonry_section,#rank_modal').on('click', '.comment_like_cnt', function () {
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
                } else if (str == -1)
                {
                    // User disliked the post
                    t.find('.post_comment_like').html((like - 1));
                    t.find('.post_comment_text').html('Like');
                } else
                {
                    // like failed
//                    console.log('fail');
                }
            }
        });
    });

    // Display comment reply
    $(".post_masonry_section,#rank_modal").on('click', '.post_reply', function () {

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
    $('.post_masonry_section,#rank_modal').on('keypress', '.comment_reply', function (e) {
        var key = e.keyCode;
        // If the user has pressed enter
        if (key == 13) {
            var t = $(this);
            var msg = $.trim($(this).val());
            if (msg != '')
            {
                var post_comment_id = $(this).parents('.commnt_visit_sec').data('post_comment_id');
                $.ajax({
                    url: 'user/challenge/add_comment_reply/' + post_comment_id,
                    method: 'post',
                    data: {
                        msg: msg
                    },
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

    // Open rank modal and display rank post in it
    $('.post_masonry_section').on('click', '.others_rank', function () {
        var t = $(this);
        var challenge_id = t.parents('.rank_lg_sec').data('challenge_id');

        $.ajax({
            url: 'user/challenge/get_top_rank_post/' + challenge_id,
            success: function (str) {
                $('#rank_modal').find('.modal-body').html(str);
            }
        });
    });

    var page = 2;
    var load = true;
    $(window).scroll(function () {
        if (load)
        {
            if ($(window).scrollTop() == ($(document).height() - $(window).height())) {
                loaddata();
            }
        }
    });

    function loaddata()
    {
        $.ajax({
            url: base_url + 'user/home/challenge/' + page,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('.post_masonry_section').append("<div class='col-sm-12 alert alert-info text-center'>" + no_groups + "</div>");
                } else
                {
                    $('.grid').append(data.view).masonry('reloadItems');
                    setTimeout(function(){
                        $('.grid').masonry();
                        stButtons.locateElements();
                        if (window.stButtons) {
                            stButtons.locateElements();
                        }
                    },1000);
                }
            }
        });
        page++;
    }

    $('.grid').masonry({
        itemSelector: '.grid-item',
        percentPosition: true
    });

    // Share link popover
    $('.post_section').on('click', '.share-link', function () {
        $popover = $(this).siblings('.popover-content-custom');
        if ($popover.hasClass('hide'))
        {
            $popover.removeClass('hide').addClass('show');
        }
        else
        {
            $popover.removeClass('show').addClass('hide');
        }
    });
});