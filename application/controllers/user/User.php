<?php

error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('Facebook'));
        $this->load->model(array('Users_model', 'Common_functionality', 'Seo_model'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('home');
    }

    /*
     * index method loads home page view with all required details
     * develop by : ar
     */

    public function index() {
        $session_data = $this->session->userdata('user');
        $data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($data['user_data'])) {
            redirect('login');
        }
        $this->template->load('front', 'user/home.php', $this->data);
    }

    /**
     * This function is used Verify Email Address and update is_acrive to 1.
     * develop by : HPA
     */
    public function verify_email($token = null) {
        $email_user_data = $this->Users_model->fetch_email_token(['token' => $token]);
        if (!empty($email_user_data)) {
            $user_id = $email_user_data['id'];
            $db_token = $email_user_data['token'];
            $upd_data = [
                'token' => NULL,
                'is_active' => '1',
            ];
            $this->Users_model->update_user_data($user_id, $upd_data);
            $this->session->set_flashdata('message', ['message' => lang('Email Verify Successfully.'), 'class' => 'alert alert-success']);
            redirect('login');
        } else {
            $this->session->set_flashdata('message', ['message' => lang('Invalid Email Token'), 'class' => 'alert alert-danger']);
            redirect('login');
        }
    }

    /**
     * This function is used send Email for change password.
     * develop by : HPA
     */
    public function forgot_password() {
        $this->data['meta_data'] = $this->Seo_model->get_page_meta('Forgot Password');
        $this->data['fb_login_url'] = $this->facebook->get_login_url();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('sign', 'user/forgot_password.php', $this->data);
        } else {
            $email = $this->input->post('email');
            $res_data = $this->Users_model->check_if_user_exist(array('email' => $email), false, true);
            if (!empty($res_data)) {
                if ($res_data == 801) {
                    $this->session->set_flashdata('message', ['message' => lang('User is deleted by admin.'), 'class' => 'alert alert-danger']);
                    redirect('user/forgot_password');
                } else if ($res_data == 802) {
                    $this->session->set_flashdata('message', ['message' => lang('User is blocked by admin.'), 'class' => 'alert alert-danger']);
                    redirect('user/forgot_password');
                } else if ($res_data == 803) {
                    $this->session->set_flashdata('message', ['message' => lang('User is marked as inactive.'), 'class' => 'alert alert-danger']);
                    redirect('user/forgot_password');
                }
                $user_id = $res_data['id'];
//                $forgot_pass_data = $this->Users_model->fetch_email_token($user_id);
                $token = random_string('alnum', 20);
                $ins_data = [
                    'forgot_token' => $token,
                ];
                $this->Users_model->update_user_data($user_id, $ins_data);

                // ------------------------------------------------------------------------

                $email_config = mail_config();
                $this->email->initialize($email_config);

                $path = base_url() . 'user/reset_password/' . $token;
                $message = "<p>Welcome " . $res_data['name'] . "</p>";
                $message .= "<p>You have requested to have your password reset on Habby.Please click the link below to reset your password now:</p>";
                $message .= "<p><a href='" . $path . "'>" . $path . "</a></p>";
                $message .= "<p>Thanks</p>";

                $this->email
                        ->from('support@habby.ch', 'Habby')
                        ->to($res_data['email'])
                        ->subject('Change Password Request')
                        ->message($message);

                // ------------------------------------------------------------------------

                if ($this->email->send()) {
                    $this->session->set_flashdata('message', ['message' => lang('We have sent an email to you, please click on the link in your email to reset your password!!'), 'class' => 'alert alert-success']);
                    redirect('user/forgot_password');
                } else {
                    echo $this->email->print_debugger();
                }
            } else {
                $this->session->set_flashdata('message', ['message' => lang('Email id is not registered with Habby.'), 'class' => 'alert alert-danger']);
                redirect('user/forgot_password');
            }
        }
    }

    /**
     * This function is used for reset new password.
     * develop by : HPA
     */
    public function reset_password($token = null) {
        //Token base 64 encode and decode
        $this->data['fb_login_url'] = $this->facebook->get_login_url();
        $fetch_token_data = $this->Users_model->fetch_email_token(['forgot_token' => $token]);
        if (empty($fetch_token_data)) {
            $this->session->set_flashdata('message', ['message' => lang('Invalid Token'), 'class' => 'alert alert-danger']);
            redirect('login');
        } else {
            $this->form_validation->set_rules('password', lang('New Password'), 'trim|required|min_length[6]|matches[re_password]', array('required' => lang('Please fill the field') . ' %s .', 'min_length' => lang('Please enter password min 6 letter'), 'matches' => lang('Please enter same password')));
            $this->form_validation->set_rules('re_password', lang('Repeat Password'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
            $this->data['token'] = $token;
            if ($this->form_validation->run() == FALSE) {
                $this->template->load('sign', 'user/reset_password', $this->data);
            } else {
                $password = $this->input->post('password');
                $user_id = $fetch_token_data['id'];
                $encode_pass = $this->encrypt->encode($password);
                $this->Users_model->update_user_data($user_id, ['password' => $encode_pass, 'forgot_token' => null]);
                $this->session->set_flashdata('message', ['message' => lang('Your password is successfully changed! Please login to access your account!'), 'class' => 'alert alert-success']);
                redirect('login');
            }
        }
    }

    public function upload_chat_media() {
        $media = array();
        if (!empty($_FILES['image-0']['name'])) {
            $filecount = count($_FILES['image-0']['name']);
            for ($i = 0; $i < $filecount; ++$i) {
                $_FILES['image']['name'] = $_FILES['image-0']['name'][$i];
                $_FILES['image']['type'] = $_FILES['image-0']['type'][$i];
                $_FILES['image']['tmp_name'] = $_FILES['image-0']['tmp_name'][$i];
                $_FILES['image']['error'] = $_FILES['image-0']['error'][$i];
                $_FILES['image']['size'] = $_FILES['image-0']['size'][$i];

                // Code of image uploading
                $config['upload_path'] = './uploads/chat_media';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1000000;
                $config['file_name'] = md5(uniqid(mt_rand()));

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image-0')) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                    echo "0";
                    die;
                } else {
                    $data = $this->upload->data();
                    $media_arr = array();
                    $media_arr['media'] = $data['file_name'];
                    $media[] = $media_arr;
                }
            }
        } else if (!empty($_FILES['video-0']['name'])) {
            $filecount = count($_FILES['video-0']['name']);
            for ($i = 0; $i < $filecount; ++$i) {
                $_FILES['video']['name'] = $_FILES['video-0']['name'][$i];
                $_FILES['video']['type'] = $_FILES['video-0']['type'][$i];
                $_FILES['video']['tmp_name'] = $_FILES['video-0']['tmp_name'][$i];
                $_FILES['video']['error'] = $_FILES['video-0']['error'][$i];
                $_FILES['video']['size'] = $_FILES['video-0']['size'][$i];

                // Code of image uploading
                $config['upload_path'] = './uploads/chat_media';
                $config['allowed_types'] = 'mp4|mov|3gp';
                $config['max_size'] = 4000000;
                $config['file_name'] = md5(uniqid(mt_rand()));

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('video-0')) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                    echo "0";
                    die;
                } else {
                    $data = $this->upload->data();
                    $media_arr = array();
                    $media_arr['media'] = $data['file_name'];
                    $media[] = $media_arr;
                    // Create video thumb
                    $cmd = ROOT_PATH . "ffmpeg/bin/ffmpeg -i " . ROOT_PATH . "uploads/chat_media/" . $data['file_name'] . " -ss 00:00:01.435 -f image2 -vframes 1 " . ROOT_PATH . "uploads/chat_media/" . $data['raw_name'] . "_thumb.png";
                    exec($cmd);
                }
            }
        } else if (!empty($_FILES['files-0']['name'])) {
            $filecount = count($_FILES['files-0']['name']);
            for ($i = 0; $i < $filecount; ++$i) {
                $_FILES['files']['name'] = $_FILES['files-0']['name'][$i];
                $_FILES['files']['type'] = $_FILES['files-0']['type'][$i];
                $_FILES['files']['tmp_name'] = $_FILES['files-0']['tmp_name'][$i];
                $_FILES['files']['error'] = $_FILES['files-0']['error'][$i];
                $_FILES['files']['size'] = $_FILES['files-0']['size'][$i];

                // Code of image uploading
                $config['upload_path'] = './uploads/chat_media';
                $config['allowed_types'] = 'pdf|doc|docx|txt|xls|xlsx|text';
                $config['max_size'] = 5000000;
                $config['file_name'] = md5(uniqid(mt_rand()));

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('files-0')) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                    echo "0";
                    die;
                } else {
                    $data = $this->upload->data();
                    $media_arr = array();
                    $media_arr['media'] = $data['file_name'];
                    $media[] = $media_arr;
                }
            }
        } else {
            echo "601";
            die;
        }
        echo json_encode($media);
    }

    public function download_file($fileName) {
        $this->load->helper('download');
        ob_clean();
        $file = 'uploads/chat_media/' . $fileName;
        if (!file_exists($file))
            die("I'm sorry, the file doesn't seem to exist.");

        $type = filetype($file);
        // Get a date and timestamp
        $today = date("F j, Y, g:i a");
        $time = time();
        // Send file headers
        header("Content-type: $type");
        header("Content-Disposition: attachment;filename=$fileName");
        header("Content-Transfer-Encoding: binary");
        header('Pragma: no-cache');
        header('Expires: 0');
        // Send the file contents.
        set_time_limit(0);
        readfile($file);
    }

    /* v! Redirect Url for the login with facebook define in the application/config/config.php */

    public function facebook_callback() {
        $user_detail = $this->facebook->get_user();
        $sess_user_data = $this->session->userdata('user');
        if (!empty($user_detail)) {
            if (!empty($sess_user_data)) {
//                pr($sess_user_data, 1);
                $res_fb_account = $this->Users_model->check_fb_id_used($user_detail['id']);
                if ($res_fb_account == 0) {
                    //update users table with new facebook ID
                    $this->Users_model->update_user_data($sess_user_data['id'], ['external_id' => $user_detail['id'], 'signup_type' => 2]);
                    $this->session->set_flashdata('message', ['message' => lang('Your account is successfully linked to facebook.'), 'class' => 'alert alert-success']);
                    redirect('home');
                } else {
                    //Error Facebook is already connect with some other account
                    $this->session->set_flashdata('message', ['message' => lang('fb_connect_fail'), 'class' => 'alert alert-danger']);
                    redirect('home');
                }
            }
            $fname = $user_detail['first_name'];
            $lname = $user_detail['last_name'];
            $display_name = $user_detail['name'];
            $gender = 'male';
            if (!empty($user_detail['gender'])) {
                $gender = ( strtolower($user_detail['gender']) == 'male') ? 'Male' : 'Female';
            }

            $email = $user_detail['email'];
            $facebook_id = $user_detail['id'];

            $res_data = $this->Users_model->check_if_user_exist(array('email' => $email), true);
            $res_fb_account = $this->Users_model->check_fb_id_used($user_detail['id']);

            //IF New User then it will enter all data into database otherwise it will create login-session for him/her
            if ($res_data == 0 && $res_fb_account == 0) {
                $profile_image = $this->use_facebook_photo($user_detail['id']);
                $ins_data = array(
                    'name' => $display_name,
                    'email' => $email,
                    'country' => '99',
                    'gender' => $gender,
                    'external_id' => $facebook_id,
                    'signup_type' => 2,
                    'user_image' => $profile_image,
                    'is_active' => 1
                );

                $last_user_id = $this->Users_model->insert_user_data($ins_data); // Register User - add data into database
                //Create Related Sub Directories for last created User - using cms_helper.php 

                $all_user_data = $this->Users_model->check_if_user_exist(['email' => $email], false, true);
                $this->session->set_userdata(['user' => $all_user_data, 'loggedin' => TRUE]);
                $this->Users_model->update_user_data($all_user_data['id'], ['last_login' => date('Y-m-d H:i:s')]);
                redirect('home');
            } else {
                if ($res_fb_account == 0) {
                    $user_data = $this->Users_model->check_if_user_exist(array('email' => $email), false, true);
                } else {
                    $user_data = $this->Users_model->check_if_user_exist(array('external_id' => $facebook_id, 'signup_type' => 2), false, true);
                }

                // v! Redirect to password change page if users who are logged in with facebook didn't set password for their account
                if ($user_data['external_id'] != '') {
                    $this->session->set_userdata(['user' => $user_data, 'loggedin' => TRUE]);
                    $this->Users_model->update_user_data($user_data['id'], ['last_login' => date('Y-m-d H:i:s')]); // Update last Login Details
                    redirect('home');
//                    if ($user_data['password'] == '') {
////                        redirect('user/dashboard/password_change');
//                    } else {
////                        redirect('user/dashboard');
//                    }
                } else {
                    $this->session->set_flashdata('message', array('message' => lang('Email address already in use. Please try with another one.'), 'class' => 'alert alert-danger'));
                    redirect('login');
                }
            }/*  // END of ELSE of if($res_data == 0) condition */
        } else {
            $this->session->set_flashdata('message', array('message' => lang('Insufficient detail to Login. Please try again.'), 'class' => 'alert alert-danger'));
            redirect('login');
        }
    }

    public function use_facebook_photo($facebook_id) {
        if (!empty($facebook_id)) {
            $data = file_get_contents('https://graph.facebook.com/' . $facebook_id . '/picture?type=large');
            $img_name = random_string('alnum', 20) . '.jpg';
            $img_path = '/var/www/html/uploads/user_profile/' . $img_name;            
            file_put_contents($img_path, $data);
            return $img_name;
        }
    }

}
