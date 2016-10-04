<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model'));
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $session_data = $this->session->userdata('user');
        $data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($data['user_data'])) {
            redirect('login');
        } else {
            $this->template->load('front', 'user/home.php');
        }
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
