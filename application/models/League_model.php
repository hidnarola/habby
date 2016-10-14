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

    /*
     * 
     */

    public function add_league($arr) {
        if ($this->db->insert('league', $arr)) {
            return true;
        }
        return false;
    }

    public function insert_league_user($data) {
        $this->db->insert('league_members', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function get_league_by_id($id) {
        if ($id != "") {
            $this->db->where('id', $id);
            $res_data = $this->db->get('league')->row_array();
            return $res_data;
        }
    }

}