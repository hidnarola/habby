<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_posts_model', 'Users_model', 'Post_model']);
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
        $this->template->load('admin_main', 'admin/posts/index', $this->data);
    }

    /**
     * Function is used to get result based on datatable in user list page
     */
    public function list_post() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $final['recordsTotal'] = $this->Admin_posts_model->get_posts_count();
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $final['data'] = $this->Admin_posts_model->get_all_posts();
        $start = $this->input->get('start') + 1;

        foreach ($final['data'] as $key => $val) {
            $final['data'][$key] = $val;
            $final['data'][$key]['test_id'] = $start++;
        }
        echo json_encode($final);
    }

    public function action($action, $user_id) {

        $where = 'id = ' . $this->db->escape($user_id);
        $check_post = $this->Admin_posts_model->get_result('post', $where);
        if ($check_post) {
            if ($action == 'delete') {
                $update_array = array(
                    'is_deleted' => 1
                );
                $this->session->set_flashdata('success', 'User successfully deleted!');
            } elseif ($action == 'block') {
                $update_array = array(
                    'is_block' => 1
                );
                $this->session->set_flashdata('success', 'Post successfully blocked!');
            } else {
                $update_array = array(
                    'is_block' => 0
                );
                $this->session->set_flashdata('success', 'Post successfully unblocked!');
            }
            $this->Admin_posts_model->update_record('post', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/posts'));
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
        $post_id = $this->uri->segment(4);
        if (is_numeric($post_id)) {
            $check_post = $this->Admin_posts_model->get_post_result($post_id);
            if ($check_post) {
                $this->data['post_datas'] = $check_post;
                $this->data['title'] = 'Habby - Admin edit post';
                $this->data['heading'] = 'Edit post';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add post';
            $this->data['heading'] = 'Add post';
        }
        $this->form_validation->set_rules('description', 'description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/posts/manage', $this->data);
        } else {
            $post_arr['description'] = $this->input->post('description');
            $post_arr['user_id'] = $this->session->user['id'];
            if ($post_id != '') {
                $where = 'id = ' . $this->db->escape($post_id);
                if (!empty($_FILES['uploadfile']['name'])) {
                    $filecount = count($_FILES['uploadfile']['name']);
                    for ($i = 0; $i < $filecount; ++$i) {
                        $_FILES['userFile']['name'] = $_FILES['uploadfile']['name'][$i];
                        $_FILES['userFile']['type'] = $_FILES['uploadfile']['type'][$i];
                        $_FILES['userFile']['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
                        $_FILES['userFile']['error'] = $_FILES['uploadfile']['error'][$i];
                        $_FILES['userFile']['size'] = $_FILES['uploadfile']['size'][$i];

                        // Code of image uploading
                        $config['upload_path'] = './uploads/user_post';
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
                            $media_arr['post_id'] = $post_id;
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
                        $config['upload_path'] = './uploads/user_post';
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
                            $media_arr['post_id'] = $post_id;
                            $media_arr['media_type'] = 'video';
                            $media_arr['media'] = $data['file_name'];
                            $media[] = $media_arr;
                        }
                    }
                }
                if (count($media) > 0) {
                    $this->Post_model->insert_post_media($media);
                }
                $update_array = array(
                    'description' => $this->input->post('description')
                );
                $this->Admin_posts_model->update_record('post', $where, $update_array);
                $this->session->set_flashdata('success', 'post successfully updated!');
                redirect('admin/posts');
            } else {
                if ($post_id = $this->Admin_posts_model->insert('post', $post_arr)) {
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
                            $config['upload_path'] = './uploads/user_post';
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
                                $media_arr['post_id'] = $post_id;
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
                            $config['upload_path'] = './uploads/user_post';
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
                                $media_arr['post_id'] = $post_id;
                                $media_arr['media_type'] = 'video';
                                $media_arr['media'] = $data['file_name'];
                                $media[] = $media_arr;
                            }
                        }
                    }
                    if (count($media) > 0) {
                        $this->Post_model->insert_post_media($media);
                    }
                    $this->session->set_flashdata('success', 'Post successfully added!');
                } else {
                    $this->session->set_flashdata('error', 'Post not added!');
                }
                redirect(site_url('admin/posts'));
            }
        }
    }

    public function view() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $post_id = $this->uri->segment(4);
        $this->data['posts'] = $this->Admin_posts_model->get_post_details($post_id);
        $this->template->load('admin_main', 'admin/posts/view', $this->data);
    }

    public function del_post() {
        if ($this->input->post()) {
            $post_media_id = $this->input->post('post_media_id');
            $status = $this->Admin_posts_model->delete_post_media($post_media_id);
            echo $status;exit;
        }
    }

}
