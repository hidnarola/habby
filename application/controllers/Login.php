<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $data['user_data'] = $this->session->userdata('user');
        if (!empty($data['user_data'])) {
            $this->Users_model->update_user_data($data['user_data']['id'], ['last_login' => date('Y-m-d H:i:s')]);
            redirect('home');
        }
        if ($this->session->userdata('language') == FALSE) {
            $this->session->set_userdata('language', 'english');
        }
        if ($this->input->post()) {
            $remember_me = get_cookie('Remember_me');

            /* 	If Remember_key Cookie exists in browser then it wil fetch data using it's value and 
              set sessin data and force login User */

            if (isset($remember_me)) {
                $remember_me_decode = $this->encrypt->decode($remember_me);
                $rem_data = $this->Users_model->check_if_user_exist(['id' => $remember_me_decode], false, true);
                $this->session->set_userdata(['user' => $rem_data, 'loggedin' => TRUE]);
            }

            $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email', array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));
            $this->form_validation->set_rules('password', lang('Password'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));

            if ($this->form_validation->run() == FALSE) {
                $this->template->load('sign', 'user/login', $data);
            } else {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $remember_me = $this->input->post('remember_me');
//                pr($this->input->post());

                //check_if_user_exist - three params 1->where condition 2->is get num_rows for query 3->is fetech single or all data
                $user_data = $this->Users_model->check_if_user_exist(['email' => $email], false, true);
                if (!empty($user_data)) {
                    $db_pass = $this->encrypt->decode($user_data['password']);

                    if ($db_pass == $password) {
                        /* If remember Me Checkbox is clicked */
                        /* Set Cookie IF Start */
                        if ($remember_me == '1') {

                            $cookie = array(
                                'name' => 'Remember_me',
                                'value' => $this->encrypt->encode($user_data['id']),
                                'expire' => '172800'
                            );

                            $this->input->set_cookie($cookie);
                        } /* // END */

                        $this->session->set_userdata(['user' => $user_data, 'loggedin' => TRUE]); // Start Loggedin User Session
                        $this->session->set_flashdata('message', ['message' => lang('Login Successfully'), 'class' => 'alert alert-success']);
                        $this->Users_model->update_user_data($user_data['id'], ['last_login' => date('Y-m-d H:i:s')]); // update last login time
                        $user_redirect = $this->session->userdata('user_redirect');
                        if (!empty($user_redirect)) {
                            $this->session->unset_userdata('user_redirect');
                            redirect($user_redirect);
                        } else {
                            redirect('home');
                        }
                    } else {
                        $this->session->set_flashdata('message', ['message' => lang('Password is incorrect.'), 'class' => 'alert alert-danger']);
                        redirect('login');
                    } // End of else for if($db_pass == $password) condition
                } else {
                    $this->session->set_flashdata('message', ['message' => lang('Username and password are incorrect.'), 'class' => 'alert alert-danger']);
                    redirect('login');
                }
                exit;
            }
        } else {
            $this->template->load('sign', 'user/login');
        }
    }

    public function register() {
        $data['user_data'] = $this->session->userdata('user');
        if (!empty($data['user_data'])) {
            $this->Users_model->update_user_data($data['user_data']['id'], ['last_login' => date('Y-m-d H:i:s')]);
            redirect('user/dashboard');
        }

        if ($this->input->post()) {
            
        } else {
            $this->template->load('sign', 'user/login');
        }
    }

}
