$('document').ready(function () {
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

    $('.post_section').on('click', '.pstbtn', function () {
        var t = $(this);
        post_id = t.parents('.pst_full_sec').data('post_id');

        $.ajax({
            url: base_url + 'user/post/save_post/' + post_id,
            success: function (str) {
                if (str == 1)
                {
                    t.html('saved')
                }
                else
                {
                    t.html('save failed');
                }
            }
        });
    });

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

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        $('.image_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files)
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
                this.files = '';
                $('.message').html("Please select proper image");
                $('.message').show();
            }
        }
    });

    // Video uploading script
    $('#uploadVideo').on("change", function () {
        $('.message').html();
        $('.video_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
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
                $('.message').html("Please select proper image");
                $('.message').show();
            }
        }
    });

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

    $(".post_section").on('click', '.post_comment_reply', function () {
        var t = $(this);
        var post_comment_id = t.parents('.commnt_visit_sec').data('post_comment_id');
        $.ajax({
            url: base_url + 'user/post/display_comment_reply/' + post_comment_id,
            success: function (str) {
                t.parents('.cmn_dtl').find('.reply_dtl').html(str);
            }
        });
    });

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

    var page = 2;
    var load = true;
    $(window).scroll(function () {
        if (load)
        {
            if ($(window).scrollTop() == ($(document).height() - $(window).height())) {
                loaddata();
                setTimeout(function () {
                    $('.post_masonry_article').each(function () {
                        console.log($(this).data('post_id') + " having left " + $(this).offset().left);
                        if ($(this).offset().left > 250)
                        {
                            $(this).addClass('right');
                        }
                    });
                }, 1500);

//                       $('.post_section').masonry({
//                            itemSelector: '.pst_full_sec',
//                             columnWidth: 100
//                        });

            }
        }
    });

    function loaddata()
    {
        var uri = window.location.href;
        uri = uri.split('/');
        var myurl = '';
        if (typeof (uri[4]) != "undefined" && uri[4] == "challenge")
        {
            myurl = base_url + 'user/home/challenge/' + page;
        }
        else
        {
            myurl = base_url + 'user/home/smile_share/' + page;
        }
        $.ajax({
            url: myurl,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('.post_section').append("<div class='col-sm-12 alert alert-info text-center'>No more data found</div>");
                }
                else
                {
                    $('.post_section').append(data.view);
                    stButtons.locateElements();

// or if you want to be a bit defensive about whether the lib has been
// loaded or not:
                    if (window.stButtons) {
                        stButtons.locateElements();
                    } // Parse ShareThis markup
                }
            }
        });
        page++;
    }
});