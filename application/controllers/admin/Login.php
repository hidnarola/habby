<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model'));
    }

    public function index() {

        $remember_me = get_cookie('Remember_me');

        /* 	If Remember_key Cookie exists in browser then it wil fetch data using it's value and 
          set sessin data and force login User */

        if (isset($remember_me)) {
            $remember_me_decode = $this->encrypt->decode($remember_me);
            $rem_data = $this->Users_model->check_if_user_exist(['id' => $remember_me_decode, 'role_id' => 1], false, true);
            $this->session->set_userdata(['admin' => $rem_data, 'loggedin' => TRUE]);
        }

        $this->data['user_data'] = $this->session->userdata('admin');
        if (!empty($this->data['user_data'])) {
            $this->Users_model->update_user_data($data['user_data']['id'], ['last_login' => date('Y-m-d H:i:s')]);
            redirect('admin/dashboard');
        }

        if ($this->input->post()) {
            pr($this->input->post());
            $email = $this->input->post('username');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');

            //check_if_user_exist - three params 1->where condition 2->is get num_rows for query 3->is fetech single or all data
            $user_data = $this->Users_model->check_if_user_exist(['email' => $email, 'role_id' => 1], false, true);
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

                    $this->session->set_userdata(['admin' => $user_data, 'loggedin' => TRUE]); // Start Loggedin User Session
                    $this->session->set_flashdata('message', ['message' => 'Login Successfull', 'class' => 'alert alert-success']);
                    $this->Users_model->update_user_data($user_data['id'], ['last_login' => date('Y-m-d H:i:s')]); // update last login time
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('message', ['message' => 'Password is incorrect.', 'class' => 'alert alert-danger']);
                    redirect('admin/login');
                } // End of else for if($db_pass == $password) condition
            } else {
                $this->session->set_flashdata('message', ['message' => 'Username and password incorrect.', 'class' => 'alert alert-danger']);
                redirect('admin/login');
            }
        } else {
            $this->load->view('admin/login_admin', $this->data);
        }
    }

}
