<?php
class Post extends CI_Model
{
	/*
	 * add_post is used to insert post in database
	 * @param $post_arr array[] specify input fields for post table
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
}
?>