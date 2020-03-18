<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

	 function __construct() {
        	parent::__construct();
		$this->load->model('excel_model');
		
    }
    
    function create_excel_home() {
        $date = date("Y-m-d H:i:s");
        $excel_array = $this->excel_model->get_dashboard_data();
        $this->excel_model->writeToExcel($excel_array, 'CONSOLIDATED_ALL_MATERIAL_REQUESTS' . " ($date)");
    }
    
    function create_excel_ngo_report() {
        $date = date("Y-m-d H:i:s");
        $excel_array = $this->excel_model->get_ngo_list();
        $this->excel_model->writeToExcel($excel_array, 'NGO_LIST' . " ($date)");
    }
    
    function create_excel_camp_list() {
        $date = date("Y-m-d H:i:s");
        $excel_array = $this->excel_model->get_camp_list();
        $this->excel_model->writeToExcel($excel_array, 'CAMP_LIST' . " ($date)");
    }
    
    function create_excel_item_list() {
        $date = date("Y-m-d H:i:s");
        $excel_array = $this->excel_model->get_all_item();
        $this->excel_model->writeToExcel($excel_array, 'ITEM_LIST' . " ($date)");
    }
    
    function create_excel_show_camp($camp = ''){
        $date = date("Y-m-d H:i:s");
        $input['camp_id'] = $camp;
        $excel_array = $this->excel_model->get_material_requests($input);
        $this->excel_model->writeToExcel($excel_array, 'SHOW_CAMP' . " ($date)");
    }
    
    function create_excel_show_item($item = ''){
        $date = date("Y-m-d H:i:s");
        $input['item_id'] = $item;
        $excel_array = $this->excel_model->get_material_requests($input);
        $this->excel_model->writeToExcel($excel_array, 'SHOW_ITEM' . " ($date)");
    }
    function create_excel_user_data(){
        $date = date("Y-m-d H:i:s");
        $excel_array = $this->excel_model->get_user_data();
        $this->excel_model->writeToExcel($excel_array, 'USER_DATA' . " ($date)");
    }
}