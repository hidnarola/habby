<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Post_model', 'Common_functionality'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('home');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    /*
     * index method loads home page view with all required details
     * develop by : ar
     */

    public function index() {
        $this->data['posts'] = $this->Post_model->smileshare_post($data = array(),$this->session->user['id']);
      //   pr($this->data['posts'],1);
        $this->template->load('front', 'user/home.php', $this->data);
    }


    /*
     * smile_share method loads home page view with all required details
     * develop by : ar
     */

    public function smile_share() {
        $this->data['posts'] = $this->Post_model->smileshare_post($data = array(),$this->session->user['id']);
      //  pr($this->data['posts'],1);
        $this->template->load('front', 'user/home.php', $this->data);
    }

    /*
     * challenge method loads home page view with all required details
     * develop by : ar
     */

    public function challenge() {
        $this->data['posts'] = $this->Post_model->challange_post($data = array(),$this->session->user['id']);
      //  pr($this->data['posts'],1);
        $this->template->load('front', 'user/home.php', $this->data);
    }

    /*
     * add_post method is used to add post in database
     * develop by : ar
     */

    public function add_post() {
        if ($this->input->post()) {


            $this->form_validation->set_rules('description', 'description', 'required');
            if (!($this->form_validation->run() == FALSE)) {

                $post_arr['description'] = $this->input->post('description');
                $post_arr['user_id'] = $this->session->user['id'];

                if($_FILES['uploadfile']['name'])
                {
                    // Code of image uploading
                    $config['upload_path']          = './uploads/user_post';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1000000;

                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('uploadfile'))
                    {
                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('msg', 'Problem occurs during image uploading.');
                    }
                    else
                    {
                            $data = array('upload_data' => $this->upload->data());

                            if($post_id = $this->Post_model->add_post($post_arr))
                            {
                                $media = array();

                                foreach($data as $row)
                                {
                                    $media_arr = array();
                                    $media_arr['post_id'] = $post_id;
                                    $media_arr['media_type'] = 'image';
                                    $media_arr['media'] = $row['file_name'];
                                    $media[] = $media_arr;
                                }
                                $this->Post_model->insert_post_media($media);
                                $this->session->set_flashdata('msg', 'post added successfully');
                            }
                            else
                            {
                                $this->session->set_flashdata('msg', 'There was some problem in uploading post.');   
                            }
                    }
                }
                else
                {
                    $this->Post_model->add_post($post_arr);
                    $this->session->set_flashdata('msg', 'post added successfully');
                }
            } else {
                $this->session->set_flashdata('msg', 'Invalid data entered for post');
            }
        }
        redirect('home');
    }

    /**
     * This function is used to log out from account.
     * develop by : HPA
     */
    public function log_out() {
        $this->session->sess_destroy();
//        $this->session->unset_userdata('user');
        delete_cookie('Remember_me');
        $this->session->set_flashdata('message', array('message' => lang('Log out Successfully.'), 'class' => 'alert alert-success'));
        redirect('login');
    }

    /**
     * This function is used to display and edit logged in user details.
     * develop by : HPA
     */
    public function profile() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));
            if ($this->form_validation->run() == FALSE) {
                $this->template->load('front', 'user/profile', $this->data);
            } else {
                $upd_data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'gender' => $this->input->post('gender'),
                    'country' => $this->input->post('country'),
                    'bio' => $this->input->post('bio'),
                    'hobby' => $this->input->post('hobby'),
                );
                $last_user_id = $this->Users_model->update_user_data($this->data['user_data']['id'], $upd_data); // v!-q Insert Data into Users Table
                $this->session->set_flashdata('message', array('message' => lang('User Profile has been updated successfully.'), 'class' => 'alert alert-success'));
                redirect('home/profile');
            }
        } else {
            $this->data['all_countries'] = $this->Users_model->get_all_countries();
            $this->template->load('front', 'user/profile', $this->data);
        }
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
