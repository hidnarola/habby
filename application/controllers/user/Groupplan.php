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

    public function index() {
        if ($this->input->get()) {
            $filterby = $this->input->get('filterby');
            $this->data['filterby'] = $filterby;
            if ($filterby == 'popular') {
                $this->data['Group_plans'] = $this->Groupplan_model->get_popular_group_plans();
            } else if ($filterby == 'recommended') {
                $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan();
            } else {
                $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan();
            }
        } else {
            $this->data['Group_plans'] = $this->Groupplan_model->get_group_plan();
        }
        $this->template->load('front', 'user/groupplan/groupplan', $this->data);
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
        $this->session->set_flashdata('message', array('message' => lang('Group plan added successfully'), 'class' => 'alert alert-success'));
        redirect('groupplan');
    }

    /*
     * search method loads soulmate search group results.
     * develop by : HPA
     */

    public function search() {
        if ($this->input->get()) {
            $filterby = $this->input->get('topic_filter');
            $search_topic = $this->input->get('topic');
            $this->data['Group_plans'] = $this->Groupplan_model->get_search_groupplan($search_topic, $filterby);
//            pr($this->data['topichat_groups'], 1);
            $this->template->load('front', 'user/groupplan/groupplan', $this->data);
        }
    }

}
