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
        $this->data['posts'] = $this->Post_model->display_post($data = array(),$this->session->user['id']);
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
                $post_arr['description'] = $this->input->post('description');
                $post_arr['user_id'] = '1'; // need to retrive from session

                $this->Post_model->add_post($post_arr);
                $this->session->set_flashdata('msg', 'post added successfully');
            } else {
                $this->session->set_flashdata('msg', 'Invalid data entered for post');
            }
        }
        redirect('home');
    }

    public function change_lang() {
        if ($this->input->post()) {
            $lang = $this->input->post('lang');
            if ($lang == 'eng') {
                $this->session->set_userdata('language', 'english');
            } else if ($lang == 'fr') {
                $this->session->set_userdata('language', 'french');
            } else if ($lang == 'ru') {
                $this->session->set_userdata('language', 'russian');
            }
        }
    }

    public function log_out() {
        $this->session->sess_destroy();
//        $this->session->unset_userdata('user');
        delete_cookie('Remember_me');
        $this->session->set_flashdata('message', array('message' => lang('Log out Successfully.'), 'class' => 'alert alert-success'));
        redirect('login');
    }

}