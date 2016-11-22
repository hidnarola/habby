<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    /*
      v! Function will check if user is exist or not (spark id - vpa)
      check_if_user_exist - three params 1->where condition 2->is get num_rows for query 3->is fetech single or all data
     * 
     * @return  int 801     user is deleted
     *          int 802     user is blocked
     *          int 803     user is inactive
     */

    public function check_if_user_exist($data = array(), $is_total_rows = false, $is_single = false) {
        $this->db->where($data);
        //$this->db->where('is_blocked=0 AND is_deleted =0');
        //$this->db->where('is_active', 1);
        if ($is_total_rows == true) {
            $res_data = $this->db->get('users')->num_rows();
        } else {
            if ($is_single == true) {
                $res_data = $this->db->get('users')->row_array();
                if($res_data['is_deleted']){
                    return 801;
                }
                else if($res_data['is_blocked'])
                {
                    return 802;
                }
                else if(!$res_data['is_active'])
                {
                    return 803;
                }
            } else {
                $res_data = $this->db->get('users')->result_array();
            }
        }
//        echo $this->db->last_query();
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

    /*
     * 
     */

    public function add_coin_to_user($user_id) {
        $this->db->where('id', $user_id);
        $user = $this->db->get('users')->row_array();
        $this->update_user_data($user_id, ['total_coin' => ($user['total_coin'] + 1)]);
        return true;
    }

    /*
     * 
     */

    public function deduct_coin_from_user($user_id) {
        $this->db->where('id', $user_id);
        $user = $this->db->get('users')->row_array();
        $this->update_user_data($user_id, ['total_coin' => ($user['total_coin'] - 1)]);
        return true;
    }

    // --------------------------------------  Table - Country ----------------------------------------

    public function get_all_countries() {
        $res_data = $this->db->get('country')->result_array();
        return $res_data;
    }

    public function check_fb_id_used($fb_id) {
        $res = $this->db->get_where('users', ['external_id' => $fb_id, 'signup_type' => 'Facebook'])->num_rows();
        return $res;
    }

    /* v! Insert data into users table */

    public function insert_follower_data($data) {
        $this->db->insert('follower', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function delete_follower_data($where) {
        $this->db->where($where);
        $this->db->delete('follower');
        return true;
    }

    public function get_user_follower($user_id) {
        if ($user_id != "") {
            $this->db->select('u.name,u.user_image,f.*');
            $this->db->join('users u', 'u.id=f.follower_id');
            $this->db->where('f.user_id', $user_id);
            $res_data = $this->db->get('follower f')->result_array();
            return $res_data;
        }
    }

    public function get_user_following($user_id) {
        if ($user_id != "") {
            $this->db->select('u.name,u.user_image,f.*');
            $this->db->join('users u', 'u.id=f.user_id');
            $this->db->where('f.follower_id', $user_id);
            $res_data = $this->db->get('follower f')->result_array();
            return $res_data;
        }
    }

    /*
     * 
     */
    public function is_email_exist($email){
        return $this->db->get_where('users', ['email' => $email])->num_rows();
    }
    
    /*
     * 
     */
    public function fetch_user_by_email($email){
        return $this->db->get_where('users',['email'=>$email])->row_array();
    }
}

?>