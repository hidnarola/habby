<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class League extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_league_model', 'Users_model', 'League_model']);
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
        $this->template->load('admin_main', 'admin/league/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_league() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_league_model->get_league_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_league_model->get_all_leagues();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }

    public function action($action, $group_id) {

        $where = 'id = ' . $this->db->escape($group_id);
        $check_league = $this->Admin_league_model->get_result('league', $where);
        if ($check_league) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'League Group successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_blocked' => 1
                );
                $this->session->set_flashdata('success', 'League Group successfully blocked!');
            } else {
                $update_array = array(
                    'is_blocked' => 0
                );
                $this->session->set_flashdata('success', 'League Group successfully unblocked!');
            }
            $this->Admin_league_model->update_record('league', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/league'));
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
            $Leagues = $this->Admin_league_model->get_league_result($group_id);
            if ($Leagues) {
                $this->data['Leagues'] = $Leagues;
                $this->data['title'] = 'Habby - Admin edit League Group';
                $this->data['heading'] = 'Edit League Group';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add League Group';
            $this->data['heading'] = 'Add League Group';
        }
        $this->form_validation->set_rules('name', 'League Name', 'required');
        $this->form_validation->set_rules('introduction', 'Introduction', 'required');
        $this->form_validation->set_rules('user_limit', 'User Limit', 'required|numeric');
        $this->form_validation->set_rules('requirements', 'Requirements', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/league/manage', $this->data);
        } else {
            if ($group_id != '') {
                $upd_data = array(
                    'name' => $this->input->post('name'),
                    'introduction' => $this->input->post('introduction'),
                    'user_limit' => $this->input->post('user_limit'),
                    'requirements' => $this->input->post('requirements')
                );

                if ($_FILES['league_image']['name'] != NULL || $_FILES['league_image']['name'] != "") {
                    /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                    $config['upload_path'] = './uploads/league';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['min_width'] = '300';
                    $config['min_height'] = '300';
                    $config['encrypt_name'] = TRUE;
                    $config['file_name'] = md5(uniqid(mt_rand()));

                    //Initialize all params for the CI uplaod library
                    $this->upload->initialize($config);

                    // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
                    // IF not fit into given parameter then set proper error message and redirect to car/pictire function
                    if (!$this->upload->do_upload('league_image')) {

                        $error = $this->upload->display_errors();

                        if ($_FILES["league_image"]["tmp_name"] != '') {
                            $image_info = getimagesize($_FILES["league_image"]["tmp_name"]);
                            $image_width = $image_info[0];
                            $image_height = $image_info[1];
                            $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                        }
                        $this->session->set_flashdata('error', 'League image was not uploaded.');
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
                        $image_name = $data_upload['upload_data']['file_name'];
                        $upd_data['league_image'] = $image_name;
                    }
                }

                if ($_FILES['league_logo']['name'] != NULL || $_FILES['league_logo']['name'] != "") {
                    /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                    $config['upload_path'] = './uploads/league';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['min_width'] = '300';
                    $config['min_height'] = '300';
                    $config['encrypt_name'] = TRUE;
                    $config['file_name'] = md5(uniqid(mt_rand()));

                    //Initialize all params for the CI uplaod library
                    $this->upload->initialize($config);

                    // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
                    // IF not fit into given parameter then set proper error message and redirect to car/pictire function
                    if (!$this->upload->do_upload('league_logo')) {

                        $error = $this->upload->display_errors();

                        if ($_FILES["league_logo"]["tmp_name"] != '') {
                            $image_info = getimagesize($_FILES["league_logo"]["tmp_name"]);
                            $image_width = $image_info[0];
                            $image_height = $image_info[1];
                            $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                        }
                        $this->session->set_flashdata('error', 'League logo was not uploaded.');
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
                        $image_name = $data_upload['upload_data']['file_name'];
                        $upd_data['league_logo'] = $image_name;
                    }
                }
                $where = 'id = ' . $this->db->escape($group_id);
                $this->Admin_league_model->update_record('league', $where, $upd_data);
                $this->session->set_flashdata('success', 'League Group successfully updated!');
                redirect('admin/league');
            } else {
                $ins_data = array(
                    'name' => $this->input->post('name'),
                    'introduction' => $this->input->post('introduction'),
                    'user_limit' => $this->input->post('user_limit'),
                    'requirements' => $this->input->post('requirements'),
                    'user_id' => $this->data['user_data']['id']
                );
                $upd_data = array();
                if ($league_group_id = $this->Admin_league_model->insert('league', $ins_data)) {
                    if ($_FILES['league_image']['name'] != NULL || $_FILES['league_image']['name'] != "") {
                        /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                        $config['upload_path'] = './uploads/league';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['min_width'] = '300';
                        $config['min_height'] = '300';
                        $config['encrypt_name'] = TRUE;
                        $config['file_name'] = md5(uniqid(mt_rand()));

                        //Initialize all params for the CI uplaod library
                        $this->upload->initialize($config);

                        // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
                        // IF not fit into given parameter then set proper error message and redirect to car/pictire function
                        if (!$this->upload->do_upload('league_image')) {

                            $error = $this->upload->display_errors();

                            if ($_FILES["league_image"]["tmp_name"] != '') {
                                $image_info = getimagesize($_FILES["league_image"]["tmp_name"]);
                                $image_width = $image_info[0];
                                $image_height = $image_info[1];
                                $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                            }
                            $image_name = "league_default.jpg";
                            $this->session->set_flashdata('error', 'League image was not uploaded.');
                        } else {
                            $data_upload = array('upload_data' => $this->upload->data());
                            $image_name = $data_upload['upload_data']['file_name'];
                        }
                    } else {
                        $image_name = "league_default.jpg";
                    }
                    $upd_data['league_image'] = $image_name;

                    if ($_FILES['league_logo']['name'] != NULL || $_FILES['league_logo']['name'] != "") {
                        /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                        $config['upload_path'] = './uploads/league';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['min_width'] = '300';
                        $config['min_height'] = '300';
                        $config['encrypt_name'] = TRUE;
                        $config['file_name'] = md5(uniqid(mt_rand()));

                        //Initialize all params for the CI uplaod library
                        $this->upload->initialize($config);

                        // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
                        // IF not fit into given parameter then set proper error message and redirect to car/pictire function
                        if (!$this->upload->do_upload('league_logo')) {

                            $error = $this->upload->display_errors();

                            if ($_FILES["league_logo"]["tmp_name"] != '') {
                                $image_info = getimagesize($_FILES["league_logo"]["tmp_name"]);
                                $image_width = $image_info[0];
                                $image_height = $image_info[1];
                                $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                            }
                            $image_name = "league_logo_default.jpg";
                            $this->session->set_flashdata('error', 'League logo was not uploaded.');
                        } else {
                            $data_upload = array('upload_data' => $this->upload->data());
                            $image_name = $data_upload['upload_data']['file_name'];
                        }
                    } else {
                        $image_name = "league_logo_default.jpg";
                    }
                    $upd_data['league_logo'] = $image_name;
                    $where = 'id = ' . $this->db->escape($league_group_id);
                    $this->Admin_league_model->update_record('league', $where, $upd_data);
                    $ins_user_data = array(
                        'league_id' => $league_group_id,
                        'user_id' => $this->session->user['id']
                    );
                    $this->League_model->insert_league_user($ins_user_data);
                    $this->session->set_flashdata('success', 'League Group successfully Added!');
                } else {
                    $this->session->set_flashdata('error', 'Invalid request. Please try again!');
                }
                redirect(site_url('admin/league'));
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
        $this->template->load('admin_main', 'admin/league/view', $this->data);
    }

}
