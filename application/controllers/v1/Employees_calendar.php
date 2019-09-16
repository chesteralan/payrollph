<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_calendar extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Calendar');
		$this->template_data->set('current_uri', 'employees_calendar');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'calendar', 'edit');

	}

	public function index($month=0,$year=0,$output='') {

		$current_month = ($month) ? $month : date('m');
		$current_year = ($year) ? $year : date('Y');
		$this->template_data->set('current_month', $current_month);
		$this->template_data->set('current_year', $current_year);

		$this->template_data->set('current_dates', array());

		$this->template_data->set('output', $output);
		$this->load->view('employees/calendar/calendar_list', $this->template_data->get_data());
	}

	public function records($current_date=0,$output='') {

		$this->template_data->set('output', $output);
		$this->load->view('employees/calendar/calendar_records', $this->template_data->get_data());
	}

	public function import($output='') {

		$this->template_data->set('output', $output);
		$this->load->view('employees/calendar/calendar_import', $this->template_data->get_data());
	}

}
