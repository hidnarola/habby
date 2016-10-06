<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Topichat extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Topichat_model', 'Common_functionality'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('topichat');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    /*
     * index method loads topichat page view with all required details
     * develop by : HPA
     */

    public function index() {
        $this->data['topichat_groups'] = $this->Topichat_model->get_topichat_group();
//        pr($this->data['topichat_group'], 1);
        $this->template->load('front', 'user/topichat/topichat', $this->data);
    }

    /*
     * add_group method is used to add new group in topichat
     * develop by : HPA
     */

    public function add_group() {
        $topic_group_id = "";
        $image_name = "";
        if ($this->input->post()) {
//            $this->form_validation->set_rules('topic_name', 'Topic', 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
//            $this->form_validation->set_rules('notes', lang('Notes'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
//            if (!($this->form_validation->run() == FALSE)) {
//            } else {
//                redirect('topichat');
//            }
            $ins_data = array(
                'topic_name' => $this->input->post('topic_name'),
                'person_limit' => (($this->input->post('person_limit')) == -1) ? $this->input->post('person_limit') : $this->input->post('No_of_person'),
                'notes' => $this->input->post('notes'),
                'user_id' => $this->data['user_data']['id'],
            );
            $topic_group_id = $this->Topichat_model->insert_topic_group_data($ins_data);
        }
        if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
//            pr($_FILES, 1);
            /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
            $config['upload_path'] = './uploads/topichat_group';
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
                $image_name = "topichat_img1.jpg";
                $this->session->set_flashdata('message', ['message' => 'Group cover is not uploaded.', 'class' => 'alert alert-danger']);
            } else {
                $data_upload = array('upload_data' => $this->upload->data());
                $image_name = $data_upload['upload_data']['file_name'];
            }
        } else {
            $image_name = "topichat_img1.jpg";
        }
        $this->Topichat_model->update_topic_group_data($topic_group_id, ['group_cover' => $image_name]);
        $this->session->set_flashdata('message', array('message' => lang('Topic added successfully'), 'class' => 'alert alert-success'));
        redirect('topichat');
    }

    public function profile_upload() {
        if ($_FILES) {

            /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
            $config['upload_path'] = './uploads/user_profile';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['min_width'] = '300';
            $config['min_height'] = '300';
            $config['encrypt_name'] = TRUE;

            //Initialize all params for the CI uplaod library
            $this->upload->initialize($config);

            // If picture is uploaded then IF otherwise ELSE "car_picture" paseed as input file name
            // IF not fit into given parameter then set proper error message and redirect to car/pictire function
            if (!$this->upload->do_upload('user_image')) {

                $error = $this->upload->display_errors();

                if ($_FILES["user_image"]["tmp_name"] != '') {
                    $image_info = getimagesize($_FILES["user_image"]["tmp_name"]);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $error .= lang(' Current Image Width: ') . $image_width . lang(' & Image Height: ') . $image_height;
                }

                $this->session->set_flashdata('message', ['message' => $error, 'class' => 'alert alert-danger']);
                redirect('home/profile');
            } else {
                $data_upload = array('upload_data' => $this->upload->data());
                $image_name = $data_upload['upload_data']['file_name'];
//                $img_path = 'uploads/user_profile/' . $image_name;

                $this->Users_model->update_user_data($this->data['user_data']['id'], ['user_image' => $image_name]);

                $this->session->set_flashdata('message', ['message' => lang('Image has been uploaded successfully'), 'class' => 'alert alert-success']);
                redirect('home/profile');
            }
        }
    }

}
