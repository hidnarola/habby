<?php

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
        $this->load->model(array('Users_model', 'Common_functionality'));
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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('sign', 'user/forgot_password.php', $this->data);
        } else {
            $email = $this->input->post('email');
            $res_data = $this->Users_model->check_if_user_exist(array('email' => $email), false, true);
            if (!empty($res_data)) {
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
                $message .= "<p><a href='" . $path . "'>Click Here</a></p>";
                $message .= "<p>Thanks</p>";

                $this->email
                        ->from('support@habby.ch', 'Habby')
                        ->to($res_data['email'])
                        ->subject('Change Password Request')
                        ->message($message);

                $this->email->send();

                // ------------------------------------------------------------------------
                $this->session->set_flashdata('message', ['message' => lang('We have sent an email to you, please click on the link in your email to reset your password!!'), 'class' => 'alert alert-success']);
                redirect('user/forgot_password');
            } else {
                $this->session->set_flashdata('message', ['message' => lang('Incorrect Email Id.Please try again.'), 'class' => 'alert alert-danger']);
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
        }
        echo json_encode($media);
    }

}
