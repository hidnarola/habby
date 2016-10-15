<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge_model extends CI_Model {
    /* v! insert challanges into challanges table 
     * develop by : HPA
     */

    public function insert_challenge($data) {
        $this->db->insert('challanges', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! insert challange users into challange_user table 
     * develop by : HPA
     */

    public function insert_challenge_user($data) {
        $this->db->insert('challange_user', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Update challange into challanges table 
     * develop by : HPA
     */

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

    /* v! Select newest challanges which is not created by logged in user from challanges table 
     * develop by : HPA
     */

    public function get_challenges($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id, 'left');
        $this->db->where('ch.user_id !=' . $user_id . ' AND cu.user_id IS NULL');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select popular challanges which is not created by logged in user from challanges table 
     * develop by : HPA
     */

    public function get_popular_challenges($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id, 'left');
        $this->db->where('ch.user_id !=' . $user_id . ' AND cu.user_id IS NULL');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.average_rank', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select challanges by id from challanges table 
     * develop by : HPA
     */

    public function get_challenge_by_id($id) {
        if ($id != null) {
            $this->db->where('id', $id);
            $res_data = $this->db->get('challanges')->row_array();
            return $res_data;
        }
    }

    /* v! Select created challanges from challanges table 
     * develop by : HPA
     */

    public function get_my_challenge() {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*');
        $this->db->where('ch.user_id =' . $user_id);
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.created_date', 'DESC');
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select Joined challanges from challanges table 
     * develop by : HPA
     */

    public function get_joined_challenge() {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id . ' AND ch.user_id != cu.user_id');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.created_date', 'DESC');
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select accepted challanges from challange_user table 
     * develop by : HPA
     */

    public function get_challenge_accepted() {
        $user_id = logged_in_user_id();
        $this->db->select('cu.*,users.name as display_name,ch.name');
        $this->db->join('users', 'users.id = cu.user_id');
        $this->db->join('challanges ch', 'cu.challange_id = ch.id AND ch.user_id =' . $user_id);
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('cu.challange_date', 'DESC');
        $res_data = $this->db->get('challange_user cu')->result_array();
        return $res_data;
    }

}

?>