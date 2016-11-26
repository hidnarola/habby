<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Post_model', 'Users_model'));
    }

    /*
     * add_like is used to give like to particular post
     * @param $post_id int specify post_id
     *
     * echo '-1', if user displike the post,
     *   	'1', if user like the post,
     * 		'0', if operation fail
     * developed by : ar
     */

    public function add_like($post_id) {
        $user_id = $this->session->user['id'];
        if (!empty($like = $this->Post_model->user_like_exist_for_post($user_id, $post_id))) {
            // Update entry
            $update_arr['is_liked'] = !$like['is_liked'];
            $update_arr['created_date'] = date('Y-m-d H:i:s');
            if ($this->Post_model->update_post_like($update_arr, $like['id'])) {
                if ($like['is_liked']) {
                    echo '-1';
                } else {
                    echo '1';
                }
            } else {
                echo '0';
            }
        } else {
            // Insert entry
            $insert_arr['user_id'] = $user_id;
            $insert_arr['post_id'] = $post_id;
            $insert_arr['is_liked'] = "1";
            if ($this->Post_model->add_post_like($insert_arr)) {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    /*
     * save_post is used to save post to the user personal page
     * @param $post_id int specify post_id that is going to share
     * 
     * echo '1', if post was saved
     * 		'0', if post was failed
     * developed by : ar
     */

    public function save_post($post_id) {
        $insert_arr['user_id'] = $this->session->user['id'];
        $insert_arr['post_id'] = $post_id;
        if ($this->Post_model->save_post($insert_arr)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    /*
     * add_coin is used to add coin to particular post
     * @param $post_id int specify post_id
     *
     * echo '1', if coin added
     * 		'2', coin deleted
     * 		'0', operation fail 
     */

    public function add_coin($post_id) {
        $user_id = $this->session->user['id'];
        if (!empty($coin = $this->Post_model->user_coin_exist_for_post($user_id, $post_id))) {
            // Update entry
            /*
              if ($this->Post_model->delete_post_coin($coin['id'])) {
              echo '2';
              } else {
              echo '0';
              } */
            echo '2';
        } else {
            $userdata = $this->Users_model->check_if_user_exist(['id' => $user_id], false, true);
            if ($userdata['total_coin'] > 0) {
                $insert_arr['user_id'] = $user_id;
                $insert_arr['post_id'] = $post_id;
                if ($this->Post_model->add_post_coin($insert_arr)) {
                    // Add or deduct coin from user's account
                    $this->Users_model->deduct_coin_from_user($user_id);
                    $this->Users_model->add_coin_to_user($this->get_post_user($post_id));
                    echo '1';
                } else {
                    echo '0';
                }
            } else {
                echo '3';
            }
            // Insert entry
        }
    }

    /*
     * add_comment is used to add comment on the post
     * @param $post_id int specify post_id
     * 
     * echo '1', if comment added
     *      '0', if comment not added
     * developed by : ar
     */

    public function add_comment($post_id) {
        if ($this->input->post()) {
            $insert_arr['post_id'] = $post_id;
            $insert_arr['user_id'] = $this->session->user['id'];
            $insert_arr['comment'] = $this->input->post('msg');
            if ($this->Post_model->insert_post_comment($insert_arr)) {
                // Create post comment content
                $data['comment'] = $this->Post_model->get_post_comment_data_by_id($this->db->insert_id());
                $this->load->view('user/partial/add_comment', $data);
            } else {
                echo '0';
            }
        }
    }

    /*
     * 
     */

    public function add_postcomment_like($post_comment_id) {
        $user_id = $this->session->user['id'];
        if (!empty($like = $this->Post_model->user_like_exist_for_postcomment($user_id, $post_comment_id))) {
            // Update entry
            $update_arr['is_liked'] = !$like['is_liked'];
            $update_arr['created_date'] = date('Y-m-d H:i:s');
            if ($this->Post_model->update_postcomment_like($update_arr, $like['id'])) {
                if ($like['is_liked']) {
                    echo '-1';
                } else {
                    echo '1';
                }
            } else {
                echo '0';
            }
        } else {
            // Insert entry
            $insert_arr['user_id'] = $user_id;
            $insert_arr['post_comment_id'] = $post_comment_id;
            $insert_arr['is_liked'] = "1";
            if ($this->Post_model->add_postcomment_like($insert_arr)) {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    /*
     * 
     */

    public function display_comment_reply($post_comment_id) {
        $data['reply'] = $this->Post_model->get_post_reply($post_comment_id);
        $this->load->view('user/partial/display_comment_reply', $data);
    }

    /*
     * 
     */

    public function add_comment_reply($post_comment_id) {
        if ($this->input->post()) {
            $insert_arr['post_comment_id'] = $post_comment_id;
            $insert_arr['user_id'] = $this->session->user['id'];
            $insert_arr['comment'] = $this->input->post('msg');
            if ($this->Post_model->insert_post_comment_reply($insert_arr)) {
                // Create post comment content
                $data['reply'] = $this->Post_model->get_post_comment_reply_data_by_id($this->db->insert_id());
                $this->load->view('user/partial/add_comment_reply', $data);
            } else {
                echo '0';
            }
        }
    }

    /*
     * 
     */

    public function get_post_user($post_id) {
        $this->db->select('user_id');
        $this->db->where('id', $post_id);
        $row = $this->db->get('post')->row_array();
        return $row['user_id'];
    }

    /*
     * 
     */

    public function display_post($post_id) {
        $this->data['post'] = $this->Post_model->get_post_details($post_id);
        $this->load->view('user/post/display_single_post', $this->data);
    }

    /*
     * 
     */

    public function display_challenge_post($post_id) {
        $this->data['post'] = $this->Post_model->get_challenge_post_details($post_id);
        $this->load->view('user/post/display_single_post', $this->data);
    }

}

?>