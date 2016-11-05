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
        $limit = 2;
        $start = ($page - 1) * $limit;
        $this->data['event_posts'] = $this->Event_model->get_event_post($data = array(), $this->session->user['id'], $start, $limit);
        if ($page == 1) {
            $this->template->load('front', 'user/events/events', $this->data);
        } else {
            $data = array();
            if (count($this->data['event_posts']) > 0) {
                $data['view'] = $this->load->view('user/partial/events/display_events', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
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

    /*
     * 
     */
    public function join_event($event_id){
        $logged_in_user = $this->session->user['id'];
        if(!($this->Event_model->user_exist_for_event($logged_in_user,$event_id)))
        {
            if(!($this->Event_model->user_requested_for_event($logged_in_user,$event_id)))
            {
                // Is limit exceed for particular event?
                $limit = $this->Event_model->get_limit_for_event($event_id);
                $joined_user = $this->Event_model->get_total_joined_user_for_event($event_id);
                if($joined_user < $limit)
                {
                    // User can join group
                    // Check for approval is needed or not
                    if($this->Event_model->Is_approval_needed_for_event($event_id))
                    {
                        // Request for join group
                        if($this->Event_model->add_event_join_request($logged_in_user,$event_id))
                        {
                            echo "6";
                        }
                        else
                        {
                            echo "5";
                        }
                    }
                    else
                    {
                        // Join group directly (without request)
                        if($this->Event_model->add_event_user($logged_in_user,$event_id))
                        {
                            echo "4";
                        }
                        else
                        {
                            echo "3";
                        }
                    }
                }
                else
                {
                    // Limit exceed
                    echo "2";
                }
            }
            else
            {
                // Already requested for particular event
                echo "1";
            }
        }
        else
        {
            // User already available in that event
            echo "0";
        }
    }
    
    /*
     * 
     */
    public function details($id){
        $limit = 20;
        $id = base64_decode(urldecode($id));
        $this->data['group_id'] = $id;
        $this->data['event'] = $this->Event_model->get_event_by_id($id);
        $this->data['recent_images'] = array();
        $this->data['recent_videos'] = array();
        $this->data['recent_videos_thumb'] = array();
        foreach ($this->data['recent_videos'] as $video) {
            $this->data['recent_videos_thumb'][] = explode(".", $video)[0] . "_thumb.png";
        }
        
        $this->data['messages'] = $this->Event_model->get_messages($id, $limit);;
        krsort($this->data['messages']); // Reverse array
        $this->template->load('join', 'user/events/join_event', $this->data);
    }
}