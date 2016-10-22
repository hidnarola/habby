<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_posts_model', 'Users_model', 'Post_model']);
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
        $this->template->load('admin_main', 'admin/posts/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_post() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_posts_model->get_posts_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_posts_model->get_all_posts();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }

    public function action($action, $user_id) {

        $where = 'id = ' . $this->db->escape($user_id);
        $check_post = $this->Admin_posts_model->get_result('post', $where);
        if ($check_post) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'User successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_block' => 1
                );
                $this->session->set_flashdata('success', 'Post successfully blocked!');
            } else {
                $update_array = array(
                    'is_block' => 0
                );
                $this->session->set_flashdata('success', 'Post successfully unblocked!');
            }
            $this->Admin_posts_model->update_record('post', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/posts'));
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
        $post_id = $this->uri->segment(4);
        if (is_numeric($post_id)) {
            $check_post = $this->Admin_posts_model->get_post_result($post_id);
            if ($check_post) {
                $this->data['post_datas'] = $check_post;
                $this->data['title'] = 'Habby - Admin edit post';
                $this->data['heading'] = 'Edit post';
            } else {
                show_404();
            }
        }
        if ($this->input->post()) {
            $this->form_validation->set_rules('description', 'description', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->template->load('admin_main', 'admin/posts/manage', $this->data);
            } else {
                $update_array = $this->input->post(null);
                $this->Admin_users_model->update_record('post', $where, $update_array);
                $this->session->set_flashdata('success', 'post successfully updated!');
                redirect('admin/posts');
            }
        }
        $this->template->load('admin_main', 'admin/posts/manage', $this->data);
    }

    public function view() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $post_id = $this->uri->segment(4);
        $this->data['posts'] = $this->Admin_posts_model->get_post_details($post_id);
        $this->template->load('admin_main', 'admin/posts/view', $this->data);
    }

}
