<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soulmate_model extends CI_Model {
    
    /* v! insert soulmate group into soulmate_group table 
     * * develop by : HPA
     */

    public function insert_soulmate_data($data) {
        $this->db->insert('soulmate_group', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! insert soulmate group request into soulmate_group_user_request table 
     * * develop by : HPA
     */

    public function insert_soulmate_request($data) {
        $this->db->insert('soulmate_group_user_request', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Update data into soulmate_group table 
     * * develop by : HPA
     */

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

    /* v! Select soulmate group details and not created by user from soulmate_group table 
     * develop by : HPA
     */

    public function get_soulmate_group($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('sg.*,users.name as display_name,users.user_image,COUNT(DISTINCT sur.id) AS Is_Requested');
        $this->db->join('users', 'users.id = sg.user_id');
        $this->db->join('soulmate_group_user_request sur', 'sur.soulmate_group_id = sg.id AND sur.requested_user_id = ' . $user_id, 'left');
        $this->db->where('sg.user_id !=' . $user_id);
        $this->db->where('sg.join_user_id IS NULL');
        $this->db->order_by('sg.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('soulmate_group sg')->result_array();
        return $res_data;
    }

    /* v! Select soulmate group details by search group name from soulmate_group table 
     * develop by : HPA
     */

    public function get_search_soulmate_group($search_topic = NULL, $start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('sg.*,users.name as display_name,users.user_image,COUNT(DISTINCT sur.id) AS Is_Requested');
        $this->db->join('soulmate_group_user_request sur', 'sur.soulmate_group_id = sg.id AND sur.requested_user_id = ' . $user_id, 'left');
        $this->db->join('users', 'users.id = sg.user_id');
        $this->db->like('sg.name', $search_topic);
        $this->db->where('sg.user_id !=' . $user_id);
        $this->db->where('(sg.join_user_id !=' . $user_id . ' or sg.join_user_id IS NULL)');
        $this->db->order_by('sg.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('soulmate_group sg')->result_array();
        return $res_data;
    }

    /* v! Select soulmate group details by id from soulmate_group table 
     * develop by : HPA
     */

    public function get_soulmate_group_by_id($id) {
        if ($id != null) {
            $this->db->select('sg.*,u.name as user_name,u.user_image,j.name as join_user,j.user_image as join_user_image');
            $this->db->join('users u', 'u.id = sg.user_id');
            $this->db->join('users j','j.id = sg.join_user_id','left');
            $this->db->where('sg.id', $id);
            $res_data = $this->db->get('soulmate_group sg')->row_array();
            return $res_data;
        }
    }

    /* v! Select created soulmate group details from soulmate_group table 
     * develop by : HPA
     */

    public function get_my_soulmate() {
        $user_id = logged_in_user_id();
        $this->db->select('sg.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = sg.join_user_id');
        $this->db->where('sg.user_id =' . $user_id);
        $this->db->order_by('sg.created_date', 'DESC');
        $res_data = $this->db->get('soulmate_group sg')->result_array();
        return $res_data;
    }

    /* v! Select joined soulmate group details from soulmate_group table 
     * develop by : HPA
     */

    public function get_joined_soulmate() {
        $user_id = logged_in_user_id();
        $this->db->select('sg.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = sg.user_id');
        $this->db->where('sg.join_user_id =' . $user_id);
        $this->db->order_by('sg.created_date', 'DESC');
        $res_data = $this->db->get('soulmate_group sg')->result_array();
        return $res_data;
    }

    /* v! Select user request from soulmate_group_user_request table 
     * develop by : HPA
     */

    public function get_soulmate_request() {
        $user_id = logged_in_user_id();
        $this->db->select('sg.*,users.name as display_name,users.user_image,sl.name');
        $this->db->join('users', 'users.id = sg.requested_user_id');
        $this->db->join('soulmate_group sl', 'sl.id = sg.soulmate_group_id AND sl.user_id =' . $user_id);
        $this->db->where('sg.requested_user_id !=' . $user_id . ' AND sl.join_user_id IS NULL');
        $this->db->order_by('sg.created_date', 'DESC');
        $res_data = $this->db->get('soulmate_group_user_request sg')->result_array();
        return $res_data;
    }

    /* v! Select user request by id from soulmate_group_user_request table 
     * develop by : HPA
     */

    public function get_soulmate_request_by_id($id) {
        if ($id != null) {
            $this->db->where('sg.id', $id);
            $res_data = $this->db->get('soulmate_group_user_request sg')->row_array();
            return $res_data;
        }
    }

    /* v! Delete user request by id from soulmate_group_user_request table 
     * develop by : HPA
     */

    public function delete_soulmate_request($id) {
        if ($id != null) {
            $this->db->where('soulmate_group_id', $id);
            $this->db->delete('soulmate_group_user_request');
        }
    }

    /* v! Delete user all request when user accept anyone request of same group from soulmate_group_user_request table 
     * develop by : HPA
     */

    public function delete_soulmate_request_by_id($id) {
        if ($id != null) {
            $this->db->where('id', $id);
            $this->db->delete('soulmate_group_user_request');
        }
    }

    /*
     * get_messages is used to fetch message for given group
     * @param $group_id int specify group id to which message will fetch
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */
    public function get_messages($group_id,$limit) {
        $this->db->select('s.*,u.name,u.user_image');
        $this->db->where('s.soulmate_group_id',$group_id);
        $this->db->join('users u','s.user_id = u.id');
        $this->db->limit($limit,0);
        $this->db->order_by('s.id','desc');
        return $this->db->get('soulmate_group_chat s')->result_array();
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
    public function load_messages($group_id,$limit,$last_msg_id) {
        $this->db->select('l.*,u.name,u.user_image');
        $this->db->where('l.league_id',$group_id);
        $this->db->where('l.id < ',$last_msg_id);
        $this->db->join('users u','l.user_id = u.id');
        $this->db->limit($limit,0);
        $this->db->order_by('l.id','desc');
        return $this->db->get('league_messages l')->result_array();
    }
}

?>