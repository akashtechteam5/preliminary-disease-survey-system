<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	 function __construct() {
        	parent::__construct();
        	$this->load->model('Cron_model');
    	}
    	
	function generate_backup() {
        $status = $this->Cron_model->backupDatabase();
    }
}