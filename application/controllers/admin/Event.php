<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_event_model', 'Users_model', 'Event_model']);
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
        $this->template->load('admin_main', 'admin/event/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_event() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_event_model->get_event_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_event_model->get_all_events();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }


    public function action($action, $group_id)
    {
        $where = 'id = ' . $this->db->escape($group_id);
        $check_event = $this->Admin_event_model->get_result('events', $where);
        if ($check_event) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'Event successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_block' => 1
                );
                $this->session->set_flashdata('success', 'Event successfully blocked!');
            } else {
                $update_array = array(
                    'is_block' => 0
                );
                $this->session->set_flashdata('success', 'Event successfully unblocked!');
            }
            $this->Admin_event_model->update_record('events', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/event'));
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
            $events = $this->Admin_event_model->get_event_result($group_id);
            if ($events) {
                $this->data['events'] = $events;
                $this->data['title'] = 'Habby - Admin edit Event';
                $this->data['heading'] = 'Edit Event';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add Event';
            $this->data['heading'] = 'Add Event';
        }
        $this->form_validation->set_rules('title', 'Event Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/event/manage', $this->data);
        } else {
            if ($group_id != '') {
                // Update event
                $upd_data = array(
                    'title' => $this->input->post('title'),
                    'details' => $this->input->post('details'),
                    'start_time' => date("Y-m-d H:i:s", strtotime($this->input->post('start_time'))),
                    'end_time' => date("Y-m-d H:i:s", strtotime($this->input->post('end_time'))),
                    'limit' => $this->input->post('limit'),
                    'approval_needed' => $this->input->post('approval_needed')
                );
                $where = 'id = ' . $this->db->escape($group_id);
                
                if ($this->Admin_event_model->update_record('events', $where, $upd_data)) {
                    
                    $media = array();
                    if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
                        $config['upload_path'] = './uploads/event_post';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = 1000000;
                        $config['file_name'] = md5(uniqid(mt_rand()));

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
                            $this->session->set_flashdata('message', ['message' => 'Group cover is not uploaded.', 'class' => 'alert alert-danger']);
                        }
                        else
                        {
                            $data_upload = array('upload_data' => $this->upload->data());
                            $media_arr = array();
                            $media_arr['event_id'] = $group_id;
                            $media_arr['media_type'] = 'image';
                            $media_arr['media'] = $data_upload['upload_data']['file_name'];
                            $media[] = $media_arr;
                        }
                    }
                    if (count($media) > 0) {
                        $this->Event_model->delete_old_media($group_id);
                        $this->Event_model->insert_event_media($media);
                    }
                    
                    $this->session->set_flashdata('success', 'Event successfully updated!');
                    redirect('admin/event');
                }
            } else {
                // Insert new event
                /*
                 * Get location
                 */
                $geolocation = $this->input->post('lat') . ',' . $this->input->post('long');
                $request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false';
                $file_contents = file_get_contents($request);
                $json_decode = json_decode($file_contents);
                if (isset($json_decode->results[0])) {
                    $response = array();
                    foreach ($json_decode->results[0]->address_components as $addressComponet) {
                        if (in_array('political', $addressComponet->types)) {
                            $response[] = $addressComponet->long_name;
                        }
                    }

                    $location = array();

                    if (isset($response[1])) {
                        $location[] = $response[1];
                    }
                    if (isset($response[2])) {
                        $location[] = $response[2];
                    }
                    if (isset($response[3])) {
                        $location[] = $response[3];
                    }
                    if (count($location) > 0) {
                        $location = implode(", ", $location);
                    } else {
                        $location = "";
                    }
                }

                $ins_data = array(
                    'title' => $this->input->post('title'),
                    'details' => $this->input->post('details'),
                    'start_time' => date("Y-m-d H:i:s", strtotime($this->input->post('start_time'))),
                    'end_time' => date("Y-m-d H:i:s", strtotime($this->input->post('end_time'))),
                    'limit' => $this->input->post('limit'),
                    'approval_needed' => $this->input->post('approval_needed'),
                    'user_id' => $this->data['user_data']['id'],
                    'location_name' => $location,
                    'latitude' => $this->input->post('lat'),
                    'longitude' => $this->input->post('long')
                );
                if ($event_id = $this->Admin_event_model->insert('events', $ins_data)) {

                    // Join user event
                    $ins_arr = array(
                        'event_id' => $event_id,
                        'user_id' => $this->data['user_data']['id']
                    );
                    $this->Event_model->insert_event_user($ins_arr);

                    $media = array();
                    if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
                        // Code of image uploading
                        $config['upload_path'] = './uploads/event_post';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = 1000000;
                        $config['file_name'] = md5(uniqid(mt_rand()));
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
                            $this->session->set_flashdata('message', ['message' => 'Group cover is not uploaded.', 'class' => 'alert alert-danger']);
                        } else {
                            $data_upload = array('upload_data' => $this->upload->data());
                            $media_arr = array();
                            $media_arr['event_id'] = $event_id;
                            $media_arr['media_type'] = 'image';
                            $media_arr['media'] = $data_upload['upload_data']['file_name'];
                            $media[] = $media_arr;
                        }
                    }
                    if (count($media) > 0) {
                        $this->Event_model->insert_event_media($media);
                    }
                    $this->session->set_flashdata('success', 'Event inserted.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to insert event!');
                }
                redirect(site_url('admin/event'));
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
        $this->data['events'] = $this->Admin_event_model->get_event_result($group_id);
        $this->data['event_member'] = $this->Event_model->get_event_members($group_id);
        $this->data['event_contact'] = $this->Event_model->get_event_contact($group_id);
        $this->data['messages'] = $this->Admin_event_model->get_messages($group_id);

        $this->template->load('admin_main', 'admin/event/view', $this->data);
    }

}
