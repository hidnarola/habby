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
        $this->db->select('ch.*,users.name as display_name,users.user_image,count(distinct cu.id) as is_applied, count(distinct cr.id) as is_ranked,cr.rank as given_rank');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id, 'left');
        $this->db->join('challange_rank cr','cr.challange_id = ch.id and cr.user_id = '.$user_id,'left');
        // $this->db->where('ch.user_id !=' . $user_id . ' AND cu.user_id IS NULL');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.created_date', 'DESC');
        $this->db->group_by('ch.id');
        $this->db->limit($limit, $start);
        $res_data = $this->db->get('challanges ch')->result_array();
        return $res_data;
    }

    /* v! Select popular challanges which is not created by logged in user from challanges table 
     * develop by : HPA
     */

    public function get_popular_challenges($start, $limit) {
        $user_id = logged_in_user_id();
        $this->db->select('ch.*,users.name as display_name,users.user_image,count(distinct cu.id) as is_applied, count(distinct cr.id) as is_ranked,cr.rank as given_rank');
        $this->db->join('users', 'users.id = ch.user_id');
        $this->db->join('challange_user cu', 'cu.challange_id = ch.id AND cu.user_id =' . $user_id, 'left');
        $this->db->join('challange_rank cr','cr.challange_id = ch.id and cr.user_id = '.$user_id,'left');
        //$this->db->where('ch.user_id !=' . $user_id . ' AND cu.user_id IS NULL');
        $this->db->where('ch.is_finished', 0);
        $this->db->order_by('ch.average_rank', 'DESC');
        $this->db->group_by('ch.id');
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

    public function get_my_challenge($user_id) {
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

    public function get_joined_challenge($user_id) {
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

    public function get_challenge_accepted($user_id) {
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
     * challange_post is used to display all post according pagination
     * @param $challange_id     int	specify challange id
     * @param $logged_in_user   int     user_id of logged in user
     * @param $start            int 	specify start position for pagination
     * @param $limit            int 	specify page size
     * 
     * @return array[][] return found record as per condition
     * developed by : ar
     */

    public function get_challenge_posts($challange_id, $logged_in_user, $start = 0, $limit = 0) {
        $this->db->select('cp.*,u.name,u.user_image,count(DISTINCT cc.id) as tot_coin, count(DISTINCT cc1.id) as is_coined,count(DISTINCT cl.id) as tot_like, count(DISTINCT cl1.id) as is_liked,count(DISTINCT cpc.id) as tot_comment,count(DISTINCT crp.id) as positive_rank,count(DISTINCT crn.id) as negetive_rank,count(DISTINCT cru.id) is_ranked, cru.rank');
        $this->db->from('challange_post cp');
        $this->db->join('users u', 'cp.user_id = u.id');
        $this->db->join('challange_post_coin cc', 'cp.id = cc.challange_post_id', 'left');
        $this->db->join('challange_post_coin cc1', 'cp.id = cc1.challange_post_id and cc1.user_id = ' . $logged_in_user, 'left');
        $this->db->join('challange_post_like cl', 'cp.id = cl.challange_post_id and cl.is_liked = 1', 'left');
        $this->db->join('challange_post_like cl1', 'cp.id = cl1.challange_post_id and cl1.is_liked = 1 and cl1.user_id = ' . $logged_in_user, 'left');
        $this->db->join('challange_post_comment cpc', 'cp.id = cpc.challange_post_id', 'left');
        $this->db->join('challange_post_rank crp','cp.id = crp.challange_post_id and crp.rank = 1','left');
        $this->db->join('challange_post_rank crn','cp.id = crn.challange_post_id and crn.rank = 0','left');
        $this->db->join('challange_post_rank cru','cp.id = cru.challange_post_id and cru.user_id = '.$logged_in_user,'left');
        $this->db->where('cp.challange_id = ' . $challange_id);
        $this->db->order_by('(count(DISTINCT crp.id) - count(DISTINCT crn.id))', 'desc');
        $this->db->group_by('cp.id');
        $post = $this->db->get()->result_array();
        $post_ids = array_column($post, 'id');

        if (count($post_ids) > 0) {
            $this->db->where_in('p.challange_post_id', $post_ids);
            $this->db->select('p.*, u.name, u.user_image, count(DISTINCT pl.id) as cnt_like, count(DISTINCT pr.id) as cnt_reply, count(pli.id) as is_liked');
            $this->db->from('challange_post_comment p');
            $this->db->join('users u', 'p.user_id = u.id');
            $this->db->join('challange_post_comments_like pl', 'p.id = pl.challange_post_comment_id and pl.is_liked=1', 'left');
            $this->db->join('challange_post_comments_like pli', 'p.id = pli.challange_post_comment_id and pli.is_liked=1 and pli.user_id=' . $logged_in_user, 'left');
            $this->db->join('challange_post_comments_reply pr', 'p.id = pr.challange_post_comment_id', 'left');
            $this->db->order_by('p.created_date', 'desc');
            $this->db->group_by('p.id');

            $post_comments = $this->db->get()->result_array();
            $post_comments_ids = array_column($post_comments, 'challange_post_id');
            if (count($post_comments_ids) > 0) {
                for ($i = 0; $i < count($post); ++$i) {
                    $post[$i]['comments'] = array();
                    if (in_array($post[$i]['id'], $post_comments_ids)) {
                        $posts = array();
                        foreach ($post_comments as $value) {
                            if ($post[$i]['id'] == $value['challange_post_id']) {
                                $posts[] = $value;
                            }
                        }
                        $post[$i]['comments'] = $posts;
                    }
                }
            }
        }
        return $post;
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

    public function get_post_user($post_id) {
        $this->db->select('user_id');
        $this->db->where('id', $post_id);
        $row = $this->db->get('challange_post')->row_array();
        return $row['user_id'];
    }

    /*
     * user_like_exist_for_post is used to check, if user has given like to particular post
     * @param $user_id	int 	specify user_id
     * @param $post_id 	int 	specify post_id
     *
     * @return boolean 	true, if user entry exist for post
     * 					false, if not exist
     * developed by : ar
     */

    public function user_like_exist_for_post($user_id, $post_id) {
        $where['user_id'] = $user_id;
        $where['challange_post_id'] = $post_id;
        $this->db->where($where);
        return $this->db->get('challange_post_like')->row_array();
    }

    /*
     * update_post_like is used to update like status to particular post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */

    public function update_post_like($array, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('challange_post_like', $array)) {
            return true;
        }
        return false;
    }

    /*
     * add_post_like is used to give like to particular post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */

    public function add_post_like($array) {
        if ($this->db->insert('challange_post_like', $array)) {
            return true;
        }
        return false;
    }

    /*
     * insert_post_comment is used to insert comments to the post
     * @param $arr array[] input data
     * 
     * @return boolean true, if success
     *                  false, if fail
     * developed by : ar
     */

    public function insert_post_comment($arr) {
        if ($this->db->insert('challange_post_comment', $arr)) {
            return true;
        }
        return false;
    }

    /*
     * get_post_comment_data_by_id is used to retrive comments data by post_comment_id
     * @param $post_comment_id int specify post_comment_id
     * 
     * @return $array return records found as per condition
     * developed by : ar
     */

    public function get_post_comment_data_by_id($post_comment_id) {
        $this->db->select('p.*, u.name, u.user_image, count(pl.challange_post_comment_id) as cnt_like, count(pr.challange_post_comment_id) as cnt_reply');
        $this->db->from('challange_post_comment p');
        $this->db->join('challange_post_comments_like pl', 'p.id = pl.challange_post_comment_id', 'left');
        $this->db->join('challange_post_comments_reply pr', 'p.id = pr.challange_post_comment_id', 'left');
        $this->db->join('users u', 'p.user_id = u.id and p.id = ' . $post_comment_id);
        return $this->db->get()->row_array();
    }

    /*
     * user_like_exist_for_postcomment is used to check, if user has given like to particular comment of post
     * @param $user_id          int 	specify user_id
     * @param $post_comment_id 	int 	specify post_comment_id
     *
     * @return boolean 	true, if user entry exist for post
     * 					false, if not exist
     * developed by : ar
     */

    public function user_like_exist_for_postcomment($user_id, $post_comment_id) {
        $where['user_id'] = $user_id;
        $where['challange_post_comment_id'] = $post_comment_id;
        $this->db->where($where);
        return $this->db->get('challange_post_comments_like')->row_array();
    }

    /*
     * update_postcomment_like is used to update like status to particular comment on post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 			false, if fail
     * developed by : ar
     */

    public function update_postcomment_like($array, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('challange_post_comments_like', $array)) {
            return true;
        }
        return false;
    }

    /*
     * add_postcomment_like is used to give like to particular comment of post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 			false, if fail
     * developed by : ar
     */

    public function add_postcomment_like($array) {
        if ($this->db->insert('challange_post_comments_like', $array)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */

    public function get_post_reply($post_comment_id) {
        $this->db->select('u.name, u.user_image,r.reply_text, r.created_date');
        $this->db->from('challange_post_comments_reply r');
        $this->db->join('users u', 'r.user_id = u.id and r.challange_post_comment_id = ' . $post_comment_id);
        $this->db->group_by('r.created_date', 'asc');
        return $this->db->get()->result_array();
    }

    /*
     * 
     */

    public function insert_post_comment_reply($arr) {
        if ($this->db->insert('challange_post_comments_reply', $arr)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */
    public function get_post_comment_reply_data_by_id($post_comment_reply_id)
    {
        $this->db->select('p.*, u.name, u.user_image');
        $this->db->from('challange_post_comments_reply p');
        $this->db->join('users u','p.user_id = u.id and p.id = '.$post_comment_reply_id);
        return $this->db->get()->row_array();
    }
    
    /*
     * 
     */
    public function user_rank_exist_for_post($uid,$post_id)
    {
        $where['user_id'] = $uid;
        $where['challange_post_id'] = $post_id;
        $this->db->where($where);
        return $this->db->get('challange_post_rank')->row_array();
    }
    
    /*
     * update_post_rank is used to update rank status to particular post
     * @param $array array[] specify fields that going to insert
     * @param $id    int     specify id field of challange_post_rank table
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */

    public function update_post_rank($array, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('challange_post_rank', $array)) {
            return true;
        }
        return false;
    }

    /*
     * add_post_rank is used to add rank to particular post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */
    public function add_post_rank($array) {
        if ($this->db->insert('challange_post_rank', $array)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */
    public function get_challenge_data($challange_id)
    {
        $this->db->select('c.*,u.name as challange_user,u.user_image as challange_user_image');
        $this->db->from('challanges c');
        $this->db->join('users u', 'c.user_id = u.id');
        $this->db->where('c.id = '.$challange_id);
        return $this->db->get()->row_array();
    }
    
    /*
     * 
     */
    public function get_rank_post_by_challenge_id($challange_id,$logged_in_user,$limit)
    {
        $this->db->select('cp.*,u.name,u.user_image,count(DISTINCT cc.id) as tot_coin, count(DISTINCT cc1.id) as is_coined,count(DISTINCT cl.id) as tot_like, count(DISTINCT cl1.id) as is_liked,count(DISTINCT cpc.id) as tot_comment,count(DISTINCT crp.id) as positive_rank,count(DISTINCT crn.id) as negetive_rank,count(DISTINCT cru.id) is_ranked, cru.rank');
        $this->db->from('challange_post cp');
        $this->db->join('users u', 'cp.user_id = u.id');
        $this->db->join('challange_post_coin cc', 'cp.id = cc.challange_post_id', 'left');
        $this->db->join('challange_post_coin cc1', 'cp.id = cc1.challange_post_id and cc1.user_id = ' . $logged_in_user, 'left');
        $this->db->join('challange_post_like cl', 'cp.id = cl.challange_post_id and cl.is_liked = 1', 'left');
        $this->db->join('challange_post_like cl1', 'cp.id = cl1.challange_post_id and cl1.is_liked = 1 and cl1.user_id = ' . $logged_in_user, 'left');
        $this->db->join('challange_post_comment cpc', 'cp.id = cpc.challange_post_id', 'left');
        $this->db->join('challange_post_rank crp','cp.id = crp.challange_post_id and crp.rank = 1','left');
        $this->db->join('challange_post_rank crn','cp.id = crn.challange_post_id and crn.rank = 0','left');
        $this->db->join('challange_post_rank cru','cp.id = cru.challange_post_id and cru.user_id = '.$logged_in_user,'left');
        $this->db->where('cp.challange_id = ' . $challange_id);
        $this->db->order_by('(count(DISTINCT crp.id) - count(DISTINCT crn.id))', 'desc');
        $this->db->group_by('cp.id');
        //$this->db->limit($limit);
        $post = $this->db->get()->result_array();
        $post_ids = array_column($post, 'id');

        if (count($post_ids) > 0) {
            $this->db->where_in('p.challange_post_id', $post_ids);
            $this->db->select('p.*, u.name, u.user_image, count(DISTINCT pl.id) as cnt_like, count(DISTINCT pr.id) as cnt_reply, count(pli.id) as is_liked');
            $this->db->from('challange_post_comment p');
            $this->db->join('users u', 'p.user_id = u.id');
            $this->db->join('challange_post_comments_like pl', 'p.id = pl.challange_post_comment_id and pl.is_liked=1', 'left');
            $this->db->join('challange_post_comments_like pli', 'p.id = pli.challange_post_comment_id and pli.is_liked=1 and pli.user_id=' . $logged_in_user, 'left');
            $this->db->join('challange_post_comments_reply pr', 'p.id = pr.challange_post_comment_id', 'left');
            $this->db->order_by('p.created_date', 'desc');
            $this->db->group_by('p.id');

            $post_comments = $this->db->get()->result_array();
            $post_comments_ids = array_column($post_comments, 'challange_post_id');
            if (count($post_comments_ids) > 0) {
                for ($i = 0; $i < count($post); ++$i) {
                    $post[$i]['comments'] = array();
                    if (in_array($post[$i]['id'], $post_comments_ids)) {
                        $posts = array();
                        foreach ($post_comments as $value) {
                            if ($post[$i]['id'] == $value['challange_post_id']) {
                                $posts[] = $value;
                            }
                        }
                        $post[$i]['comments'] = $posts;
                    }
                }
            }
        }
        return $post;
    }
    
    /*
     * 
     */
    public function user_rank_exist_for_challenge($uid,$challenge_id)
    {
        $where['user_id'] = $uid;
        $where['challange_id'] = $challenge_id;
        $this->db->where($where);
        return $this->db->get('challange_rank')->row_array();
    }
    
    public function update_challenge_rank($array, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('challange_rank', $array)) {
            return true;
        }
        return false;
    }

    /*
     * add_post_rank is used to add rank to particular challenge
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 		false, if fail
     * developed by : ar
     */
    public function add_challenge_rank($array) {
        if ($this->db->insert('challange_rank', $array)) {
            return true;
        }
        return false;
    }
    
    /*
     * change_challenge_average_rank is used to change average rank of the challenge
     * @param   $challenge_id   int     specify challeranknge id
     * @param   $rank_number    int     specify the rank number to increase or decrese e.g. if rank_number is 2, then average rank is increased by 2, if rank_number is -1, then average rank is decresed by 1.
     * 
     * @return  true, if success
     *          false, if fail
     * developed by : ar
     */
    public function change_challenge_average_rank($challenge_id,$rank_number)
    {
        $this->db->where('id',$challenge_id);
        $this->db->set('average_rank',"average_rank + ".$rank_number,false);
        if($this->db->update('challanges'))
        {
            return true;
        }
        return false;
    }
}
?>