<?php

class Admin_users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_users() {
        $start = $this->input->get('start');
        $columns = ['id', 'name', 'email', 'hobby', 'total_coin', 'last_login', 'is_deleted', 'is_blocked'];
        $this->db->select('id,@a:=@a+1 AS test_id,name,email,hobby,total_coin,DATE_FORMAT(last_login,"%d %b %Y <br> %l:%i %p") AS last_login,is_deleted,is_blocked', false);
        $this->db->where('role_id', 2);
        $this->db->where('is_deleted', 0);
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('name LIKE "%' . $keyword['value'] . '%" OR email LIKE "%' . $keyword['value'] . '%" OR hobby LIKE "%' . $keyword['value'] . '%" OR total_coin LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('users,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_users_count() {
        $columns = ['id', 'name', 'email', 'hobby', 'total_coin', 'last_login', 'is_deleted', 'is_blocked'];
        $this->db->select('id,@a:=@a+1 AS test_id,name,email,hobby,total_coin,DATE_FORMAT(last_login,"%d %b %Y <br> %l:%i %p") AS last_login,is_deleted,is_blocked', false);
        $this->db->where('role_id', 2);
        $this->db->where('is_deleted', 0);
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('name LIKE "%' . $keyword['value'] . '%" OR email LIKE "%' . $keyword['value'] . '%" OR hobby LIKE "%' . $keyword['value'] . '%" OR total_coin LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('users')->num_rows();
        return $res_data;
    }

    /**
     * @uses : This function is used get result from the table
     * @param : @table 
     * @author : HPA
     */
    public function get_result($table, $condition = null) {
        $this->db->select('*');
        if (!is_null($condition)) {
            $this->db->where($condition);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    /**
     * @uses : This function is used to update record
     * @param : @table, @user_id, @user_array = array of update  
     * @author : HPA
     */
    public function update_record($table, $condition, $user_array) {
        $this->db->where($condition);
        if ($this->db->update($table, $user_array)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_verification_request($where) {
        $this->db->where($where);
        $this->db->delete('verification');
    }

}

?>