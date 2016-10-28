<?php

class Admin_league_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_leagues() {
        $start = $this->input->get('start');
        $columns = ['lg.id', 'lg.name', '(SELECT COUNT(lm.user_id) FROM `league_members` lm WHERE lg.id=lm.league_id)', 'lg.user_limit', 'u.name', 'lg.created_date'];
        $this->db->select('lg.id,@a:=@a+1 AS test_id,lg.name,(SELECT COUNT(lm.user_id) FROM `league_members` lm WHERE lg.id=lm.league_id) as total_joined,lg.user_limit,u.name as user_name,DATE_FORMAT(lg.created_date,"%d %b %Y <br> %l:%i %p") AS created_date,lg.is_deleted,lg.is_blocked', false);
        $this->db->join('users u', 'u.id = lg.user_id');
        $this->db->where('lg.is_deleted', 0);
        $this->db->group_by('lg.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('lg.name LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('league lg,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_league_count() {
        $columns = ['lg.id', 'lg.name', '(SELECT COUNT(lm.user_id) FROM `league_members` lm WHERE lg.id=lm.league_id)', 'lg.user_limit', 'u.name', 'lg.created_date'];
        $this->db->join('users u', 'u.id = lg.user_id');
        $this->db->where('lg.is_deleted', 0);
        $this->db->group_by('lg.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('lg.name LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('league lg')->num_rows();
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
    public function get_league_result($group_id) {
        $this->db->select('lg.name,lg.user_limit,lg.introduction,lg.league_image,lg.requirements,lg.league_logo,u.name as user_name,u.user_image,(SELECT GROUP_CONCAT(lu.user_id) from league_members lu where lu.league_id = ' . $group_id . ') AS joined_user,(SELECT COUNT(lu.user_id) FROM `league_members` lu WHERE lg.id=lu.league_id ) as Total_User,lg.created_date');
        $this->db->join('users u', 'u.id=lg.user_id');
        $this->db->where('lg.id', $group_id);
        $res_data = $this->db->get('league lg')->row_array();
        return $res_data;
    }
    /**
     * @uses : This function is used get result from the table
     * @param : @table 
     * @author : HPA
     */
    public function get_league_results($group_id) {
        $this->db->select('lg.name,lg.user_limit,lg.introduction,lg.league_image,lg.requirements,lg.league_logo,u.name as user_name,u.user_image,(SELECT GROUP_CONCAT(lu.user_id) from league_members lu where lu.league_id = ' . $group_id . ') AS joined_user,(SELECT COUNT(lu.user_id) FROM `league_members` lu WHERE lg.id=lu.league_id ) as Total_User,lg.created_date');
        $this->db->join('users u', 'u.id=lg.user_id');
        $this->db->where('lg.id', $group_id);
        $res_data = $this->db->get('league lg')->row_array();
        $joied_users = explode(',', $res_data['joined_user']);
        foreach ($joied_users as $joied_user_id) {
            $this->db->select('name as joined_user_name,user_image as joined_user_image');
            $this->db->where('id', $joied_user_id);
            $users[$joied_user_id] = $this->db->get('users')->row_array();
        }
        $res_data['joined_user'] = $users;
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
            echo $this->db->last_query();
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