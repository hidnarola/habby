<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_challenge_model', 'Users_model', 'Challenge_model']);
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
        $this->template->load('admin_main', 'admin/challenge/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_challenge() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_challenge_model->get_challenge_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_challenge_model->get_all_challenge();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }

    public function action($action, $group_id) {

        $where = 'id = ' . $this->db->escape($group_id);
        $check_challenges = $this->Admin_challenge_model->get_result('challanges', $where);
        if ($check_challenges) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'Challenge successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_blocked' => 1
                );
                $this->session->set_flashdata('success', 'Challenge successfully blocked!');
            } else {
                $update_array = array(
                    'is_blocked' => 0
                );
                $this->session->set_flashdata('success', 'Challenge successfully unblocked!');
            }
            $this->Admin_challenge_model->update_record('challanges', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/challenge'));
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
        $group_id = $this->uri->segment(4);
        if (is_numeric($group_id)) {
            $Challenges = $this->Admin_challenge_model->get_challenge_result($group_id);
            if ($Challenges) {
                $this->data['Challenges'] = $Challenges;
                $this->data['title'] = 'Habby - Admin edit Challenge';
                $this->data['heading'] = 'Edit Challenge';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add Challenge';
            $this->data['heading'] = 'Add Challenge';
        }
        $this->form_validation->set_rules('name', 'Challenge Name', 'required');
        $this->form_validation->set_rules('rewards', 'Rewards', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/challenge/manage', $this->data);
        } else {
            if ($group_id != '') {
                $upd_data = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'rewards' => $this->input->post('rewards')
                );
                $where = 'id = ' . $this->db->escape($group_id);
                if ($this->Admin_challenge_model->update_record('challanges', $where, $upd_data)) {
                    $this->session->set_flashdata('success', 'Challenge successfully updated!');
                    redirect('admin/challenge');
                }
            } else {
                $groupplan_id = "";
                if ($this->input->post()) {
                    $ins_data = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                        'rewards' => $this->input->post('rewards'),
                        'user_id' => $this->data['user_data']['id'],
                    );
                    $groupplan_id = $this->Admin_challenge_model->insert('challanges', $ins_data);
                }
                $ins_user_data = array(
                    'challange_id' => $groupplan_id,
                    'user_id' => $this->data['user_data']['id'],
                );
                $this->Challenge_model->insert_challenge_user($ins_user_data);
                $this->session->set_flashdata('success', 'Challenge successfully Added!');
                redirect(site_url('admin/challenge'));
            }
        }
    }

    public function view() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $group_id = $this->uri->segment(4);
        $this->data['challenges'] = $this->Admin_challenge_model->get_challenge_results($group_id);
        $this->data['messages'] = $this->Admin_challenge_model->get_messages($group_id);
        $this->template->load('admin_main', 'admin/challenge/view', $this->data);
    }

}
