<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge extends CI_Controller {

    var $data;

    /*
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Challenge_model', 'Common_functionality'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('challenge');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    /*
     * index method loads soulmate page view with all required details
     * develop by : HPA
     */

    public function index($page = 1) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        $this->data['Newest_Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
        $this->data['Popular_Challenges'] = $this->Challenge_model->get_popular_challenges($start, $limit);
        $this->data['Recom_Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
        $this->template->load('front', 'user/challenge/challenge', $this->data);
    }

    /*
     * add_group method is used to add new group in soulmate
     * develop by : HPA
     */

    public function add_group() {
        $groupplan_id = "";
        if ($this->input->post()) {
            $ins_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'rewards' => $this->input->post('rewards'),
                'user_id' => $this->data['user_data']['id'],
            );
            $groupplan_id = $this->Challenge_model->insert_challenge($ins_data);
        }
        $ins_user_data = array(
            'challange_id' => $groupplan_id,
            'user_id' => $this->data['user_data']['id'],
        );
        $this->Challenge_model->insert_challenge_user($ins_user_data);
        $this->session->set_flashdata('message', array('message' => lang('Challenge added successfully'), 'class' => 'alert alert-success'));
        redirect('challenge');
    }

    /*
     * search method loads soulmate search group results.
     * develop by : HPA
     */

    public function search() {
        if ($this->input->get()) {
            $filterby = $this->input->get('topic_filter');
            $search_topic = $this->input->get('topic');
            $this->data['Group_plans'] = $this->Groupplan_model->get_search_groupplan($search_topic, $filterby);
//            pr($this->data['topichat_groups'], 1);
            $this->template->load('front', 'user/groupplan/groupplan', $this->data);
        }
    }

    /*
     * challenges method joins load all challenges filter wise.
     * develop by : HPA
     */

    public function challenges($page = 1) {
        if ($this->input->get()) {
            $limit = 3;
            $start = ($page - 1) * $limit;
            $filterby = $this->input->get('ch');
            if ($filterby == 'popular') {
                $this->data['Challenges'] = $this->Challenge_model->get_popular_challenges($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            } else {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            }
            $this->template->load('front', 'user/challenge/challenges', $this->data);
        } else {
            redirect('challenge');
        }
    }

    /*
     * load_challenge_data method load challenges with ajax.
     * develop by : HPA
     */

    public function load_challenge_data($page = 1) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('ch');
            if ($filterby == 'popular') {
                $this->data['Challenges'] = $this->Challenge_model->get_popular_challenges($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            } else {
                $this->data['Challenges'] = $this->Challenge_model->get_challenges($start, $limit);
            }
        }
        if ($page == 1) {
            $this->template->load('front', 'user/challenge/challenges', $this->data);
        } else {
            $data = array();
            if (count($this->data['Challenges']) > 0) {
                $data['view'] = $this->load->view('user/partial/challenge/display_challenges', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    /*
     * accept method accept challenges.
     * develop by : HPA
     */

    public function accept($topic_id) {
        $id = base64_decode(urldecode($topic_id));
        $ins_data = array(
            'challange_id' => $id,
            'user_id' => $this->data['user_data']['id'],
            'is_quit' => false,
        );
        $this->Challenge_model->insert_challenge_user($ins_data);
        redirect('challenge/details/' . $topic_id);
    }

    /*
     * details method display challenges with all required details.
     * develop by : HPA
     */

    public function details($Id) {
        $limit = 20;
        $Id = base64_decode(urldecode($Id));
        $this->data['group_id'] = $Id;
        $this->data['challenge'] = $this->Challenge_model->get_challenge_by_id($Id);
        $this->data['challenge_users'] = $this->Challenge_model->get_challenges_users($Id);
        $this->data['messages'] = $this->Challenge_model->get_messages($Id, $limit);
        
        $this->data['challenge_post'] = $this->Challenge_model->get_challenge_posts($Id);
        //pr($this->data['challenge_post'],1);
        krsort($this->data['messages']); // Reverse array
        $this->template->load('join', 'user/challenge/join_challenge', $this->data);
    }

    public function upload_media($challange_id) {
        if ($this->input->post()) {
            if (!empty($this->input->post('type'))) {
                $media = array();
                $c_id = base64_decode(urldecode($challange_id));
                if ($this->input->post('type') == "image") {
                    if (!empty($_FILES['image_upload']['name'])) {
                        $filecount = count($_FILES['image_upload']['name']);
                        for ($i = 0; $i < $filecount; ++$i) {
//                            $_FILES['userFile']['name'] = $_FILES['image_upload']['name'][$i];
//                            $_FILES['userFile']['type'] = $_FILES['image_upload']['type'][$i];
//                            $_FILES['userFile']['tmp_name'] = $_FILES['image_upload']['tmp_name'][$i];
//                            $_FILES['userFile']['error'] = $_FILES['image_upload']['error'][$i];
//                            $_FILES['userFile']['size'] = $_FILES['image_upload']['size'][$i];
                            $_FILES['userFile']['name'] = $_FILES['image_upload']['name'];
                            $_FILES['userFile']['type'] = $_FILES['image_upload']['type'];
                            $_FILES['userFile']['tmp_name'] = $_FILES['image_upload']['tmp_name'];
                            $_FILES['userFile']['error'] = $_FILES['image_upload']['error'];
                            $_FILES['userFile']['size'] = $_FILES['image_upload']['size'];

                            // Code of image uploading
                            $config['upload_path'] = './uploads/challenge_post';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['max_size'] = 1000000;

                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('userFile')) {
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('msg', 'Problem occurs during image uploading.');
                            } else {
                                $data = $this->upload->data();
                                $media_arr = array();
                                $media_arr['challange_id'] = $c_id;
                                $media_arr['user_id'] = $this->session->user['id'];
                                $media_arr['media_type'] = 'image';
                                $media_arr['media'] = $data['file_name'];
                                $media[] = $media_arr;
                            }
                        }
                        if(count($media) > 0)
                        {
                            $this->Challenge_model->insert_challenge_media($media);
                            $this->session->set_flashdata('msg','Image has succesfully uploaded');
                        }
                    }
                } else if ($this->input->post('type') == "video") {
                    if (!empty($_FILES['video_upload']['name'])) {
                        $filecount = count($_FILES['video_upload']['name']);
                        for ($i = 0; $i < $filecount; ++$i) {
//                            $_FILES['userFile']['name'] = $_FILES['video_upload']['name'][$i];
//                            $_FILES['userFile']['type'] = $_FILES['video_upload']['type'][$i];
//                            $_FILES['userFile']['tmp_name'] = $_FILES['video_upload']['tmp_name'][$i];
//                            $_FILES['userFile']['error'] = $_FILES['video_upload']['error'][$i];
//                            $_FILES['userFile']['size'] = $_FILES['video_upload']['size'][$i];
                            $_FILES['userFile']['name'] = $_FILES['video_upload']['name'];
                            $_FILES['userFile']['type'] = $_FILES['video_upload']['type'];
                            $_FILES['userFile']['tmp_name'] = $_FILES['video_upload']['tmp_name'];
                            $_FILES['userFile']['error'] = $_FILES['video_upload']['error'];
                            $_FILES['userFile']['size'] = $_FILES['video_upload']['size'];

                            // Code of image uploading
                            $config['upload_path'] = './uploads/challenge_post';
                            $config['allowed_types'] = 'mp4|mov|3gp';
                            $config['max_size'] = 4000000;

                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('userFile')) {
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('msg', 'Problem occurs during video uploading.');
                            } else {
                                $data = $this->upload->data();
                                $media_arr = array();
                                $media_arr['challange_id'] = $c_id;
                                $media_arr['user_id'] = $this->session->user['id'];
                                $media_arr['media_type'] = 'video';
                                $media_arr['media'] = $data['file_name'];
                                $media[] = $media_arr;
                            }
                        }
                        if(count($media) > 0)
                        {
                            $this->Challenge_model->insert_challenge_media($media);
                            $this->session->set_flashdata('msg','Video has succesfully uploaded');
                        }
                    }
                } else {
                    $this->session->set_flashdata("msg", "Something went wrong.");
                }
            } else {
                $this->session->set_flashdata("msg", "Please select image or video.");
            }
        } else {
            $this->session->set_flashdata("msg", "Something went wrong.");
        }
        redirect('challenge/details/' . $challange_id);
    }

    /*
     * add_coin is used to add coin to particular post
     * @param $post_id int specify post_id
     *
     * echo '1', if coin added
     * 		'2', Coin already given
     * 		'0', operation fail 
     */

    public function add_coin($post_id) {
        $user_id = $this->session->user['id'];
        if (!empty($coin = $this->Challenge_model->user_coin_exist_for_post($user_id, $post_id))) {
            echo '2';
        } else {
            $userdata = $this->Users_model->check_if_user_exist(['id' => $user_id], false, true);
            if($userdata['total_coin'] > 0)
            {
                $insert_arr['user_id'] = $user_id;
                $insert_arr['challange_post_id'] = $post_id;
                if ($this->Challenge_model->add_post_coin($insert_arr)) {
                    // Add or deduct coin from user's account
                    $this->Users_model->deduct_coin_from_user($user_id);
                    $this->Users_model->add_coin_to_user($this->Challenge_model->get_post_user($post_id));
                    echo '1';
                } else {
                    echo '0';
                }
            }
            else
            {
                echo '3';
            }
            // Insert entry
        }
    }
    
}
