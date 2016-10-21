<?php

class Admin_posts_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_posts() {
        $start = $this->input->get('start');
        $columns = ['p.id', 'u.name', 'p.description', 'COUNT(DISTINCT pc.id)', 'COUNT(DISTINCT pl.is_liked)', 'COUNT(DISTINCT pcm.id)', 'COUNT(DISTINCT ps.id)', 'COUNT(DISTINCT psh.id)'];
        $this->db->select('p.id,@a:=@a+1 AS test_id,u.name as user_name,p.description,COUNT(DISTINCT pc.id)as total_coins,COUNT(DISTINCT pl.is_liked) as total_likes,COUNT(DISTINCT pcm.id)as total_comments,COUNT(DISTINCT ps.id)as total_saved,COUNT(DISTINCT psh.id)as total_shared,p.is_block,p.is_deleted', false);
        $this->db->join('users u', 'u.id=p.user_id');
        $this->db->join('post_like pl', 'p.id=pl.post_id AND pl.is_liked = 1', 'left');
        $this->db->join('post_coin pc', 'p.id=pc.post_id', 'left');
        $this->db->join('post_comments pcm', 'p.id=pcm.post_id', 'left');
        $this->db->join('saved_post ps', 'p.id=ps.post_id', 'left');
        $this->db->join('post_share psh', 'p.id=psh.post_id', 'left');
        $this->db->where('p.is_deleted', 0);
        $this->db->group_by('p.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('description LIKE "%' . $keyword['value'] . '%" OR user_name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('post p,(SELECT @a:= ' . $start . ') AS a')->result_array();
//        pr($res_data, 1);
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_posts_count() {
        $columns = ['p.id', 'u.name', 'p.description', 'COUNT(DISTINCT pc.id)', 'COUNT(DISTINCT pl.is_liked)', 'COUNT(DISTINCT pcm.id)', 'COUNT(DISTINCT ps.id)', 'COUNT(DISTINCT psh.id)'];
        $this->db->join('users u', 'u.id=p.user_id');
        $this->db->join('post_like pl', 'p.id=pl.post_id AND pl.is_liked = 1', 'left');
        $this->db->join('post_coin pc', 'p.id=pc.post_id', 'left');
        $this->db->join('post_comments pcm', 'p.id=pcm.post_id', 'left');
        $this->db->join('saved_post ps', 'p.id=ps.post_id', 'left');
        $this->db->join('post_share psh', 'p.id=psh.post_id', 'left');
        $this->db->where('p.is_deleted', 0);
        $this->db->group_by('p.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('p.description LIKE "%' . $keyword['value'] . '%" OR user_name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('post p')->num_rows();
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

}

?>