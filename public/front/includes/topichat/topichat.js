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
            url: base_url + 'topichat/load_more_msg/' + group_id,
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
                } else
                {
                    load = false;
                    $('.chat_area2').prepend('<div class="text-center">No more messages to show</div>');
                    $(".chat_area2").animate({scrollTop: 0}, 500);
                }
                in_progress = false;
            }
        });
    }

    $('#emogis').popover({
        html: true,
        content: function () {
            return $("#popover-content").html();
        }
    });

    // Add rank to the post
    $('.topichat_msg_sec').on('click', '.add', function () {
        var t = $(this);
        var chat_id = t.parents('.topichat_media_post').data('chat_id');
        $.ajax({
            url: base_url + 'user/topichat/add_rank_to_chat_post/' + chat_id,
            success: function (str) {
                if (str == 1)
                {
                    t.find('img').attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    t.siblings('.rank_rate').html(parseInt(t.siblings('.rank_rate').html()) + 1);
                } else if (str == 2)
                {
                    t.find('img').attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    t.siblings('.sub').find('img').attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow.png');
                    t.siblings('.rank_rate').html(parseInt(t.siblings('.rank_rate').html()) + 2);
                }
            }
        });
    });

    // Subtract rank to the post
    $('.topichat_msg_sec').on('click', '.sub', function () {
        var t = $(this);
        var chat_id = t.parents('.topichat_media_post').data('chat_id');
        $.ajax({
            url: base_url + 'user/topichat/subtract_rank_from_chat_post/' + chat_id,
            success: function (str) {
                if (str == -1)
                {
                    t.find('img').attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    t.siblings('.rank_rate').html(parseInt(t.siblings('.rank_rate').html()) - 1);
                } else if (str == -2)
                {
                    t.find('img').attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    t.siblings('.add').find('img').attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow.png');
                    t.siblings('.rank_rate').html(parseInt(t.siblings('.rank_rate').html()) - 2);
                }
            }
        });
    });

    $('input:radio[name="person_limit"]').change(function () {
        if ($(this).is(":checked") && $(this).val() == 'Yes')
            $("#txt_No_of_person").removeAttr("disabled");
        else
            $("#txt_No_of_person").attr("disabled", "disabled");
    });

    // Image uploading script
    $("body").on("change", "#uploadFile", function ()
    {
        console.log('on change fired');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                $('.message').hide();
                $('.new_image_wrapper').show();
                $("#imagePreview").css("background-image", "url(" + this.result + ")");
            }
        } else {
            $('.message').html("Please select proper image");
            $('.message').show();
        }
    });

//    $(".video_wrapper").animate({scrollTop: $('.video_wrapper').prop("scrollHeight")}, 1000);
//    var load = true;
//    var in_progress = false;
//    $('.video_wrapper').scroll(function () {
//        if (load && !in_progress)
//        {
//            if ($('.video_wrapper').scrollTop() == 0) {
//                loadvideo();
//                in_process = true;
//            }
//        }
//    });
//
//    function loadvideo()
//    {
//        $.ajax({
//            url: base_url + 'topichat/load_more_video/' + group_id,
//            method: 'post',
//            async: false,
//            data: 'last_video=' + last_video,
//            success: function (more) {
//                console.log(more);
//                return false;
//                more = JSON.parse(more);
//                if (more.status)
//                {
//                    $('.chat_area2').prepend(more.view);
//                    last_msg = more.last_msg_id;
//                    $(".chat_area2").animate({scrollTop: 200}, 500);
//                } else
//                {
//                    load = false;
//                    $('.chat_area2').prepend('<div class="text-center">No more messages to show</div>');
//                    $(".chat_area2").animate({scrollTop: 0}, 500);
//                }
//                in_progress = false;
//            }
//        });
//    }
});