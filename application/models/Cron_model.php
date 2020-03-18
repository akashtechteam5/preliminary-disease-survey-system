<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_model extends CI_Model {
    
    public function backupDatabase() {

        ini_set("memory_limit", "10000M");
        ini_set("max_execution_time", "20000");

        $this->load->dbutil();
        $this->load->helper('file');

        $datetime = date("Y-m-d-H-i-s");
        $backup_file_name = 'ims_' . $datetime;
        $backup_file_ext = '.gz';
        $backup_file_dir = FCPATH . 'db_backup/dump/';
        $backup_file_url = base_url() . 'db_backup/dump/';
        $backup_file = $backup_file_dir . $backup_file_name . $backup_file_ext;

        if (file_exists($backup_file)) {
            echo 'File already exists. <br> Backup failed.';
            exit();
        }

        $prefs = array(
            'tables' => array(),
            'ignore' => array(),
            'format' => 'gzip',
            'filename' => $backup_file_name,
            'foreign_key_checks' => FALSE,
        );
        $backup = $this->dbutil->backup($prefs);
        write_file($backup_file, $backup);

        echo 'Backup done successfully. <br>';

        $this->deleteOldBackups(7, $backup_file_dir, array('gz'));

     }

    public function deleteOldBackups($days_before, $file_path, $file_ext) {
        $days = $days_before;
        $path = $file_path;
        $filetypes_to_delete = $file_ext;
        $old_files_found = false;

        // Open the directory
        if ($handle = opendir($path)) {
            // Loop through the directory
            while (false !== ($file = readdir($handle))) {
                // Check the file we're doing is actually a file
                if (is_file($path . $file)) {
                    $file_info = pathinfo($path . $file);
                    if (isset($file_info['extension']) && in_array(strtolower($file_info['extension']), $filetypes_to_delete)) {
                        // Check if the file is older than X days old
                        if (filemtime($path . $file) < ( time() - ( $days * 24 * 60 * 60 ) )) {
                            echo "The file $file is older than $days days. <br>";
                            $old_files_found = true;
                            // Do the deletion
                            unlink($path . $file);
                        }
                    }
                }
            }
        }
        if ($old_files_found) {
            echo 'Old backup files deleted.';
        }
    }
    

}