<?php

class Admin_challenge_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_challenge() {
        $start = $this->input->get('start');
        $columns = ['ch.id', 'ch.name', 'ch.rewards', 'COUNT(chu.user_id) as total_joined', 'ch.average_rank', 'ch.is_finished', 'u.name'];
        $this->db->select('ch.id,@a:=@a+1 AS test_id,ch.name,ch.rewards,COUNT(chu.user_id) as total_joined,ch.average_rank,ch.is_finished,u.name as user_name,ch.is_deleted,ch.is_blocked', false);
        $this->db->join('challange_user chu', 'chu.challange_id = ch.id', 'left');
        $this->db->join('users u', 'u.id = ch.user_id');
        $this->db->where('ch.is_deleted', 0);
        $this->db->group_by('ch.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('ch.name LIKE "%' . $keyword['value'] . '%" OR ch.rewards LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('challanges ch,(SELECT @a:= ' . $start . ') AS a')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_challenge_count() {
        $columns = ['ch.id', 'ch.name', 'ch.rewards', 'total_joined', 'ch.average_rank', 'ch.is_finished', 'u.name'];
        $this->db->join('challange_user chu', 'chu.challange_id = ch.id', 'left');
        $this->db->join('users u', 'u.id = ch.user_id');
        $this->db->where('ch.is_deleted', 0);
        $this->db->group_by('ch.id');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('ch.name LIKE "%' . $keyword['value'] . '%" OR ch.rewards LIKE "%' . $keyword['value'] . '%" OR u.name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $res_data = $this->db->get('challanges ch')->num_rows();
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
    public function get_challenge_result($group_id) {
        $this->db->select('ch.name,ch.description,ch.rewards,u.name as user_name,u.user_image,ch.created_date');
        $this->db->join('users u', 'u.id=ch.user_id');
        $this->db->where('ch.id', $group_id);
        $res_data = $this->db->get('challanges ch')->row_array();
        return $res_data;
    }

    /**
     * @uses : This function is used get result from the table
     * @param : @table 
     * @author : HPA
     */
    public function get_challenge_results($group_id) {
        $this->db->select('ch.name,ch.description,ch.rewards,u.name as user_name,u.user_image,(SELECT GROUP_CONCAT(chu1.user_id) from challange_user chu1 JOIN `challanges` `ch1` ON `ch1`.`id`=`chu1`.`challange_id` where chu1.challange_id = ' . $group_id . ')AS joined_user,COUNT(chu.user_id) as Total_User,ch.created_date,(SELECT GROUP_CONCAT(chp.id) from challange_post chp where chp.challange_id = ' . $group_id . ')AS challenge_post');
        $this->db->join('users u', 'u.id=ch.user_id');
        $this->db->join('challange_user chu', 'ch.id=chu.user_id');
        $this->db->where('ch.id', $group_id);
        $res_data = $this->db->get('challanges ch')->row_array();
        $joied_users = explode(',', $res_data['joined_user']);
        foreach ($joied_users as $joied_user_id) {
            $this->db->select('name as joined_user_name,user_image as joined_user_image');
            $this->db->where('id', $joied_user_id);
            $users[$joied_user_id] = $this->db->get('users')->row_array();
        }
        $res_data['joined_user'] = $users;
        $posts = explode(',', $res_data['challenge_post']);
        foreach ($posts as $post_id) {
            $this->db->select('chp.id,chp.media,chp.media_type,u.name as post_user_name,u.user_image as post_user_image,count(DISTINCT cc.id) as tot_coin,count(DISTINCT cl.id) as tot_like,count(DISTINCT cpc.id) as tot_comment,count(DISTINCT crp.id) as positive_rank,count(DISTINCT crn.id) as negetive_rank');
            $this->db->join('users u', 'u.id=chp.user_id');
            $this->db->join('challange_post_coin cc', 'chp.id = cc.challange_post_id', 'left');
            $this->db->join('challange_post_like cl', 'chp.id = cl.challange_post_id and cl.is_liked = 1', 'left');
            $this->db->join('challange_post_comment cpc', 'chp.id = cpc.challange_post_id', 'left');
            $this->db->join('challange_post_rank crp', 'chp.id = crp.challange_post_id and crp.rank = 1', 'left');
            $this->db->join('challange_post_rank crn', 'chp.id = crn.challange_post_id and crn.rank = 0', 'left');
            $this->db->where('chp.id', $post_id);
            $c_posts[] = $this->db->get('challange_post chp')->row_array();
        }
        $post_ids = array_column($c_posts, 'id');
        if (count($post_ids) > 0) {
            $this->db->where_in('p.challange_post_id', $post_ids);
            $this->db->select('p.*, u.name, u.user_image, count(DISTINCT pl.id) as cnt_like, count(DISTINCT pr.id) as cnt_reply');
            $this->db->from('challange_post_comment p');
            $this->db->join('users u', 'p.user_id = u.id');
            $this->db->join('challange_post_comments_like pl', 'p.id = pl.challange_post_comment_id and pl.is_liked=1', 'left');
            $this->db->join('challange_post_comments_reply pr', 'p.id = pr.challange_post_comment_id', 'left');
            $this->db->order_by('p.created_date', 'desc');
            $this->db->group_by('p.id');

            $post_comments = $this->db->get()->result_array();
            $post_comments_ids = array_column($post_comments, 'challange_post_id');
            $comments_ids = array_column($post_comments, 'id');
            if (count($comments_ids) > 0) {
                $this->db->select('cp.*, u.name, u.user_image');
                $this->db->from('challange_post_comments_reply cp');
                $this->db->where_in('challange_post_comment_id', $comments_ids);
                $this->db->join('users u', 'cp.user_id = u.id');
                $post_replies = $this->db->get()->result_array();
                if (count($post_replies) > 0) {
                    for ($i = 0; $i < count($post_comments); ++$i) {
                        $post_comments[$i]['comment_replies'] = array();
                        $posts = array();
                        foreach ($post_replies as $value) {
                            if ($post_comments[$i]['id'] == $value['challange_post_comment_id']) {
                                $posts[] = $value;
                            }
                        }
                        $post_comments[$i]['comment_replies'] = $posts;
                    }
                }
            }
            if (count($post_comments_ids) > 0) {
                for ($i = 0; $i < count($c_posts); ++$i) {
                    $c_posts[$i]['comments'] = array();
                    if (in_array($c_posts[$i]['id'], $post_comments_ids)) {
                        $posts = array();
                        foreach ($post_comments as $value) {
                            if ($c_posts[$i]['id'] == $value['challange_post_id']) {
                                $posts[] = $value;
                            }
                        }
                        $c_posts[$i]['comments'] = $posts;
                    }
                }
            }
        }

        $res_data['challenge_post'] = $c_posts;
        return $res_data;
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

}

?>