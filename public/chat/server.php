<?php

// prevent the server from timing out
set_time_limit(0);

// include the web sockets server script (the server is started at the far bottom of this file)
require 'class.PHPWebSocket.php';

// when a client sends data to the server
function wsOnMessage($clientID, $message, $messageLength, $binary) {
    global $Server;

//    $ip = long2ip($Server->wsClients[$clientID][6]);
    // check if message length is 0
    if ($messageLength == 0) {
        $Server->wsClose($clientID);
        return;
    }
    //Decode the JSON
    $message = json_decode($message);

    if (!empty($message->type)) {
        if ($message->type == 'bind' && empty($Server->wsClients[$clientID]['user_data'])) {
            $Server->wsClients[$clientID]['user_data'] = $message->message;
            return;
        } else if (!empty($Server->wsClients[$clientID]['user_data'])) {
            // Send message to user
            if (sizeof($Server->wsClients) == 1) {
                $Server->wsSend($clientID, "No one available in the group");
            } else {
                // object that sent to recieving user
                $send_object = array();
                $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                $send_object['user_image'] = $Server->wsClients[$clientID]['user_data']->user_image;
                $send_object['message'] = $message->message;

                foreach ($Server->wsClients as $id => $client) {
                    if ($id != $clientID) {
                        $Server->wsSend($id, json_encode($send_object));
                    }
                }
            }
        } else {
            $Server->wsSend($clientID, "Invalid message sent");
        }
    }
}

// when a client connects
function wsOnOpen($clientID) {

    global $Server;
    $ip = long2ip($Server->wsClients[$clientID][6]);
    //$Server->wsSend('client id = '.$clientID);
    $Server->log("$ip ($clientID) has connected.");

    //Send a join notice to everyone but the person who joined
    foreach ($Server->wsClients as $id => $client) {
        if ($id != $clientID)
            $Server->wsSend($id, "Visitor $clientID ($ip) has joined the room.");
    }
}

// when a client closes or lost connection
function wsOnClose($clientID, $status) {
    global $Server;
    $ip = long2ip($Server->wsClients[$clientID][6]);

    $Server->log("$ip ($clientID) has disconnected.");

    //Send a user left notice to everyone in the room
    foreach ($Server->wsClients as $id => $client)
        $Server->wsSend($id, "Visitor $clientID ($ip) has left the room.");
}

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
// $Server->wsStartServer('192.168.1.202', 9300);
$Server->wsStartServer('127.0.0.1', 9300);
?>