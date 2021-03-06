<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Topichat_model extends CI_Model {
    /* v! Insert topichat group data into topic_group table 
     * develop by : HPA
     */

    public function insert_topic_group_data($data) {
        $this->db->insert('topic_group', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! Insert topichat group joined user data into topic_group_user table 
     * develop by : HPA
     */

    public function insert_topic_group_user($data) {
        $this->db->insert('topic_group_user', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    /* v! update topichat group into topic_group table 
     * develop by : HPA
     */

    public function update_topic_group_data($id, $data) {
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(['id' => $id]);
        }
        $this->db->update('topic_group', $data);
        $last_id = $this->db->affected_rows();
        return $last_id;
    }

    /* v! Select newest topichat group from topic_group table 
     * develop by : HPA
     */
    public function get_topichat_group($start, $limit) {
        $user_id = logged_in_user_id();
        //$this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id) as Total_User,tg.*,users.name as display_name,users.user_image,count(DISTINCT tt.id) as is_joined');
        
        // Changed by "ar" dated on 14th Feb based on client requirement to display number of online user
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id and tu.is_online = "1") as Total_User,tg.*,users.name as display_name,users.user_image,count(DISTINCT tt.id) as is_joined');
        
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
//        $this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->where('tg.is_blocked', '0');
        $this->db->where('tg.is_deleted', '0');
        $this->db->limit($limit, $start);
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
//        echo $this->db->last_query();
//        pr($res_data, 1);
        return $res_data;
    }

    /* Select Recommnded topichat group for logged in user from topic_group table
     * @param $start    int     specify start position
     * @param $limit    int     specify limit
     * 
     * @return array[][]    return two dimensional array having record of topic groups
     * develop by : ar
     */

    public function get_recommended_group($start, $limit) {
        $user_id = logged_in_user_id();

        $joined_group = array_column($this->db->select('topic_id')->where('user_id', $user_id)->get('topic_group_user')->result_array(), 'topic_id');

        // Fetch group in which user's friends are joined and user has not joined
        $this->db->select('distinct(tgu.topic_id)');
        $this->db->from('topic_group_user tgu');
        $this->db->join('users u', 'u.id = tgu.user_id');
        $this->db->join('topic_group tg', 'tg.id = tgu.topic_id and tg.is_blocked != 1 and tg.is_deleted != 1');
        $this->db->join('follower f', '(f.follower_id = ' . $user_id . ' and f.user_id = u.id) or (f.user_id = ' . $user_id . ' and f.follower_id = u.id)'); // follower or following user
        $friends_group = array_column($this->db->get()->result_array(), 'topic_id');

        // removed those group whoes user's already joined
        $recommanded_group = array_diff($friends_group, $joined_group);

        if (count($recommanded_group) >= ($start + $limit)) { // Checking limit is sufficient
            $ids_to_fetch = array_slice($recommanded_group, $start, $limit);
            return $this->fetch_topic_groups_by_ids($ids_to_fetch);
        } else { // Need to fetch more groups
            $ids_not_to_search = (array_merge($joined_group, $recommanded_group));

            // Fetch hobby of user
            $user_hobbies = array_map("trim", explode(",", $this->db->select('hobby')->where('id', $user_id)->get('users')->row_array()['hobby']));
            if (count($user_hobbies) > 0) { // If hobby exist
                $fetch_limit = (($start + $limit) - count($recommanded_group));
                // Fetch group according to user's hobby
                $this->db->select('distinct(tg.id)');
                $this->db->from('topic_group tg');
                if(count($ids_not_to_search) > 0)
                {
                    $this->db->where_not_in('tg.id', $ids_not_to_search);
                }
                $this->db->where('tg.is_blocked != 1 and tg.is_deleted != 1');
                $this->db->limit($fetch_limit);
                foreach ($user_hobbies as $hobby) {
                    $this->db->or_like('topic_name', $hobby);
                    $this->db->or_like('notes', $hobby);
                }
                $interested_group_id = array_column($this->db->get()->result_array(), 'id');
                $ids_not_to_search = array_merge($ids_not_to_search, $interested_group_id);

                $recommanded_group = array_merge($recommanded_group, $interested_group_id);

                if ($fetch_limit > count($interested_group_id)) {
                    $fetch_limit = (($start + $limit) - count($recommanded_group));
                    // Fetch old group, that user has not joined
                    $this->db->select('distinct(tg.id)');
                    $this->db->from('topic_group tg');
                    if(count($ids_not_to_search) > 0)
                    {
                        $this->db->where_not_in('tg.id', $ids_not_to_search);
                    }
                    $this->db->where('tg.is_blocked != 1 and tg.is_deleted != 1');
                    $this->db->limit($fetch_limit);
                    $this->db->order_by('id', 'asc');
                    $old_group_id = array_column($this->db->get()->result_array(), 'id');

                    $recommanded_group = array_merge($recommanded_group, $old_group_id);
                }
                $ids_to_fetch = array_slice($recommanded_group, $start, $limit);
                return $this->fetch_topic_groups_by_ids($ids_to_fetch);
            } else { // If hobby not available
                // Fetch old group, that user has not joined
                $fetch_limit = (($start + $limit) - count($recommanded_group));
                // Fetch Old groups
                $this->db->select('distinct(tg.id)');
                $this->db->from('topic_group tg');
                if(count($ids_not_to_search) > 0)
                {
                    $this->db->where_not_in('tg.id', $ids_not_to_search);
                }
                $this->db->where('tg.is_blocked != 1 and tg.is_deleted != 1');
                $this->db->limit($fetch_limit);
                $this->db->order_by('id', 'asc');
                $old_group_id = array_column($this->db->get()->result_array(), 'id');
                $recommanded_group = array_merge($recommanded_group, $old_group_id);
                $ids_to_fetch = array_slice($recommanded_group, $start, $limit);
                return $this->fetch_topic_groups_by_ids($ids_to_fetch);
            }
        }
    }

    /*
     * 
     */

    public function fetch_topic_groups_by_ids($ids) {
        if (count($ids) > 0) {
            // $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id ) as Total_User,tg.*,users.name as display_name,users.user_image');
            
            // Changed by "ar" dated on 14th Feb based on client requirement to display number of online user
            $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id and tu.is_online = "1") as Total_User,tg.*,users.name as display_name,users.user_image');
            
            $this->db->join('users', 'users.id = tg.user_id');
            $this->db->where_in('tg.id', $ids);
            $this->db->group_by('tg.id');
            return $this->db->get('topic_group tg')->result_array();
        } else {
            $arr = array();
            return $arr;
        }
    }

    /* v! Select popular topichat group from topic_group table 
     * develop by : HPA
     */

    public function get_popular_topichat_group($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id tu.is_online="1")as Total_User ,tg.*,users.name as display_name,users.user_image,count(DISTINCT tt.id) as is_joined');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        //$this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->order_by('Total_User', 'DESC');
        $this->db->where('tg.is_blocked', '0');
        $this->db->where('tg.is_deleted', '0');
        $this->db->group_by('tg.id');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('topic_group tg')->result_array();
//        echo $this->db->last_query();
        //    pr($res_data,1);
        return $res_data;
    }

    /* v! Select topichat group by search group name from topic_group table 
     * develop by : HPA
     */

    public function get_search_topichat_group($search_topic = NULL, $filterby = NULL, $start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('(SELECT COUNT(tu.user_id) FROM `topic_group_user` tu WHERE tg.id=tu.topic_id)as Total_User ,tg.*,users.name as display_name,users.user_image,count(DISTINCT tt.id) as is_joined');
        if ($filterby == 'popular') {
            $this->db->order_by('Total_User', 'DESC');
        } else if ($filterby == 'recommended') {
            $this->db->order_by('tg.created_date', 'DESC');
        } else {
            $this->db->order_by('tg.created_date', 'DESC');
        }
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->like('tg.topic_name', $search_topic);
        $this->db->where('tg.is_blocked', '0');
        $this->db->where('tg.is_deleted', '0');
//        $this->db->where('tg.user_id !=' . $user_id . ' AND tt.user_id IS NULL');
        $this->db->limit($limit, $start);
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

    /* v! Select topichat group by id from topic_group table 
     * develop by : HPA
     */

    public function get_topichat_group_by_id($id) {
        if ($id != null) {
            $this->db->where('id', $id);
            $res_data = $this->db->get('topic_group')->row_array();
            return $res_data;
        }
    }

    /* v! Select created topichat group from topic_group table 
     * develop by : HPA
     */

    public function get_my_topichat_group($user_id) {
        $this->db->select('tg.*');
//        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id, 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tg.user_id =' . $user_id);
        $this->db->where('tg.is_blocked', '0');
        $this->db->where('tg.is_deleted', '0');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }

    /* v! Select joined topichat group from topic_group table 
     * develop by : HPA
     */

    public function get_joined_topichat_group($user_id) {
        $this->db->select('tg.*');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id . ' AND tg.user_id != tt.user_id', 'left');
        $this->db->join('users', 'users.id = tg.user_id');
        $this->db->where('tt.user_id IS NOT NULL');
        $this->db->where('tg.is_blocked', '0');
        $this->db->where('tg.is_deleted', '0');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
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
    public function get_messages($group_id, $logged_in_user, $limit = null,$sort="time") {
        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank, count(distinct pv.id) as watching_user');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->join('topic_group_chat_rank trp', 'tg.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tg.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tg.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->join('topic_post_user_view pv','pv.topic_group_chat_id = tg.id and pv.currently_viewing = "1"','left');        
        $this->db->limit($limit, 0);
        if($sort != "time")
        {
            $this->db->order_by('watching_user', 'desc');
        }
        $this->db->order_by('tg.id','desc');
        $this->db->group_by('tg.id');
        
        // Changes for phase 2, to get only media post
        $this->db->where('tg.media_type IS NOT NULL');
        // Changes over
        
        $messages = $this->db->get('topic_group_chat tg')->result_array();
        
        // Phase 2 changes, retrive user who are currently watching post
        $post_ids = array_column($messages,'id');
        if(count($post_ids) > 0)
        {
            $this->db->select('pv.topic_group_chat_id as post_id,u.id,u.name,u.user_image');
            $this->db->join('users u','pv.user_id = u.id and pv.currently_viewing = "1"');
            $this->db->where_in('pv.topic_group_chat_id',$post_ids);
            $this->db->from('topic_post_user_view pv');
            $currently_viewing_users = $this->db->get()->result_array();
            foreach($currently_viewing_users as $user){
                // code to add user in message array
                $key = array_search($user['post_id'], $post_ids);
                $messages[$key]['watching_users'][] = $user;
            }
        }
        // phase 2 changes over
        
        return $messages;
    }
    
    /* changes of phase 2
     * get_text_messages is used to fetch message for given group
     * @param $group_id int specify group id to which message will fetch
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */
    public function get_text_messages($group_id, $logged_in_user, $limit = null) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $this->db->group_by('tg.id');
        
        // Changes for phase 2, to get only media post
        $this->db->where('tg.media_type IS NULL');
        // Changes over
        return $this->db->get('topic_group_chat tg')->result_array();
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

    public function load_messages($group_id, $logged_in_user, $limit, $sort, $other) {
        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank, count(distinct pv.id) as watching_user');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->join('topic_group_chat_rank trp', 'tg.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tg.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tg.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->join('topic_post_user_view pv','pv.topic_group_chat_id = tg.id and pv.currently_viewing = "1"','left');
        $this->db->limit($limit, 0);
        
        $this->db->group_by('tg.id');
        $this->db->where('tg.media_type IS NOT NULL');
        if($sort == "time")
        {
            $this->db->where('tg.id < ', $other);
            $this->db->order_by('tg.id', 'desc');
        }
        else
        {
            $this->db->where_not_in('tg.id',explode(",",$other));
        }
        $this->db->order_by('tg.id', 'desc');
        $messages = $this->db->get('topic_group_chat tg')->result_array();
        
        // Phase 2 changes, retrive user who are currently watching post
        $post_ids = array_column($messages,'id');
        if(count($post_ids) > 0)
        {
            $this->db->select('pv.topic_group_chat_id as post_id,u.id,u.name,u.user_image');
            $this->db->join('users u','pv.user_id = u.id and pv.currently_viewing = "1"');
            $this->db->where_in('pv.topic_group_chat_id',$post_ids);
            $this->db->from('topic_post_user_view pv');
            $currently_viewing_users = $this->db->get()->result_array();
            foreach($currently_viewing_users as $user){
                // code to add user in message array
                $key = array_search($user['post_id'], $post_ids);
                $messages[$key]['watching_users'][] = $user;
            }
        }
        // phase 2 changes over
        
        return $messages;
    }
    
    /*
     * load_text_messages is used to fetch more message for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_text_messages($group_id, $logged_in_user, $limit, $last_msg_id) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.id < ', $last_msg_id);
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $this->db->group_by('tg.id');
        
        // Changes for phase 2, to get only media post
        $this->db->where('tg.media_type IS NULL');
        // Changes over
        
        $messages = $this->db->get('topic_group_chat tg')->result_array();
        return $messages;
    }

    /*
     * get_recent_images used to fetch recent images from database related to particular group
     * @param   $group_id   int     specify group_id
     * @param   $limit      int     specify limit
     * 
     * @return  array   one dimensional array having image names
     * developed by : ar
     */

    public function get_recent_images($group_id, $limit) {
        $this->db->select('id,media');
        $this->db->where('media_type', 'image');
        $this->db->where('topic_group_id', $group_id);
        $this->db->limit($limit);
        $this->db->order_by('created_date', 'desc');
        $arr = $this->db->get('topic_group_chat')->result_array();
        return $arr;
        //return array_column($arr, 'media');
    }

    /*
     * get_recent_videos used to fetch recent videos from database related to particular group
     * @param   $group_id   int     specify group_id
     * @param   $limit      int     specify limit
     * 
     * @return  array   one dimensional array having video names
     * developed by : ar
     */

    public function get_recent_videos($group_id, $limit) {
        $this->db->select('id,media');
        $this->db->where('media_type', 'video');
        $this->db->where('topic_group_id', $group_id);
        $this->db->limit($limit);
        $this->db->order_by('created_date', 'desc');
        $arr = $this->db->get('topic_group_chat')->result_array();
        return $arr;
        //return array_column($arr, 'media');
    }

    /*
     * get_recent_links used to fetch recent shared links from database related to particular group
     * @param   $group_id   int     specify group_id
     * @param   $limit      int     specify limit
     * 
     * @return  array   one dimensional array having link details
     * developed by : HPA
     */

    public function get_recent_links($group_id, $limit) {
        $this->db->select('id,media,youtube_video');
        $this->db->where('media_type', 'links');
        $this->db->where('topic_group_id', $group_id);
        $this->db->limit($limit);
        $this->db->order_by('created_date', 'desc');
        $arr = $this->db->get('topic_group_chat')->result_array();
        return $arr;
    }

    /*
     * load_recent_videos is used to fetch more message for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_recent_videos($group_id, $limit, $last_video_id = null) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media IS NOT NULL');
        $this->db->where('tg.media_type', 'video');
        if (!is_null($last_video_id)) {
            $this->db->where('tg.id < ', $last_video_id);
        }
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
        return $res_data;
    }

    /*
     * load_recent_images is used to fetch more message for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_recent_images($group_id, $limit, $last_image_id = null) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media IS NOT NULL');
        $this->db->where('tg.media_type', 'image');
        if (!is_null($last_image_id)) {
            $this->db->where('tg.id < ', $last_image_id);
        }
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
        return $res_data;
    }

    /*
     * load_recent_links is used to fetch more links for given group
     * @param $group_id int specify group id to which message will fetch
     * @param $last_msg_id int specify last message that displayed
     * 
     * @return array[][] message data
     *          boolean false, if fail
     * developed by : ar
     */

    public function load_recent_links($group_id, $limit, $last_image_id = null) {
        $this->db->select('tg.*,u.name,u.user_image');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media IS NOT NULL');
        $this->db->where('tg.media_type', 'links');
        if (!is_null($last_image_id)) {
            $this->db->where('tg.id < ', $last_image_id);
        }
        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
        $this->db->order_by('tg.id', 'desc');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
        return $res_data;
    }

    /*
     * 
     */

    public function user_rank_exist_for_chat($uid, $chat_id) {
        $where['user_id'] = $uid;
        $where['topic_group_chat_id'] = $chat_id;
        $this->db->where($where);
        return $this->db->get('topic_group_chat_rank')->row_array();
    }

    /*
     * update_chat_rank is used to update rank status to particular chat
     * @param $array array[] specify fields that going to insert
     * @param $id    int     specify id field of challange_post_rank table
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */

    public function update_chat_rank($array, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('topic_group_chat_rank', $array)) {
            return true;
        }
        return false;
    }

    /*
     * add_chat_rank is used to add rank to particular post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */

    public function add_chat_rank($array) {
        if ($this->db->insert('topic_group_chat_rank', $array)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */

    public function get_top_rank_media($group_id, $logged_in_user, $limit) {
        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media_type IS NOT NULL');
        $this->db->join('users u', 'tg.user_id = u.id');
//        $this->db->join('topic_group_chat_rank tr','tg.id = tr.topic_group_chat_id');
        $this->db->join('topic_group_chat_rank trp', 'tg.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tg.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tg.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->limit($limit, 0);
        $this->db->order_by('(count(DISTINCT trp.id) - count(DISTINCT trn.id))', 'desc');
        $this->db->group_by('tg.id');
        return $this->db->get('topic_group_chat tg')->result_array();
    }

    public function get_shared_media($group_id, $logged_in_user, $limit) {
        $this->db->select('tg.*');
//        $this->db->select('tg.*,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->like('tg.media', 'media');
        $this->db->where('tg.topic_group_id', $group_id);
        $this->db->where('tg.media_type IS NOT NULL AND tg.media_type ="links"');
//        $this->db->join('users u', 'tg.user_id = u.id');
        $this->db->limit($limit, 0);
//        $this->db->order_by('(count(DISTINCT trp.id) - count(DISTINCT trn.id))', 'desc');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group_chat tg')->result_array();
//        echo $this->db->last_query();
//        exit;
        return $res_data;
    }

    /*
     * developed by : ar
     */

    public function insert_topichat_group_modification($arr) {
        if ($this->db->insert('topic_group_modify', $arr)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */

    public function get_topic_notification_by_user_id($user_id, $start, $limit) {
        $this->db->select('n.*, u.name,tg.topic_name, f.name as user_name');
        $this->db->where('n.user_id = ' . $user_id);
        $this->db->join('users u', 'u.id = n.user_id');
        $this->db->join('users f', 'f.id = n.from_user_id');
        $this->db->join('topic_group tg', 'tg.id = n.topic_group_id AND tg.is_blocked=0 AND tg.is_deleted=0');
        $this->db->limit($limit, $start);
        $this->db->order_by('n.id', 'desc');
        return $this->db->get('topic_notification n')->result_array();
    }

    /*
     * 
     */

    public function get_chat_id_from_media_name($media) {
        $this->db->select('id');
        $id = $this->db->where('media', $media)->get('topic_group_chat')->row_array()['id'];
        return $id;
    }

    public function get_chat_id_from_link($media) {
        $this->db->select('id');
        $id = $this->db->where('link_id', $media)->get('topic_group_chat')->row_array()['id'];
        return $id;
    }

    public function get_media_details($id, $type) {
        $logged_in_user = logged_in_user_id();
        $this->db->select('tc.id,tc.media,tc.topic_group_id,tc.youtube_video,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->join('topic_group_chat_rank trp', 'tc.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tc.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tc.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->join('users u', 'u.id = tc.user_id');
        $this->db->where('media_type', $type);
        $this->db->where('tc.media', $id);
        $res_data = $this->db->get('topic_group_chat tc')->row_array();
        return $res_data;
    }

    public function get_youtube_media_details($id) {
        $logged_in_user = logged_in_user_id();
        $this->db->select('tc.id,tc.topic_group_id,tc.youtube_video,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->join('topic_group_chat_rank trp', 'tc.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tc.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tc.id = tru.topic_group_chat_id and tru.user_id = ' . $logged_in_user, 'left');
        $this->db->join('users u', 'u.id = tc.user_id');
        $this->db->where('media_type', 'links');
        $this->db->where('tc.id', $id);
        $res_data = $this->db->get('topic_group_chat tc')->row_array();
        return $res_data;
    }

    /* v! Select accepted Topichat users from topichats_user table 
     * develop by : HPA
     */

    public function get_topichats_users($id) {
        if ($id != null) {
            $this->db->select('tu.id,users.name as display_name,users.user_image');
            $this->db->join('users', 'users.id = tu.user_id');
            $this->db->where('tu.topic_id', $id);
            $this->db->limit(10, 0);
            $res_data = $this->db->get('topic_group_user tu')->result_array();
            return $res_data;
        }
    }

    /*
     * 
     */

    public function is_group_limit_exceed($group_id) {
        $this->db->select('tg.person_limit, count(DISTINCT tgu.id) as joined_user');
        $this->db->where('tg.id', $group_id);
        $this->db->join('topic_group_user tgu', 'tgu.topic_id = tg.id');
        $this->db->group_by('tg.id');
        return $this->db->get('topic_group tg')->row_array();
    }

    /* Phase 2 changes
     * 
     * subscribe_topichat_group is used to subscribe topichat group by user

     * @param   $group_id      int      specify topi_group_id
     *          $user_id       int      specify user_id, that is going to subscribe topichat group
     *
     * return 	true, if success
     * 		false, if fail
     * 
     * developed by : ar
     */
    public function subscribe_topichat_group($group_id,$user_id){
        $this->db->where('topic_id', $group_id);
        $this->db->where('user_id', $user_id);
        $array['is_subscribed'] = "1";
        if ($this->db->update('topic_group_user', $array)) {
            return true;
        }
        return false;
    }
    
    /* Phase 2 changes
     * 
     * unsubscribe_topichat_group is used to unsubscribe topichat group by user

     * @param   $group_id      int      specify topi_group_id
     *          $user_id       int      specify user_id, that is going to unsubscribe topichat group
     *
     * return 	true, if success
     * 		false, if fail
     * 
     * developed by : ar
     */
    public function unsubscribe_topichat_group($group_id,$user_id){
        $this->db->where('topic_id', $group_id);
        $this->db->where('user_id', $user_id);
        $array['is_subscribed'] = "0";
        if ($this->db->update('topic_group_user', $array)) {
            return true;
        }
        return false;
    }
    
    /* Phase 2 changes
     * 
     * is_user_scubscribe_for_group is used to idenitify that user is sbscriber of particular group or not

     * @param   $group_id      int      specify topi_group_id
     *          $user_id       int      specify user_id
     *
     * return 	true, if if user is subscriber of given group
     * 		false, if user is not subscriber of given group
     * 
     * developed by : ar
     */
    public function is_user_scubscribe_for_group($group_id,$user_id){
        try
        {
            $this->db->select('is_subscribed');
            $this->db->where('topic_id',$group_id);
            $this->db->where('user_id',$user_id);
            return $this->db->get('topic_group_user')->row_array()['is_subscribed'];
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    
    /* Phase 2 changes
     * 
     * is_user_scubscribe_for_group is used to idenitify that user is sbscriber of particular group or not

     * @param   $group_id      int      specify topi_group_id
     *          $user_id       int      specify user_id
     *
     * return 	true, if if user is subscriber of given group
     * 		false, if user is not subscriber of given group
     * 
     * developed by : ar
     */
    public function get_subscribed_topichat_group($user_id){
        $this->db->select('tg.*');
        $this->db->join('topic_group_user tt', 'tt.topic_id = tg.id AND tt.user_id =' . $user_id.' and tt.is_subscribed = "1"');
        $this->db->where('tg.is_blocked', '0');
        $this->db->where('tg.is_deleted', '0');
        $this->db->order_by('tg.created_date', 'DESC');
        $this->db->group_by('tg.id');
        $res_data = $this->db->get('topic_group tg')->result_array();
        return $res_data;
    }
    
    /* Phase 2 changes
     * 
     * get_topichat_media_details is used to fetch media details of topic post by id

     * @param   $chat_id      int      specify topi_group_chat_id
     *          $user_id       int      specify logged in user_id
     *
     * return 	array, having media details
     * 
     * developed by : ar
     */
    public function get_topichat_media_details($chat_id,$user_id){
        $this->db->select('tc.id,tc.topic_group_id,tc.user_id,tc.message,tc.media,tc.media_type,tc.youtube_video,u.name,u.user_image,count(DISTINCT trp.id) as positive_rank,count(DISTINCT trn.id) as negetive_rank,count(DISTINCT tru.id) is_ranked, tru.rank');
        $this->db->join('topic_group_chat_rank trp', 'tc.id = trp.topic_group_chat_id and trp.rank = 1', 'left');
        $this->db->join('topic_group_chat_rank trn', 'tc.id = trn.topic_group_chat_id and trn.rank = 0', 'left');
        $this->db->join('topic_group_chat_rank tru', 'tc.id = tru.topic_group_chat_id and tru.user_id = ' . $user_id, 'left');
        $this->db->join('users u', 'u.id = tc.user_id');
        $this->db->where('tc.id', $chat_id);
        $res_data = $this->db->get('topic_group_chat tc')->row_array();
        return $res_data;
    }
    
    /* phase 2 changes
     * 
     * get_post_messages is used to retrive message from topic_post_chat
     * 
     * @param   $post_id        int         specify post id to which message will fetch
     *          $msg_limit      int         specify number of message to be fetch
     *          $last_msg_id    int         specify last message that displayed
     * 
     * @return  array[][]       message data
     *          boolean false,  if fail
     * 
     * developed by "ar"
     */
    public function get_post_messages($post_id,$msg_limit,$last_msg_id) {
        $this->db->select('tpc.*,u.name,u.user_image');
        $this->db->where('tpc.topic_group_chat_id', $post_id);
        if($last_msg_id != false)
        {
            $this->db->where('tpc.id < ', $last_msg_id);
        }
        $this->db->join('users u', 'tpc.user_id = u.id');
        $this->db->limit($msg_limit, 0);
        $this->db->order_by('tpc.id', 'desc');
        $this->db->group_by('tpc.id');
        $messages = $this->db->get('topic_post_chat tpc')->result_array();
        return $messages;
    }
    
    /* phase 2 changes
     * 
     * delete_post is used to delete post
     * 
     * @params      int     $post_id        specify post id
     * 
     * @return      boolean true            if success
     *              boolean false           if fail
     * 
     * developed by "ar"
     */
    public function delete_post($post_id){
        try{
            $this->db->delete('topic_group_chat',array("id"=>$post_id));
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    
    /* phase 2 changes
     * 
     * set_online_flag is used to add user in online list of particular topichat group
     * 
     * @params      int     $group_id        specify id of topichat group
     *              int     $user_id         specify user_id of the users who is going to online
     * 
     * @return      boolean true            if success
     *              boolean false           if fail
     * 
     * developed by "ar"
     */
    public function set_online_flag($group_id,$user_id){
        try
        {
            $this->db->where('topic_id',$group_id);
            $this->db->where('user_id',$user_id);
            $this->db->update('topic_group_user',array("is_online"=>true));
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    
    /* phase 2 changes
     * 
     * unset_online_flag is used to remove user in online list of particular topichat group
     * 
     * @params      int     $group_id        specify id of topichat group
     *              int     $user_id         specify user_id of the users who is going to offline
     * 
     * @return      boolean true            if success
     *              boolean false           if fail
     * 
     * developed by "ar"
     */
    public function unset_online_flag($group_id,$user_id){
        try
        {
            $this->db->where('topic_id',$group_id);
            $this->db->where('user_id',$user_id);
            $this->db->update('topic_group_user',array("is_online"=>false));
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
}
?>