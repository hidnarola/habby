<?php

// Connection settings
$conn = mysqli_connect("192.168.1.201", "habby", "6735C63zY35gOwF", "habby");

function select($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        return $arr;
    } else {
        return 0;
    }
}

function get_league_users($group_id) {
    global $conn;
    $result = mysqli_query($conn, "select user_id from league_members where league_id = $group_id");
    if (mysqli_num_rows($result) > 0) {
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row['user_id'];
        }
        return $arr;
    } else {
        return 0;
    }
    //return select("select user_id from topic_group_user where topic_id = $group_id");
}

function send_league_msg($group_id,$sender_id,$msg){
    global  $conn;
    $query = "insert into league_messages value(NULL,$group_id,$sender_id,'".$msg."',NULL,NULL)";
    if(mysqli_query($conn, $query))
    {
        return true;
    }
    return false;
}

function get_topichat_users($group_id) {
    global $conn;
    $result = mysqli_query($conn, "select user_id from topic_group_user where topic_id = $group_id");
    if (mysqli_num_rows($result) > 0) {
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row['user_id'];
        }
        return $arr;
    } else {
        return 0;
    }
    //return select("select user_id from topic_group_user where topic_id = $group_id");
}

function send_topic_msg($group_id, $sender_id, $msg) {
    global $conn;
    $query = "insert into topic_group_chat value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function get_groupplan_users($group_id) {
    global $conn;
    $result = mysqli_query($conn, "select user_id from group_users where group_id = $group_id");
    if (mysqli_num_rows($result) > 0) {
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row['user_id'];
        }
        return $arr;
    } else {
        return 0;
    }
    //return select("select user_id from topic_group_user where topic_id = $group_id");
}

function send_groupplan_msg($group_id, $sender_id, $msg) {
    global $conn;
    $query = "insert into group_chat value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

?>