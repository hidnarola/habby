<?php
$servername = isset($_SERVER['SERVER_NAME'])?$_SERVER['SERVER_NAME']:'';
// Connection settings
if ($servername == 'habby') {
    $conn = mysqli_connect("192.168.1.201", "habby", "6735C63zY35gOwF", "habby");
    mysqli_set_charset($conn, "utf8");
}
else
{
    $conn = mysqli_connect("habby-go.c2k2g1789ryk.us-west-2.rds.amazonaws.com", "habby_go", "df098gdf790gdf7890gdf8g", "habby");
    mysqli_set_charset($conn, "utf8");
}
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

function insert_id() {
    global $conn;
    return mysqli_insert_id($conn);
}

function get_league_users($group_id) {
    
    global $conn;
    $result = mysqli_query($conn, "select user_id from league_members where league_id = $group_id") or mysqli_error($conn);
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

function send_league_media($group_id, $sender_id, $msg, $media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into league_messages value(NULL,$group_id,$sender_id,'','" . $media->media . "','" . $media_type . "',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
}

function get_topichat_users($group_id) {
    echo "called";
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
    echo "in message function";
    global $conn;
    $query = "insert into topic_group_chat value(NULL,$group_id,$sender_id,'" . $msg . "',NULL,NULL,'".date('Y-m-d H:i:s')."')";
    
    if (mysqli_query($conn, $query)) {
        echo "record inserted";
        return true;
    }
    echo mysqli_error($conn);
    echo "return false";
    return false;
}

function send_topic_media($group_id, $sender_id, $msg, $media_type) {
    global $conn;
    if ($media_type == 'links') {
        $query = "insert into topic_group_chat value(NULL,$group_id,$sender_id,'','" . mysqli_real_escape_string($conn, $msg) . "','" . $media_type . "',".time().")";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    } else {
        foreach ($msg as $media) {
            $query = "insert into topic_group_chat value(NULL,$group_id,$sender_id,'','" . $media->media . "','" . $media_type . "',".time().")";
            if (mysqli_query($conn, $query)) {
                return true;
            }
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

function send_soulmate_media($group_id, $sender_id, $msg, $media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into soulmate_group_chat value(NULL,$group_id,$sender_id,'','" . $media->media . "','" . $media_type . "',NULL)";
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
    $query = "insert into group_chat value(NULL,$group_id,$sender_id,'" . mysqli_real_escape_string($conn, $msg) . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_groupplan_media($group_id, $sender_id, $msg, $media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into group_chat value(NULL,$group_id,$sender_id,'','" . $media->media . "','" . $media_type . "',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
}

function get_challenge_users($group_id) {
    global $conn;
    $result = mysqli_query($conn, "select user_id from challange_user where challange_id = $group_id AND is_quit=0");
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

function send_challenge_media($group_id, $sender_id, $msg, $media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into challange_chat value(NULL,$group_id,$sender_id,'','" . $media->media . "','" . $media_type . "',NULL)";
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
    $query = "insert into event_chat value(NULL,$group_id,$sender_id,'" . mysqli_real_escape_string($conn, $msg) . "',NULL,NULL,NULL)";
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function send_event_media($group_id, $sender_id, $msg, $media_type) {
    global $conn;
    foreach ($msg as $media) {
        $query = "insert into event_chat value(NULL,$group_id,$sender_id,'','" . $media->media . "','" . $media_type . "',NULL)";
        if (mysqli_query($conn, $query)) {
            return true;
        }
    }
}

function send_topic_notification($group_id, $sender_id, $users_id, $notification_type) {
    $users_id = array_diff($users_id, [$sender_id]);
    global $conn;
    $desc = '';
    if ($notification_type == "changed") {
        $desc = "Information has been changed by";
    } else if ($notification_type == "new message") {
        $desc = "New message by";
    }
    $sql = array();
    foreach ($users_id as $user_id) {
        $sql[] = '("' . mysqli_real_escape_string($conn, $group_id) . '","' . mysqli_real_escape_string($conn, $user_id) . '","' . mysqli_real_escape_string($conn, $sender_id) . '","' . mysqli_real_escape_string($conn, $desc) . '","' . mysqli_real_escape_string($conn, $notification_type) . '")';
    }
    $query = "insert into topic_notification (topic_group_id,user_id,from_user_id,description,type) values " . implode(',', $sql);
    if (mysqli_query($conn, $query)) {
        return true;
    }
    return false;
}

function get_topic_name($group_id) {
    global $conn;
    $query = "select topic_name from topic_group where id = $group_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            return $row['topic_name'];
        }
    } else {
        return 0;
    }
}

?>