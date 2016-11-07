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
//                    console.log(more.view);
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

    var load_video = true;
    var in_progress_video = false;
    $('.video_wrapper').scroll(function () {
        if (load_video && !in_progress_video)
        {
//            if ($('.video_wrapper').scrollTop() == $('.video_wrapper').height) {
//            if ($('.video_wrapper').scrollTop() == ($(document).height() - $('.video_wrapper').height())) {
            if ($('.video_wrapper').scrollTop() + $('.video_wrapper').innerHeight() >= $('.video_wrapper')[0].scrollHeight) {
                if (!in_progress_video)
                {
                    loadvideo();
                    in_process_video = false;
                }
            }
        }
    });

    function loadvideo()
    {
        $.ajax({
            url: base_url + 'topichat/load_more_video/' + group_id,
            method: 'post',
            async: false,
            data: 'last_video=' + last_video,
            success: function (more) {
                console.log(more);
                more = JSON.parse(more);
                if (more.status)
                {
                    $('.video_wrapper').append(more.view);
                    last_video = more.last_video_id;
                }
                else
                {
                    load_video = false;
                }
                in_progress_video = false;
            }
        });
    }
    
    var load_image = true;
    var in_progress_image = false;
    $('.image_wrapper').scroll(function () {
        if (load_image && !in_progress_image)
        {
            if ($('.image_wrapper').scrollTop() + $('.image_wrapper').innerHeight() >= $('.image_wrapper')[0].scrollHeight) {
                if (!in_progress_video)
                {
                    loadimage();
                    in_process_image = false;
                }
            }
        }
    });

    function loadimage()
    {
        $.ajax({
            url: base_url + 'topichat/load_more_image/' + group_id,
            method: 'post',
            async: false,
            data: 'last_image=' + last_image,
            success: function (more) {
                more = JSON.parse(more);
                if (more.status)
                {
                    $('.image_wrapper').append(more.view);
                    last_image = more.last_image_id;
                }
                else
                {
                    load_image = false;
                }
                in_progress_image = false;
            }
        });
    }
});