<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soulmate_model extends CI_Model {
    /* v! Insert data into users table */

    public function insert_soulmate_data($data) {
        $this->db->insert('soulmate_group', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function insert_soulmate_request($data) {
        $this->db->insert('soulmate_group_user_request', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Insert data into users table */

    public function update_soulmate_data($id, $data) {
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(['id' => $id]);
        }
        $this->db->update('soulmate_group', $data);
        $last_id = $this->db->affected_rows();
        return $last_id;
    }

    public function get_soulmate_group($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('sg.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = sg.user_id');
        $this->db->where('sg.user_id !=' . $user_id);
        $this->db->where('(sg.join_user_id !=' . $user_id . ' or sg.join_user_id IS NULL)');
        $this->db->order_by('sg.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('soulmate_group sg')->result_array();
        return $res_data;
    }

    public function get_search_soulmate_group($search_topic = NULL, $start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('sg.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = sg.user_id');
        $this->db->like('sg.name', $search_topic);
        $this->db->where('sg.user_id !=' . $user_id);
        $this->db->where('(sg.join_user_id !=' . $user_id . ' or sg.join_user_id IS NULL)');
        $this->db->order_by('sg.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('soulmate_group sg')->result_array();
        return $res_data;
    }

    public function get_soulmate_group_by_id($id) {
        if ($id != null) {
            $this->db->where('id', $id);
            $res_data = $this->db->get('soulmate_group')->row_array();
            return $res_data;
        }
    }

    
}

?>