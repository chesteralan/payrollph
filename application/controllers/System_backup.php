<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_backup extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('page_title', 'PAYROLL - Backup');
		$this->template_data->set('current_page', 'Database Backup');
		$this->template_data->set('current_uri', 'system_backup');
	}

	public function index() {

		$dir    = 'backups';
		$files = array_diff(scandir($dir), array('..', '.', '.htaccess', 'index.html'));
		arsort($files);
		$this->template_data->set('backup_files', $files);

		$this->load->view('system/backup', $this->template_data->get_data());
	}

	public function download($file)
	{
		$file_dir = "backups/" . $file;
		if (file_exists($file_dir)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file_dir).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file_dir));
		    readfile($file_dir);
		    exit;
		}
		redirect("system_backup");
	}

	public function delete($file)
	{
		$file_dir = "backups/" . $file;
		if (file_exists($file_dir)) {
			unlink($file_dir);
		}
		redirect("system_backup");
	}

}
