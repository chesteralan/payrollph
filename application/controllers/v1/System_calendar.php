<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_calendar extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Calendar');
		$this->template_data->set('current_uri', 'system_calendar');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('system', 'calendar', 'view');

	}

	public function index($month=0,$year=0,$output='') {

		$current_month = ($month) ? $month : date('m');
		$current_year = ($year) ? $year : date('Y');
		$this->template_data->set('current_month', $current_month);
		$this->template_data->set('current_year', $current_year);

		$current = new $this->Calendar_model('c');
		$current->set_select("c.*");
		$current->setCompanyId($this->session->userdata('current_company_id'),true);
		$current->set_where("((MONTH(c.calendar_date)={$current_month}) AND (YEAR(c.calendar_date)='{$current_year}'))");
		$current->set_where_or("((MONTH(c.calendar_date)={$current_month}) AND (c.repeat_yearly=1))");
		$current->set_limit(0);
		//echo $current->get_compiled_select();
		$this->template_data->set('current_dates', $current->populate());

		$this->template_data->set('output', $output);
		$this->load->view('system/calendar/calendar_list', $this->template_data->get_data());
	}

	public function edit($list_date, $output='') {

		$current = new $this->Calendar_model;
		$current->setCalendarDate($list_date,true);
		$current->setCompanyId($this->session->userdata('current_company_id'),true);

		if( $this->input->post() ) {
			if( $current->nonEmpty() ) {
				$current->setIsHoliday( (($this->input->post('is_holiday')) ? 1 : 0), false, true);
				$current->setHolidayType($this->input->post('holiday_type'), false, true);
				$current->setPremium($this->input->post('holiday_premium'), false, true);
				$current->setNotes($this->input->post('holiday_notes'), false, true);
				$current->setRepeatYearly( (($this->input->post('repeat_yearly')) ? 1 : 0), false, true);
				$current->update();
			} else {
				$current = new $this->Calendar_model;
				$current->setCalendarDate($list_date,false,true);
				$current->setCompanyId($this->session->userdata('current_company_id'),false,true);
				$current->setCompanyId($this->session->userdata('current_company_id'),true);
				$current->setIsHoliday( (($this->input->post('is_holiday')) ? 1 : 0), false, true);
				$current->setRepeatYearly( (($this->input->post('repeat_yearly')) ? 1 : 0), false, true);
				$current->setHolidayType($this->input->post('holiday_type'), false, true);
				$current->setPremium($this->input->post('holiday_premium'), false, true);
				$current->setNotes($this->input->post('holiday_notes'), false, true);
				$current->insert();
			}
			$this->postNext("system_calendar");
		}

		$this->template_data->set('current_date', $current->get());

		$terms = new $this->Terms_list_model;
		$terms->set_select("*");
		$terms->set_order('priority', 'ASC');
		$terms->set_order('name', 'ASC');
		$terms->set_start(0);
		$terms->setTrash('0',true);
		$terms->setType('holiday',true);
		$this->template_data->set('holidays', $terms->populate());

		$this->template_data->set('output', $output);
		$this->load->view('system/calendar/calendar_edit', $this->template_data->get_data());
	}

}
