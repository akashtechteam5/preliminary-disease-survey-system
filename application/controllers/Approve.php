<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Approve extends Cov_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Approve_model');
    }

//    public function approve_l3() {
//        $this->load->library('pagination');
//        $config['base_url'] = base_url() . 'approve/approve_l3';
//        $length = $config['total_rows'] = $this->Approve_model->get_l3_approve_count();
//        $config['uri_segment'] = $this->uri->total_segments();
//        $config['per_page'] = 20;
//        if ($this->uri->segment(3) != "") {
//            $page = $this->uri->segment(3);
//        } else {
//            $page = 0;
//        }
//        $this->pagination->initialize($config);
//        $data['page'] = $page;
//        $data['link'] = $this->pagination->create_links();
//        $data['approve_list'] = $this->Approve_model->get_l3_approve_list($page, $config['per_page']);
//        if ($this->input->post()) {
//            $res = false;
//            $post_arr = $this->input->post(NULL, TRUE);
//            /* if (isset($post_arr['proceed'])) {
//              for ($id = 1; $id <= $length; $id++) {
//              if (array_key_exists('check_' . $id, $post_arr)) {
//              $user_id = $this->Approve_model->getUserId($post_arr["request_id$id"]);
//              $this->Approve_model->update_l3_status($user_id, 1);
//              }
//              }
//              } else { */
//            foreach ($post_arr as $key => $value) {
//                $index = explode('_', $key);
//                if ($index[0] == 'approve') {
//                    $user_id = $this->Approve_model->getUserId($post_arr["request_id$index[1]"]);
//                    $res = $this->Approve_model->update_l3_status($user_id, 1);
//                }
//            }
//            // }
//            if ($res) {
//                $msg = "Approve Success";
//                redirect($msg, 'approve/approve_l3');
//            } else {
//                $msg = "Approve Failed";
//                redirect($msg, 'approve/approve_l3');
//            }
//        }
//        $this->load->view('register/approve_l3', $data);
//    }
//
//    public function approve_l2() {
//        $this->load->library('pagination');
//        $config['base_url'] = base_url() . 'approve/approve_l2';
//        $length = $config['total_rows'] = $this->Approve_model->get_l2_approve_count();
//        $config['uri_segment'] = $this->uri->total_segments();
//        $config['per_page'] = 20;
//        if ($this->uri->segment(3) != "") {
//            $page = $this->uri->segment(3);
//        } else {
//            $page = 0;
//        }
//        $this->pagination->initialize($config);
//        $data['page'] = $page;
//        $data['link'] = $this->pagination->create_links();
//        $data['approve_list'] = $this->Approve_model->get_l2_approve_list($page, $config['per_page']);
//        if ($this->input->post()) {
//            $res = false;
//            $post_arr = $this->input->post(NULL, TRUE);
//            /* if (isset($post_arr['proceed'])) {
//              for ($id = 1; $id <= $length; $id++) {
//              if (array_key_exists('check_' . $id, $post_arr)) {
//              $user_id = $this->Approve_model->getUserId($post_arr["request_id$id"]);
//              $this->Approve_model->update_l2_status($user_id, 1);
//              }
//              }
//              } else { */
//            foreach ($post_arr as $key => $value) {
//                $index = explode('_', $key);
//                if ($index[0] == 'approve') {
//                    $user_id = $this->Approve_model->getUserId($post_arr["request_id$index[1]"]);
//                    $res = $this->Approve_model->update_l2_status($user_id, 1);
//                }
//            }
//            // }
//            if ($res) {
//                $msg = "Approve Success";
//                redirect($msg, 'approve/approve_l2');
//            } else {
//                $msg = "Approve Failed";
//                redirect($msg, 'approve/approve_l2');
//            }
//        }
//        $this->load->view('register/approve_l2', $data);
//    }
    
    public function approve_symptoms() {
        $title = 'Member Option';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $user_type = $this->LOG_USER_TYPE;
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'approve/approve_symptoms';
        $length = $config['total_rows'] = $this->Approve_model->getPendingSymptomsCount($user_type);
        $config['uri_segment'] = $this->uri->total_segments();
        $config['per_page'] = 20;
        if ($this->uri->segment(3) != "") {
            $page = $this->uri->segment(3);
        } else {
            $page = 0;
        }
        $this->pagination->initialize($config);
        $data['page'] = $page;
        $data['link'] = $this->pagination->create_links();
        
        $data['approve_list'] = $this->Approve_model->getPendingSymptoms($page, $config['per_page'], $user_type);
//        echo '<pre>';        print_r($data['approve_list']);die;
        foreach ($data as $k => $v) {
            $this->set($k, $v);
        }
        $this->setView();
    }
    
    public function edit_symptom($sym_id_enc = '') {
        $title = 'Member Option';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $data['flag'] = FALSE;
        $data['msg'] = '';
        $login_id = $this->LOG_USER_ID;
        $user_type = 3;
        $key = 'IOSS#z0!6';
        $sym_id = $this->Approve_model->decrypt($key, urldecode($sym_id_enc));
        $user_id = $this->Approve_model->getSymptomUserById($sym_id, $user_type);
        if(!$user_id){
            $this->redirect("Invalid Details", 'home', FAlSE);
        }
//            echo '<pre>';print_r($data['symptoms']);die; 
        if ($this->input->post()) {
            $post = $this->input->post(NULL, TRUE);
            if ($user_type == 3) {
                $post['approval_l3'] = 1;
            } else if ($user_type == 2) {
                $post['approval_l2'] = 1;
            }
//            $post['date'] = date('Y-m-d H:i:s');
            $flag1 = $this->Approve_model->updateUserSymptoms($sym_id,$post);
            $flag2 = $this->Approve_model->insertSymptomApprovalHistory($login_id, $user_type, $sym_id);
            //$flag = TRUE;
            if ($flag1 && $flag2) {
                $msg = "Approve Success";
                $this->redirect($msg, 'approve/approve_symptoms', TRUE);
                
            } else {
                $msg = "Approve Failed";
                $this->redirect($msg, 'approve/approve_symptoms', FALSE);
            }
        }
        $this->load->model('Symptoms_model');
        $data['symptoms'] = $this->Symptoms_model->getAllSymptoms($user_id);
        foreach ($data as $k => $v) {
            $this->set($k, $v);
        }
        $this->setView();
    }
    
    

}
