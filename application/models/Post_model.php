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
        $this->db->select('p.*,u.name as post_user,u.user_image as post_user_profile,count(DISTINCT pc.id) as post_coin, count(DISTINCT pl.id) as post_like, count(DISTINCT pco.id) as post_comment, count(DISTINCT ps.id) as post_share, count(DISTINCT pcoin.id) as is_coined, count(DISTINCT pli.id) as is_liked, count(DISTINCT sp.id) as is_saved, pm.media');
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
        $this->db->where('p.is_block','0');
        $this->db->where('p.is_deleted','0');
        $this->db->order_by('p.id', 'desc');
        $this->db->group_by('p.id');
        $this->db->limit($limit, $start);
        $post = $this->db->get()->result_array();

        $post_ids = array_column($post, 'id');

        if (count($post_ids) > 0) {
            $this->db->where_in('post_id', $post_ids);
            $post_media = $this->db->get('post_media')->result_array();
            $post_media_ids = array_column($post_media, 'post_id');

            if (count($post_media_ids) > 0) {
                for ($i = 0; $i < count($post); ++$i) {
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

            // Post comments
            $this->db->where_in('p.post_id', $post_ids);
            $this->db->select('p.*, u.name, u.user_image, count(DISTINCT pl.id) as cnt_like, count(DISTINCT pr.id) as cnt_reply, count(pli.id) as is_liked');
            $this->db->from('post_comments p');
            $this->db->join('users u', 'p.user_id = u.id');
            $this->db->join('post_comment_like pl', 'p.id = pl.post_comment_id and pl.is_liked=1', 'left');
            $this->db->join('post_comment_like pli', 'p.id = pli.post_comment_id and pli.is_liked=1 and pli.user_id=' . $logged_in_user, 'left');
            $this->db->join('post_comment_reply pr', 'p.id = pr.post_comment_id', 'left');
            $this->db->order_by('p.created_date', 'desc');
            $this->db->group_by('p.id');
            //$this->db->join();

            $post_comments = $this->db->get()->result_array();
            //        echo $this->db->last_query();
            $post_comments_ids = array_column($post_comments, 'post_id');
            //        pr($post_comments,1);
            if (count($post_comments_ids) > 0) {
                for ($i = 0; $i < count($post); ++$i) {
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
        $post = $this->db->query("select * from (select (sum(if(rank = 1, 1, 0)) - sum(if(rank = 0, 1, 0))) AS avg_rank, c.name,c.description, c.id, cu.name as challange_user,cu.user_image as challange_user_image, post_rank.challange_post_id, post.media,post.media_type, pu.name as post_user,pu.user_image as post_user_image,  count(DISTINCT cc.id) as tot_coin, count(DISTINCT cc1.id) as is_coined, count(DISTINCT cl.id) as tot_like, count(DISTINCT cl1.id) as is_liked, count(DISTINCT cpc.id) as tot_comment  from challange_post_rank post_rank left join challange_post post on post.id = post_rank.challange_post_id left join challanges c on c.id = post.challange_id join users cu on cu.id = c.user_id join users pu on pu.id = post.user_id  left join challange_post_coin cc on post.id = cc.challange_post_id left join challange_post_coin cc1 on post.id = cc1.challange_post_id and cc1.user_id = 7 left join challange_post_like cl on post.id = cl.challange_post_id and cl.is_liked = 1 left join challange_post_like cl1 on post.id = cl1.challange_post_id and cl1.is_liked = 1 and cl1.user_id = 7 left join challange_post_comment cpc on post.id = cpc.challange_post_id  group by post_rank.challange_post_id order by avg_rank desc) a group by a.id having avg_rank >= 0")->result_array();

        $post_ids = array_column($post, 'challange_post_id');

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

    public function insert_post_comment($arr) {
        if ($this->db->insert('post_comments', $arr)) {
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
        $this->db->select('p.*, u.name, u.user_image, count(pl.post_comment_id) as cnt_like, count(pr.post_comment_id) as cnt_reply');
        $this->db->from('post_comments p');
        $this->db->join('post_comment_like pl', 'p.id = pl.post_comment_id', 'left');
        $this->db->join('post_comment_reply pr', 'p.id = pr.post_comment_id', 'left');
        $this->db->join('users u', 'p.user_id = u.id and p.id = ' . $post_comment_id);
        return $this->db->get()->row_array();
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
        if ($this->db->insert('post_comment_like', $array)) {
            return true;
        }
        return false;
    }

    /*
     * user_like_exist_for_postcomment is used to check, if user has given like to particular comment of post
     * @param $user_id	int 	specify user_id
     * @param $post_comment_id 	int 	specify post_comment_id
     *
     * @return boolean 	true, if user entry exist for post
     * 					false, if not exist
     * developed by : ar
     */

    public function user_like_exist_for_postcomment($user_id, $post_comment_id) {
        $where['user_id'] = $user_id;
        $where['post_comment_id'] = $post_comment_id;
        $this->db->where($where);
        return $this->db->get('post_comment_like')->row_array();
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
        if ($this->db->update('post_comment_like', $array)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */

    public function get_post_reply($post_comment_id) {
        $this->db->select('u.name, u.user_image,r.comment, r.created_date');
        $this->db->from('post_comment_reply r');
        $this->db->join('users u', 'r.user_id = u.id and r.post_comment_id = ' . $post_comment_id);
        $this->db->group_by('r.created_date', 'asc');
        return $this->db->get()->result_array();
    }

    /*
     * 
     */

    public function insert_post_comment_reply($arr) {
        if ($this->db->insert('post_comment_reply', $arr)) {
            return true;
        }
        return false;
    }

    /*
     * 
     */

    public function get_post_comment_reply_data_by_id($post_comment_reply_id) {
        $this->db->select('p.*, u.name, u.user_image');
        $this->db->from('post_comment_reply p');
        $this->db->join('users u', 'p.user_id = u.id and p.id = ' . $post_comment_reply_id);
        return $this->db->get()->row_array();
    }

    public function get_post_details($post_id) {
        $this->db->select('p.*,u.name as post_user,u.user_image as post_user_profile,count(DISTINCT pc.id) as post_coin, count(DISTINCT pl.id) as post_like, count(DISTINCT pco.id) as post_comment, count(DISTINCT ps.id) as post_share');
        $this->db->from('post p');
        $this->db->where('p.id', $post_id);
        $this->db->join('users u', 'p.user_id = u.id');
        $this->db->join('post_coin pc', 'p.id = pc.post_id', 'left');
        $this->db->join('post_like pl', 'p.id = pl.post_id and pl.is_liked=1', 'left');
        $this->db->join('post_comments pco', 'p.id = pco.post_id', 'left');
        $this->db->join('post_share ps', 'p.id = ps.post_id', 'left');
        $this->db->order_by('p.id', 'desc');
        $this->db->group_by('p.id');
        $post = $this->db->get()->row_array();

        if (!empty($post)) {
            $this->db->where('post_id', $post['id']);
            $post_media = $this->db->get('post_media')->result_array();
            $post_media_ids = array_column($post_media, 'post_id');

            if (count($post_media_ids) > 0) {
                $post['media'] = '';
                if (in_array($post['id'], $post_media_ids)) {
                    $posts = array();
                    foreach ($post_media as $value) {
                        if ($post['id'] == $value['post_id']) {
                            $posts[] = $value;
                        }
                    }
                    $post['media'] = $posts;
                }
            }

            $this->db->where('p.post_id', $post['id']);
            $this->db->select('p.*, u.name, u.user_image, count(DISTINCT pl.id) as cnt_like, count(DISTINCT pr.id) as cnt_reply');
            $this->db->from('post_comments p');
            $this->db->join('users u', 'p.user_id = u.id');
            $this->db->join('post_comment_like pl', 'p.id = pl.post_comment_id and pl.is_liked=1', 'left');
            $this->db->join('post_comment_reply pr', 'p.id = pr.post_comment_id', 'left');
            $this->db->order_by('p.created_date', 'desc');
            $this->db->group_by('p.id');
            //$this->db->join();

            $post_comments = $this->db->get()->result_array();
            //        echo $this->db->last_query();
            $post_comments_ids = array_column($post_comments, 'post_id');
            //        pr($post_comments,1);
            if (count($post_comments_ids) > 0) {
                $post['comments'] = array();
                if (in_array($post['id'], $post_comments_ids)) {
                    $posts = array();
                    foreach ($post_comments as $value) {
                        if ($post['id'] == $value['post_id']) {
                            $posts[] = $value;
                        }
                    }
                    $post['comments'] = $posts;
                }
            }
        }
        return $post;
    }

}

?>