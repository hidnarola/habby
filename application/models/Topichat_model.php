<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Topichat_model extends CI_Model {
    /* v! Insert topichat group data into topic_group table 
     * develop by : HPA
     */

    public function insert_topic_group_data($data) {
        $this->db->insert('topic_group', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Insert topichat group joined user data into topic_group_user table 
     * develop by : HPA
     */

    public function insert_topic_group_user($data) {
        $this->db->insert('topic_group_user', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! update topichat group into topic_group table 
     * develop by : HPA
     */

    public function update_topic_group_data($id, $data) {
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(['id' => $id]);
        }
        $this->db->update('topic_group', $data);
        $last_id = $this->db->affected_rows();
        return $last_id;
    }

    /* v! Select newest topichat group from topic_group table 
     * develop by : HPA
     */

    public function get_topichat_group($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id ) as Total_User,tg.*,users.name as display_name,users.user_image,count(DISTINCT tt.id) as is_joined');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
//        $this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
//        echo $this->db->last_query();
//        pr($res_data, 1);
        return $res_data;
    }

    /* Select Recommnded topichat group for logged in user from topic_group table
     * @param $start    int     specify start position
     * @param $limit    int     specify limit
     * 
     * @return array[][]    return two dimensional array having record of topic groups
     * develop by : ar
     */

    public function get_recommended_group($start, $limit) {
        $user_id = logged_in_user_id();

        $joined_group = array_column($this->db->select('topic_id')->where('user_id', $user_id)->get('topic_group_user')->result_array(), 'topic_id');

        // Fetch group in which user's friends are joined and user has not joined
        $this->db->select('distinct(tgu.topic_id)');
        $this->db->from('topic_group_user tgu');
        $this->db->join('users u', 'u.id = tgu.user_id');
        $this->db->join('topic_group tg', 'tg.id = tgu.topic_id and tg.is_blocked != 1 and tg.is_deleted != 1');
        $this->db->join('follower f', '(f.follower_id = ' . $user_id . ' and f.user_id = u.id) or (f.user_id = ' . $user_id . ' and f.follower_id = u.id)'); // follower or following user
        $friends_group = array_column($this->db->get()->result_array(), 'topic_id');

        // removed those group whoes user's already joined
        $recommanded_group = array_diff($friends_group, $joined_group);

        if (count($recommanded_group) >= ($start + $limit)) { // Checking limit is sufficient
            $ids_to_fetch = array_slice($recommanded_group, $start, $limit);
            return $this->fetch_topic_groups_by_ids($ids_to_fetch);
        } else { // Need to fetch more groups
            $ids_not_to_search = (array_merge($joined_group, $recommanded_group));

            // Fetch hobby of user
            $user_hobbies = array_map("trim", explode(",", $this->db->select('hobby')->where('id', $user_id)->get('users')->row_array()['hobby']));
            if (count($user_hobbies) > 0) { // If hobby exist
                $fetch_limit = (($start + $limit) - count($recommanded_group));
                // Fetch group according to user's hobby
                $this->db->select('distinct(tg.id)');
                $this->db->from('topic_group tg');
                $this->db->where_not_in('tg.id', $ids_not_to_search);
                $this->db->where('tg.is_blocked != 1 and tg.is_deleted != 1');
                $this->db->limit($fetch_limit);
                foreach ($user_hobbies as $hobby) {
                    $this->db->or_like('topic_name', $hobby);
                    $this->db->or_like('notes', $hobby);
                }
                $interested_group_id = array_column($this->db->get()->result_array(), 'id');
                $ids_not_to_search = array_merge($ids_not_to_search, $interested_group_id);

                $recommanded_group = array_merge($recommanded_group, $interested_group_id);

                if ($fetch_limit > count($interested_group_id)) {
                    $fetch_limit = (($start + $limit) - count($recommanded_group));
                    // Fetch old group, that user has not joined
                    $this->db->select('distinct(tg.id)');
                    $this->db->from('topic_group tg');
                    $this->db->where_not_in('tg.id', $ids_not_to_search);
                    $this->db->where('tg.is_blocked != 1 and tg.is_deleted != 1');
                    $this->db->limit($fetch_limit);
                    $this->db->order_by('id', 'asc');
                    $old_group_id = array_column($this->db->get()->result_array(), 'id');

                    $recommanded_group = array_merge($recommanded_group, $old_group_id);
                }
                $ids_to_fetch = array_slice($recommanded_group, $start, $limit);
                return $this->fetch_topic_groups_by_ids($ids_to_fetch);
            } else { // If hobby not available
                // Fetch old group, that user has not joined
                $fetch_limit = (($start + $limit) - count($recommanded_group));
                // Fetch Old groups
                $this->db->select('distinct(tg.id)');
                $this->db->from('topic_group tg');
                $this->db->where_not_in('tg.id', $ids_not_to_search);
                $this->db->where('tg.is_blocked != 1 and tg.is_deleted != 1');
                $this->db->limit($fetch_limit);
                $this->db->order_by('id', 'asc');
                $old_group_id = array_column($this->db->get()->result_array(), 'id');
                $recommanded_group = array_merge($recommanded_group, $old_group_id);
                $ids_to_fetch = array_slice($recommanded_group, $start, $limit);
                return $this->fetch_topic_groups_by_ids($ids_to_fetch);
            }
        }
    }

    /*
     * 
     */

    public function fetch_topic_groups_by_ids($ids) {
        if (count($ids) > 0) {
            $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id ) as Total_User,tg.*,users.name as display_name,users.user_image');
            $this->db->join('users', 'users.id = tg.user_id');
            $this->db->where_in('tg.id', $ids);
            $this->db->group_by('tg.id');
            return $this->db->get('topic_group tg')->result_array();
        } else {
            $arr = array();
            return $arr;
        }
    }

    /* v! Select popular topichat group from topic_group table 
     * develop by : HPA
     */

    public function get_popular_topichat_group($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)as Total_User ,tg.*,users.name as display_name,users.user_image,count(DISTINCT tt.id) as is_joined');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        //$this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->order_by('Total_User', 'DESC');
        $this->db->group_by('tg.id');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('topic_group tg')->result_array();
//        echo $this->db->last_query();
        //    pr($res_data,1);
        return $res_data;
    }

    /* v! Select topichat group by search group name from topic_group table 
     * develop by : HPA
     */

    public function get_search_topichat_group($search_topic = NULL, $filterby = NULL, $start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)as Total_User ,tg.*,users.name as display_name,users.user_image,count(DISTINCT tt.id) as is_joined');
        if ($filterby == 'popular') {
            $this->db->order_by('Total_User', 'DESC');
        } else if ($filterby == 'recommended') {
            $this->db->order_by('tg.created_date', 'DESC');
        } else {
            $this->db->order_by('tg.created_date', 'DESC');
        }
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->like('tg.topic_name', $search_topic);
//        $this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->limit($limit, $start);
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

    /* v! Select topichat group by id from topic_group table 
     * develop by : HPA
     */

    public function get_topichat_group_by_id($id) {
        if ($id != null) {
            $this->db->where('id', $id);
            $res_data = $this->db->get('topic_group')->row_array();
            return $res_data;
        }
    }

    /* v! Select created topichat group from topic_group table 
     * develop by : HPA
     */

    public function get_my_topichat_group($user_id) {
        $this->db->select('tg.*');
//        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tg.user_id =' . $user_id);
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

    /* v! Select joined topichat group from topic_group table 
     * develop by : HPA
     */

    public function get_joined_topichat_group($user_id) {
        $this->db->select('tg.*');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id . ' AND tg.user_id != tt.user_id', 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tt.user_id IS NOT NULL');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

    /*
     * get_messages is used to fetch message for given group
     * @param $group_id int specify group id to which message will fetch
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function get_messages($group_id, $logged_in_user, $limit = null) {
        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->join('topic_group_chat_rank trp', 'tg.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tg.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tg.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $this->db->group_by('tg.id');
        return $this->db->get('topic_group_chat tg')->result_array();
    }

    /*
     * load_messages is used to fetch more message for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_messages($group_id, $logged_in_user, $limit, $last_msg_id) {
        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.id < ', $last_msg_id);
        $this->db->join('topic_group_chat_rank trp', 'tg.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tg.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tg.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $this->db->group_by('tg.id');
        $messages = $this->db->get('topic_group_chat tg')->result_array();
        return $messages;
    }

    /*
     * get_recent_images used to fetch recent images from database related to particular group
     * @param   $group_id   int     specify group_id
     * @param   $limit      int     specify limit
     * 
     * @return  array   one dimensional array having image names
     * developed by : ar
     */

    public function get_recent_images($group_id, $limit) {
        $this->db->select('media');
        $this->db->where('media_type', 'image');
        $this->db->where('topic_group_id', $group_id);
        $this->db->limit($limit);
        $this->db->order_by('created_date', 'desc');
        $arr = $this->db->get('topic_group_chat')->result_array();
        return array_column($arr, 'media');
    }

    /*
     * get_recent_videos used to fetch recent videos from database related to particular group
     * @param   $group_id   int     specify group_id
     * @param   $limit      int     specify limit
     * 
     * @return  array   one dimensional array having video names
     * developed by : ar
     */

    public function get_recent_videos($group_id, $limit) {
        $this->db->select('media');
        $this->db->where('media_type', 'video');
        $this->db->where('topic_group_id', $group_id);
        $this->db->limit($limit);
        $this->db->order_by('created_date', 'desc');
        $arr = $this->db->get('topic_group_chat')->result_array();
        return array_column($arr, 'media');
    }

    /*
     * get_recent_links used to fetch recent shared links from database related to particular group
     * @param   $group_id   int     specify group_id
     * @param   $limit      int     specify limit
     * 
     * @return  array   one dimensional array having link details
     * developed by : HPA
     */

    public function get_recent_links($group_id, $limit) {
        $this->db->select('media');
        $this->db->where('media_type', 'links');
        $this->db->where('topic_group_id', $group_id);
        $this->db->limit($limit);
        $this->db->order_by('created_date', 'desc');
        $arr = $this->db->get('topic_group_chat')->result_array();
        return array_column($arr, 'media');
    }

    /*
     * load_recent_videos is used to fetch more message for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_recent_videos($group_id, $limit, $last_video_id = null) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media IS NOT NULL');
        $this->db->where('tg.media_type', 'video');
        if (!is_null($last_video_id)) {
            $this->db->where('tg.id < ', $last_video_id);
        }
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
        return $res_data;
    }

    /*
     * load_recent_images is used to fetch more message for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_recent_images($group_id, $limit, $last_image_id = null) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media IS NOT NULL');
        $this->db->where('tg.media_type', 'image');
        if (!is_null($last_image_id)) {
            $this->db->where('tg.id < ', $last_image_id);
        }
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
        return $res_data;
    }

    /*
     * load_recent_links is used to fetch more links for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_recent_links($group_id, $limit, $last_image_id = null) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media IS NOT NULL');
        $this->db->where('tg.media_type', 'links');
        if (!is_null($last_image_id)) {
            $this->db->where('tg.id < ', $last_image_id);
        }
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
        return $res_data;
    }

    /*
     * 
     */

    public function user_rank_exist_for_chat($uid, $chat_id) {
        $where['user_id'] = $uid;
        $where['topic_group_chat_id'] = $chat_id;
        $this->db->where($where);
        return $this->db->get('topic_group_chat_rank')->row_array();
    }

    /*
     * update_chat_rank is used to update rank status to particular chat
     * @param $array array[] specify fields that going to insert
     * @param $id    int     specify id field of challange_post_rank table
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */

    public function update_chat_rank($array, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('topic_group_chat_rank', $array)) {
            return true;
        }
        return false;
    }

    /*
     * add_chat_rank is used to add rank to particular post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */

    public function add_chat_rank($array) {
        if ($this->db->insert('topic_group_chat_rank', $array)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */

    public function get_top_rank_media($group_id, $logged_in_user, $limit) {
        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->where('tg.topic_group_id', $group_id);
//        $this->db->where('tg.media_type IS NOT NULL AND tg.media_type !="files"');
        $this->db->join('users u', 'tg.user_id = u.id');
//        $this->db->join('topic_group_chat_rank tr','tg.id = tr.topic_group_chat_id');
        $this->db->join('topic_group_chat_rank trp', 'tg.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tg.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tg.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->limit($limit, 0);
        $this->db->order_by('(count(DISTINCT trp.id) - count(DISTINCT trn.id))', 'desc');
        $this->db->group_by('tg.id');
        return $this->db->get('topic_group_chat tg')->result_array();
    }

    public function get_shared_media($group_id, $logged_in_user, $limit) {
        $this->db->select('tg.*');
//        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->like('tg.media', 'media');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media_type IS NOT NULL AND tg.media_type ="links"');
//        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
//        $this->db->order_by('(count(DISTINCT trp.id) - count(DISTINCT trn.id))', 'desc');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
//        echo $this->db->last_query();
//        exit;
        return $res_data;
    }

    /*
     * developed by : ar
     */

    public function insert_topichat_group_modification($arr) {
        if ($this->db->insert('topic_group_modify', $arr)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */

    public function get_topic_notification_by_user_id($user_id, $start, $limit) {
        $this->db->select('n.*, u.name,tg.topic_name, f.name as user_name');
        $this->db->where('n.user_id = ' . $user_id);
        $this->db->join('users u', 'u.id = n.user_id');
        $this->db->join('users f', 'f.id = n.from_user_id');
        $this->db->join('topic_group tg', 'tg.id = n.topic_group_id');
        $this->db->limit($limit, $start);
        $this->db->order_by('n.id', 'desc');
        return $this->db->get('topic_notification n')->result_array();
    }

    /*
     * 
     */

    public function get_chat_id_from_media_name($media) {
        $this->db->select('id');
        $id = $this->db->where('media', $media)->get('topic_group_chat')->row_array()['id'];
        return $id;
    }

    public function get_media_details($id, $type) {
        $logged_in_user = logged_in_user_id();
        $this->db->select('tc.id,tc.media,tc.topic_group_id,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->join('topic_group_chat_rank trp', 'tc.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tc.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tc.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->join('users u', 'u.id = tc.user_id');
        $this->db->where('media_type', $type);
        $this->db->where('tc.media', $id);
        $res_data = $this->db->get('topic_group_chat tc')->row_array();
        return $res_data;
    }

    /* v! Select accepted Topichat users from topichats_user table 
     * develop by : HPA
     */

    public function get_topichats_users($id) {
        if ($id != null) {
            $this->db->select('tu.id,users.name as display_name,users.user_image');
            $this->db->join('users', 'users.id = tu.user_id');
            $this->db->where('tu.topic_id', $id);
            $this->db->limit(10, 0);
            $res_data = $this->db->get('topic_group_user tu')->result_array();
            return $res_data;
        }
    }

}

?>