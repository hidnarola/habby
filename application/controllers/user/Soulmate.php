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

}
