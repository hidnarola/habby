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
            $this->db->having('description LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
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
            $this->db->having('p.description LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
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
     * @uses : This function is used get result from the table
     * @param : @table 
     * @author : HPA
     */
    public function get_post_result($post_id) {
        $this->db->select('p.id,p.description,u.name,u.user_image');
        $this->db->join('users u', 'u.id=p.user_id');
        $this->db->where('p.id', $post_id);
        $post = $this->db->get('post p')->result_array();
        if (!empty($post)) {
            $this->db->where('post_id', $post_id);
            $post_media = $this->db->get('post_media')->result_array();
            $post_media_ids = array_column($post_media, 'post_id');

            if (count($post_media_ids) > 0) {
                $post[0]['media'] = '';
                if (in_array($post_id, $post_media_ids)) {
                    $posts = array();
                    foreach ($post_media as $value) {
                        if ($post_id == $value['post_id']) {
                            $posts[] = $value;
                        }
                    }
                    $post[0]['media'] = $posts;
                }
            }
        }
        return $post[0];
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
            $this->db->where('post_id', $post_id);
            $post_media = $this->db->get('post_media')->result_array();

            $post['media'] = '';

            $posts = array();
            foreach ($post_media as $value) {
                if ($post_id == $value['post_id']) {
                    $posts[] = $value;
                }
            }
            $post['media'] = $posts;

            $this->db->where('p.post_id', $post_id);
            $this->db->select('p.*, u.name, u.user_image, count(DISTINCT pl.id) as cnt_like, count(DISTINCT pr.id) as cnt_reply');
            $this->db->from('post_comments p');
            $this->db->join('users u', 'p.user_id = u.id');
            $this->db->join('post_comment_like pl', 'p.id = pl.post_comment_id and pl.is_liked=1', 'left');
            $this->db->join('post_comment_reply pr', 'p.id = pr.post_comment_id', 'left');
            $this->db->order_by('p.created_date', 'desc');
            $this->db->group_by('p.id');
            $post_comments = $this->db->get()->result_array();
            //$this->db->join();
            $post['comments'] = array();
            $posts = array();
            foreach ($post_comments as $value) {
                if ($post_id == $value['post_id']) {
                    $posts[] = $value;
                }
            }
            $post['comments'] = $posts;

            // fetch reply of comments
            $post_comments_ids = array_column($post['comments'], 'id');
            if (count($post_comments_ids) > 0) {
                $this->db->select('p.*, u.name, u.user_image');
                $this->db->from('post_comment_reply p');
                $this->db->where_in('post_comment_id', $post_comments_ids);
                $this->db->join('users u', 'p.user_id = u.id');
                $post_replies = $this->db->get()->result_array();

                if (count($post_replies) > 0) {
                    for ($i = 0; $i < count($post['comments']); ++$i) {
                        $post['comments'][$i]['comment_replies'] = array();
                        $posts = array();
                        foreach ($post_replies as $value) {
                            if ($post['comments'][$i]['id'] == $value['post_comment_id']) {
                                $posts[] = $value;
                            }
                        }
                        $post['comments'][$i]['comment_replies'] = $posts;
                    }
                }
            }
        }
        return $post;
    }

    /**
     * @uses : Insert posts record into table
     * @param : @table = table name, @array = array of insert
     * @return : insert_id else 0
     * @author : HPA
     */
    public function insert($table, $array) {
        if ($this->db->insert($table, $array)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function delete_post_media($post_media_id) {
        if ($post_media_id != null) {
            $this->db->where('id', $post_media_id);
            $this->db->delete('post_media');
            return true;
        }
        return false;
    }

}

?>