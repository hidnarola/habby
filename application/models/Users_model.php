<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    /*
      v! Function will check if user is exist or not (spark id - vpa)
      check_if_user_exist - three params 1->where condition 2->is get num_rows for query 3->is fetech single or all data
     */

    public function check_if_user_exist($data = array(), $is_total_rows = false, $is_single = false) {
        $this->db->where($data);
        $this->db->where('is_blocked !=', 1);
        $this->db->where('is_active', 1);
        if ($is_total_rows == true) {
            $res_data = $this->db->get('users')->num_rows();
        } else {
            if ($is_single == true) {
                $res_data = $this->db->get('users')->row_array();
            } else {
                $res_data = $this->db->get('users')->result_array();
            }
        }
        echo $this->db->last_query();
        return $res_data;
    }

    /* v! Insert data into users table */

    public function insert_user_data($data) {
        $this->db->insert('users', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Insert data into users table */

    public function update_user_data($id, $data) {
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(['id' => $id]);
        }
        $this->db->update('users', $data);
        $last_id = $this->db->affected_rows();
        return $last_id;
    }

    public function fetch_email_token($data = array()) {
        $this->db->select('id,token,forgot_token');
        $this->db->where($data);
        $res_data = $this->db->get('users')->row_array();
        return $res_data;
    }

    // --------------------------------------  Table - Country ----------------------------------------

    public function get_all_countries() {
        $res_data = $this->db->get('country')->result_array();
        return $res_data;
    }

}

?>