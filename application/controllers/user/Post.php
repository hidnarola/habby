<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
	 var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Post_model','Users_model'));
    }

    /*
	 * add_like is used to give like to particular post
	 * @param $post_id int specify post_id
	 *
	 * echo '-1', if user displike the post,
	 *   	'1', if user like the post,
	 *		'0', if operation fail
	 * developed by : ar
	 */
	public function add_like($post_id)
	{
		$user_id = $this->session->user['id'];
		if(!empty($like = $this->Post_model->user_like_exist_for_post($user_id,$post_id)))
		{
			// Update entry
			$update_arr['is_liked'] = ! $like['is_liked'];
			$update_arr['created_date'] = date('Y-m-d H:i:s');
			if($this->Post_model->update_post_like($update_arr,$like['id']))
			{
				if($like['is_liked'])
				{
					echo '-1';
				}
				else
				{
					echo '1';
				}
			}
			else
			{
				echo '0';
			}
		}
		else
		{
			// Insert entry
			$insert_arr['user_id'] = $user_id;
			$insert_arr['post_id'] = $post_id;
			$insert_arr['is_liked'] = "1";
			if($this->Post_model->add_post_like($insert_arr))
			{
				echo '1';
			}
			else
			{
				echo '0';
			}
		}
	}

	/*
	 * save_post is used to save post to the user personal page
	 * @param $post_id int specify post_id that is going to share
	 * 
	 * echo '1', if post was saved
	 *		'0', if post was failed
	 * developed by : ar
	 */
	public function save_post($post_id)
	{
		$insert_arr['user_id'] = $this->session->user['id'];
		$insert_arr['post_id'] = $post_id;
		if($this->Post_model->save_post($insert_arr))
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
	}

	/*
	 * add_coin is used to add coin to particular post
	 * @param $post_id int specify post_id
	 *
	 * echo '1', if coin added
	 *		'2', coin deleted
	 *		'0', operation fail 
	 */
	public function add_coin($post_id)
	{
		$user_id = $this->session->user['id'];
		if(!empty($coin = $this->Post_model->user_coin_exist_for_post($user_id,$post_id)))
		{
			// Update entry
			if($this->Post_model->delete_post_coin($coin['id']))
			{
				echo '2';
			}
			else
			{
				echo '0';
			}
		}
		else
		{
			// Insert entry
			$insert_arr['user_id'] = $user_id;
			$insert_arr['post_id'] = $post_id;
			if($this->Post_model->add_post_coin($insert_arr))
			{
				echo '1';
			}
			else
			{
				echo '0';
			}
		}
	}
}
?>