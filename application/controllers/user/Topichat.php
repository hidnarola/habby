<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Topichat extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->helper('download');
        $this->load->model(array('Users_model', 'Topichat_model', 'Common_functionality', 'Seo_model'));
        $this->data['banner_image'] = $this->Common_functionality->get_banner_image('topichat');
        $session_data = $this->session->userdata('user');
        $this->data['user_data'] = $this->Users_model->check_if_user_exist(['id' => $session_data['id']], false, true);
        if (empty($this->data['user_data'])) {
            redirect('login');
        }
    }

    /*
     * index method loads topichat page view with all required details
     * develop by : HPA
     */

    public function index($page = 1) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('filterby');
            $this->data['filterby'] = $filterby;
            if ($filterby == 'popular') {
                $this->data['topichat_groups'] = $this->Topichat_model->get_popular_topichat_group($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['topichat_groups'] = $this->Topichat_model->get_recommended_group($start, $limit);
            } else {
                $this->data['topichat_groups'] = $this->Topichat_model->get_topichat_group($start, $limit);
            }
        } else {
            $this->data['topichat_groups'] = $this->Topichat_model->get_topichat_group($start, $limit);
        }
        if ($page == 1) {
            $this->data['meta_data'] = $this->Seo_model->get_page_meta('Topichat');
            $this->template->load('front', 'user/topichat/topichat', $this->data);
        } else {
            $data = array();
            if (count($this->data['topichat_groups']) > 0) {
                $data['view'] = $this->load->view('user/partial/topichat/display_topichat_group', $this->data, true);
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    public function load_topichat_data($page = 1) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('filterby');
            $this->data['filterby'] = $filterby;
            if ($filterby == 'popular') {
                $this->data['topichat_groups'] = $this->Topichat_model->get_popular_topichat_group($start, $limit);
            } else if ($filterby == 'recommended') {
                $this->data['topichat_groups'] = $this->Topichat_model->get_recommended_group($start, $limit);
            } else {
                $this->data['topichat_groups'] = $this->Topichat_model->get_topichat_group($start, $limit);
            }
        } else {
            $this->data['topichat_groups'] = $this->Topichat_model->get_topichat_group($start, $limit);
        }
        if ($page == 1) {
            $this->template->load('front', 'user/topichat/topichat', $this->data);
        } else {
            $data = array();
            if (count($this->data['topichat_groups']) > 0) {
                $data['view'] = $this->load->view('user/partial/topichat/display_topichat_group', $this->data, true);
                $data['status'] = 1;
                $data['cnt'] = count($this->data['topichat_groups']);
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    /*
     * add_group method is used to add new group in topichat
     * develop by : HPA
     */

    public function add_group() {
        $topic_group_id = "";
        $image_name = "";
        if ($this->input->post()) {
            $ins_data = array(
                'topic_name' => $this->input->post('topic_name'),
                'person_limit' => (($this->input->post('person_limit')) == -1) ? $this->input->post('person_limit') : $this->input->post('No_of_person'),
                'notes' => $this->input->post('notes'),
                'user_id' => $this->data['user_data']['id'],
            );
            $topic_group_id = $this->Topichat_model->insert_topic_group_data($ins_data);
        }
        if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
//            pr($_FILES, 1);
            /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
            $config['upload_path'] = './uploads/topichat_group';
            $config['allowed_types'] = 'gif|jpg|png';
//            $config['min_width'] = '300';
//            $config['min_height'] = '300';
            $config['encrypt_name'] = TRUE;
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
                $image_name = "topichat_img1.jpg";
                $this->session->set_flashdata('message', ['message' => lang('Group cover is not uploaded.'), 'class' => 'alert alert-danger']);
            } else {
                $data_upload = array('upload_data' => $this->upload->data());
                $image_name = $data_upload['upload_data']['file_name'];
            }
        } else {
            $image_name = "topichat_img1.jpg";
        }
        $this->Topichat_model->update_topic_group_data($topic_group_id, ['group_cover' => $image_name]);
        $ins_user_data = array(
            'topic_id' => $topic_group_id,
            'user_id' => $this->data['user_data']['id'],
        );
        $this->Topichat_model->insert_topic_group_user($ins_user_data);
        $this->session->set_flashdata('message', array('message' => lang('Topic added successfully'), 'class' => 'alert alert-success'));
        redirect('topichat');
    }

    /*
     * update_group is used to update topichat group information
     * @param $group_id     int     specify group id of the group for which we are updating info
     * 
     * @return boolean  true    if, succesfully updated
     *                  false   if, fail in updation
     * develop by : ar
     */

    public function update_group($group_id) {
        $group_id = base64_decode(urldecode($group_id));
        $image_name = "";
        if ($this->input->post()) {
            $limit = $this->Topichat_model->is_group_limit_exceed($group_id);
            if ($this->input->post('person_limit') != -1 && $limit['joined_user'] > $this->input->post('No_of_person')) {
                $this->session->set_flashdata('message', array('message' => lang('You can not set person limit less then no. of joined user.'), 'class' => 'alert alert-warning text-center flashmsg'));
                redirect('topichat/details/' . urlencode(base64_encode($group_id)));
            } else {
                $update_data = array(
                    'topic_name' => $this->input->post('topic_name'),
                    'person_limit' => (($this->input->post('person_limit')) == -1) ? $this->input->post('person_limit') : $this->input->post('No_of_person'),
                    'notes' => $this->input->post('notes'),
                        //'user_id' => $this->data['user_data']['id'],
                );
            }
        }
        if ($_FILES['group_cover']['name'] != NULL || $_FILES['group_cover']['name'] != "") {
            /* v! If Image is uploaded then use upload library for the codeigniter to upload image */
            $config['upload_path'] = './uploads/topichat_group';
            $config['allowed_types'] = 'gif|jpg|png';
//            $config['min_width'] = '300';
//            $config['min_height'] = '300';
            $config['encrypt_name'] = TRUE;
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
                $this->session->set_flashdata('message', ['message' => lang('Group cover is not uploaded.'), 'class' => 'alert alert-danger']);
            } else {
                $data_upload = array('upload_data' => $this->upload->data());
                $update_data['group_cover'] = $data_upload['upload_data']['file_name'];
            }
        }
        $this->Topichat_model->update_topic_group_data($group_id, $update_data);
        $this->session->set_flashdata('message', array('message' => lang('Topic updated successfully'), 'class' => 'alert alert-success text-center flashmsg'));
        // Add entry in modification table
        $arr['user_id'] = $this->session->user['id'];
        $arr['description'] = "Information has been changed by";
        if ($this->Topichat_model->insert_topichat_group_modification($arr)) {
            
        }
        redirect('topichat/details/' . urlencode(base64_encode($group_id)));
    }

    /*
     * search method loads topichat page view with all required details
     * develop by : HPA
     */

    public function search($page = 1) {
        $limit = 3;
        $start = ($page - 1) * $limit;
        if ($this->input->get()) {
            $filterby = $this->input->get('topic_filter');
            $search_topic = $this->input->get('topic');
            $this->data['filterby'] = $filterby;
            $this->data['topic'] = $search_topic;
            $this->data['topichat_groups'] = $this->Topichat_model->get_search_topichat_group($search_topic, $filterby, $start, $limit);
//            pr($this->data['topichat_groups'], 1);
            if ($page == 1) {
                $this->template->load('front', 'user/topichat/topichat', $this->data);
            } else {
                $data = array();
                if (count($this->data['topichat_groups']) > 0) {
                    $data['view'] = $this->load->view('user/partial/topichat/display_topichat_group', $this->data, true);
                    $data['status'] = 1;
                } else {
                    $data['status'] = 0;
                }
                echo json_encode($data);
            }
        }
    }

    /*
     * join method joins topichat and insert users request.
     * develop by : HPA
     */

    public function join($topic_id) {
        $id = base64_decode(urldecode($topic_id));
        $limit = $this->Topichat_model->is_group_limit_exceed($id);
        if ($limit['person_limit'] == -1 || $limit['person_limit'] > $limit['joined_user']) {
            $ins_data = array(
                'topic_id' => $id,
                'user_id' => $this->data['user_data']['id'],
            );
            $this->Topichat_model->insert_topic_group_user($ins_data);
            redirect('topichat/details/' . $topic_id);
        } else {
            $this->session->set_flashdata('message', array('message' => lang('You can not join this group as it reaches its limit.'), 'class' => 'alert alert-warning text-center flashmsg'));
            redirect('topichat');
        }
    }

    /*
     * details method display topichat with all required details.
     * develop by : HPA
     */

    public function details($Id) {
        $limit = 20;
        $this->data['Id'] = $Id;
        $Id = base64_decode(urldecode($Id));
        $this->data['group_id'] = $Id;
        $this->data['topichat'] = $this->Topichat_model->get_topichat_group_by_id($Id);
        $grouplimit = $this->Topichat_model->is_group_limit_exceed($Id);
        $this->data['joined_user'] = $grouplimit['joined_user'];
        $this->data['recent_images'] = $this->Topichat_model->get_recent_images($Id, $image_limit = 8);
        $this->data['recent_videos'] = $this->Topichat_model->get_recent_videos($Id, $image_limit = 8);
        $this->data['recent_links'] = $this->Topichat_model->get_recent_links($Id, $image_limit = 2);
        $this->data['recent_videos_thumb'] = array();
        foreach ($this->data['recent_videos'] as $video) {
            $this->data['recent_videos_thumb'][] = explode(".", $video)[0] . "_thumb.png";
        }
        $this->data['top_rank_post'] = $this->Topichat_model->get_top_rank_media($Id, $this->session->user['id'], $top_rank_limit = 3);
//        $this->data['shared_links'] = $this->Topichat_model->get_shared_media($Id, $this->session->user['id'], $top_rank_limit = 3);
//        pr($this->data['top_rank_post'],1);
        $this->data['messages'] = $this->Topichat_model->get_messages($Id, $this->session->user['id'], $limit);
        krsort($this->data['messages']); // Reverse array
        $this->template->load('join', 'user/topichat/join_topichat', $this->data);
    }

    public function load_more_msg($group_id) {
        $limit = 10;
        $last_msg_id = $this->input->post('last_msg');
        $this->data['messages'] = $this->Topichat_model->load_messages($group_id, $this->session->user['id'], $limit, $last_msg_id);
        if (count($this->data['messages']) > 0) {
            $data['query'] = $this->db->last_query();
            $data['status'] = 1;
            krsort($this->data['messages']); // Reverse array
            $data['view'] = $this->load->view('user/partial/topichat/load_more_msg', $this->data, true);
            $data['last_msg_id'] = $this->data['messages'][count($this->data['messages']) - 1]['id'];
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    /*
     * 
     */

    public function add_rank_to_chat_post($chat_id) {
        $uid = $this->session->user['id'];
        if (!empty($rank = $this->Topichat_model->user_rank_exist_for_chat($uid, $chat_id))) {
            // Update entry
            if (!$rank['rank']) { // rank is negetive?
                $update_arr['rank'] = "1";
                if ($this->Topichat_model->update_chat_rank($update_arr, $rank['id'])) {
                    echo "2";
                } else {
                    echo '0';
                }
            } else {
                echo "3"; // no need to insert/update
            }
        } else {
            // Insert entry
            $insert_arr['user_id'] = $uid;
            $insert_arr['topic_group_chat_id'] = $chat_id;
            $insert_arr['rank'] = '1';
            if ($this->Topichat_model->add_chat_rank($insert_arr)) {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    /*
     * 
     */

    public function subtract_rank_from_chat_post($chat_id) {
        $uid = $this->session->user['id'];
        if (!empty($rank = $this->Topichat_model->user_rank_exist_for_chat($uid, $chat_id))) {
            // Update entry
            if ($rank['rank']) { // rank is positive?
                $update_arr['rank'] = "0";
                if ($this->Topichat_model->update_chat_rank($update_arr, $rank['id'])) {
                    echo "-2";
                } else {
                    echo '0';
                }
            } else {
                echo "3"; // no need to insert/update
            }
        } else {
            // Insert entry
            $insert_arr['user_id'] = $uid;
            $insert_arr['topic_group_chat_id'] = $chat_id;
            $insert_arr['rank'] = '0';
            if ($this->Topichat_model->add_chat_rank($insert_arr)) {
                echo '-1';
            } else {
                echo '0';
            }
        }
    }

    public function topichat_media($Id) {

        $Id = base64_decode(urldecode($Id));
        $this->data['group_id'] = $Id;
        $this->data['recent_images'] = $this->Topichat_model->load_recent_images($Id, $image_limit = 8);
        $this->data['recent_videos'] = $this->Topichat_model->load_recent_videos($Id, $video_limit = 8);
        $this->data['recent_links'] = $this->Topichat_model->load_recent_links($Id, $link_limit = 6);
        $this->data['recent_videos_thumb'] = array();
        foreach ($this->data['recent_videos'] as $video) {
            $this->data['recent_videos_thumb'][] = explode(".", $video['media'])[0] . "_thumb.png";
        }
        $this->template->load('join', 'user/topichat/topichat_media', $this->data);
    }

    public function load_more_video($group_id) {
        $limit = 8;
        $last_video_id = $this->input->post('last_video');
        $this->data['recent_videos'] = $this->Topichat_model->load_recent_videos($group_id, $limit, $last_video_id);
        $this->data['recent_videos_thumb'] = array();
        foreach ($this->data['recent_videos'] as $video) {
            $this->data['recent_videos_thumb'][] = explode(".", $video['media'])[0] . "_thumb.png";
        }
        if (count($this->data['recent_videos']) > 0) {
            $data['status'] = 1;
            $data['view'] = $this->load->view('user/partial/topichat/load_more_video', $this->data, true);
            $data['last_video_id'] = $this->data['recent_videos'][count($this->data['recent_videos']) - 1]['id'];
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    public function load_more_image($group_id) {
        $limit = 4;
        $last_image_id = $this->input->post('last_image');
        $this->data['recent_images'] = $this->Topichat_model->load_recent_images($group_id, $limit, $last_image_id);
        if (count($this->data['recent_images']) > 0) {
            $data['status'] = 1;
            $data['view'] = $this->load->view('user/partial/topichat/load_more_image', $this->data, true);
            $data['last_image_id'] = $this->data['recent_images'][count($this->data['recent_images']) - 1]['id'];
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    public function load_more_links($group_id) {
        $link_limit = 2;
        $last_link_id = $this->input->post('last_link');
        $this->data['recent_links'] = $this->Topichat_model->load_recent_links($group_id, $link_limit, $last_link_id);
        if (count($this->data['recent_links']) > 0) {
            $data['status'] = 1;
            $data['view'] = $this->load->view('user/partial/topichat/load_more_links', $this->data, true);
            $data['last_link_id'] = $this->data['recent_links'][count($this->data['recent_links']) - 1]['id'];
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    public function get_content() {
        $url = "https://img.youtube.com/vi/AbzdfUNsSsM/0.jpg";
        $data = file_get_contents($url);
        $img_name = random_string('alnum', 20) . '.jpg';
        $img_path = 'uploads/shared_media/' . $img_name;
        $file_handler = fopen($img_path, 'w+');
        fputs($file_handler, $data);
        fclose($file_handler);
//        file_put_contents($img_path, $data);
        $image = "<img src='" . base_url() . "uploads/shared_media/" . $img_name . "'/>";
        echo $image;
        exit;
        return $image;
    }

    /*
     * 
     */

    public function get_chat_id_from_media_name() {
        $media = $this->input->post('media');
        echo $this->Topichat_model->get_chat_id_from_media_name($media);
    }

    public function get_chat_id_from_link_id() {
        $media = $this->input->post('link_id');
        echo $this->Topichat_model->get_chat_id_from_link($media);
    }

    public function media_details() {
        if ($this->input->post()) {
            $media = $this->input->post('image');
            $type = $this->input->post('type');
            $this->data['media_type'] = $type;
            $this->data['DEFAULT_IMAGE_PATH'] = DEFAULT_IMAGE_PATH;
            $this->data['DEFAULT_PROFILE_IMAGE_PATH'] = DEFAULT_PROFILE_IMAGE_PATH;
            $this->data['DEFAULT_CHAT_IMAGE_PATH'] = DEFAULT_CHAT_IMAGE_PATH;
            $this->data['media_content'] = $this->Topichat_model->get_media_details($media, $type);
            $group_id = $this->data['media_content']['topic_group_id'];
            $data['messages'] = $this->Topichat_model->get_messages($group_id, $this->session->user['id'], $limit = 20);
            $this->data['users'] = $this->Topichat_model->get_topichats_users($group_id);
            krsort($data['messages']); // Reverse array
            $this->data['view'] = $this->load->view('user/partial/topichat/load_more_msg', $data, true);
            echo json_encode($this->data);
            exit;
        }
    }

    public function youtube_video_details() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $this->data['media_type'] = 'Links';
            $this->data['DEFAULT_IMAGE_PATH'] = DEFAULT_IMAGE_PATH;
            $this->data['DEFAULT_PROFILE_IMAGE_PATH'] = DEFAULT_PROFILE_IMAGE_PATH;
            $this->data['DEFAULT_CHAT_IMAGE_PATH'] = DEFAULT_CHAT_IMAGE_PATH;
            $this->data['media_content'] = $this->Topichat_model->get_youtube_media_details($id);
            $group_id = $this->data['media_content']['topic_group_id'];
            $data['messages'] = $this->Topichat_model->get_messages($group_id, $this->session->user['id'], $limit = 20);
            $this->data['users'] = $this->Topichat_model->get_topichats_users($group_id);
            krsort($data['messages']); // Reverse array
            $this->data['view'] = $this->load->view('user/partial/topichat/load_more_msg', $data, true);
            echo json_encode($this->data);
            exit;
        }
    }

}
