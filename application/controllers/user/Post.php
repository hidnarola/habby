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
	 * return 	true, if success
	 *			false, if fail
	 * developed by : ar
	 */
	public function add_like($post_id)
	{
		$user_id = $this->session->user['id'];
		if(!empty($this->Post_model->user_like_exist_for_post($user_id,$post_id)))
		{
			// Update entry
			$update_arr['user_id'] = $user_id;
			$update_arr['post_id'] = $post_id;
			$update_arr['is_liked'] = "1";
			$update_arr['created_date'] = date('Y-m-d H:i:s');

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
}
?>