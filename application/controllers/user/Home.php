<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data;

    /*
     * constructor loads required data including banner image
     */

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Post_model', 'Event_model', 'Common_functionality', 'Topichat_model', 'Soulmate_model', 'Groupplan_model', 'Challenge_model', 'League_model'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('home');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    /*
     * index method loads home page view with all required details
     * develop by : ar
     */

    public function index() {
        $this->data['posts'] = $this->Post_model->smileshare_post($data = array(), $this->session->user['id'], 0, 3);
//      //   pr($this->data['posts'],1);
        $this->template->load('front', 'user/home.php', $this->data);
    }

    /*
     * smile_share method loads smile-share post with all required details
     * @param $page int specify page number that used for lazy loading
     * develop by : ar
     */

    public function smile_share($page = 1) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        $this->data['posts'] = $this->Post_model->smileshare_post($data = array(), $this->session->user['id'], $start, $limit);
        if ($page == 1) {
            $this->template->load('front', 'user/home.php', $this->data);
        } else {
            $data['view'] = $this->load->view('user/partial/load_post_data', $this->data, true);
            $data['status'] = '1';
            if (count($this->data['posts']) == 0) {
                $data['status'] = '0';
            }
            echo json_encode($data);
        }
    }

    /*
     * challenge method loads challenge post data with all required details
     * @param $page int specify page number that used for lazy loading
     * develop by : ar
     */

    public function challenge($page = 1) {
        $limit = 1;
        $start = ($page - 1) * $limit;
        $this->data['posts'] = $this->Post_model->challange_post($data = array(), $this->session->user['id'], $start, $limit);
        if ($page == 1) {
            $this->template->load('front', 'user/challenge.php', $this->data);
        } else {
            $data['view'] = $this->load->view('user/partial/load_chellenge_post', $this->data, true);
            $data['status'] = '1';
            if (count($this->data['posts']) == 0) {
                $data['status'] = '0';
            }
            echo json_encode($data);
        }
    }

    /*
     * add_post method is used to add post in database
     * develop by : ar
     */

    public function add_post() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('description', 'description', 'required');
            if (!($this->form_validation->run() == FALSE)) {
                $post_arr['description'] = $this->input->post('description');
                $post_arr['user_id'] = $this->session->user['id'];
                if ($post_id = $this->Post_model->add_post($post_arr)) {
                    $media = array();
                    if (!empty($_FILES['uploadfile']['name'])) {
                        $filecount = count($_FILES['uploadfile']['name']);
                        for ($i = 0; $i < $filecount; ++$i) {
                            $_FILES['userFile']['name'] = $_FILES['uploadfile']['name'][$i];
                            $_FILES['userFile']['type'] = $_FILES['uploadfile']['type'][$i];
                            $_FILES['userFile']['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
                            $_FILES['userFile']['error'] = $_FILES['uploadfile']['error'][$i];
                            $_FILES['userFile']['size'] = $_FILES['uploadfile']['size'][$i];

                            // Code of image uploading
                            $config['upload_path'] = './uploads/user_post';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['max_size'] = 1000000;
                            $config['file_name'] = md5(uniqid(mt_rand()));

                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('userFile')) {
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('msg', 'Problem occurs during image uploading.');
                            } else {
                                $data = $this->upload->data();
                                $media_arr = array();
                                $media_arr['post_id'] = $post_id;
                                $media_arr['media_type'] = 'image';
                                $media_arr['media'] = $data['file_name'];
                                $media[] = $media_arr;
                            }
                        }
                    }
                    if (!empty($_FILES['videofile']['name'])) {
                        $filecount = count($_FILES['videofile']['name']);
                        for ($i = 0; $i < $filecount; ++$i) {
                            $_FILES['userFile']['name'] = $_FILES['videofile']['name'][$i];
                            $_FILES['userFile']['type'] = $_FILES['videofile']['type'][$i];
                            $_FILES['userFile']['tmp_name'] = $_FILES['videofile']['tmp_name'][$i];
                            $_FILES['userFile']['error'] = $_FILES['videofile']['error'][$i];
                            $_FILES['userFile']['size'] = $_FILES['videofile']['size'][$i];

                            // Code of image uploading
                            $config['upload_path'] = './uploads/user_post';
                            $config['allowed_types'] = 'mp4|mov|3gp';
                            $config['max_size'] = 4000000;
                            $config['file_name'] = md5(uniqid(mt_rand()));

                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('userFile')) {
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('msg', 'Problem occurs during video uploading.');
                            } else {
                                $data = $this->upload->data();
                                $media_arr = array();
                                $media_arr['post_id'] = $post_id;
                                $media_arr['media_type'] = 'video';
                                $media_arr['media'] = $data['file_name'];
                                $media[] = $media_arr;
                            }
                        }
                    }
                    if (count($media) > 0) {
                        $this->Post_model->insert_post_media($media);
                    }
                    $this->session->set_flashdata('msg', 'post added successfully');
                } else {
                    $this->session->set_flashdata('msg', 'Post not added');
                }
            } else {
                $this->session->set_flashdata('msg', 'Invalid data entered for post');
            }
        }
        redirect('home');
    }

    /**
     * This function is used to log out from account.
     * develop by : HPA
     */
    public function log_out() {
        $this->session->sess_destroy();
        delete_cookie('Remember_me');
        $this->session->set_flashdata('message', array('message' => lang('Log out Successfully.'), 'class' => 'alert alert-success'));
        redirect('login', 'refresh');
    }

    /**
     * This function is used to display and edit logged in user details.
     * develop by : HPA
     */
    public function profile() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));
            if ($this->form_validation->run() == FALSE) {
                $user_id = $this->session->user['id']; // Change with the user_id for which you are displaying post
                $this->data['user_id'] = $user_id;
                $this->data['all_countries'] = $this->Users_model->get_all_countries();
                $this->data['posts'] = $this->Post_model->users_post($user_id, $this->session->user['id'], 0, 3);
                $this->data['saved_posts'] = $this->Post_model->saved_post($user_id, $this->session->user['id'], 0, 3);
                $this->data['followers'] = $this->Users_model->get_user_follower($user_id);
                $this->data['followings'] = $this->Users_model->get_user_following($user_id);
                $this->template->load('front', 'user/profile', $this->data);
            } else {
                $upd_data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'gender' => $this->input->post('gender'),
                    'country' => $this->input->post('country'),
                    'bio' => htmlentities($this->input->post('bio')),
                    'hobby' => $this->input->post('hobby'),
                );
                $last_user_id = $this->Users_model->update_user_data($this->data['user_data']['id'], $upd_data); // v!-q Insert Data into Users Table
                $this->session->set_flashdata('message', array('message' => lang('User Profile has been updated successfully.'), 'class' => 'alert alert-success'));
                redirect('home/profile');
            }
        } else {
            $user_id = $this->session->user['id']; // Change with the user_id for which you are displaying post
            $this->data['user_id'] = $user_id;
            $this->data['all_countries'] = $this->Users_model->get_all_countries();
            $this->data['posts'] = $this->Post_model->users_post($user_id, $this->session->user['id'], 0, 3);
            $this->data['saved_posts'] = $this->Post_model->saved_post($user_id, $this->session->user['id'], 0, 3);
            $this->data['followers'] = $this->Users_model->get_user_follower($user_id);
            $this->data['followings'] = $this->Users_model->get_user_following($user_id);
            $this->template->load('front', 'user/profile', $this->data);
        }
    }

    /*
     * load_user_post is used to display user's post with pagination
     * @param $user_id      int     specify user_id for which post will fetch
     * @param $page         int     specify page number
     * 
     * echo     JSON    to display post on profile page
     * developed by : ar
     */

    public function load_user_post($user_id, $page) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        $this->data['posts'] = $this->Post_model->users_post($user_id, $this->session->user['id'], $start, $limit);
        if (count($this->data['posts']) > 0) {
            $data['view'] = $this->load->view('user/partial/profile/load_user_post', $this->data, true);
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    /*
     * load_user_savepost is used to display user's save post with pagination
     * @param $user_id      int     specify user_id for which post will fetch
     * @param $page         int     specify page number
     * 
     * echo     JSON    to display post on profile page
     * developed by : ar
     */

    public function load_user_savepost($user_id, $page) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        $this->data['posts'] = $this->Post_model->saved_post($user_id, $this->session->user['id'], $start, $limit);
        if (count($this->data['posts']) > 0) {
            $data['view'] = $this->load->view('user/partial/profile/load_user_post', $this->data, true);
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    /**
     * This function is used to image upload.
     * develop by : HPA
     */
    public function profile_upload() {
        if ($_FILES) {

            /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
            $config['upload_path'] = './uploads/user_profile';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['min_width'] = '300';
            $config['min_height'] = '300';
            $config['encrypt_name'] = TRUE;
            $config['file_name'] = md5(uniqid(mt_rand()));

            //Initialize all params for the CI uplaod library
            $this->upload->initialize($config);

            // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
            // IF not fit into given parameter then set proper error message and redirect to car/pictire function
            if (!$this->upload->do_upload('user_image')) {

                $error = $this->upload->display_errors();

                if ($_FILES["user_image"]["tmp_name"] != '') {
                    $image_info = getimagesize($_FILES["user_image"]["tmp_name"]);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                }

                $this->session->set_flashdata('message', ['message' => $error, 'class' => 'alert alert-danger']);
                redirect('home/profile');
            } else {
                $data_upload = array('upload_data' => $this->upload->data());
                $image_name = $data_upload['upload_data']['file_name'];
//                $img_path = 'uploads/user_profile/' . $image_name;

                $this->Users_model->update_user_data($this->data['user_data']['id'], ['user_image' => $image_name]);

                $this->session->set_flashdata('message', ['message' => lang('Image has been uploaded successfully'), 'class' => 'alert alert-success']);
                redirect('home/profile');
            }
        }
    }

    /**
     * This function is used to display topichat groups details.
     * develop by : HPA
     */
    public function topichat($user_id = 0) {
        if ($user_id == 0) {
            $user_id = $this->session->user['id'];
            $this->data['notification'] = $this->Topichat_model->get_topic_notification_by_user_id($user_id, $start = 0, $limit = 10);
        } else {
            $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $user_id], false, true);
        }
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        $this->data['my_topichats'] = $this->Topichat_model->get_my_topichat_group($user_id);
        $this->data['joined_topichats'] = $this->Topichat_model->get_joined_topichat_group($user_id);
        $this->data['followers'] = $this->Users_model->get_user_follower($user_id);
        $this->data['followings'] = $this->Users_model->get_user_following($user_id);
        $this->template->load('front', 'user/topichat/home_topichat', $this->data);
    }

    /**
     * This function is used to display Soulmate groups details.
     * develop by : HPA
     */
    public function soulmate() {
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        $this->data['my_soulmates'] = $this->Soulmate_model->get_my_soulmate();
        $this->data['joined_soulmates'] = $this->Soulmate_model->get_joined_soulmate();
        $this->data['soulmate_reqs'] = $this->Soulmate_model->get_soulmate_request();
        $this->template->load('front', 'user/soulmate/home_soulmate', $this->data);
    }

    /**
     * This function is used to display group plans details.
     * develop by : HPA
     */
    public function groupplan() {
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        $this->data['my_groupplans'] = $this->Groupplan_model->get_my_groupplan();
        $this->data['joined_groupplans'] = $this->Groupplan_model->get_joined_groupplan();
        $this->data['groupplan_reqs'] = $this->Groupplan_model->get_groupplan_request();
        $this->template->load('front', 'user/groupplan/home_groupplan', $this->data);
    }

    /**
     * This function is used to display Challenges details.
     * develop by : HPA
     */
    public function challenges($user_id = 0) {
        if ($user_id == 0) {
            $user_id = $this->session->user['id'];
        } else {
            $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $user_id], false, true);
        }
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        $this->data['my_challenges'] = $this->Challenge_model->get_my_challenge($user_id);
        $this->data['joined_challenges'] = $this->Challenge_model->get_joined_challenge($user_id);
        $this->data['challenge_accepted'] = $this->Challenge_model->get_challenge_accepted($user_id);
        $this->data['followers'] = $this->Users_model->get_user_follower($user_id);
        $this->data['followings'] = $this->Users_model->get_user_following($user_id);
        $this->data['finish_challenges'] = $this->Challenge_model->get_finished_challenge($user_id);
        $this->template->load('front', 'user/challenge/home_challenge', $this->data);
    }

    /**
     * This function is used to display League groups details.
     * develop by : HPA
     */
    public function league($user_id = 0) {
        if ($user_id == 0) {
            $user_id = $this->session->user['id'];
        } else {
            $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $user_id], false, true);
        }
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        $this->data['my_leagues'] = $this->League_model->get_my_league($user_id);
        $this->data['joined_leagues'] = $this->League_model->get_joined_league($user_id);
        $this->data['followers'] = $this->Users_model->get_user_follower($user_id);
        $this->data['followings'] = $this->Users_model->get_user_following($user_id);
        $this->template->load('front', 'user/league/home_league', $this->data);
    }

    public function user_profile($user_id) {
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $user_id], false, true);
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        $this->data['followers'] = $this->Users_model->get_user_follower($user_id);
        $this->data['followings'] = $this->Users_model->get_user_following($user_id);
        $this->data['posts'] = $this->Post_model->users_post($user_id, $this->session->user['id'], 0, 3);
        $this->data['saved_posts'] = $this->Post_model->saved_post($user_id, $this->session->user['id'], 0, 3);
        $this->template->load('front', 'user/profile', $this->data);
    }

    public function events($user_id = 0) {
        if ($user_id == 0) {
            $user_id = $this->session->user['id'];
        } else {
            $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $user_id], false, true);
        }
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        $this->data['user_events'] = $this->Event_model->get_users_event($user_id, 0, 3);
        $this->data['joined_events'] = $this->Event_model->get_users_joined_event($user_id, 0, 3);
        if ($user_id == $this->session->user['id']) {
            $this->data['event_request'] = $this->Event_model->get_join_request($user_id);
        }
        $this->template->load('front', 'user/events/home_events', $this->data);
    }

    public function load_users_events($user_id, $page) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        $this->data['event_post'] = $this->Event_model->get_users_event($user_id, $start, $limit);
        if (count($this->data['event_post']) > 0) {
            $data['view'] = $this->load->view('user/partial/events/load_user_events', $this->data, true);
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
            $data['message'] = lang("No more event found");
        }
        echo json_encode($data);
    }

    public function load_users_joined_events($user_id, $page) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        $this->data['event_post'] = $this->Event_model->get_users_joined_event($user_id, $start, $limit);
        if (count($this->data['event_post']) > 0) {
            $data['view'] = $this->load->view('user/partial/events/load_user_events', $this->data, true);
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
            $data['message'] = lang("No more saved post found");
        }
        echo json_encode($data);
    }

    public function accept_event_request($request_id) {
        $event_request = $this->Event_model->get_event_request($request_id);

        //Delete request
        $this->Event_model->delete_request($request_id);

        // Insert into event_user
        if ($this->Event_model->add_event_user($event_request['user_id'], $event_request['event_id'])) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function deny_event_request($request_id) {
        //Delete request
        if ($this->Event_model->delete_request($request_id)) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function follow_user() {
        if ($this->input->post()) {
            $Ins_arr = array(
                'user_id' => $this->input->post('user_id'),
                'follower_id' => $this->session->user['id']
            );
            $id = $this->Users_model->insert_follower_data($Ins_arr);
            echo $id;
            exit;
        }
    }

    public function unfollow_user() {
        if ($this->input->post()) {
            $where = 'user_id = ' . $this->db->escape($this->input->post('user_id')) . 'AND follower_id=' . $this->db->escape($this->session->user['id']);
            $id = $this->Users_model->delete_follower_data($where);
            echo $id;
            exit;
        }
    }

    public function get_location() {
        var_dump($_SERVER);
        $ip = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        pr($ip);
        $url = "http://freegeoip.net/json/$ip";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        curl_close($ch);

        if ($data) {
            pr($data);
            $location = json_decode($data);

            $lat = $location->latitude;
            $lon = $location->longitude;

            $sun_info = date_sun_info(time(), $lat, $lon);
            print_r($sun_info);
        }
    }

}
