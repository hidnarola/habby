<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Event_model', 'Common_functionality'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('events');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    public function index($page = 1) {
        $limit = 4;
        $start = ($page - 1) * $limit;
        if ($page == 1) {
            $this->data['event_posts'] = $this->Event_model->get_event_post($data = array(), $this->session->user['id'], $start, $limit);
//            pr($this->data['posts'],1);
            $this->template->load('front', 'user/events/events', $this->data);
        } else {
//            $data = array();
//            if (count($this->data['Group_plans']) > 0) {
//                $data['view'] = $this->load->view('user/partial/groupplan/display_groupplan', $this->data, true);
//                $data['status'] = 1;
//            } else {
//                $data['status'] = 0;
//            }
//            echo json_encode($data);
        }
    }

    public function add_event() {
        if ($this->input->post()) {
            $ins_data = array(
                'title' => $this->input->post('title'),
                'details' => $this->input->post('details'),
                'start_time' => date("Y-m-d H:i:s", strtotime($this->input->post('start_time'))),
                'end_time' => date("Y-m-d H:i:s", strtotime($this->input->post('end_time'))),
                'limit' => $this->input->post('limit'),
                'release_distance_range' => $this->input->post('distance_range'),
                'approval_needed' => ($this->input->post('approval') == "Yes") ? '1' : '0',
                'user_id' => $this->session->user['id']
            );
            if ($event_id = $this->Event_model->insert_event($ins_data)) {
                // Join user event
                $ins_arr = array(
                    'event_id'=>$event_id,
                    'user_id'=>$this->session->user['id']
                );
                $this->Event_model->insert_event_user($ins_arr);
                
                $media = array();
                if (!empty($_FILES['uploadfile']['name'])) {
                    $filecount = count($_FILES['uploadfile']['name']);
                    for ($i = 0; $i < $filecount; ++$i) {
                        $_FILES['userFile']['name'] = $_FILES['uploadfile']['name'][$i];
                        $_FILES['userFile']['type'] = $_FILES['uploadfile']['type'][$i];
                        $_FILES['userFile']['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
                        $_FILES['userFile']['error'] = $_FILES['uploadfile']['error'][$i];
                        $_FILES['userFile']['size'] = $_FILES['uploadfile']['size'][$i];

                        // Code of image uploading
                        $config['upload_path'] = './uploads/event_post';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = 1000000;
                        $config['file_name'] = md5(uniqid(mt_rand()));

                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('userFile')) {
                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('msg', 'Problem occurs during image uploading.');
                        } else {
                            $data = $this->upload->data();
                            $media_arr = array();
                            $media_arr['event_id'] = $event_id;
                            $media_arr['media_type'] = 'image';
                            $media_arr['media'] = $data['file_name'];
                            $media[] = $media_arr;
                        }
                    }
                }
                if (!empty($_FILES['videofile']['name'])) {
                    $filecount = count($_FILES['videofile']['name']);
                    for ($i = 0; $i < $filecount; ++$i) {
                        $_FILES['userFile']['name'] = $_FILES['videofile']['name'][$i];
                        $_FILES['userFile']['type'] = $_FILES['videofile']['type'][$i];
                        $_FILES['userFile']['tmp_name'] = $_FILES['videofile']['tmp_name'][$i];
                        $_FILES['userFile']['error'] = $_FILES['videofile']['error'][$i];
                        $_FILES['userFile']['size'] = $_FILES['videofile']['size'][$i];

                        // Code of image uploading
                        $config['upload_path'] = './uploads/event_post';
                        $config['allowed_types'] = 'mp4|mov|3gp';
                        $config['max_size'] = 4000000;
                        $config['file_name'] = md5(uniqid(mt_rand()));

                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('userFile')) {
                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('msg', 'Problem occurs during video uploading.');
                        } else {
                            $data = $this->upload->data();
                            $media_arr = array();
                            $media_arr['event_id'] = $event_id;
                            $media_arr['media_type'] = 'video';
                            $media_arr['media'] = $data['file_name'];
                            $media[] = $media_arr;
                        }
                    }
                }
                if (count($media) > 0) {
                    $this->Event_model->insert_event_media($media);
                }
                $this->session->set_flashdata('msg', 'Event added successfully');
            }
            else
            {
                $this->session->set_flashdata('msg', 'Event not added');
            }
        }
        redirect('events');
    }

}
