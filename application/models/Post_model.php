<?php
class Post_model extends CI_Model
{
	/*
	 * add_post is used to insert post in database
	 * @param $post_arr array[] specify input fields for post table
	 * 
	 * @return int, if insert successfully then return last inserted id
	 *			false, if insert fails
	 * develop by : ar
	 */
	public function add_post($post_arr)
	{
		if($this->db->insert('post',$post_arr))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/*
	 * display_post is used to display post according pagination
	 * @param $data 	array[]	specify where condition
	 * @param $logged_in_user int user_id of logged in user
	 * @param $start 	int 	specify start position for pagination
	 * @param $limit 	int 	specify page size
	 * 
	 * @return array[][] return found record as per condition
	 * developed by : ar
	 */
	public function display_post($data,$logged_in_user,$start=0,$limit=0)
	{
		$this->db->select('p.*,u.name as post_user,u.user_image as post_user_profile,count(pc.post_id) as post_coin, count(pl.post_id) as post_like, count(pco.post_id) as post_comment, count(ps.post_id) as post_share, count(pli.post_id) as is_liked, count(sp.post_id) as is_saved');
		$this->db->from('post p');
		$this->db->join('users u','p.user_id = u.id');
		$this->db->join('post_coin pc','p.id = pc.post_id','left');
		$this->db->join('post_like pl','p.id = pl.post_id and pl.is_liked=1','left');
		$this->db->join('post_like pli','p.id = pli.post_id and pli.is_liked=1 and pli.user_id='.$logged_in_user,'left');
		$this->db->join('post_comments pco','p.id = pco.post_id','left');
		$this->db->join('post_share ps','p.id = ps.post_id','left');
		$this->db->join('saved_post sp','p.id = sp.post_id and sp.user_id='.$logged_in_user,'left');
		$this->db->order_by('p.id','desc');
		$this->db->group_by('p.id');
		return $this->db->get()->result_array();
	}

	/*
	 * add_post_like is used to give like to particular post
	 * @param $array array[] specify fields that going to insert
	 *
	 * return 	true, if success
	 *			false, if fail
	 * developed by : ar
	 */
	public function add_post_like($array)
	{
		if($this->db->insert('post_like',$array))
		{
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
	 *					false, if not exist
	 * developed by : ar
	 */
	public function user_like_exist_for_post($user_id,$post_id)
	{
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
	 *			false, if fail
	 * developed by : ar
	 */
	public function update_post_like($array,$id)
	{
		$this->db->where('id',$id);
		if($this->db->update('post_like',$array))
		{
			return true;
		}
		return false;
	}

	/*
	 *
	 *
	 */
	public function save_post($array)
	{
		if($this->db->insert('saved_post',$array))
		{
			return true;
		}
		return false;
	}
}
?>