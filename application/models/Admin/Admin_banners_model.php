<?php

class Admin_banners_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_banners() {
//        $start = $this->input->get('start');
//        $columns = ['id', 'page', 'image','is_active'];
//        $this->db->select('id,@a:=@a+1 AS test_id,page,image,is_active', false);
//        $keyword = $this->input->get('search');
//        if (!empty($keyword['value'])) {
//            $this->db->having('page LIKE "%' . $keyword['value'] . '%"', NULL);
//        }
//        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
//        $this->db->limit($this->input->get('length'), $this->input->get('start'));      
//        $res_data = $this->db->get('banner_images,(SELECT @a:= '.$start.') AS a')->result_array();
//        return $res_data;
        return $this->db->get('banner_images')->result_array();
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_banners_count() {
        $res_data = $this->db->get('banner_images')->num_rows();
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

    /**
     * @uses : Insert banner record into table
     * @param : @table = table name, @array = array of insert
     * @return : insert_id else 0
     * @author : HPA
     */
    public function insert($table, $array) {
        if ($this->db->insert($table, $array)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

}

?>