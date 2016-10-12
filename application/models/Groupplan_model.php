<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Groupplan_model extends CI_Model {
    /* v! Insert data into users table */

    public function insert_groupplan_data($data) {
        $this->db->insert('group', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function insert_groupplan_user($data) {
        $this->db->insert('group_users_request', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Insert data into users table */

    public function update_groupplan_data($id, $data) {
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(['id' => $id]);
        }
        $this->db->update('group', $data);
        $last_id = $this->db->affected_rows();
        return $last_id;
    }

    public function get_group_plan($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(gu.user_id) FROM `group_users` gu WHERE gp.id=gu.group_id) as Total_User,gp.*,users.name as display_name,users.user_image');
        $this->db->join('group_users gus', 'gus.group_id = gp.id AND gus.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = gp.user_id');
        $this->db->where('gp.user_id !=' . $user_id . ' AND gus.user_id IS NULL');
        $this->db->order_by('gp.created_date', 'DESC');
        $this->db->group_by('gp.id');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('group gp')->result_array();
        return $res_data;
    }

    public function get_search_groupplan($search_topic = NULL, $filterby = NUll, $start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(gu.user_id) FROM `group_users` gu WHERE gp.id=gu.group_id) as Total_User,gp.*,users.name as display_name,users.user_image');
        $this->db->join('group_users gus', 'gus.group_id = gp.id AND gus.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = gp.user_id');
        $this->db->like('gp.name', $search_topic);
        $this->db->where('gp.user_id !=' . $user_id . ' AND gus.user_id IS NULL');
        if ($filterby == 'popular') {
            $this->db->order_by('Total_User', 'DESC');
        } else if ($filterby == 'recommended') {
            $this->db->order_by('gp.created_date', 'DESC');
        } else {
            $this->db->order_by('gp.created_date', 'DESC');
        }
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('group gp')->result_array();
        return $res_data;
    }

    public function get_popular_group_plans($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(gu.user_id) FROM `group_users` gu WHERE gp.id=gu.group_id) as Total_User,gp.*,users.name as display_name,users.user_image');
        $this->db->join('group_users gus', 'gus.group_id = gp.id AND gus.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = gp.user_id');
        $this->db->where('gp.user_id !=' . $user_id . ' AND gus.user_id IS NULL');
        $this->db->order_by('Total_User', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('group gp')->result_array();
        return $res_data;
    }

    public function get_groupplan_by_id($id) {
        if ($id != null) {
            $this->db->where('id', $id);
            $res_data = $this->db->get('group')->row_array();
            return $res_data;
        }
    }

}

?>