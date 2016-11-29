<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Users_model']);
//        $this->load->library(['encryption', 'upload']);
    }

    /**
     * function use to display admin dashboard.(HPA)
     */
    public function index() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $this->template->load('admin_main', 'admin/dashboard', $this->data);
    }

    /**
     * function use for logout from admin panel.(HDA)
     */
    public function log_out() {
        $this->session->sess_destroy();
//        $this->session->unset_userdata('admin');
        delete_cookie('Remember_me');
        $this->session->set_flashdata('message', array('message' => 'Log out Successfully.', 'class' => 'alert alert-success'));
        redirect('admin/login');
    }

    public function edit() {
        $session_data = $this->session->userdata('admin');
        $data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($data['user_data'])) {
            redirect('admin/login');
        }
        $data['all_countries'] = $this->Users_model->get_all_countries();
        $data['heading'] = 'Edit Profile';
        $email = $session_data['email'];
        $post_email = $this->input->post('email');
        $email_unique_str = '';
        if ($email != $post_email) {
            $email_unique_str = '|is_unique[users.email]';
        }

        $this->form_validation->set_rules('name', lang('Display name'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' . $email_unique_str, array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/profile_edit', $data);
        } else {
            $user_id = $session_data['id'];
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $gender = $this->input->post('gender');
            $country = $this->input->post('country');
            $bio = $this->input->post('bio');
            $hobby = $this->input->post('hobby');

            //update_user_data
            $upd_data = [
                'name' => $name,
                'email' => $email,
                'gender' => $gender,
                'country' => $country,
                'bio' => $bio,
                'hobby' => $hobby,
                'modified_date' => date('Y-m-d H:i:s')
            ];
            $this->Users_model->update_user_data($user_id, $upd_data);
            $user_data = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
            $this->session->set_userdata(['admin' => $user_data]);
            $this->session->set_flashdata('success', 'Profile updated successfully.');
            redirect('admin/edit_profile');
        }
    }

    public function change_password() {
        $session_data = $this->session->userdata('admin');
        $data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($data['user_data'])) {
            redirect('admin/login');
        }
        $data['heading'] = 'Change Password';
        $sess_pass = $data['user_data']['password'];
        $decode_pass = $this->encrypt->decode($sess_pass);

        $user_id = $session_data['id'];
        $this->form_validation->set_rules('curr_pass', lang('Current Password'), 'trim|required|in_list[' . $decode_pass . ']', ['in_list' => lang('Current Password Incorrect.'), 'required' => lang('Please fill the field') . ' %s .']);
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[6]|matches[re_pass]', array('required' => lang('Please fill the field') . ' %s .', 'min_length' => lang('Please enter password min 6 letter'), 'matches' => lang('Please enter same password')));
        $this->form_validation->set_rules('re_pass', 'Repeat Password', 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/change_password', $data);
        } else {
            $password = $this->input->post('pass');
            if ($password == $decode_pass) {
                $this->session->set_flashdata('error', 'Please do not use existing password.');
                redirect('admin/change_password');
            }
            $encode_pass = $this->encrypt->encode($password);

            $this->Users_model->update_user_data($user_id, ['password' => $encode_pass]);
            $this->session->set_flashdata('success', 'Password has been set Successfully.');
            redirect('admin/dashboard');
        }
    }

}
