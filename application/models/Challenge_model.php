<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge_model extends CI_Model {
    /* v! Insert data into users table */

    public function insert_challenge($data) {
        $this->db->insert('challanges', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Insert data into users table */

    public function update_challenge($id, $data) {
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(['id' => $id]);
        }
        $this->db->update('challanges', $data);
        $last_id = $this->db->affected_rows();
        return $last_id;
    }

    public function get_challenges($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->where('ch.user_id !=' . $user_id);
        $this->db->order_by('ch.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    public function get_popular_challenges($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->where('ch.user_id !=' . $user_id);
        $this->db->order_by('ch.average_rank', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

}

?>