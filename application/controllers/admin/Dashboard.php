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
        $data['verification_count'] = $this->Verification_model->fetch_new_verification_request_count();
        $data['all_countries'] = $this->Users_model->get_all_countries();
        $data['heading'] = 'Edit Profile';
        $email = $session_data['email_id'];
        $post_email = $this->input->post('email_id');
        $email_unique_str = '';
        if ($email != $post_email) {
            $email_unique_str = '|is_unique[users.email_id]';
        }

        $this->form_validation->set_rules('fname', lang('First name'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
        $this->form_validation->set_rules('lname', lang('Last Name'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
        $this->form_validation->set_rules('display_name', lang('Display As'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
        $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email' . $email_unique_str, array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));
        $this->form_validation->set_rules('phone_no', lang('Phone Number'), 'numeric|regex_match[/^[0-9]{9}$/]', array('numeric' => lang('Please enter number in phone number'), 'regex_match' => lang('Please enter 9 number in phone')));

        if ($this->form_validation->run() == FALSE) {
            $data['subview'] = 'admin/profile_edit';
            $this->load->view('admin/layouts/layout_main', $data);
        } else {
            pr($this->input->post);
            $user_id = $session_data['id'];
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email_id = $this->input->post('email_id');
            $display_as = $this->input->post('display_name');
            $gender = $this->input->post('gender');
            $birth_year = $this->input->post('birth_year');
            $country_code = $this->input->post('country_code');
            $phone_no = $this->input->post('phone_no');
            $phone_privacy = (int) $this->input->post('phone_privacy');

            $old_bio = trim($data['user_data']['bio']);
            $user_bio = trim($this->input->post('user_bio'));

            $old_phone = trim($data['user_data']['phone']);
            $post_phone_no = $this->input->post('phone_no');

            $ip = $this->input->ip_address();

            //update_user_data
            $upd_data = [
                'fname' => $fname,
                'lname' => $lname,
                'display_name' => $display_as,
                'email_id' => $email_id,
                'gender' => $gender,
                'birth_year' => $birth_year,
                'country' => $country_code,
                'phone' => $phone_no,
                'is_phone_privacy' => $phone_privacy,
                'bio' => $user_bio,
                'modified_date' => date('Y-m-d H:i:s')
            ];
            
            $this->Users_model->update_user_data($user_id, $upd_data);


            //IF Bio is not same as old then it will verify first for that it will insert record into verification table
            if ($old_bio != $user_bio) {

                $res_veri_data = $this->Verification_model->get_verification_id(['user_id' => $user_id, 'verification_type' => '5']);
                if (!empty($res_veri_data)) {
                    $this->Verification_model->update_verification($res_veri_data['id'], ['user_id' => $user_id, 'verification_type' => '5',
                        'is_submitted' => '1', 'is_approved' => '0',
                        'ip_address' => $ip, 'approved_by' => NULL,
                        'modified_date' => date('Y-m-d H:i:s')]);
                } else {
                    $this->Verification_model->insert_verification(['user_id' => $user_id, 'verification_type' => '5', 'is_submitted' => '1', 'ip_address' => $ip]);
                }
            }

            //IF Email is not same as old then it will verify first for that it will insert record into verification table
            if ($email != $post_email) {
                $verification_id = $this->Verification_model->get_verification_id(['user_id' => $user_id, 'verification_type' => '1'], 'id');
                $this->Verification_model->update_verification($verification_id, ['is_approved' => '0', 'is_submitted' => '1', 'ip_address' => $ip,
                    'modified_date' => date('Y-m-d H:i:s')]);
            }

            //IF Phone Number is not same as old then it will verify first for that it will insert/Update record into verification table
            if ($old_phone != $post_phone_no) {

                $phone_veri_data = $this->Verification_model->get_verification_id(['user_id' => $user_id, 'verification_type' => '4']);
                if (!empty($phone_veri_data)) {
                    $this->Verification_model->update_verification($phone_veri_data['id'], ['user_id' => $user_id, 'verification_type' => '4',
                        'is_submitted' => '1', 'is_approved' => '0',
                        'ip_address' => $ip, 'approved_by' => NULL, 'token' => NULL,
                        'modified_date' => date('Y-m-d H:i:s')]);
                } else {
                    $this->Verification_model->insert_verification(['user_id' => $user_id, 'verification_type' => '4', 'is_submitted' => '1',
                        'ip_address' => $ip]);
                }
            }

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
        $data['verification_count'] = $this->Verification_model->fetch_new_verification_request_count();
        $data['heading'] = 'Change Password';
        $sess_pass = $data['user_data']['password'];
        $decode_pass = $this->encrypt->decode($sess_pass);

        $user_id = $session_data['id'];
        $this->form_validation->set_rules('curr_pass', lang('Current Password'), 'trim|required|in_list[' . $decode_pass . ']', ['in_list' => lang('Current Password Incorrect.'), 'required' => lang('Please fill the field') . ' %s .']);
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[6]|matches[re_pass]', array('required' => lang('Please fill the field') . ' %s .', 'min_length' => lang('Please enter password min 6 letter'), 'matches' => lang('Please enter same password')));
        $this->form_validation->set_rules('re_pass', 'Repeat Password', 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));

        if ($this->form_validation->run() == FALSE) {
            $data['subview'] = 'admin/change_password';
            $this->load->view('admin/layouts/layout_main', $data);
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
