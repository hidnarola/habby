<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_seo_model', 'Users_model']);
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
        $this->template->load('admin_main', 'admin/seo/index', $this->data);
    }
    
    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_seo() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_seo_model->get_seo_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_seo_model->get_all_seo();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }
 
    /**
     * @uses : Edit page for seo
     * @author : ar
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
            $check_seo = $this->Admin_seo_model->get_result('seo', $where);
            if ($check_seo) {
                $this->data['seo_datas'] = $check_seo[0];
                $this->data['title'] = 'Habby - Admin edit SEO';
                $this->data['heading'] = 'Edit SEO';
            } else {
                show_404();
            }
        }
        $this->form_validation->set_rules('page', 'Page name', 'trim|required');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'trim|required');
        $this->form_validation->set_rules('meta_keyword', 'Meta keyword', 'trim|required');
        $this->form_validation->set_rules('meta_description', 'Meta description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/seo/manage', $this->data);
        } else {
            $update_array = $this->input->post(null);
            if ($id != '') {
                $this->Admin_seo_model->update_record('seo', $where, $update_array);
                $this->session->set_flashdata('success', 'SEO successfully updated!');
                redirect('admin/seo');
            }
        }
    }
}
