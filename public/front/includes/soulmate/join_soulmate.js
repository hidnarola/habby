var Server;
data = JSON.parse(data);

function send(text) {
    var msg = {
        message: text,
        type: 'soulmate_msg',
        group_id: group_id
    }
    Server.send('message', JSON.stringify(msg));
}

$(document).ready(function () {
    Server = new FancyWebSocket('ws://192.168.1.186:9300');
//    Server = new FancyWebSocket('ws://127.0.0.1:9300');
    // Send message to server
    $('#message').keypress(function (e) {
        if (e.keyCode == 13 && this.value) {
            if (this.value.trim() != '')
            {
                this.value = $.emoticons.replace($('#message').val());
                $('.chat_area2').append("<p class='chat_2 clearfix'><span class='wdth_span'><span>" + this.value + "</span></span></p>");
                send(this.value);
                $(this).val('');
                $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
            }
        }
    });

    $('.submit_btn').click(function (e) {
        msg = $('#message').val();
        if (msg.trim() != '')
        {
            msg = $.emoticons.replace($('#message').val());
            $('.chat_area2').append("<p class='chat_2 clearfix'><span class='wdth_span'><span>" + msg + "</span></span></p>");
            send(msg);
            $('#message').val('');
            $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
        }
    });

    //Let the user know we're connected
    Server.bind('open', function () {
        // Fire when user connect first time
        var msg = {
            type: 'room_bind',
            message: data,
            group_id: group_id,
            room_type: 'soulmate_msg'
        }
        Server.send('message', JSON.stringify(msg));
    });

    //OH NOES! Disconnection occurred.
    Server.bind('close', function (data) {
//                    log("Disconnected.");
    });

    //Log any messages sent from server
    Server.bind('message', function (payload) {
        console.log(payload);
        userdata = JSON.parse(payload);
        $('.chat_area2').append("<p class='chat_1 clearfix'><img class='user_chat_thumb' title='" + userdata.user + "' src='" + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + "'><span class='wdth_span'><span>" + userdata.message + "</span></span></p>");
        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
    });

    Server.connect();
});