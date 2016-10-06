<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Topichat_model extends CI_Model {
    
    /* v! Insert data into users table */

    public function insert_topic_group_data($data) {
        $this->db->insert('topic_group', $data);
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

    public function get_topichat_group() {
        $res_data = $this->db->get('topic_group')->result_array();
        return $res_data;
    }

    // --------------------------------------  Table - Country ----------------------------------------

    public function get_all_countries() {
        $res_data = $this->db->get('country')->result_array();
        return $res_data;
    }

}

?>