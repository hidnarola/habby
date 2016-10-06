<?php

class Post_model extends CI_Model {
    /*
     * add_post is used to insert post in database
     * @param $post_arr array[] specify input fields for post table
     * 
     * @return int, if insert successfully then return last inserted id
     * 			false, if insert fails
     * develop by : ar
     */

    public function add_post($post_arr) {
        if ($this->db->insert('post', $post_arr)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /*
     * smileshare_post is used to display post that only having media according pagination
     * @param $data 	array[]	specify where condition
     * @param $logged_in_user int user_id of logged in user
     * @param $start 	int 	specify start position for pagination
     * @param $limit 	int 	specify page size
     * 
     * @return array[][] return found record as per condition
     * developed by : ar
     */

    public function smileshare_post($data, $logged_in_user, $start = 0, $limit = 0) {
        $this->db->select('p.*,u.name as post_user,u.user_image as post_user_profile,count(pc.post_id) as post_coin, count(pl.post_id) as post_like, count(pco.post_id) as post_comment, count(ps.post_id) as post_share, count(pcoin.post_id) as is_coined, count(pli.post_id) as is_liked, count(sp.post_id) as is_saved, pm.media');
        $this->db->from('post p');
        $this->db->join('users u', 'p.user_id = u.id');
        $this->db->join('post_coin pc', 'p.id = pc.post_id', 'left');
        $this->db->join('post_coin pcoin', 'p.id = pcoin.post_id and pcoin.user_id=' . $logged_in_user, 'left');
        $this->db->join('post_like pl', 'p.id = pl.post_id and pl.is_liked=1', 'left');
        $this->db->join('post_like pli', 'p.id = pli.post_id and pli.is_liked=1 and pli.user_id=' . $logged_in_user, 'left');
        $this->db->join('post_comments pco', 'p.id = pco.post_id', 'left');
        $this->db->join('post_share ps', 'p.id = ps.post_id', 'left');
        $this->db->join('saved_post sp', 'p.id = sp.post_id and sp.user_id=' . $logged_in_user, 'left');
        $this->db->join('post_media pm', 'p.id = pm.post_id');
        $this->db->order_by('p.id', 'desc');
        $this->db->group_by('p.id');
        $post = $this->db->get()->result_array();
        
        $post_ids = array_column($post, 'id');

        $this->db->where_in('post_id', $post_ids);
        $this->db->select('p.*, u.name, u.user_image, count(pl.post_comment_id) as cnt_like, count(pr.post_comment_id) as cnt_reply');
        $this->db->from('post_comments p');
        $this->db->join('post_comment_like pl','p.id = pl.post_comment_id','left');
        $this->db->join('post_comment_reply pr','p.id = pr.post_comment_id','left');
        $this->db->join('users u','p.user_id = u.id');
        $this->db->order_by('p.created_date', 'desc');
        $this->db->group_by('p.id');
        //$this->db->join();
        
        $post_comments = $this->db->get()->result_array();
        $post_comments_ids = array_column($post_comments, 'post_id');
        
        if(count($post_comments_ids) > 0)
        {
            for ($i = 0; $i < count($post);++$i) {
                $post[$i]['comments'] = array();
                if (in_array($post[$i]['id'], $post_comments_ids)) {
                    $posts = array();
                    foreach ($post_comments as $value) {
                        if ($post[$i]['id'] == $value['post_id']) {
                            $posts[] = $value;
                        }
                    }
                    $post[$i]['comments'] = $posts;
                }
            }
        }
        return $post;
    }

    /*
     * challange_post is used to display all post according pagination
     * @param $data 	array[]	specify where condition
     * @param $logged_in_user int user_id of logged in user
     * @param $start 	int 	specify start position for pagination
     * @param $limit 	int 	specify page size
     * 
     * @return array[][] return found record as per condition
     * developed by : ar
     */

    public function challange_post($data, $logged_in_user, $start = 0, $limit = 0) {
        $this->db->select('p.*,u.name as post_user,u.user_image as post_user_profile,count(pc.post_id) as post_coin, count(pl.post_id) as post_like, count(pco.post_id) as post_comment, count(ps.post_id) as post_share, count(pcoin.post_id) as is_coined, count(pli.post_id) as is_liked, count(sp.post_id) as is_saved');
        $this->db->from('post p');
        $this->db->join('users u', 'p.user_id = u.id');
        $this->db->join('post_coin pc', 'p.id = pc.post_id', 'left');
        $this->db->join('post_coin pcoin', 'p.id = pcoin.post_id and pcoin.user_id=' . $logged_in_user, 'left');
        $this->db->join('post_like pl', 'p.id = pl.post_id and pl.is_liked=1', 'left');
        $this->db->join('post_like pli', 'p.id = pli.post_id and pli.is_liked=1 and pli.user_id=' . $logged_in_user, 'left');
        $this->db->join('post_comments pco', 'p.id = pco.post_id', 'left');
        $this->db->join('post_share ps', 'p.id = ps.post_id', 'left');
        $this->db->join('saved_post sp', 'p.id = sp.post_id and sp.user_id=' . $logged_in_user, 'left');
        $this->db->order_by('p.id', 'desc');
        $this->db->group_by('p.id');
        $post = $this->db->get()->result_array();

        $post_ids = array_column($post, 'id');

        $this->db->where_in('post_id', $post_ids);
        $post_media = $this->db->get('post_media')->result_array();
        $post_media_ids = array_column($post_media, 'post_id');

        if(count($post_media_ids) > 0)
        {
            for ($i = 0; $i < count($post);  ++$i) {
                $post[$i]['media'] = '';
                if (in_array($post[$i]['id'], $post_media_ids)) {
                    $posts = array();
                    foreach ($post_media as $value) {
                        if ($post[$i]['id'] == $value['post_id']) {
                            $posts[] = $value;
                        }
                    }
                    $post[$i]['media'] = $posts;
                }
            }
        }
        
        $this->db->where_in('post_id', $post_ids);
        $this->db->select('p.*, u.name, u.user_image, count(pl.post_comment_id) as cnt_like, count(pr.post_comment_id) as cnt_reply');
        $this->db->from('post_comments p');
        $this->db->join('post_comment_like pl','p.id = pl.post_comment_id','left');
        $this->db->join('post_comment_reply pr','p.id = pr.post_comment_id','left');
        $this->db->join('users u','p.user_id = u.id');
        $this->db->order_by('p.created_date', 'desc');
        $this->db->group_by('p.id');
        //$this->db->join();
        
        $post_comments = $this->db->get()->result_array();
        $post_comments_ids = array_column($post_comments, 'post_id');
        
        if(count($post_comments_ids) > 0)
        {
            for ($i = 0; $i < count($post);++$i) {
                $post[$i]['comments'] = array();
                if (in_array($post[$i]['id'], $post_comments_ids)) {
                    $posts = array();
                    foreach ($post_comments as $value) {
                        if ($post[$i]['id'] == $value['post_id']) {
                            $posts[] = $value;
                        }
                    }
                    $post[$i]['comments'] = $posts;
                }
            }
        }
        return $post;
    }

    /*
     * add_post_like is used to give like to particular post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 			false, if fail
     * developed by : ar
     */

    public function add_post_like($array) {
        if ($this->db->insert('post_like', $array)) {
            return true;
        }
        return false;
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
        $where['post_id'] = $post_id;
        $this->db->where($where);
        return $this->db->get('post_like')->row_array();
        //return $this->db->where('user_id',$user_id)->where('post_id',$post_id)->count_all_results('post_like');
    }

    /*
     * update_post_like is used to update like status to particular post
     * @param $array array[] specify fields that going to insert
     *
     * return 	true, if success
     * 			false, if fail
     * developed by : ar
     */

    public function update_post_like($array, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('post_like', $array)) {
            return true;
        }
        return false;
    }

    /*
     * save_post is used to save post to user's personal page
     * @param $array array[] input fields
     * 
     * @return boolean	true, if success
     * 					false, if fail
     * developed by : ar
     */

    public function save_post($array) {
        if ($this->db->insert('saved_post', $array)) {
            return true;
        }
        return false;
    }

    /*
     * add_post_coin is used to add coin to given value
     * @param $array array[] input fields
     * 
     * @return boolean	true, if success
     * 					false, if fail
     * developed by : ar
     */

    public function add_post_coin($array) {
        if ($this->db->insert('post_coin', $array)) {
            return true;
        }
        return false;
    }

    /*
     * delete_post_coin is used to delete coin to given value
     * @param $post_coin_id int unique id field of post_coin table
     * 
     * @return boolean	true, if success
     * 					false, if fail
     * developed by : ar
     */

    public function delete_post_coin($post_coin_id) {
        $where['id'] = $post_coin_id;
        if ($this->db->delete('post_coin', $where)) {
            return true;
        }
        return false;
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
        $where['post_id'] = $post_id;
        $this->db->where($where);
        return $this->db->get('post_coin')->row_array();
        //return $this->db->where('user_id',$user_id)->where('post_id',$post_id)->count_all_results('post_like');
    }

    /*
     * insert_post_media is used to insert multiple row in post media table
     * @param $arr array[][] specify input data
     *
     * @return 	int 	number of rows inserted, if success
     * 			boolean	false, if fail
     * developed by : ar
     */

    public function insert_post_media($arr) {
        return $this->db->insert_batch('post_media', $arr);
    }

    /*
     * insert_post_comment is used to insert comments to the post
     * @param $arr array[] input data
     * 
     * @return boolean true, if success
     *                  false, if fail
     * developed by : ar
     */
    public function insert_post_comment($arr)
    {
        if($this->db->insert('post_comments',$arr))
        {
            return true;
        }
        return false;
    }
}
?>