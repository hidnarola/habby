<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Post_model', 'Common_functionality'));
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
        $this->data['posts'] = $this->Post_model->smileshare_post($data = array(),$this->session->user['id']);
      //   pr($this->data['posts'],1);
        $this->template->load('front', 'user/home.php', $this->data);
    }


    /*
     * smile_share method loads home page view with all required details
     * develop by : ar
     */

    public function smile_share() {
        $this->data['posts'] = $this->Post_model->smileshare_post($data = array(),$this->session->user['id']);
      //   pr($this->data['posts'],1);
        $this->template->load('front', 'user/home.php', $this->data);
    }

    /*
     * challenge method loads home page view with all required details
     * develop by : ar
     */

    public function challenge() {
        $this->data['posts'] = $this->Post_model->challange_post($data = array(),$this->session->user['id']);
      //   pr($this->data['posts'],1);
        $this->template->load('front', 'user/home.php', $this->data);
    }

    /*
     * add_post method is used to add post in database
     * develop by : ar
     */

    public function add_post() {
        if ($this->input->post()) {


            $this->form_validation->set_rules('description', 'description', 'required');
            if (!($this->form_validation->run() == FALSE)) {
                // Code of image uploading
                $config['upload_path']          = './uploads/user_post/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000000;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('uploadfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('msg', 'Problem occurs during image uploading.');
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $post_arr['description'] = $this->input->post('description');
                        $post_arr['user_id'] = '1'; // need to retrive from session

                        if($post_id = $this->Post_model->add_post($post_arr))
                        {
                            $media = array();

                            foreach($data as $row)
                            {
                                $media_arr = array();
                                $media_arr['post_id'] = $post_id;
                                $media_arr['media_type'] = 'image';
                                $media_arr['media'] = $row['file_name'];
                                $media[] = $media_arr;
                            }
                            $this->Post_model->insert_post_media($media);
                            $this->session->set_flashdata('msg', 'post added successfully');
                        }
                        else
                        {
                            $this->session->set_flashdata('msg', 'There was some problem in uploading post.');   
                        }
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
//        $this->session->unset_userdata('user');
        delete_cookie('Remember_me');
        $this->session->set_flashdata('message', array('message' => lang('Log out Successfully.'), 'class' => 'alert alert-success'));
        redirect('login');
    }

    /**
     * This function is used to display logged in user details.
     * develop by : HPA
     */
    public function profile() {
        $this->template->load('front', 'user/profile.php', $this->data);
    }

}
