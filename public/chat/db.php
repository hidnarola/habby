<?php

// Connection settings
$conn = mysqli_connect("192.168.1.201", "habby", "6735C63zY35gOwF", "habby");
mysqli_set_charset($conn,"utf8");

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

function send_league_msg($group_id, $sender_id, $msg) {
    global $conn;
    $query = "insert into league_messages value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_league_media($group_id, $sender_id, $msg,$media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into league_messages value(NULL,$group_id,$sender_id,'','".$media->media."','".$media_type."',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
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
    $query = "insert into topic_group_chat value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_topic_media($group_id, $sender_id, $msg,$media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into topic_group_chat value(NULL,$group_id,$sender_id,'','".$media->media."','".$media_type."',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
}

function send_soulmate_msg($group_id, $sender_id, $msg) {
    global $conn;
    $query = "insert into soulmate_group_chat value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_soulmate_media($group_id, $sender_id, $msg,$media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into soulmate_group_chat value(NULL,$group_id,$sender_id,'','".$media->media."','".$media_type."',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
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
    $query = "insert into group_chat value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_groupplan_media($group_id, $sender_id, $msg, $media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into group_chat value(NULL,$group_id,$sender_id,'','".$media->media."','".$media_type."',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
}

function get_challenge_users($group_id) {
    global $conn;
    $result = mysqli_query($conn, "select user_id from challange_user where challange_id = $group_id");
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

function send_challenge_msg($group_id, $sender_id, $msg) {
    global $conn;
    $query = "insert into challange_chat value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_challenge_media($group_id, $sender_id, $msg,$media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into challange_chat value(NULL,$group_id,$sender_id,'','".$media->media."','".$media_type."',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
}

function get_event_users($group_id) {
    global $conn;
    $result = mysqli_query($conn, "select user_id from event_users where event_id = $group_id");
    if (mysqli_num_rows($result) > 0) {
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row['user_id'];
        }
        return $arr;
    } else {
        return 0;
    }
}

function send_event_msg($group_id, $sender_id, $msg) {
    global $conn;
    $query = "insert into event_chat value(NULL,$group_id,$sender_id,'" . mysqli_real_escape_string($conn,$msg) . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_event_media($group_id, $sender_id, $msg,$media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into event_chat value(NULL,$group_id,$sender_id,'','".$media->media."','".$media_type."',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
}
?>