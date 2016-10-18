<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge_model extends CI_Model {
    /* v! insert challanges into challanges table 
     * develop by : HPA
     */

    public function insert_challenge($data) {
        $this->db->insert('challanges', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! insert challange users into challange_user table 
     * develop by : HPA
     */

    public function insert_challenge_user($data) {
        $this->db->insert('challange_user', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Update challange into challanges table 
     * develop by : HPA
     */

    public function update_challenge($id, $data) {
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(['id' => $id]);
        }
        $this->db->update('challanges', $data);
        $last_id = $this->db->affected_rows();
        return $last_id;
    }

    /* v! Select newest challanges which is not created by logged in user from challanges table 
     * develop by : HPA
     */

    public function get_challenges($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id, 'left');
        $this->db->where('ch.user_id !=' . $user_id . ' AND cu.user_id IS NULL');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.created_date', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select popular challanges which is not created by logged in user from challanges table 
     * develop by : HPA
     */

    public function get_popular_challenges($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*,users.name as display_name,users.user_image');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id, 'left');
        $this->db->where('ch.user_id !=' . $user_id . ' AND cu.user_id IS NULL');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.average_rank', 'DESC');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select challanges by id from challanges table 
     * develop by : HPA
     */

    public function get_challenge_by_id($id) {
        if ($id != null) {
            $this->db->select('ch.*,users.name as display_name,users.user_image');
            $this->db->join('users', 'users.id = ch.user_id');
            $this->db->where('ch.id', $id);
            $res_data = $this->db->get('challanges ch')->row_array();
            return $res_data;
        }
    }

    /* v! Select created challanges from challanges table 
     * develop by : HPA
     */

    public function get_my_challenge() {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*');
        $this->db->where('ch.user_id =' . $user_id);
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.created_date', 'DESC');
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select Joined challanges from challanges table 
     * develop by : HPA
     */

    public function get_joined_challenge() {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id . ' AND ch.user_id != cu.user_id');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.created_date', 'DESC');
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select accepted challanges from challange_user table 
     * develop by : HPA
     */

    public function get_challenge_accepted() {
        $user_id = logged_in_user_id();
        $this->db->select('cu.*,users.name as display_name,ch.name');
        $this->db->join('users', 'users.id = cu.user_id');
        $this->db->join('challanges ch', 'cu.challange_id = ch.id AND ch.user_id =' . $user_id);
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('cu.challange_date', 'DESC');
        $res_data = $this->db->get('challange_user cu')->result_array();
        return $res_data;
    }

    /* v! Select accepted challange users from challange_user table 
     * develop by : HPA
     */

    public function get_challenges_users($id) {
        if ($id != null) {
            $this->db->select('chu.*,users.name as display_name,users.user_image');
            $this->db->join('users', 'users.id = chu.user_id');
            $this->db->where('chu.challange_id', $id);
            $res_data = $this->db->get('challange_user chu')->result_array();
            return $res_data;
        }
    }

    /*
     * get_messages is used to fetch message for given group
     * @param $group_id int specify group id to which message will fetch
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function get_messages($group_id, $limit) {
        $this->db->select('chc.*,u.name,u.user_image');
        $this->db->where('chc.challange_id', $group_id);
        $this->db->join('users u', 'chc.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('chc.id', 'desc');
        $res_data = $this->db->get('challange_chat chc')->result_array();
        return $res_data;
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

    public function load_messages($group_id, $limit, $last_msg_id) {
        $this->db->select('chc.*,u.name,u.user_image');
        $this->db->where('chc.challange_id', $group_id);
        $this->db->where('chc.id < ', $last_msg_id);
        $this->db->join('users u', 'chc.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('chc.id', 'desc');
        return $this->db->get('challange_chat chc')->result_array();
    }

    /*
     * insert_challenge_media is used to insert multiple row in challange_post table
     * @param $arr array[][] specify input data
     *
     * @return 	int 	number of rows inserted, if success
     * 			boolean	false, if fail
     * developed by : ar
     */

    public function insert_challenge_media($arr) {
        return $this->db->insert_batch('challange_post', $arr);
    }

    /*
     * 
     */
    public function get_challenge_posts($challange_id)
    {
        $this->db->select('cp.*,u.name,u.user_image,count(DISTINCT cc.id) as tot_coin, count(DISTINCT cc1.id) as is_coined,count(DISTINCT cl.id) as tot_like, count(DISTINCT cl1.id) as is_liked,count(DISTINCT cpc.id) as tot_comment');
        $this->db->from('challange_post cp');
        $this->db->join('users u','cp.user_id = u.id');
        $this->db->join('challange_post_coin cc','cp.id = cc.challange_post_id','left');
        $this->db->join('challange_post_coin cc1','cp.id = cc1.challange_post_id and cc1.user_id = '.$this->session->user['id'],'left');
        $this->db->join('challange_post_like cl','cp.id = cl.challange_post_id and cl.is_liked = 1','left');
        $this->db->join('challange_post_like cl1','cp.id = cl1.challange_post_id and cl1.is_liked = 1 and cl1.user_id = '.$this->session->user['id'],'left');
        $this->db->join('challange_post_comment cpc','cp.id = cpc.challange_post_id','left');
        $this->db->where('cp.challange_id = '.$challange_id);
        $this->db->order_by('id','desc');
        $this->db->group_by('cp.id');
        return $this->db->get()->result_array();
    }
    
    /*
     * user_coin_exist_for_post is used to check, if user has given like to particular post
     * @param $user_id	int 	specify user_id
     * @param $post_id 	int 	specify post_id
     *
     * @return boolean 	true, if user entry exist for post
     * 					false, if not exist
     * developed by : ar
     */

    public function user_coin_exist_for_post($user_id, $post_id) {
        $where['user_id'] = $user_id;
        $where['challange_post_id'] = $post_id;
        $this->db->where($where);
        return $this->db->get('challange_post_coin')->row_array();
        //return $this->db->where('user_id',$user_id)->where('post_id',$post_id)->count_all_results('post_like');
    }
    
    /*
     * add_post_coin is used to add coin to given value
     * @param $array array[] input fields
     * 
     * @return boolean	true, if success
     *  		false, if fail
     * developed by : ar
     */

    public function add_post_coin($array) {
        if ($this->db->insert('challange_post_coin', $array)) {
            return true;
        }
        return false;
    }
    
    /*
     * 
     */
    public function get_post_user($post_id)
    {
        $this->db->select('user_id');
        $this->db->where('id',$post_id);
        $row = $this->db->get('challange_post')->row_array();
        return $row['user_id'];
    }
}

?>