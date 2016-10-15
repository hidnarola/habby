<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of League
 *
 * @author rashish
 */
class League extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Common_functionality', 'League_model'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('league');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    /**
     * This function is used to .
     * develop by : ar
     */
    public function index($page = 1) {
        $limit = 2;
        $start = ($page - 1) * $limit;
        $this->data['filterby'] = (($this->input->get('filterby')) ? $this->input->get('filterby') : '');
        $this->data['search_topic'] = (($this->input->get('topic')) ? $this->input->get('topic') : '');
        $this->data['league'] = $this->League_model->get_leagues($this->data['search_topic'], $this->data['filterby'], $start, $limit);
        if ($page == 1) {
            $this->template->load('front', 'user/league/league', $this->data);
        } else {
            $data = array();
            if (count($this->data['league']) > 0) {
                $data['view'] = $this->load->view('user/partial/league/display_league', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    public function load_league($page = 1) {
        $limit = 2;
        $start = ($page - 1) * $limit;
        $this->data['filterby'] = (($this->input->get('filterby')) ? $this->input->get('filterby') : '');
        $this->data['search_topic'] = (($this->input->get('topic')) ? $this->input->get('topic') : '');
        $this->data['league'] = $this->League_model->get_leagues($this->data['search_topic'], $this->data['filterby'], $start, $limit);
        if ($page == 1) {
            $this->template->load('front', 'user/league/league', $this->data);
        } else {
            $data = array();
            if (count($this->data['league']) > 0) {
                $data['view'] = $this->load->view('user/partial/league/display_league', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    /*
     * 
     */

    public function add_league() {
        if ($this->input->post()) {
            $insert_arr['user_id'] = $this->session->user['id'];
            $insert_arr['name'] = $this->input->post('league_name');
            $insert_arr['introduction'] = $this->input->post('league_intro');
            $insert_arr['user_limit'] = $this->input->post('user_limit');
            $insert_arr['requirements'] = $this->input->post('league_requirements');

            if ($_FILES['league_image']['name'] != NULL || $_FILES['league_image']['name'] != "") {
                /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                $config['upload_path'] = './uploads/league';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['min_width'] = '300';
                $config['min_height'] = '300';
                $config['encrypt_name'] = TRUE;

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
                    $this->session->set_flashdata('message', ['message' => 'League image was not uploaded.', 'class' => 'alert alert-danger']);
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $image_name = $data_upload['upload_data']['file_name'];
                }
            } else {
                $image_name = "league_default.jpg";
            }
            $insert_arr['league_image'] = $image_name;

            if ($_FILES['league_logo']['name'] != NULL || $_FILES['league_logo']['name'] != "") {
                /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
                $config['upload_path'] = './uploads/league';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['min_width'] = '300';
                $config['min_height'] = '300';
                $config['encrypt_name'] = TRUE;

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
                    $this->session->set_flashdata('message', ['message' => 'League logo was not uploaded.', 'class' => 'alert alert-danger']);
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $image_name = $data_upload['upload_data']['file_name'];
                }
            } else {
                $image_name = "league_logo_default.jpg";
            }
            $insert_arr['league_logo'] = $image_name;

            if (!$this->League_model->add_league($insert_arr)) {
                $this->session->set_flash('message', 'There was some problem while creating league');
            }
            $ins_data = array(
                'league_id' => $this->db->insert_id(),
                'user_id' => $this->session->user['id']
            );
            $this->League_model->insert_league_user($ins_data);
            redirect('league');
        }
    }

    /**
     * This function is used to join League group.
     * develop by : HPA
     */
    public function apply($league_id) {
        $Id = base64_decode(urldecode($league_id));
        $ins_data = array(
            'league_id' => $Id,
            'user_id' => $this->data['user_data']['id'],
        );
        $this->League_model->insert_league_user($ins_data);
        redirect('league/details/' . $league_id);
    }

    /**
     * This function is used to display League group details.
     * develop by : HPA
     */
    public function details($Id) {
        $limit = 20;
        $Id = base64_decode(urldecode($Id));
        $this->data['group_id'] = $Id;
        $this->data['league'] = $this->League_model->get_league_by_id($Id);
        $this->data['messages'] = $this->League_model->get_messages($Id, $limit);
        krsort($this->data['messages']); // Reverse array
        $this->template->load('join', 'user/league/join_league', $this->data);
    }

    public function load_more_msg($group_id) {
        $limit = 10;
        $last_msg_id = $this->input->post('last_msg');
        $this->data['messages'] = $this->League_model->load_messages($group_id, $limit, $last_msg_id);
        if (count($this->data['messages']) > 0) {
            $data['status'] = 1;
            krsort($this->data['messages']); // Reverse array
            $data['view'] = $this->load->view('user/partial/league/load_more_msg', $this->data, true);
            $data['last_msg_id'] = $this->data['messages'][count($this->data['messages']) - 1]['id'];
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

}
