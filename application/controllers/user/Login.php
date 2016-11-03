<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['facebook']);
        $this->load->model(array('Users_model'));
    }

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

    /**
     * This function is used login.
     * develop by : HPA
     */
    public function index() {
        $this->data['user_data'] = $this->session->userdata('user');
        if (!empty($this->data['user_data'])) {
            pr($this->data['user_data'], 1);
            $this->Users_model->update_user_data($data['user_data']['id'], ['last_login' => date('Y-m-d H:i:s')]);
            redirect('home');
        }
        if ($this->session->userdata('language') == FALSE) {
            $this->session->set_userdata('language', 'english');
        }
        $this->data['fb_login_url'] = $this->facebook->get_login_url();
        $remember_me = get_cookie('Remember_me');
        /* 	If Remember_key Cookie exists in browser then it wil fetch data using it's value and 
          set sessin data and force login User */

        if (isset($remember_me)) {
            $remember_me_decode = $this->encrypt->decode($remember_me);
            $rem_data = $this->Users_model->check_if_user_exist(['id' => $remember_me_decode], false, true);
            $this->session->set_userdata(['user' => $rem_data, 'loggedin' => TRUE]);
        }
        if ($this->input->post()) {

            $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email', array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail')));
            $this->form_validation->set_rules('password', lang('Password'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));

            if ($this->form_validation->run() == FALSE) {
                $this->template->load('sign', 'user/login', $this->data);
            } else {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $remember_me = $this->input->post('remember_me');

                //check_if_user_exist - three params 1->where condition 2->is get num_rows for query 3->is fetech single or all data
                $user_data = $this->Users_model->check_if_user_exist(['email' => $email], false, true);
                if (!empty($user_data)) {
                    $db_pass = $this->encrypt->decode($user_data['password']);
                    if ($db_pass == $password) {
                        /* If remember Me Checkbox is clicked */
                        /* Set Cookie IF Start */
                        if ($remember_me == '1') {
                            $cookie = array(
                                'name' => 'Remember_me',
                                'value' => $this->encrypt->encode($user_data['id']),
                                'expire' => '172800'
                            );

                            $this->input->set_cookie($cookie);
                        } /* // END */

                        $this->session->set_userdata(['user' => $user_data, 'loggedin' => TRUE]); // Start Loggedin User Session
                        $this->session->set_flashdata('message', ['message' => lang('Login Successfully'), 'class' => 'alert alert-success']);
                        $update_arr = array();
                        if ($user_data['last_login'] < date("Y-m-d H:i:s\n", strtotime('today'))) {
                            $update_arr['total_coin'] = $user_data['total_coin'] + 5;
                        }
                        $update_arr['last_login'] = date('Y-m-d H:i:s');
                        $this->Users_model->update_user_data($user_data['id'], $update_arr); // update last login time

                        $user_redirect = $this->session->userdata('user_redirect');
                        if (!empty($user_redirect)) {
                            $this->session->unset_userdata('user_redirect');
                            redirect($user_redirect);
                        } else {
                            redirect('home');
                        }
                    } else {
                        $this->session->set_flashdata('message', ['message' => lang('Password is incorrect.'), 'class' => 'alert alert-danger']);
                        redirect('login');
                    } // End of else for if($db_pass == $password) condition
                } else {
                    $this->session->set_flashdata('message', ['message' => lang('Username and password are incorrect.'), 'class' => 'alert alert-danger']);
                    redirect('login');
                }
            }
        } else {
            $this->template->load('sign', 'user/login', $this->data);
        }
    }

    /**
     * This function is used to create new user and send verification mail.
     * develop by : HPA
     */
    public function register() {
        $this->data['user_data'] = $this->session->userdata('user');
        $this->data['all_countries'] = $this->Users_model->get_all_countries();
        if (!empty($this->data['user_data'])) {
            $this->Users_model->update_user_data($data['user_data']['id'], ['last_login' => date('Y-m-d H:i:s')]);
            redirect('home');
        }
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('required' => lang('Please fill the field') . ' %s .', 'valid_email' => lang('Please enter valid E-mail'), 'is_unique' => lang('Email is already exists')));
            $this->form_validation->set_rules('password', lang('Password'), 'trim|required|min_length[6]|matches[re_password]', array('required' => lang('Please fill the field') . ' %s .', 'min_length' => lang('Please enter password min 6 letter'), 'matches' => lang('Please enter same password')));
            $this->form_validation->set_rules('re_password', lang('Repeat Password'), 'trim|required', array('required' => lang('Please fill the field') . ' %s .'));
            if ($this->form_validation->run() == FALSE) {
                $this->template->load('sign', 'user/login', $this->data);
            } else {
                $encode_pass = $this->encrypt->encode($this->input->post('password'));
                $ins_data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => $encode_pass,
                    'gender' => $this->input->post('gender'),
                    'country' => $this->input->post('country'),
                    'bio' => $this->input->post('bio'),
                    'hobby' => $this->input->post('hobby'),
                    'user_image' => "profile_img.jpg",
                    'modified_date' => date('Y-m-d H:i:s')
                );
                $last_user_id = $this->Users_model->insert_user_data($ins_data); // v!-q Insert Data into Users Table
                if ($last_user_id != null) {

                    $token = random_string('alnum', 20);

                    // ------------------------------------------------------------------------						
                    $email_config = mail_config();
                    $this->email->initialize($email_config);

                    $path = base_url() . 'user/verify_email/' . $token;

                    $message = "<p>Hello " . $this->input->post('name') . "</p>";
                    $message .= "<p>You recently entered a contact email address. To confirm your contact email, follow the link below: <br/><a href='" . $path . "'>Click Here</a></p>";
                    $message .= "<p>Thanks</p>";


                    $this->email
                            ->from('support@habby.ch', 'Habby')
                            ->to($this->input->post('email'))
                            ->subject('Verify Email Request')
                            ->message($message);

                    $this->email->send();
                    // ------------------------------------------------------------------------

                    $ins_data_verify = [
                        'token' => $token
                    ];
                    $this->Users_model->update_user_data($last_user_id, $ins_data_verify);
                }
                $this->session->set_flashdata('message', array('message' => lang('You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!'), 'class' => 'alert alert-success'));
                redirect('login');
            }
        } else {
            $this->template->load('sign', 'user/login', $this->data);
        }
    }

    /**
     * This function is used to change language.
     * develop by : HPA
     */
    public function change_lang() {
        if ($this->input->post()) {
            $lang = $this->input->post('lang');
            if ($lang == 'eng') {
                $this->session->set_userdata('language', 'english');
            } else if ($lang == 'fr') {
                $this->session->set_userdata('language', 'french');
            } else if ($lang == 'ru') {
                $this->session->set_userdata('language', 'russian');
            }
        }
    }

}
