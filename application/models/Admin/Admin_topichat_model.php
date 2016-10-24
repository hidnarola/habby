<?php

class Admin_topichat_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_topichats() {
        $start = $this->input->get('start');
        $columns = ['tg.id', 'tg.topic_name', '(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)', 'tg.person_limit', 'u.name'];
        $this->db->select('tg.id,@a:=@a+1 AS test_id,tg.topic_name,(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id ) as total_joined,tg.person_limit,u.name as user_name,tg.is_deleted,tg.is_blocked', false);
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id', 'left');
        $this->db->join('users u', 'u.id = tg.user_id');
        $this->db->where('tg.is_deleted', 0);
        $this->db->group_by('tg.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('tg.topic_name LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('topic_group tg,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_topichat_count() {
        $columns = ['tg.id', 'tg.topic_name', '(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)', 'tg.person_limit', 'u.name'];
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id', 'left');
        $this->db->join('users u', 'u.id = tg.user_id');
        $this->db->where('tg.is_deleted', 0);
        $this->db->group_by('tg.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('tg.topic_name LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('topic_group tg')->num_rows();
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
    public function get_topichat_result($group_id) {
        $this->db->select('tg.topic_name,tg.person_limit,tg.group_cover,tg.notes,u.name,u.user_image');
        $this->db->join('users u', 'u.id=tg.user_id');
        $this->db->where('tg.id', $group_id);
        $res_data = $this->db->get('topic_group tg')->row_array();
        pr($res_data, 1);
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