<?php

class Admin_seo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : ar
     */
    public function get_all_seo() {
        $start = $this->input->get('start');
        $columns = ['id','page','meta_title'];
        $this->db->select('id,@a:=@a+1 AS test_id,page,meta_title,meta_keyword,meta_description', false);
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('page LIKE "%' . $keyword['value'] . '%" OR meta_title LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('seo,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }
    
    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : ar
     */
    public function get_seo_count() {
        $columns = ['id','page','meta_title'];
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('page LIKE "%' . $keyword['value'] . '%" OR meta_title LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('seo')->num_rows();
        return $res_data;
    }
    
    /**
     * @uses : This function is used get result from the table
     * @param : @table 
     * @author : ar
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
     * @author : ar
     */
    public function update_record($table, $condition, $user_array) {
        $this->db->where($condition);
        if ($this->db->update($table, $user_array)) {
            return 1;
        } else {
            return 0;
        }
    }
}

?>