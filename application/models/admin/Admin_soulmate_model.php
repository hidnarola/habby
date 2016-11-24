<?php

class Admin_soulmate_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_soulmate() {
        $start = $this->input->get('start');
        $columns = ['sg.id', 'sg.name', 'u.name', 'sg.created_date'];
        $this->db->select('sg.id,@a:=@a+1 AS test_id,sg.name,sg.slogan,u.name as user_name,DATE_FORMAT(sg.created_date,"%d %b %Y <br> %l:%i %p") AS created_date,sg.is_deleted,sg.is_blocked', false);
        $this->db->join('users u', 'u.id = sg.user_id');
        $this->db->where('sg.is_deleted', 0);
        $this->db->group_by('sg.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('sg.name LIKE "%' . $keyword['value'] . '%" OR sg.slogan LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('soulmate_group sg,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_soulmate_count() {
        $columns = ['sg.id', 'sg.name', 'u.name', 'sg.created_date'];
        $this->db->join('users u', 'u.id = sg.user_id');
        $this->db->where('sg.is_deleted', 0);
        $this->db->group_by('sg.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('sg.name LIKE "%' . $keyword['value'] . '%" OR sg.slogan LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('soulmate_group sg')->num_rows();
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
     * @uses : This function is used get result from the table
     * @param : @table 
     * @author : HPA
     */
    public function get_soulmate_result($group_id) {
        $this->db->select('sg.name,sg.slogan,sg.group_cover,sg.introduction,u.name as user_name,u.user_image,ju.name as join_user_name,ju.user_image as join_user_image,sg.created_date');
        $this->db->join('users u', 'u.id=sg.user_id');
        $this->db->join('users ju', 'ju.id=sg.join_user_id AND sg.join_user_id IS NOT NULL', 'left');
        $this->db->where('sg.id', $group_id);
        $res_data = $this->db->get('soulmate_group sg')->row_array();
        return $res_data;
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

    /**
     * @uses : Insert posts record into table
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