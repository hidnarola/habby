<?php

// prevent the server from timing out
set_time_limit(0);

// include the web sockets server script (the server is started at the far bottom of this file)
require 'class.PHPWebSocket.php';

// when a client sends data to the server
function wsOnMessage($clientID, $message, $messageLength, $binary) {
    global $Server;
    $ip = long2ip($Server->wsClients[$clientID][6]);

    // check if message length is 0
    if ($messageLength == 0) {
        $Server->wsClose($clientID);
        return;
    }
/*
    //The speaker is the only person in the room. Don't let them feel lonely.
    if (sizeof($Server->wsClients) == 1)
        $Server->wsSend($clientID, "There isn't anyone else in the room, but I'll still listen to you. --Your Trusty Server");
    else
    //Send the message to everyone but the person who said it
        foreach ($Server->wsClients as $id => $client)
            if ($id != $clientID)
                $Server->wsSend($id, "Visitor $clientID ($ip) said \"$message\"");
*/
	//Decode the JSON
	$message = json_decode($message);
	 
	//Variables the JSON will fill
	// $requestType;
	// $username;
	// $password;
	// $to;
	// $from;
	// $msg;
	$display_name;
	$user_image;
	 
	//Unpacking the JSON into the above variables
	foreach($message as $k => $v){
		if($k == "display_name")
			$display_name = $v;
		if($k == "user_image")
			$user_image = $v;
		
		// if($k == "requestType")
			// $requestType = $v;
		// if($k == "message")
			// $msg = $v;
		// elseif($k == "to")
			// $to = $v;
		// elseif($k == "Uname")
			// $username = $v;
		// elseif($k == "Pword")
			// $password = $v;
	}
	 
	//Actions if the client has sent a message with requestType 'message'
	if($requestType == 'message'){
		$recipientID;
		$int = 1;
		foreach($Server->wsClients as $user){
			if($user[12] == $to){
				$recipientID = $int;
							BREAK;
					}
			$int++;
		}
	 
		$Server->wsSend($clientID,"Me: ".$msg);
		$Server->wsSend($recipientID,$sender.": ".$msg);
	}
	 
	//Actions if the client has sent a message with requestType 'login'
	elseif($requestType == 'login'){
			/*MAKE SURE THIS USERNAME HAS NOT ALREADY BEEN USED*/
		$Server->wsClients[$clientID][12] = $username;
		$accessGranted = 1;
	}
}

// when a client connects
function wsOnOpen($clientID) {
    global $Server;
    $ip = long2ip($Server->wsClients[$clientID][6]);
		$server->wsSend('client id = '.$clientID);
    $Server->log("$ip ($clientID) has connected.");

    //Send a join notice to everyone but the person who joined
    foreach ($Server->wsClients as $id => $client)
        if ($id != $clientID)
            $Server->wsSend($id, "Visitor $clientID ($ip) has joined the room.");
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
$Server->wsStartServer('192.168.1.202', 9300);
?>