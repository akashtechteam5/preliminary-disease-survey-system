<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionnaire_model extends CI_Model {

    public $dbforge;

    function __construct() {
            parent::__construct();
            $this->dbforge = $this->load->dbforge($this->db, TRUE);

    }
    
    public function check_forge(){
        $fields = array(
            'sample_1' => array('type' => 'TEXT')
        );
        $this->dbforge->add_column('user_custom_info', $fields);
    }


    public function getAllQuestions(){
        $this->db->select('*');
        $this->db->from('questionnaire');
        $this->db->where('status',1);
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            if($row['type']!="text"){
                $row['custom_options'] = $this->getCustomOptions($row['id']);
            }
            $data[] = $row;
        }
        return $data;
    }

    public function getCustomOptions($id){
        $this->db->select('*');
        $this->db->from('questionnaire_options');
        $this->db->where('custom_info_id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertAnswers($input,$user_id,$selected_id)
    {

        $this->db->where('user_id',$selected_id);
        $count = $this->db->count_all_results('question_answers');

        
        $this->db->set('done_by',$user_id);
        
        foreach($input as $key => $value){
            if(is_array($value)){
                $value = json_encode($value);
            }
            $this->db->set($key,$value);
        }
        if($count == 0){
            $this->db->set('user_id',$selected_id);
        $this->db->insert('question_answers');
        } else {
            $this->db->where('user_id',$selected_id);
           $this->db->update('question_answers'); 
        }

    }


    public function getAnswers($selected_id)
    {
        $this->db->select('*');
        $this->db->where('user_id',$selected_id);
        $query = $this->db->get('question_answers');
        return $query->result_array();
    }
}