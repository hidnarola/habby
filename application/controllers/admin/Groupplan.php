<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Groupplan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_groupplan_model', 'Users_model', 'Groupplan_model']);
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
        $this->template->load('admin_main', 'admin/groupplan/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_groupplan() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_groupplan_model->get_groupplan_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_groupplan_model->get_all_groupplan();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }

    public function action($action, $group_id) {

        $where = 'id = ' . $this->db->escape($group_id);
        $check_topichat = $this->Admin_groupplan_model->get_result('group', $where);
        if ($check_topichat) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'Group plan successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_blocked' => 1
                );
                $this->session->set_flashdata('success', 'Group plan successfully blocked!');
            } else {
                $update_array = array(
                    'is_blocked' => 0
                );
                $this->session->set_flashdata('success', 'Group plan successfully unblocked!');
            }
            $this->Admin_groupplan_model->update_record('group', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/groupplan'));
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
            $Groupplans = $this->Admin_groupplan_model->get_groupplan_result($group_id);
            if ($Groupplans) {
                $this->data['Groupplans'] = $Groupplans;
                $this->data['title'] = 'Habby - Admin edit Groupplan';
                $this->data['heading'] = 'Edit Groupplan';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add Groupplan';
            $this->data['heading'] = 'Add Groupplan';
        }
        $this->form_validation->set_rules('name', 'Group Name', 'required');
        $this->form_validation->set_rules('user_limit', 'Group User Limit', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/groupplan/manage', $this->data);
        } else {
            if ($group_id != '') {
                $upd_data = array(
                    'name' => $this->input->post('name'),
                    'user_limit' => $this->input->post('user_limit'),
                    'slogan' => $this->input->post('slogan'),
                    'introduction' => $this->input->post('introduction')
                );
                $where = 'id = ' . $this->db->escape($group_id);
                if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
                    $config['upload_path'] = './uploads/group_plan';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['min_width'] = '300';
                    $config['min_height'] = '300';
                    $config['encrypt_name'] = TRUE;
                    $config['file_name'] = md5(uniqid(mt_rand()));
                    //Initialize all params for the CI uplaod library
                    $this->upload->initialize($config);

                    // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
                    // IF not fit into given parameter then set proper error message and redirect to car/pictire function
                    if (!$this->upload->do_upload('group_cover')) {

                        $error = $this->upload->display_errors();

                        if ($_FILES["group_cover"]["tmp_name"] != '') {
                            $image_info = getimagesize($_FILES["group_cover"]["tmp_name"]);
                            $image_width = $image_info[0];
                            $image_height = $image_info[1];
                            $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                        }
                        $this->session->set_flashdata('message', ['message' => 'Group cover is not uploaded.', 'class' => 'alert alert-danger']);
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
                        $image_name = $data_upload['upload_data']['file_name'];
                        $upd_data['group_cover'] = $image_name;
                    }
                }
                if ($topic_id = $this->Admin_groupplan_model->update_record('group', $where, $upd_data)) {
                    $this->session->set_flashdata('success', 'Group successfully updated!');
                    redirect('admin/groupplan');
                }
            } else {
                $ins_data = array(
                    'name' => $this->input->post('name'),
                    'slogan' => $this->input->post('slogan'),
                    'user_limit' => $this->input->post('user_limit'),
                    'introduction' => $this->input->post('introduction'),
                    'user_id' => $this->data['user_data']['id'],
                );
                if ($groupplan_id = $this->Admin_groupplan_model->insert('group', $ins_data)) {
                    if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
                        /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                        $config['upload_path'] = './uploads/group_plan';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['min_width'] = '300';
                        $config['min_height'] = '300';
                        $config['encrypt_name'] = TRUE;
                        $config['file_name'] = md5(uniqid(mt_rand()));

                        //Initialize all params for the CI uplaod library
                        $this->upload->initialize($config);

                        // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
                        // IF not fit into given parameter then set proper error message and redirect to car/pictire function
                        if (!$this->upload->do_upload('group_cover')) {

                            $error = $this->upload->display_errors();

                            if ($_FILES["group_cover"]["tmp_name"] != '') {
                                $image_info = getimagesize($_FILES["group_cover"]["tmp_name"]);
                                $image_width = $image_info[0];
                                $image_height = $image_info[1];
                                $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                            }
                            $image_name = "grp_pln_img1.jpg";
                            $this->session->set_flashdata('message', ['message' => 'Group cover is not uploaded.', 'class' => 'alert alert-danger']);
                        } else {
                            $data_upload = array('upload_data' => $this->upload->data());
                            $image_name = $data_upload['upload_data']['file_name'];
                        }
                    } else {
                        $image_name = "grp_pln_img1.jpg";
                    }
                    $this->Groupplan_model->update_groupplan_data($groupplan_id, ['group_cover' => $image_name]);
                    $ins_user_data = array(
                        'group_id' => $groupplan_id,
                        'user_id' => $this->data['user_data']['id'],
                    );
                    $this->Groupplan_model->insert_grouplan_users($ins_user_data);
                    $this->session->set_flashdata('success', 'Group successfully inserted!');
                } else {
                    $this->session->set_flashdata('error', 'Invalid request. Please try again!');
                }
                redirect(site_url('admin/topichat'));
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
        $this->data['groupplans'] = $this->Admin_groupplan_model->get_groupplan_result($group_id);
        $this->template->load('admin_main', 'admin/groupplan/view', $this->data);
    }

}
