<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Challenge_model', 'Common_functionality'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('challenge');
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
        $limit = 3;
        $start = ($page - 1) * $limit;
        $this->data['Newest_Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
        $this->data['Popular_Challenges'] = $this->Challenge_model->get_popular_challenges($start, $limit);
        $this->data['Recom_Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
        $this->template->load('front', 'user/challenge/challenge', $this->data);
    }

    /*
     * add_group method is used to add new group in soulmate
     * develop by : HPA
     */

    public function add_group() {
        $groupplan_id = "";
        if ($this->input->post()) {
            $ins_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'rewards' => $this->input->post('rewards'),
                'user_id' => $this->data['user_data']['id'],
            );
            $groupplan_id = $this->Challenge_model->insert_challenge($ins_data);
        }
        $this->session->set_flashdata('message', array('message' => lang('Challenge added successfully'), 'class' => 'alert alert-success'));
        redirect('challenge');
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

    public function challenges($page = 1) {
        if ($this->input->get()) {
            $limit = 3;
            $start = ($page - 1) * $limit;
            $filterby = $this->input->get('ch');
            if ($filterby == 'popular') {
                $this->data['Challenges'] = $this->Challenge_model->get_popular_challenges($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            } else {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            }
            $this->template->load('front', 'user/challenge/challenges', $this->data);
        } else {
            redirect('challenge');
        }
    }

    public function load_challenge_data($page = 1) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('ch');
            if ($filterby == 'popular') {
                $this->data['Challenges'] = $this->Challenge_model->get_popular_challenges($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            } else {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            }
        }
        if ($page == 1) {
            $this->template->load('front', 'user/challenge/challenges', $this->data);
        } else {
            $data = array();
            if (count($this->data['Challenges']) > 0) {
                $data['view'] = $this->load->view('user/partial/challenge/display_challenges', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

}
