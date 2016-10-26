<?php

class Admin_challenge_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_challenge() {
        $start = $this->input->get('start');
        $columns = ['ch.id', 'ch.name', 'ch.rewards', 'COUNT(chu.user_id) as total_joined', 'ch.average_rank', 'ch.is_finished', 'u.name'];
        $this->db->select('ch.id,@a:=@a+1 AS test_id,ch.name,ch.rewards,COUNT(chu.user_id) as total_joined,ch.average_rank,ch.is_finished,u.name as user_name,ch.is_deleted,ch.is_blocked', false);
        $this->db->join('challange_user chu', 'chu.challange_id = ch.id', 'left');
        $this->db->join('users u', 'u.id = ch.user_id');
        $this->db->where('ch.is_deleted', 0);
        $this->db->group_by('ch.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('ch.name LIKE "%' . $keyword['value'] . '%" OR ch.rewards LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('challanges ch,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_challenge_count() {
        $columns = ['ch.id', 'ch.name', 'ch.rewards', 'total_joined', 'ch.average_rank', 'ch.is_finished', 'u.name'];
        $this->db->join('challange_user chu', 'chu.challange_id = ch.id', 'left');
        $this->db->join('users u', 'u.id = ch.user_id');
        $this->db->where('ch.is_deleted', 0);
        $this->db->group_by('ch.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('ch.name LIKE "%' . $keyword['value'] . '%" OR ch.rewards LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('challanges ch')->num_rows();
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
    public function get_groupplan_result($group_id) {
        $this->db->select('g.name,g.user_limit,g.group_cover,g.slogan,g.introduction,u.name as user_name,u.user_image,(SELECT GROUP_CONCAT(gu.user_id) from group_users gu JOIN `group` `g1` ON `g1`.`id`=`gu`.`group_id` where gu.group_id = ' . $group_id . ') AS joined_user,(SELECT COUNT(gu1.user_id) FROM `group_users` gu1 WHERE g.id=gu1.group_id ) as Total_User,g.created_date');
        $this->db->join('users u', 'u.id=g.user_id');
        $this->db->where('g.id', $group_id);
        $res_data = $this->db->get('group g')->row_array();
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