var Server;
data = JSON.parse(data);

function send(text) {
    var msg = {
        message: text,
        type: 'event_msg',
        group_id: group_id
    }
    Server.send('message', JSON.stringify(msg));
}

$(document).ready(function () {
    Server = new FancyWebSocket('ws://192.168.1.186:9300');
//    Server = new FancyWebSocket('ws://127.0.0.1:9300');
    // Send message to server
    $('#message_div').keypress(function (e) {
        if (e.keyCode == 13) {
            if ($.trim($(this).html()) != '')
            {
                $('.chat_area2').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + $('#message_div').html() + "</span></span></div>");
                send($('#message_div').html());
                $(this).html('');
                $('#message').val('');
                $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
            }
            return false;
        }
        else if (e.charCode == 32 && $.trim($(this).html()) == '')
        {
            return false;
        }
        else if ($.trim($(this).html()) == '&nbsp;' || $.trim($(this).html()) == '<br>')
        {
            $(this).html('');
            return false;
        }
    });

    $('.submit_btn').click(function (e) {
        msg = $('#message_div').html();
        if (msg.trim() != '')
        {
            $('.chat_area2').append("<div class='chat_2 clearfix event_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + msg + "</span></span></div>");
            send(msg);
            $('#message_div').html('');
            $('#message').val('');
            $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
        }
    });

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        for (var key in files)
        {
            if (/^image/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    var i = Math.random().toString(36).substring(7);
                    // $('#imagePreview').addClass('imagePreview');
                    $('.message').hide();

                    $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" style="float:right;clear:right"><div class="wdth_span media_wrapper"><span class="imagePreview' + i + '"  id="imagePreview_msg"></span></div></div>');

                    $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");

                    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                }
            }
            else
            {
                //this.files = '';
                $('.message').html("Please select proper image");
                $('.message').show();
            }
        }
        var form_data = new FormData();
        $.each(files, function (i, file) {
            form_data.append('image-' + i, file);
        });
        form_data.append("msg_image", files);
        // Send file using ajax
        $.ajax({
            url: base_url + '/user/User/upload_chat_media',
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            error: function (textStatus, errorThrown) {

            },
            success: function (str)
            {
                console.log(str);
                if (str != 0)
                {
                    var msg = {
                        message: str,
                        type: 'event_msg',
                        group_id: group_id,
                        media: 'image'
                    }
                    Server.send('message', JSON.stringify(msg));
                }
            }
        });
    });

    // Video uploading script
    $("#upload_video").on("change", function ()
    {
        var display_file_class = '';
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        for (var key in files)
        {
            console.log("key = ", key);
            if (key != "length" && key != "item")
            {
                if (/^video/.test(files[key].type)) { // only video file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        var i = Math.random().toString(36).substring(7);
                        display_file_class = 'imagePreview' + i;

                        $('.message').hide();
                        $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" style="float:right;clear:right"><div class="media_wrapper" style="float:right"><span class="' +display_file_class+ '"  id="imagePreview_msg"></span></div></div>');
                        $('.' + display_file_class).html("<video controls='' src='" + this.result + "' style='height:180px;'>");
                        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                    }
                }
                else
                {
                    $('.chat_area2').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>Please select proper video</span></span></div>");
                    //this.files = '';
                    $('.message').html("Please select proper Video");
                    $('.message').show();
                    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                    return;
                }
            }

        }
        var form_data = new FormData();
        $.each(files, function (i, file) {
            form_data.append('video-' + i, file);
        });
        form_data.append("msg_video", files);
        // Send file using ajax
        $.ajax({
            url: base_url + '/user/User/upload_chat_media',
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            error: function (textStatus, errorThrown) {

            },
            success: function (str)
            {
                console.log('in video uploading response : ' + str);
                if (str == "601")
                {
                    var p = $('.' + display_file_class).parent().addClass('wdth_span');
                    p.html('<span>Fail to send message</span>');
                }
                else if (str != 0)
                {
                    var msg = {
                        message: str,
                        type: 'event_msg',
                        group_id: group_id,
                        media: 'video'
                    }
                    Server.send('message', JSON.stringify(msg));
                }
            }
        });
    });

    //Let the user know we're connected
    Server.bind('open', function () {
        // Fire when user connect first time
        var msg = {
            type: 'room_bind',
            message: data,
            group_id: group_id,
            room_type: 'event_msg'
        }
        Server.send('message', JSON.stringify(msg));
    });

    //OH NOES! Disconnection occurred.
    Server.bind('close', function (data) {
//                    log("Disconnected.");
    });

    //Log any messages sent from server
    Server.bind('message', function (payload) {
        console.log("message received : ", payload);
        userdata = JSON.parse(payload);
        if (userdata.media_type == null)
        {
            console.log("text message");
            $('.chat_area2').append('<div class="chat_1 clearfix event_media_post" data-chat_id="" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><span class="wdth_span"><span>' + userdata.message + '</span></div>');

        }
        else
        {
            if (userdata.media_type == "image")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix event_media_post" data-chat_id="" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="wdth_span media_wrapper img_media_wrapper"><span class="imagePreview' + i + '" id="imagePreview_msg"></span></div></div>');

                $('.imagePreview' + i).css("background-image", "url(" + upload_path + userdata.media + ")");
            }
            else if (userdata.media_type == "video")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="media_wrapper" style="float:left"><span class="imagePreview' + i + '" id="imagePreview_msg"></span></div></div>');
                $('.imagePreview' + i).html("<video controls='' src='" + upload_path + userdata.media + "' style='height:180px;'>");
            }
        }
        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
    });

    Server.connect();
});