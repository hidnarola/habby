<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soulmate extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Soulmate_model', 'Common_functionality'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('soulmate');
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

    public function index() {
        $limit = 4;
        $this->data['soulmate_groups'] = $this->Soulmate_model->get_soulmate_group(0, $limit);
        $this->template->load('front', 'user/soulmate/soulmate', $this->data);
    }

    /*
     * load_soulmate_group according to pagination
     * @param $page int specify page number
     * 
     * developed by : ar
     */

    public function load_soulmate_group($page) {
        $data = array();
        $limit = 4;
        $start = ($page - 1) * $limit;
        $this->data['soulmate_groups'] = $this->Soulmate_model->get_soulmate_group($start, $limit);
        if (count($this->data['soulmate_groups']) > 0) {
            $data['view'] = $this->load->view('user/partial/soulmate/display_soulmate_group', $this->data, true);
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    /*
     * add_group method is used to add new group in soulmate
     * develop by : HPA
     */

    public function add_group() {
        $soulmate_group_id = "";
        $image_name = "";
        if ($this->input->post()) {
            $ins_data = array(
                'name' => $this->input->post('name'),
                'slogan' => $this->input->post('slogan'),
                'introduction' => $this->input->post('introduction'),
                'user_id' => $this->data['user_data']['id'],
            );
            $soulmate_group_id = $this->Soulmate_model->insert_soulmate_data($ins_data);
        }
        if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
//            pr($_FILES, 1);
            /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
            $config['upload_path'] = './uploads/soulmate_group';
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
        $this->session->set_flashdata('message', array('message' => lang('Soulmate group added successfully'), 'class' => 'alert alert-success'));
        redirect('soulmate');
    }

    /*
     * search method loads soulmate search group results.
     * develop by : HPA
     */

    public function search($page = 1) {
        if ($this->input->get()) {
            $limit = 4;
            $start = ($page - 1) * $limit;
            $search_topic = $this->input->get('topic');
            $this->data['soulmate_groups'] = $this->Soulmate_model->get_search_soulmate_group($search_topic, $start, $limit);
            if ($page == 1) {
                $this->template->load('front', 'user/soulmate/soulmate', $this->data);
            } else {
                if (count($this->data['soulmate_groups']) > 0) {
                    $data['view'] = $this->load->view('user/partial/soulmate/display_soulmate_group', $this->data, true);
                    $data['status'] = 1;
                } else {
                    $data['status'] = 0;
                }
                echo json_encode($data);
            }
        }
    }

    /*
     * join method joins soulmate group and insert users request.
     * develop by : HPA
     */

    public function join($topic_id) {
        $id = base64_decode(urldecode($topic_id));
        $ins_data = array(
            'soulmate_group_id' => $id,
            'requested_user_id' => $this->data['user_data']['id'],
        );
        $this->Soulmate_model->insert_soulmate_request($ins_data);
        $this->session->set_flashdata('message', ['message' => 'Request has been sent sucessfully.', 'class' => 'alert alert-success']);
        redirect('soulmate');
    }

    public function details($Id) {
        $limit = 20;
        $Id = base64_decode(urldecode($Id));
        $this->data['group_id'] = $Id;
        $this->data['soulmate'] = $this->Soulmate_model->get_soulmate_group_by_id($Id);
        $this->data['messages'] = $this->Soulmate_model->get_messages($Id, $limit);
        krsort($this->data['messages']); // Reverse array
        $this->template->load('join', 'user/soulmate/join_soulmate', $this->data);
    }
    
    public function load_more_msg($group_id) {
        $limit = 10;
        $last_msg_id = $this->input->post('last_msg');
        $this->data['messages'] = $this->Soulmate_model->load_messages($group_id, $limit, $last_msg_id);
        if (count($this->data['messages']) > 0) {
            $data['status'] = 1;
            krsort($this->data['messages']); // Reverse array
            $data['view'] = $this->load->view('user/partial/soulmate/load_more_msg', $this->data, true);
            $data['last_msg_id'] = $this->data['messages'][count($this->data['messages']) - 1]['id'];
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    /*
     * request_action method accept & denied soulmate request.
     * develop by : HPA
     */

    public function request_action() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $Req = $this->Soulmate_model->get_soulmate_request_by_id($id);
            $soulmate_group_id = $Req['soulmate_group_id'];
            if ($this->input->post('action') == 'accept') {
                $updated_array = array(
                    'join_user_id' => $Req['requested_user_id'],
                );
                $updated_id = $this->Soulmate_model->update_soulmate_data($soulmate_group_id, $updated_array);
                if ($updated_id != "") {
                    $this->Soulmate_model->delete_soulmate_request($soulmate_group_id);
                }
                echo $soulmate_group_id;
                exit;
            } else {
                $this->Soulmate_model->delete_soulmate_request_by_id($id);
                exit;
            }
            die;
        }
    }

}
