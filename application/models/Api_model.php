<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{


    public function getApiDetails($api_key)
    {
        if (empty($api_key)) {
            return FALSE;
        }

        if ($api_key == 'AKASHRAJATHNEBEEDNITHINBIJILABHIJITHAKHIL') {
            return TRUE;
        }
    }

    public function setAccessToken($user_id)
    {
        $key = $this->generateKey();
        $ignore_limits = 0;
        $level = 1;
        $res = $this->insertKey($key, ['user_id' => $user_id, 'level' => $level, 'ignore_limits' => $ignore_limits]);
        return $res ? $key : false;
    }

    public function generateKey()
    {
        do {
            // Generate a random salt
            $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

            // If an error occurred, then fall back to the previous method
            if ($salt === false) {
                $salt = hash('sha256', time() . mt_rand());
            }

            $new_key = substr($salt, 0, config_item('rest_key_length'));
        } while ($this->keyExists($new_key));

        return $new_key;
    }

    public function keyExists($key)
    {
        return $this->db
            ->where(config_item('rest_key_column'), $key)
            ->count_all_results(config_item('rest_keys_table')) > 0;
    }

    public function insertKey($key, $data)
    {
        $data[config_item('rest_key_column')] = $key;
        $data['date_created'] = function_exists('now') ? now() : time();

        return $this->db
            ->set($data)
            ->insert(config_item('rest_keys_table'));
    }

    public function verifyLoginCredentialsLevels($username, $password)
    {
        if ($username && $password) {
            $password = sha1($password);
            $this->db->select('login_id, password,level_user_type');
            $this->db->where('mobile_no', $username);
            $this->db->where('password', $password);
            $this->db->where('status', "yes");
            $this->db->limit(1);
            $query = $this->db->get('login');
            $count = $query->num_rows();
        } else {
            return false;
        }

        if ($count == 1) {
            $user_details = $query->result_array()[0];
            $user_id = $user_details['login_id'];
            $this->db->set('last_login', date('Y-m-d H:i:s'))->where('login_id', $user_id)->update('login');
            return $user_id;
        } else {
            return false;
        }
    }

    public function verifyLoginCredentialsUser($username, $password)
    {
        if ($username && $password) {
            $password = sha1($password);
            $this->db->select('login_id, mobile_no, password');
            $this->db->where('mobile_no', $username);
            $this->db->where('password', $password);
            $this->db->where('status', "yes");
            $this->db->limit(1);
            $query = $this->db->get('login');
            $count = $query->num_rows();
        } else {
            return false;
        }

        if ($count == 1) {
            $user_details = $query->result_array()[0];
            $user_id = $user_details['login_id'];
            $this->db->set('last_login', date('Y-m-d H:i:s'))->where('login_id', $user_id)->update('login');
            return $user_id;
        } else {
            return false;
        }
    }

    public function getLoggedDetailsOnToken($access_token)
    {
        $array = $this->db->select("l.login_id, l.mobile_no, l.level_user_type")
            ->from("access_keys as ak")
            ->join("login as l", "ak.user_id=l.login_id", "INNER")
            ->where("ak.key", $access_token)
            ->limit(1)
            ->get()->result_array();
        // print_r($array);die;
        if (count($array))
            return [
                "login_id" => $array[0]['login_id'],
                "login_type" => $array[0]['level_user_type'],
                "login_mobile" => $array[0]['mobile_no']
            ];
        return [];
    }

    public function getUserListOnLoginId($login_id)
    {
        $array = $this->db->select("id, name, gender, age, health_status, vulnerability_status")
            ->where("login_id", $login_id)
            ->get("users")->result_array();
        $details = [];
        foreach ($array as $row) {
            $health_status_colour = $this->getColour("green");
            $details[] = [
                "user_id" => $row['id'],
                "name" => $row['name'],
                "gender" => $row['gender'],
                "age" => $row['age'],
                "health_status" => $row['health_status'],
                "health_status_colour" => $health_status_colour,
                "vulnerability_status" => $row['vulnerability_status'],
            ];
        }
        return $details;
    }

    public function getLoginIdFromMobile($mobile)
    {
        $array = $this->db->select("login_id")
                    ->where("mobile_no", $mobile)
                    ->limit(1)
                    ->get("login")->result_array();
        if(count($array))
            return $array[0]['login_id'];
        return 0;
    }

    public function getUserDetailsFromId($user_id)
    {
        $array = $this->db->where("id", $user_id)->limit(1)->get("users")->result_array();
        $details = [];
        if(count($array)) {
            $details["user_id"] = $user_id;
            $details["name"] = $array[0]["name"];
            $details["address"] = $array[0]["address"];
            $details["state"] = $this->getState($array[0]["state_id"]);
            $details["district"] = $this->getDistrict($array[0]["district_id"]);
            $details["panchayat"] = $this->getPanchayat($array[0]["panchayat_id"]);
            $details["village"] = $this->getVillage($array[0]["village_id"]);
            $details["contact_1"] = $array[0]["contact_1"];
            $details["contact_2"] = $array[0]["contact_2"];
            $details["contact_3"] = $array[0]["contact_3"];
            $details["health_status"] = $array[0]["health_status"];
            $details["health_status_colour"] = $this->getColour("green");
            $details["vulnerability_status"] = $array[0]["vulnerability_status"];
            $details["symptoms"] = $this->getSymptoms($user_id);
            $details["questionnaire"] = [];
            // $details["questionnaire"] = $this->getQuestionnaire($user_id);
        }
        return $details;
    }

    public function getSymptoms($user_id)
    {
        $array = $this->db->where("status", 1)->get("symptoms")->result_array();
        $symptomUpdations = $this->db->where("user_id", $user_id)->order_by("date", "DESC")->limit(1)->get("symptoms_updation_history")->result_array();
        $details = [];
        foreach ($array as $row) {
            $subDet = [
                "symptom_id" => $row["id"],
                "symptom" => $row["symptom"],
                "symptom_mal" => $row["symptom_mal"],
                "value" => "",
            ];
            if(count($symptomUpdations)) {
                $subDet["value"] = ($symptomUpdations[0]["symptom_{$row["id"]}"])?"yes":"no";
            }
            $details[] = $subDet;
        }
        return $details;
    }

    public function getColour($index)
    {
        $colours = [
            "green" => "#056300",
            "red" => "#7a1701",
            "yellow" => "#dede00",
            "blue" => "#00a7de",
        ];
        return (isset($colours[$index]))?$colours[$index]:"";
    }

    public function getState($state_id)
    {
        return $this->getValueFromId($state_id, "state_name", "state_id", "states");
    }

    public function getDistrict($district_id)
    {
        return $this->getValueFromId($district_id, "district_name", "district_id", "districts");
    }

    public function getPanchayat($panchayat_id)
    {
        return $this->getValueFromId($panchayat_id, "panchayat_name", "panchayat_id", "panchayat");
    }

    public function getVillage($village_id)
    {
        return $this->getValueFromId($village_id, "village_name", "village_id", "villages");
    }

    public function getValueFromId($columValue, $returnColumn, $conditionColumn, $table)
    {
        $array = $this->db->select($returnColumn)
                        ->from($table)
                        ->where($conditionColumn, $columValue)
                        ->limit(1)
                        ->get()->result_array();
        if(count($array))
            return $array[0][$returnColumn];
        return "";
    }

    public function getSymptomsCount()
    {
        return $this->db->where("status", 1)->count_all_results("symptoms");
    }

    public function updateUserSymptoms($symptomsUpdateRow)
    {
        return $this->db->insert("symptoms_updation_history", $symptomsUpdateRow);
    }

    public function getVulnerabilities()
    {
        $array = $this->db->where("status", 1)->get("vulnerability")->result_array();
        $data = [];
        foreach ($array as $row) {
            $data[] = [
                "id" => "vulnerability_{$row['id']}",
                "name" => $row['name'],
                "name_mal" => $row['name_mal']
            ];
        }
        return $data;
    }

    /* public function getQuestionnaire($user_id)
    {
        $array = $this->db->select("q.id, q.type, q.field_name, q.field_name_mal, qc.category")
                    ->from("questionnaire as q")
                    ->join("question_category as qc")
                    ->where("q.status", 1)
                    ->get()->result_array();
        foreach ($array as $key => $value) {
            $options = [];
            if(in_array($value["type"], ["radio", "checkbox"])) {
                $options = $this->getQuestionOptions($value["id"]);
            }
            $answer = 
        }
    }

    public function getQuestionOptions($id)
    {
        $array = $this->db->select("custom_option, custom_option_mal")
                        ->from("questionnaire_options")
                        ->where("custom_info_id", $id)
                        ->get()->result_array();
        return $array;
    } */

}
