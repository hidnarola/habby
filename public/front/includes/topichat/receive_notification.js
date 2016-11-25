var Server;
data = JSON.parse(data);
$(document).ready(function () {
    Server = new FancyWebSocket(socket_server);
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
//        console.log("message received : ", payload);
        userdata = JSON.parse(payload);
        $('#notification_heading').after('<p class="topi_msg"><span class="by_spn">' + userdata.group + '</span><span class="topi_msg_span2"><span class="topi_msg_link">' + userdata.message + ' <a href="' + base_url + '/user_profile/' + userdata.user_id + '">' + userdata.user + '</a></span></span></p>');
    });
    Server.connect();
});