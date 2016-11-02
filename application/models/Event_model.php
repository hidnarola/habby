<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {
    
    /*
     * 
     */
    public function insert_event($data) {
        $this->db->insert('events', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    
    /*
     * insert_event_media is used to insert multiple row in event media table
     * @param $arr array[][] specify input data
     *
     * @return 	int 	number of rows inserted, if success
     *          boolean	false, if fail
     * developed by : ar
     */

    public function insert_event_media($arr) {
        return $this->db->insert_batch('event_media', $arr);
    }

    public function get_event_post($where,$logged_in_user,$start,$limit){
        if(!empty($where) && count($where)>0)
        {
            $this->db->where('where',$where);
        }
        $this->db->select('e.*,u.name,u.user_image,count(distinct eu.id) as is_joined');
        $this->db->from('events e');
        $this->db->join('users u','e.user_id = u.id');
        $this->db->join('event_users eu','eu.event_id = e.id and eu.user_id = '.$logged_in_user,'left');
        $this->db->group_by('e.id');
        $this->db->order_by('e.id','desc');
        $this->db->limit($limit,$start);
        $post = $this->db->get()->result_array();
        
        $event_ids = array_column($post, 'id');
        if(count($event_ids) > 0)
        {
            $this->db->where_in('event_id',$event_ids);
            $media = $this->db->get('event_media')->result_array();
            foreach ($media as $event_media) {
                $post[array_search($event_media['event_id'],$event_ids)]['media'][] = $event_media;
            }
        }
        
        return $post;
    }
    
    /* v! Insert data into group users table 
     * develop by : HPA
     */

    public function insert_event_user($data) {
        $this->db->insert('event_users', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
//
//    /* v! Update data into group table 
//     * develop by : HPA
//     */
//
//    public function update_groupplan_data($id, $data) {
//        $data['modified_date'] = date('Y-m-d H:i:s');
//        if (is_array($id)) {
//            $this->db->where($id);
//        } else {
//            $this->db->where(['id' => $id]);
//        }
//        $this->db->update('group', $data);
//        $last_id = $this->db->affected_rows();
//        return $last_id;
//    }
//
//    /* v! Select data from group table 
//     * develop by : HPA
//     */
//
//    public function get_group_plan($start, $limit) {
//        $user_id = logged_in_user_id();
//        $this->db->select('(SELECT COUNT(gu.user_id) FROM `group_users` gu WHERE gp.id=gu.group_id) as Total_User,gp.*,users.name as display_name,users.user_image,COUNT(DISTINCT gur.id) AS Is_Requested, count(DISTINCT gus.id) as is_joined');
//        $this->db->join('group_users gus', 'gus.group_id = gp.id AND gus.user_id =' . $user_id, 'left');
//        $this->db->join('users', 'users.id = gp.user_id');
//        $this->db->join('group_users_request gur', 'gur.group_id = gp.id AND gur.user_id = ' . $user_id, 'left');
//      //  $this->db->where('gp.user_id !=' . $user_id . ' AND gus.user_id IS NULL');
//        $this->db->order_by('gp.created_date', 'DESC');
//        $this->db->group_by('gp.id');
//        $this->db->limit($limit, $start);
//        $res_data = $this->db->get('group gp')->result_array();
//        return $res_data;
//    }
//
//    /* v! Select data from group table by search data 
//     * develop by : HPA
//     */
//
//    public function get_search_groupplan($search_topic = NULL, $filterby = NULL, $start, $limit) {
//        $user_id = logged_in_user_id();
//        $this->db->select('(SELECT COUNT(gu.user_id) FROM `group_users` gu WHERE gp.id=gu.group_id) as Total_User,gp.*,users.name as display_name,users.user_image,COUNT(DISTINCT gur.id) AS Is_Requested, count(DISTINCT gus.id) as is_joined');
//        $this->db->join('group_users gus', 'gus.group_id = gp.id AND gus.user_id =' . $user_id, 'left');
//        $this->db->join('users', 'users.id = gp.user_id');
//        $this->db->join('group_users_request gur', 'gur.group_id = gp.id AND gur.user_id = ' . $user_id, 'left');
//       // $this->db->where('gp.user_id !=' . $user_id . ' AND gus.user_id IS NULL');
//        $this->db->like('gp.name', $search_topic);
//        if ($filterby == 'popular') {
//            $this->db->order_by('Total_User', 'DESC');
//        } else if ($filterby == 'recommended') {
//            $this->db->order_by('gp.created_date', 'DESC');
//        } else {
//            $this->db->order_by('gp.created_date', 'DESC');
//        }
//        $this->db->group_by('gp.id');
//        $this->db->limit($limit, $start);
//        $res_data = $this->db->get('group gp')->result_array();
//        return $res_data;
//    }
//
//    /* v! Select popular data from group table 
//     * develop by : HPA
//     */
//
//    public function get_popular_group_plans($start, $limit) {
//        $user_id = logged_in_user_id();
//        $this->db->select('(SELECT COUNT(gu.user_id) FROM `group_users` gu WHERE gp.id=gu.group_id) as Total_User,gp.*,users.name as display_name,users.user_image,COUNT(DISTINCT gur.id) AS Is_Requested, count(DISTINCT gus.id) as is_joined');
//        $this->db->join('group_users gus', 'gus.group_id = gp.id AND gus.user_id =' . $user_id, 'left');
//        $this->db->join('users', 'users.id = gp.user_id');
//        $this->db->join('group_users_request gur', 'gur.group_id = gp.id AND gur.user_id = ' . $user_id, 'left');
//        //$this->db->where('gp.user_id !=' . $user_id . ' AND gus.user_id IS NULL');
//        $this->db->order_by('Total_User', 'DESC');
//        $this->db->group_by('gp.id');
//        $this->db->limit($limit, $start);
//        $res_data = $this->db->get('group gp')->result_array();
//        return $res_data;
//    }
//
//    /* v! Select data from group table by id.
//     * develop by : HPA
//     */
//
//    public function get_groupplan_by_id($id) {
//        if ($id != null) {
//            $this->db->where('id', $id);
//            $res_data = $this->db->get('group')->row_array();
//            return $res_data;
//        }
//    }
//
//    /* v! Select data of logged in user from group table 
//     * develop by : HPA
//     */
//
//    public function get_my_groupplan() {
//        $user_id = logged_in_user_id();
//        $this->db->select('gp.*');
//        $this->db->where('gp.user_id', $user_id);
//        $this->db->order_by('gp.created_date', 'DESC');
//        $res_data = $this->db->get('group gp')->result_array();
//        return $res_data;
//    }
//
//    /* v! Select data where logged in user join from group table 
//     * develop by : HPA
//     */
//
//    public function get_joined_groupplan() {
//        $user_id = logged_in_user_id();
//        $this->db->select('gp.*');
//        $this->db->join('group_users gus', 'gus.group_id = gp.id AND gus.user_id =' . $user_id . ' AND gp.user_id != gus.user_id');
//        $this->db->order_by('gp.created_date', 'DESC');
//        $res_data = $this->db->get('group gp')->result_array();
//        return $res_data;
//    }
//
//    /* v! Select group plan request from group_users_request table 
//     * develop by : HPA
//     */
//
//    public function get_groupplan_request() {
//        $user_id = logged_in_user_id();
//        $this->db->select('gr.*,users.name as display_name,users.user_image,gp.name');
//        $this->db->join('users', 'users.id = gr.user_id');
//        $this->db->join('group gp', 'gp.id = gr.group_id');
//        $this->db->where('gp.user_id =' . $user_id);
//        $this->db->order_by('gr.created_date', 'DESC');
//        $res_data = $this->db->get('group_users_request gr')->result_array();
//        return $res_data;
//    }
//
//    /* v! Select group plan request by id from group_users_request table 
//     * develop by : HPA
//     */
//
//    public function get_groupplan_request_by_id($id) {
//        if ($id != null) {
//            $this->db->where('gr.id', $id);
//            $res_data = $this->db->get('group_users_request gr')->row_array();
//            return $res_data;
//        }
//    }
//
//    /* v! Insert group plan join user details into group_users table 
//     * develop by : HPA
//     */
//
//    public function insert_grouplan_users($data) {
//        $this->db->insert('group_users', $data);
//        $last_id = $this->db->insert_id();
//        return $last_id;
//    }
//
//    /* v! Delete user request from group_users_request table 
//     * develop by : HPA
//     */
//
//    public function delete_grouplpan_request($id) {
//        if ($id != null) {
//            $this->db->where('id', $id);
//            $this->db->delete('group_users_request');
//        }
//    }
//
//    /*
//     * get_messages is used to fetch message for given group
//     * @param $group_id int specify group id to which message will fetch
//     * 
//     * @return array[][] message data
//     *          boolean false, if fail
//     * developed by : ar
//     */
//
//    public function get_messages($group_id, $limit) {
//        $this->db->select('gc.*,u.name,u.user_image');
//        $this->db->where('gc.group_id', $group_id);
//        $this->db->join('users u', 'gc.user_id = u.id');
//        $this->db->limit($limit, 0);
//        $this->db->order_by('gc.id', 'desc');
//        $res_data = $this->db->get('group_chat gc')->result_array();
//        return $res_data;
//    }
//
//    /*
//     * load_messages is used to fetch more message for given group
//     * @param $group_id int specify group id to which message will fetch
//     * @param $last_msg_id int specify last message that displayed
//     * 
//     * @return array[][] message data
//     *          boolean false, if fail
//     * developed by : ar
//     */
//
//    public function load_messages($group_id, $limit, $last_msg_id) {
//        $this->db->select('gc.*,u.name,u.user_image');
//        $this->db->where('gc.group_id', $group_id);
//        $this->db->where('gc.id < ', $last_msg_id);
//        $this->db->join('users u', 'gc.user_id = u.id');
//        $this->db->limit($limit, 0);
//        $this->db->order_by('gc.id', 'desc');
//        return $this->db->get('group_chat gc')->result_array();
//    }
//
//    /* v! Select joined groupplan users from group_users table 
//     * develop by : HPA
//     */
//
//    public function get_groupplan_users($id) {
//        if ($id != null) {
//            $this->db->select('users.name as display_name,users.user_image');
//            $this->db->join('users', 'users.id = gu.user_id');
//            $this->db->where('gu.group_id', $id);
//            $res_data = $this->db->get('group_users gu')->result_array();
//            return $res_data;
//        }
//    }
//
//    /*
//     * get_recent_images used to fetch recent images from database related to particular group
//     * @param   $group_id   int     specify group_id
//     * @param   $limit      int     specify limit
//     * 
//     * @return  array   one dimensional array having image names
//     * developed by : ar
//     */
//    public function get_recent_images($group_id,$limit)
//    {
//        $this->db->select('media');
//        $this->db->where('media_type','image');
//        $this->db->where('group_id',$group_id);
//        $this->db->limit($limit);
//        $this->db->order_by('created_date','desc');
//        $arr = $this->db->get('group_chat')->result_array();
//        return array_column($arr,'media');
//    }
//    
//    /*
//     * get_recent_videos used to fetch recent videos from database related to particular group
//     * @param   $group_id   int     specify group_id
//     * @param   $limit      int     specify limit
//     * 
//     * @return  array   one dimensional array having video names
//     * developed by : ar
//     */
//    public function get_recent_videos($group_id,$limit)
//    {
//        $this->db->select('media');
//        $this->db->where('media_type','video');
//        $this->db->where('group_id',$group_id);
//        $this->db->limit($limit);
//        $this->db->order_by('created_date','desc');
//        $arr = $this->db->get('group_chat')->result_array();
//        return array_column($arr,'media');
//    }
}

?>