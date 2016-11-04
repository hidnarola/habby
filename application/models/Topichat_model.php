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

    public function load_messages($group_id, $limit, $last_msg_id) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.id < ', $last_msg_id);
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        return $this->db->get('topic_group_chat tg')->result_array();
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
        $this->db->where('tg.media_type IS NOT NULL');
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

    /*
     * developed by : ar
     */

    public function insert_topichat_group_modification($arr) {
        if ($this->db->insert('topic_group_modify', $arr)) {
            return true;
        }
        return false;
    }

}

?>