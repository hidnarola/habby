<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Topichat_model extends CI_Model {
    /* v! Insert data into users table */

    public function insert_topic_group_data($data) {
        $this->db->insert('topic_group', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function insert_topic_group_user($data) {
        $this->db->insert('topic_group_user', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Insert data into users table */

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

    public function get_topichat_group($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id ) as Total_User,tg.*,users.name as display_name,users.user_image');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
//        echo $this->db->last_query();
//        pr($res_data, 1);
        return $res_data;
    }

    public function get_popular_topichat_group($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)as Total_User ,tg.*,users.name as display_name,users.user_image');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->order_by('Total_User', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('topic_group tg')->result_array();
//        echo $this->db->last_query();
//        pr($res_data,1);
        return $res_data;
    }

    public function get_search_topichat_group($search_topic = NULL, $filterby = NULL, $start, $limit) {
        $user_id = logged_in_user_id();
        if ($filterby == 'popular') {
            $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)as Total_User ,tg.*,users.name as display_name,users.user_image');
            $this->db->order_by('Total_User', 'DESC');
        } else if ($filterby == 'recommended') {
            $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)as Total_User ,tg.*,users.name as display_name,users.user_image');
            $this->db->order_by('tg.created_date', 'DESC');
        } else {
            $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)as Total_User ,tg.*,users.name as display_name,users.user_image');
            $this->db->order_by('tg.created_date', 'DESC');
        }
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->like('tg.topic_name', $search_topic);
        $this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

    public function get_topichat_group_by_id($id) {
        if ($id != null) {
            $this->db->where('id', $id);
            $res_data = $this->db->get('topic_group')->row_array();
            return $res_data;
        }
    }

    public function get_my_topichat_group() {
        $user_id = logged_in_user_id();
//        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id ) as Total_User,tg.*,users.name as display_name,users.user_image');
//        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tg.user_id =' . $user_id);
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

    public function get_joined_topichat_group() {
        $user_id = logged_in_user_id();
//        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id ) as Total_User,tg.*,users.name as display_name,users.user_image');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tt.user_id IS NOT NULL');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

}

?>