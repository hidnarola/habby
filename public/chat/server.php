<?php

// prevent the server from timing out
set_time_limit(0);

// include the web sockets server script (the server is started at the far bottom of this file)
require 'class.PHPWebSocket.php';
include 'db.php';

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
        if ($message->type == 'room_bind' && empty($Server->wsClients[$clientID]['user_data'])) {
            $Server->wsClients[$clientID]['user_data'] = $message->message;
            $Server->wsClients[$clientID]['room_type'] = $message->room_type;
            if ($Server->wsClients[$clientID]['room_type'] != "topic_notification") {
                $Server->wsClients[$clientID]['room_id'] = $message->group_id;
            }
            return;
        } else if (!empty($Server->wsClients[$clientID]['user_data'])) {
            if ($message->type == 'topic_msg') {
                $user_ids = get_topichat_users($message->group_id);
                foreach ($Server->wsClients as $id => $client) {
                    if ($client['room_type'] != "topic_notification" && $message->group_id == $client['room_id']) {
                        $online_users[] = $client['user_data']->id;
                    }
                }
//                print_r($online_users);

                send_topic_notification($message->group_id, $Server->wsClients[$clientID]['user_data']->id, array_diff($user_ids, $online_users), 'new message');
                // database entry for topichat
                if (isset($message->media)) {
                    if ($message->media != 'links') {
                        $message->message = json_decode($message->message);
                    }
                    send_topic_media($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message, $message->media);
                } else {
                    send_topic_msg($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message);
                }
                $chat_id = insert_id();
                // Send message to user
                if (count($user_ids) > 1) {
                    if (sizeof($Server->wsClients) != 1) {
                        // object that sent to recieving user
                        $send_object = array();
                        $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                        $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                        $send_object['user_image'] = $Server->wsClients[$clientID]['user_data']->user_image;
                        $send_object['message'] = $message->message;
                        $send_object['media'] = (isset($message->media) ? ($message->media == 'links') ? $message->message : $message->message[0]->media : NULL);
                        $send_object['chat_id'] = $chat_id;
                        $send_object['media_type'] = (isset($message->media) ? $message->media : NULL);
                        $send_object['group'] = get_topic_name($message->group_id);
                        foreach ($Server->wsClients as $id => $client) {
                            if ($id != $clientID && in_array($Server->wsClients[$id]['user_data']->id, $user_ids) && isset($Server->wsClients[$id]['room_id']) && $Server->wsClients[$id]['room_id'] == $message->group_id && $Server->wsClients[$id]['room_type'] == $message->type) {
                                $Server->wsSend($id, json_encode($send_object));
                            } else if ($id != $clientID && in_array($Server->wsClients[$id]['user_data']->id, $user_ids) && (!in_array($Server->wsClients[$id]['user_data']->id, $online_users)) && $Server->wsClients[$id]['room_type'] == "topic_notification") {
                                $send_object['message'] = 'New message by';
                                $Server->wsSend($id, json_encode($send_object));
                            }
                        }
                    }
                }
            } else if ($message->type == 'soulmate_msg') {
                $to_user = $message->to_user;
                if (isset($message->media)) {
                    $message->message = json_decode($message->message);
                    send_soulmate_media($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message, $message->media);
                } else {
                    send_soulmate_msg($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message);
                }
                // database entry for topichat
                // Send message to user
                if (sizeof($Server->wsClients) != 1) {
                    // object that sent to recieving user
                    $send_object = array();
                    $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                    $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                    $send_object['user_image'] = $Server->wsClients[$clientID]['user_data']->user_image;
                    $send_object['message'] = (isset($message->media) ? '' : $message->message);
                    $send_object['media'] = (isset($message->media) ? $message->message[0]->media : NULL);
                    $send_object['media_type'] = (isset($message->media) ? $message->media : NULL);
                    foreach ($Server->wsClients as $id => $client) {
                        if ($id != $clientID && $Server->wsClients[$id]['user_data']->id == $to_user && $Server->wsClients[$id]['room_id'] == $message->group_id && $Server->wsClients[$id]['room_type'] == $message->type) {
                            $Server->wsSend($id, json_encode($send_object));
                            break;
                        }
                    }
                }
            } else if ($message->type == 'groupplan_msg') {
                $user_ids = get_groupplan_users($message->group_id);
                // database entry for topichat
                if (isset($message->media)) {
                    $message->message = json_decode($message->message);
                    send_groupplan_media($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message, $message->media);
                } else {
                    send_groupplan_msg($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message);
                }

                // Send message to user
                if (count($user_ids) > 1) {
                    if (sizeof($Server->wsClients) != 1) {
                        // object that sent to recieving user
                        $send_object = array();
                        $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                        $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                        $send_object['user_image'] = $Server->wsClients[$clientID]['user_data']->user_image;
                        $send_object['message'] = $message->message;
                        $send_object['media'] = (isset($message->media) ? $message->message[0]->media : NULL);
                        $send_object['media_type'] = (isset($message->media) ? $message->media : NULL);
                        foreach ($Server->wsClients as $id => $client) {
                            if ($id != $clientID && in_array($Server->wsClients[$id]['user_data']->id, $user_ids) && $Server->wsClients[$id]['room_id'] == $message->group_id && $Server->wsClients[$id]['room_type'] == $message->type) {
                                $Server->wsSend($id, json_encode($send_object));
                            }
                        }
                    }
                }
            } else if ($message->type == 'league_msg') {
                $user_ids = get_league_users($message->group_id);
                // database entry for topichat
                if (isset($message->media)) {
                    $message->message = json_decode($message->message);
                    send_league_media($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message, $message->media);
                } else {
                    send_league_msg($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message);
                }

                // Send message to user
                if (count($user_ids) > 1) {
                    if (sizeof($Server->wsClients) != 1) {
                        // object that sent to recieving user
                        $send_object = array();
                        $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                        $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                        $send_object['user_image'] = $Server->wsClients[$clientID]['user_data']->user_image;
                        $send_object['message'] = $message->message;
                        $send_object['media'] = (isset($message->media) ? $message->message[0]->media : NULL);
                        $send_object['media_type'] = (isset($message->media) ? $message->media : NULL);
                        foreach ($Server->wsClients as $id => $client) {
                            if ($id != $clientID && in_array($Server->wsClients[$id]['user_data']->id, $user_ids) && $Server->wsClients[$id]['room_id'] == $message->group_id && $Server->wsClients[$id]['room_type'] == $message->type) {
                                $Server->wsSend($id, json_encode($send_object));
                            }
                        }
                    }
                }
            } else if ($message->type == 'challenge_msg') {
                $user_ids = get_challenge_users($message->group_id);
                // database entry for topichat
                if (isset($message->media)) {
                    $message->message = json_decode($message->message);
                    send_challenge_media($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message, $message->media);
                } else {
                    send_challenge_msg($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message);
                }

                // Send message to user
                if (count($user_ids) > 1) {
                    if (sizeof($Server->wsClients) != 1) {
                        // object that sent to recieving user
                        $send_object = array();
                        $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                        $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                        $send_object['user_image'] = $Server->wsClients[$clientID]['user_data']->user_image;
                        $send_object['message'] = $message->message;
                        $send_object['media'] = (isset($message->media) ? $message->message[0]->media : NULL);
                        $send_object['media_type'] = (isset($message->media) ? $message->media : NULL);
                        foreach ($Server->wsClients as $id => $client) {
                            if ($id != $clientID && in_array($Server->wsClients[$id]['user_data']->id, $user_ids) && $Server->wsClients[$id]['room_id'] == $message->group_id && $Server->wsClients[$id]['room_type'] == $message->type) {
                                $Server->wsSend($id, json_encode($send_object));
                            }
                        }
                    }
                }
            } else if ($message->type == 'event_msg') {
                $user_ids = get_event_users($message->group_id);
                // database entry for event
                if (isset($message->media)) {
                    $message->message = json_decode($message->message);
                    send_event_media($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message, $message->media);
                } else {
                    send_event_msg($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $message->message);
                }
                // Send message to user
                if (count($user_ids) > 1) {
                    if (sizeof($Server->wsClients) != 1) {
                        // object that sent to recieving user
                        $send_object = array();
                        $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                        $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                        $send_object['user_image'] = $Server->wsClients[$clientID]['user_data']->user_image;
                        $send_object['message'] = $message->message;
                        $send_object['media'] = (isset($message->media) ? $message->message[0]->media : NULL);
                        $send_object['media_type'] = (isset($message->media) ? $message->media : NULL);
                        foreach ($Server->wsClients as $id => $client) {
                            if ($id != $clientID && in_array($Server->wsClients[$id]['user_data']->id, $user_ids) && $Server->wsClients[$id]['room_id'] == $message->group_id && $Server->wsClients[$id]['room_type'] == $message->type) {
                                $Server->wsSend($id, json_encode($send_object));
                            }
                        }
                    }
                }
            } else if ($message->type == 'topic_notification') {
                $user_ids = get_topichat_users($message->group_id);
                send_topic_notification($message->group_id, $Server->wsClients[$clientID]['user_data']->id, $user_ids, $message->message);
                // Send message to user
                if (count($user_ids) > 1) {
                    if (sizeof($Server->wsClients) != 1) {
                        // object that sent to recieving user
                        $send_object = array();
                        $send_object['user'] = $Server->wsClients[$clientID]['user_data']->name;
                        $send_object['user_id'] = $Server->wsClients[$clientID]['user_data']->id;
                        $send_object['group'] = get_topic_name($message->group_id);
                        if ($message->message == "changed") {
                            $send_object['message'] = 'Information has been changed by';
                        } else if ($message->message == "new message") {
                            $send_object['message'] = 'New message by';
                        }
                        foreach ($Server->wsClients as $id => $client) {
                            if ($id != $clientID && in_array($Server->wsClients[$id]['user_data']->id, $user_ids) && $Server->wsClients[$id]['room_type'] == "topic_notification") {
                                $Server->wsSend($id, json_encode($send_object));
                            }
                        }
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
}

// when a client closes or lost connection
function wsOnClose($clientID, $status) {
    global $Server;
    $ip = long2ip($Server->wsClients[$clientID][6]);

    $Server->log("$ip ($clientID) has disconnected.");
}

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))

$Server->wsStartServer('192.168.1.143', 9300);
?>