<?php

class Admin_event_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : retrive all events for pagination.
     * @param : @table 
     * @author : ar
     */
    public function get_all_events() {
        $start = $this->input->get('start');
        $columns = ['e.id', 'e.title', 'u.name', 'e.start_time', 'e.end_time', 'e.limit', 'e.approval_needed', 'e.created_date'];
        $this->db->select('e.id,@a:=@a+1 AS test_id,e.title,DATE_FORMAT(e.start_time,"%d %b %Y <br> %l:%i %p") as start_time,DATE_FORMAT(e.end_time,"%d %b %Y <br> %l:%i %p") as end_time,e.limit,e.approval_needed,DATE_FORMAT(e.created_date,"%d %b %Y <br> %l:%i %p") as created_date,u.name as username,e.is_block,e.is_deleted', false);

        $this->db->join('users u', 'u.id = e.user_id');
        $this->db->where('e.is_deleted', 0);
        $this->db->group_by('e.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('e.title LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%" OR e.limit LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('events e,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : ar
     */
    public function get_event_count() {
        $columns = ['e.id', 'e.title', 'u.name', 'e.start_time', 'e.end_time', 'e.limit', 'e.approval_needed', 'e.created_date'];
        $this->db->join('users u', 'u.id = e.user_id');
        $this->db->where('e.is_deleted', 0);
        $this->db->group_by('e.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('e.title LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%" OR e.limit LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('events e')->num_rows();
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
     * @author : ar
     */
    public function get_event_result($group_id) {
        $this->db->select('e.*,u.name as username,u.user_image,em.media');
        $this->db->join('users u', 'u.id = e.user_id');
        $this->db->join('event_media em', 'em.event_id = e.id', 'left');
        $this->db->where('e.id', $group_id);
        $res_data = $this->db->get('events e')->row_array();

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

    public function get_messages($group_id, $limit = null) {
        $this->db->select('ec.*,u.name,u.user_image');
        $this->db->where('ec.event_id', $group_id);
        $this->db->join('users u', 'ec.user_id = u.id');
//        $this->db->limit($limit, 0);
        $this->db->group_by('ec.id');
        $this->db->order_by('ec.id', 'desc');
        $res_data = $this->db->get('event_chat ec')->result_array();
        return $res_data;
    }

    public function load_messages($group_id, $limit, $last_msg_id) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.id < ', $last_msg_id);
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        return $this->db->get('topic_group_chat tg')->result_array();
    }

}

?>