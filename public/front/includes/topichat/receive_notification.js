var Server;
data = JSON.parse(data);
$(document).ready(function () {
//    Server = new FancyWebSocket('ws://192.168.1.202:9300');
     Server = new FancyWebSocket('ws://192.168.1.143:9300');
//    Server = new FancyWebSocket('ws://123.201.110.194:9300');
//    Server = new FancyWebSocket('ws://203.109.68.198:9300');
//    Server = new FancyWebSocket('ws://127.0.0.1:9300');
    //Let the user know we're connected
    Server.bind('open', function () {
        // Fire when user connect first time
        var msg = {
            type: 'room_bind',
            message: data,
            room_type: 'topic_notification'
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
            $('#notification_heading').after('<p><span class="by_spn">'+userdata.group+'</span><span>'+userdata.message+' <a href="'+base_url+'/user_profile/'+userdata.user_id+'">'+userdata.user+'</a></span></p>');
        }
    });
    Server.connect();
});