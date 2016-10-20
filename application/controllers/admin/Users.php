<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_users_model', 'Users_model']);
    }

    /**
     * Function load view of users list.(HPA)
     */
    public function index() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $this->template->load('admin_main', 'admin/users/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_user() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_users_model->get_users_count();
        $final['redraw'] = 1;
        // $final['recordsFiltered'] = $this->admin_users_model->get_users_result(TBL_USER,$select,'count');
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_users_model->get_all_users();
        echo json_encode($final);
    }

    public function action($action, $user_id) {

        $where = 'id = ' . $this->db->escape($user_id);
        $check_user = $this->Admin_users_model->get_result('users', $where);
        if ($check_user) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'User successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_blocked' => 1
                );
                $this->session->set_flashdata('success', 'User successfully blocked!');
            } else {
                $update_array = array(
                    'is_blocked' => 0
                );
                $this->session->set_flashdata('success', 'User successfully unblocked!');
            }
            $this->Admin_users_model->update_record('users', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/users'));
    }

    /**
     * @uses : Load view of users list
     * @author : HPA
     * */
    public function edit() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $user_id = $this->uri->segment(4);
        if (is_numeric($user_id)) {
            $where = 'id = ' . $this->db->escape($user_id);
            $check_user = $this->Admin_users_model->get_result('users', $where);
            if ($check_user) {
                $this->data['user_datas'] = $check_user[0];
                $this->data['title'] = 'Habby - Admin edit user';
                $this->data['heading'] = 'Edit user';
                $this->data['all_countries'] = $this->Users_model->get_all_countries();
            } else {
                show_404();
            }
        }
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'E-Mail', 'trim|required', array('required' => 'Please fill the field' . ' %s .'));
            if ($this->form_validation->run() == FALSE) {
                $this->template->load('admin_main', 'admin/users/manage', $this->data);
            } else {
                $update_array = $this->input->post(null);
                $this->Admin_users_model->update_record('users', $where, $update_array);
                $this->session->set_flashdata('success', 'User successfully updated!');
                redirect('admin/users');
            }
        }
        $this->template->load('admin_main', 'admin/users/manage', $this->data);
    }

}
