<?php

require_once 'Api_Controller.php';

class Home extends Api_Controller {

    function __construct() {
        parent::__construct();
        
    }

    function user_detail_report_get() {
        $this->setApiUsagePermissionForUserTypes([], [0]); // allowed for 0
        $users = $this->Api_model->getUserListOnLoginId($this->LOGIN_ID);
        $this->response([
            "status" => true,
            "message" => "success",
            "data" => $users,
        ]);
    }

    function search_user_get() {
        $this->setApiUsagePermissionForUserTypes([0]); // denied for 0
        $mobile = $this->get("mobile");
        if(!$mobile){
            $this->response([
                "status" => false,
                "message" => "Please enter mobile number"
            ]);
        }
        $users = [];
        $login_id = $this->Api_model->getLoginIdFromMobile($mobile);
        if($login_id) {
            $users = $this->Api_model->getUserListOnLoginId($login_id);
        }

        $this->response([
            "status" => true,
            "message" => "success",
            "data" => compact("login_id", "users"),
        ]);
    }

    public function get_user_details_get()
    {
        $user_id = $this->get("user_id");
        if(!$user_id) {
            $this->response([
                "status" => false,
                "message" => "Please select a user",
            ]);
        }

        $userDetails = $this->Api_model->getUserDetailsFromId($user_id);
        if(!count($userDetails)) {
            $this->response([
                "status" => false,
                "message" => "Invalid user selection!"
            ]);
        }
        $this->response([
            'status' => true,
            "message" => "success",
            "data" => $userDetails
        ]);
    }

    public function update_user_symptoms_post()
    {
        $user_id = $this->post("user_id");
        $answers = $this->post("answers");
        if(!$user_id || !$answers) {
            $this->response([
                "status" => false,
                "message" => "Invalid inputs!",
            ]);
        }
        $answers = json_decode($answers, true);
        if(count($answers) != $this->Api_model->getSymptomsCount()) {
            $this->response([
                "status" => false,
                "message" => "Invalid inputs!",
            ]);
        }

        $symptomsUpdateRow = [
            "user_id" => $user_id,
            "date" => date("Y-m-d H:i:s")
        ];

        foreach ($answers as $row) {
            $symptomsUpdateRow["symptom_{$row['id']}"] = (strtolower($row['ans']) == 'yes') * 1;
        }

        if($this->Api_model->updateUserSymptoms($symptomsUpdateRow)) { // direct to db
            $this->response([
                "status" => true,
                "message" => "Success",
                "data" => $this->Api_model->getUserDetailsFromId($user_id)
            ]);
        }
        $this->response([
            "status" => false,
            "message" => "Error Occured! Please try again",
        ]);
    }
    

}
