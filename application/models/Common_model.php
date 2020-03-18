<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    function getStates($state_id = '') {

        if ($state_id)
            $this->db->where('state_id',
                    $state_id);
        $query = $this->db->get('states');
        return $state_id ? $query->row_array() : $query->result_array();
    }

    function getStateDistricts($state_id) {
        $this->db->where('state_id',
                $state_id);
        $query = $this->db->get('districts');
        return $query->result_array();
    }
    
    function getDistrictPanchayaths($district_id){
        $this->db->where('district_id',
                $district_id);
        $query = $this->db->get('panchayat');
        return $query->result_array();
    }
    
    function getPanchayathVillages($panchayat_id){
        $this->db->where('panchayat_id',
                $panchayat_id);
        $query = $this->db->get('villages');
        return $query->result_array();
    }
    
    function getPHCs($panchayat_id,$district_id){
        if($panchayat_id ){
            $this->db->where('panchayat_id',
                $panchayat_id);
        }
        if($district_id){
            $this->db->where('district_id',
                $district_id);
        }
        $query = $this->db->get('phcs');
        return $query->result_array();
    }
    
    function getCHCs($panchayat_id,$district_id,$phc_id=0){
        if($panchayat_id ){
            $this->db->where('panchayat_id',
                $panchayat_id);
        }
        if($district_id){
            $this->db->where('district_id',
                $district_id);
        }
       /* if($phc_id){
            $this->db->where('phc_id',
                $phc_id);
        }*/
        //$this->db->where("(panchayat_id=$panchayat_id OR district_id=$district_id OR phc_id=$phc_id)");
        $this->db->from('chcs');
        $query = $this->db->get();
        
        if(!$this->db->count_all_results() && $panchayat_id)
            return $this->getCHCs (0, $district_id);         

        return $query->result_array();
    }
    
    function getLevels($level_id=''){
        if ($level_id)
            $this->db->where('level_type_id',
                    $level_id);
        $query = $this->db->get('level_user_type');
        return $level_id ? $query->row_array() : $query->result_array();
    }
    
    function getVulnerabilityInfo(){
        $this->db->where('status', 1);
        $query = $this->db->get('vulnerability');
        return !empty($query->result_array()) ? $query->result_array() : array();
    }
    
    function getVulnerabilityId(){
        $array = array();
        $query = $this->db->select('id')->where('status', 1)->get('vulnerability');
        foreach($query->result_array() as $row){$array[] = "vulnerability_".$row['id'];}
        return $array;
    }

}