<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_model extends CI_Model {

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

}