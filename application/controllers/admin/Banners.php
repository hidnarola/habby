<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin/Admin_banners_model', 'Users_model']);
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
        $this->data['banners'] = $this->Admin_banners_model->get_all_banners();
        $this->template->load('admin_main', 'admin/banners/index', $this->data);
    }

    public function action($action, $user_id) {

        $where = 'id = ' . $this->db->escape($user_id);
        $check_banner = $this->Admin_banners_model->get_result('banner_images', $where);
        if ($check_banner) {
            if ($action == 'block') {
                $update_array = array(
                    'is_active' => 0
                );
                $this->session->set_flashdata('success', 'Banner successfully Deactivated!');
            } else {
                $update_array = array(
                    'is_active' => 1
                );
                $this->session->set_flashdata('success', 'Banner successfully Activated!');
            }
            $this->Admin_banners_model->update_record('banner_images', $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        redirect(site_url('admin/banners'));
    }

    /**
     * @uses : Load view of banner list
     * @author : HPA
     * */
    public function edit() {
        $session_data = $this->session->userdata('admin');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id'], 'role_id' => 1], false, true);
        if (empty($this->data['user_data'])) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(4);
        if (is_numeric($id)) {
            $where = 'id = ' . $this->db->escape($id);
            $check_banners = $this->Admin_banners_model->get_result('banner_images', $where);
            if ($check_banners) {
                $this->data['banner_datas'] = $check_banners[0];
                $this->data['title'] = 'Habby - Admin edit banner';
                $this->data['heading'] = 'Edit Banner';
            } else {
                show_404();
            }
        } else {
            $this->data['title'] = 'Habby - Admin add banner';
            $this->data['heading'] = 'Add Banner';
        }
        if (is_numeric($id)) {
            $this->form_validation->set_rules('image_name', 'Image Name', 'trim|required');
        } else {
            $this->form_validation->set_rules('page', 'Page Name', 'trim|required');
            $this->form_validation->set_rules('image_name', 'Image Name', 'trim|required');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_main', 'admin/banners/manage', $this->data);
        } else {
            $update_array = $this->input->post(null);

            if (is_numeric($id)) {
                if (!empty($_FILES['image']['name'])) {
                    $image_name = $this->upload_image('image', 'uploads/banners');
                }
            } else {
                if (!empty($_FILES['image']['name'])) {
                    $image_name = $this->upload_image('image', 'uploads/banners');
                } else {
                    $image_name = 'home_banner.jpg';
                }
            }
            if (isset($image_name)) {
                if (is_array($image_name) && array_key_exists('errors', $image_name)) {
                    $this->session->set_flashdata('error', $image_name['errors']);
                    redirect('admin/banners/add');
                } else {
                    $update_array['image'] = $image_name;
                }
            }
            if ($id != '') {
                $this->Admin_banners_model->update_record('banner_images', $where, $update_array);
                $this->session->set_flashdata('success', 'Banner successfully updated!');
                redirect('admin/banners');
            } else {
                if (isset($update_array['is_active'])) {
                    $wheres = 'page = "' . $update_array['page'] . '"';
                    $updates_array = array(
                        'is_active' => 0,
                    );
                    $this->Admin_banners_model->update_record('banner_images', $wheres, $updates_array);
                    $update_array['is_active'] = 1;
                } else {
                    $update_array['is_active'] = 0;
                }
                $this->Admin_banners_model->insert('banner_images', $update_array);
                $this->session->set_flashdata('success', 'Banner successfully added!');
                redirect(site_url('admin/banners'));
            }
        }
    }

    function upload_image($image_name, $image_path) {
        $CI = & get_instance();
        $extension = explode('/', $_FILES[$image_name]['type']);
        $randname = uniqid() . time() . '.' . $extension[1];
        $config = array('upload_path' => $image_path,
            'allowed_types' => "png|jpg|jpeg|gif",
            'max_size' => "700KB",
            'file_name' => $randname
        );
        #Load the upload library
        $CI->load->library('upload');
        $CI->upload->initialize($config);
        if ($CI->upload->do_upload($image_name)) {
            $img_data = $CI->upload->data();
            $imgname = $img_data['file_name'];
        } else {
            $imgname = array('errors' => $CI->upload->display_errors());
        }
        return $imgname;
    }

}
