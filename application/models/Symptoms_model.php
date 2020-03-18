<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Symptoms_model extends CI_Model {

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
    public function show() {
        print_r($this->db->get("test")->result());
    }

    public function getAllSymptoms($user_id) {

            $details = array();
            $i = 1;
            $this->db->where('status', 1);
            $query = $this->db->get('symptoms');
            foreach($query->result_array() as $row){
                $details[$i]['id'] = $row['id'];
                $details[$i]['symptom'] = $row['symptom'];
                $details[$i]['symptom_mal'] = $row['symptom_mal'];
                $details[$i]['value'] = $this->getUserSymptom($user_id, $row['id']);
                $i++;
            }
            return $details;
    }

    public function addUserSymptoms($data) {
        return $this->db->insert('symptoms_updation_history', $data);
    }
    
    public function getUserSymptom($user_id, $id) {
        $value = 0;
        $this->db->select("symptom_$id as id");
        $this->db->where('user_id', $user_id);
        $this->db->order_by('date', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('symptoms_updation_history');
        foreach($query->result() as $row){
            $value = $row->id;
        }
        return $value;
        
    }

}
