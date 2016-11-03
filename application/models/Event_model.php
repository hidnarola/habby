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
    
    /*
     * 
     */
    public function user_exist_for_event($user_id,$event_id){
        return $this->db->where('user_id',$user_id)->where('event_id',$event_id)->count_all_results('event_users');
    }
    
    /*
     * 
     */
    public function user_requested_for_event($user_id,$event_id) {
        return $this->db->where('user_id',$user_id)->where('event_id',$event_id)->count_all_results('event_request');
    }
    
    /*
     * 
     */
    public function get_limit_for_event($event_id) {
        $this->db->select('limit');
        $this->db->where('id',$event_id);
        return $this->db->get('events')->row_array()['limit'];
    }
    
    /*
     * 
     */
    public function get_total_joined_user_for_event($event_id)
    {
        return $this->db->where('event_id',$event_id)->count_all_results('event_users');
    }
    
    /*
     * 
     * 
     */
    public function Is_approval_needed_for_event($event_id)
    {
        $this->db->select('approval_needed');
        $this->db->where('id',$event_id);
        return $this->db->get('events')->row_array()['approval_needed'];
    }
    
    /*
     * 
     */
    public function add_event_join_request($user_id,$event_id)
    {
        $data['user_id'] = $user_id;
        $data['event_id'] = $event_id;
        if($this->db->insert('event_request',$data))
        {
            return true;
        }
        return false;
    }
    
    /*
     * 
     */
    public function add_event_user($user_id,$event_id)
    {
        $data['user_id'] = $user_id;
        $data['event_id'] = $event_id;
        if($this->db->insert('event_users',$data))
        {
            return true;
        }
        return false;
    }
}

?>