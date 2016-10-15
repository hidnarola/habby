<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Groupplan extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Groupplan_model', 'Common_functionality'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('groupplan');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    /*
     * index method loads soulmate page view with all required details
     * develop by : HPA
     */

    public function index($page = 1) {
        $limit = 2;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('filterby');
            $this->data['filterby'] = $filterby;
            if ($filterby == 'popular') {
                $this->data['Group_plans'] = $this->Groupplan_model->get_popular_group_plans($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan($start, $limit);
            } else {
                $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan($start, $limit);
            }
        } else {
            $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan($start, $limit);
        }
        if ($page == 1) {
            $this->template->load('front', 'user/groupplan/groupplan', $this->data);
        } else {
            $data = array();
            if (count($this->data['Group_plans']) > 0) {
                $data['view'] = $this->load->view('user/partial/groupplan/display_groupplan', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    /*
     * load_groupplan method loads soulmate page view with all required details
     * develop by : AR
     */

    public function load_groupplan($page = 1) {
        $limit = 2;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('filterby');
            $this->data['filterby'] = $filterby;
            if ($filterby == 'popular') {
                $this->data['Group_plans'] = $this->Groupplan_model->get_popular_group_plans($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan($start, $limit);
            } else {
                $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan($start, $limit);
            }
        } else {
            $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan($start, $limit);
        }
        if ($page == 1) {
            $this->template->load('front', 'user/groupplan/groupplan', $this->data);
        } else {
            $data = array();
            if (count($this->data['Group_plans']) > 0) {
                $data['view'] = $this->load->view('user/partial/groupplan/display_groupplan', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    /*
     * add_group method is used to add new group in soulmate
     * develop by : HPA
     */

    public function add_group() {
        $groupplan_id = "";
        $image_name = "";
        if ($this->input->post()) {
            $ins_data = array(
                'name' => $this->input->post('name'),
                'slogan' => $this->input->post('slogan'),
                'user_limit' => $this->input->post('user_limit'),
                'introduction' => $this->input->post('introduction'),
                'user_id' => $this->data['user_data']['id'],
            );
            $groupplan_id = $this->Groupplan_model->insert_groupplan_data($ins_data);
        }
        if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
//            pr($_FILES, 1);
            /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
            $config['upload_path'] = './uploads/group_plan';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['min_width'] = '300';
            $config['min_height'] = '300';
            $config['encrypt_name'] = TRUE;

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
        $this->session->set_flashdata('message', array('message' => lang('Group plan added successfully'), 'class' => 'alert alert-success'));
        redirect('groupplan');
    }

    /*
     * search method loads soulmate search group results.
     * develop by : HPA
     */

    public function search($page = 1) {
        $limit = 2;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('topic_filter');
            $this->data['filterby'] = $filterby;
            $search_topic = $this->input->get('topic');
            $this->data['Group_plans'] = $this->Groupplan_model->get_search_groupplan($search_topic, $filterby, $start, $limit);
            if ($page == 1) {
                $this->template->load('front', 'user/groupplan/groupplan', $this->data);
            } else {
                $data = array();
                if (count($this->data['Group_plans']) > 0) {
                    $data['view'] = $this->load->view('user/partial/groupplan/display_groupplan', $this->data, true);
                    $data['status'] = 1;
                } else {
                    $data['status'] = 0;
                }
                echo json_encode($data);
            }
        }
    }

    /*
     * join method joins group plan and insert users request.
     * develop by : HPA
     */

    public function join($topic_id) {
        $id = base64_decode(urldecode($topic_id));
        $ins_data = array(
            'group_id' => $id,
            'user_id' => $this->data['user_data']['id'],
            'is_approved' => false,
        );
        $this->Groupplan_model->insert_groupplan_user($ins_data);
        $this->session->set_flashdata('message', array('message' => lang('Group plan request has been sent successfully'), 'class' => 'alert alert-success'));
        redirect('groupplan');
    }

    /*
     * details method display group plan with all required details
     * develop by : HPA
     */

    public function details($Id) {
        $limit = 20;
        $Id = base64_decode(urldecode($Id));
        $this->data['group_id'] = $Id;
        $this->data['groupplan'] = $this->Groupplan_model->get_groupplan_by_id($Id);
        $this->data['messages'] = $this->Groupplan_model->get_messages($Id, $limit);
        krsort($this->data['messages']); // Reverse array
        $this->template->load('join', 'user/groupplan/join_groupplan', $this->data);
    }

    /*
     * request_action method accept & denied group plan request.
     * develop by : HPA
     */

    public function request_action() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $Req = $this->Groupplan_model->get_groupplan_request_by_id($id);
            if ($this->input->post('action') == 'accept') {
                $insert_array = array(
                    'group_id' => $Req['group_id'],
                    'user_id' => $Req['user_id'],
                );
                $inserted_id = $this->Groupplan_model->insert_grouplan_users($insert_array);
                if ($inserted_id != "") {
                    $this->Groupplan_model->delete_grouplpan_request($id);
                }
            } else {
                $this->Groupplan_model->delete_grouplpan_request($id);
            }
            die;
        }
    }

}
