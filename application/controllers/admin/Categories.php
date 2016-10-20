<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_categories_model', 'Users_model']);
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
        $this->template->load('admin_main', 'admin/categories/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_categories() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_categories_model->get_categories_count();
        $final['redraw'] = 1;
        // $final['recordsFiltered'] = $this->admin_users_model->get_users_result(TBL_USER,$select,'count');
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_categories_model->get_all_categories();
        echo json_encode($final);
    }

    public function action($action, $user_id) {

        $where = 'id = ' . $this->db->escape($user_id);
        $check_user = $this->Admin_categories_model->get_result('post_categories', $where);
        if ($check_user) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'Category successfully deleted!');
            }
            $this->Admin_categories_model->update_record('post_categories', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/categories'));
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
        $id = $this->uri->segment(4);
        if (is_numeric($id)) {
            $where = 'id = ' . $this->db->escape($id);
            $check_categories = $this->Admin_categories_model->get_result('post_categories', $where);
            if ($check_categories) {
                $this->data['categories_datas'] = $check_categories[0];
                $this->data['title'] = 'Habby - Admin edit category';
                $this->data['heading'] = 'Edit Category';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add category';
            $this->data['heading'] = 'Add Category';
        }
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/categories/manage', $this->data);
        } else {
            $update_array = $this->input->post(null);
            if ($id != '') {
                $this->Admin_categories_model->update_record('post_categories', $where, $update_array);
                $this->session->set_flashdata('success', 'Category successfully updated!');
                redirect('admin/categories');
            } else {
                $this->Admin_categories_model->insert('post_categories', $update_array);
                $this->session->set_flashdata('success', 'Category successfully added!');
                redirect(site_url('admin/categories'));
            }
        }
//        $this->template->load('admin_main', 'admin/categories/manage', $this->data);
    }

}
