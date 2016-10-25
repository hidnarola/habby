<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soulmate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_soulmate_model', 'Users_model', 'Soulmate_model']);
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
        $this->template->load('admin_main', 'admin/soulmate/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_soulmate() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_soulmate_model->get_soulmate_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_soulmate_model->get_all_soulmate();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }

    public function action($action, $group_id) {

        $where = 'id = ' . $this->db->escape($group_id);
        $check_topichat = $this->Admin_soulmate_model->get_result('soulmate_group', $where);
        if ($check_topichat) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'Soulmate Group successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_blocked' => 1
                );
                $this->session->set_flashdata('success', 'Soulmate Group successfully blocked!');
            } else {
                $update_array = array(
                    'is_blocked' => 0
                );
                $this->session->set_flashdata('success', 'Soulmate Group successfully unblocked!');
            }
            $this->Admin_soulmate_model->update_record('soulmate_group', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/soulmate'));
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
            $Soulmates = $this->Admin_soulmate_model->get_soulmate_result($group_id);
            if ($Soulmates) {
                $this->data['Soulmates'] = $Soulmates;
                $this->data['title'] = 'Habby - Admin edit Soulmate Group';
                $this->data['heading'] = 'Edit Soulmate Group';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add Soulmate Group';
            $this->data['heading'] = 'Add Soulmate Group';
        }
        $this->form_validation->set_rules('name', 'Soulmate Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/soulmate/manage', $this->data);
        } else {
            if ($group_id != '') {
                $upd_data = $this->input->post(null);
                $where = 'id = ' . $this->db->escape($group_id);
                if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
                    $config['upload_path'] = './uploads/soulmate_group';
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
                if ($topic_id = $this->Admin_soulmate_model->update_record('soulmate_group', $where, $upd_data)) {
                    $this->session->set_flashdata('success', 'Soulmate Group successfully updated!');
                    redirect('admin/soulmate');
                }
            } else {
                $ins_data = array(
                    'name' => $this->input->post('name'),
                    'slogan' => $this->input->post('slogan'),
                    'introduction' => $this->input->post('introduction'),
                    'user_id' => $this->data['user_data']['id'],
                );

                if ($soulmate_group_id = $this->Soulmate_model->insert_soulmate_data($ins_data)) {
                    if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
//            pr($_FILES, 1);
                        /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                        $config['upload_path'] = './uploads/soulmate_group';
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
                            $image_name = "soulmate_img3.jpg";
                            $this->session->set_flashdata('message', ['message' => 'Group cover is not uploaded.', 'class' => 'alert alert-danger']);
                        } else {
                            $data_upload = array('upload_data' => $this->upload->data());
                            $image_name = $data_upload['upload_data']['file_name'];
                        }
                    } else {
                        $image_name = "soulmate_img3.jpg";
                    }
                    $this->Soulmate_model->update_soulmate_data($soulmate_group_id, ['group_cover' => $image_name]);
                    $this->session->set_flashdata('success', 'Soulmate group successfully blocked!');
                } else {
                    $this->session->set_flashdata('error', 'Invalid request. Please try again!');
                }
                redirect(site_url('admin/soulmate'));
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
        $this->data['topichats'] = $this->Admin_topichat_model->get_topichat_result($group_id);
        $this->template->load('admin_main', 'admin/topichat/view', $this->data);
    }

}
