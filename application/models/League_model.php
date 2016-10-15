<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of League_model
 *
 * @author rashish
 */
class League_model extends CI_Model {
    /*
     * get_leagues is used to get data of leagues
     * @param 
     */

    public function get_leagues($search, $filter, $start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('l.*,u.name as created_user,u.user_image, count(DISTINCT lm.id) as total_user');
        $this->db->from('league l');
        $this->db->join('users u', 'l.user_id = u.id');
        $this->db->join('league_members lm', 'l.id = lm.league_id AND lm.user_id =' . $user_id, 'left');
        $this->db->where('l.user_id !=' . $user_id . ' AND lm.user_id IS NULL');
        $this->db->group_by('l.id');
        $this->db->like('l.name', $search);
        if ($filter == 'popular') {
            $this->db->order_by('total_user', 'DESC');
        } else if ($filter == 'recommended') {
            $this->db->order_by('l.created_date', 'DESC'); // need to change
        } else {
            $this->db->order_by('l.created_date', 'DESC');
        }
        $this->db->limit($limit, $start);
        $res_data = $this->db->get()->result_array();
        return $res_data;
    }

    /* v! Insert league group into league table 
     * develop by : AR
     */

    public function add_league($arr) {
        if ($this->db->insert('league', $arr)) {
            return true;
        }
        return false;
    }

    /* v! Insert league group users into league_members table 
     * develop by : HPA
     */

    public function insert_league_user($data) {
        $this->db->insert('league_members', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Selectleague group by id from league table 
     * develop by : HPA
     */

    public function get_league_by_id($id) {
        if ($id != "") {
            $this->db->where('id', $id);
            $res_data = $this->db->get('league')->row_array();
            return $res_data;
        }
    }

    /* v! Select created league group from league table 
     * develop by : HPA
     */

    public function get_my_league() {
        $user_id = logged_in_user_id();
        $this->db->select('l.*,u.name as created_user,u.user_image');
        $this->db->from('league l');
        $this->db->join('users u', 'l.user_id   = u.id');
        $this->db->where('l.user_id', $user_id);
        $this->db->order_by('l.created_date', 'DESC');
        $res_data = $this->db->get()->result_array();
        return $res_data;
    }

    /* v! Select joined league group from league table 
     * develop by : HPA
     */

    public function get_joined_league() {
        $user_id = logged_in_user_id();
        $this->db->select('l.*,u.name as created_user,u.user_image');
        $this->db->from('league l');
        $this->db->join('users u', 'l.user_id = u.id');
        $this->db->join('league_members lm', 'l.id = lm.league_id AND lm.user_id =' . $user_id.' and l.user_id != lm.user_id');
        $this->db->order_by('l.created_date', 'DESC');
        $res_data = $this->db->get()->result_array();
        return $res_data;
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
        $this->db->select('l.*,u.name,u.user_image');
        $this->db->where('l.league_id',$group_id);
        $this->db->join('users u','l.user_id = u.id');
        $this->db->limit($limit,0);
        $this->db->order_by('l.id','desc');
        return $this->db->get('league_messages l')->result_array();
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