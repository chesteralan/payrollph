<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->template_data->set('current_page', 'Payroll');
		$this->template_data->set('current_uri', 'payroll');
		$this->template_data->set('navbar_search', true);

		$this->_isCompanyId();

		$this->_isAuth('payroll', 'payroll', 'view');

	}

	public function index($filter_year=0, $filter_month=0, $filter_template=0, $start=0) {

		$this->template_data->set('filter_year', $filter_year);
		$this->template_data->set('filter_month', $filter_month);
		$this->template_data->set('filter_template', $filter_template);

		$payrolls = new $this->Payroll_model;
		$payrolls->setCompanyId($this->session->userdata('current_company_id'),true);
		$payrolls->setActive(1,true);
		$payrolls->set_select('*');
		$payrolls->set_select('(SELECT name FROM payroll_templates WHERE id=payroll.template_id) as template_name');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_employees WHERE payroll_id=payroll.id) as employees_count');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_inclusive_dates WHERE payroll_id=payroll.id) as working_days');
		$payrolls->set_start($start);
		$payrolls->set_order('year', 'DESC');
		$payrolls->set_order('month', 'DESC');
		$payrolls->set_order('id', 'DESC');
		if( $filter_month ) {
			$payrolls->setMonth($filter_month,true);
		}
		if( $filter_year ) {
			$payrolls->setYear($filter_year,true);
		}
		if( $filter_template ) {
			$payrolls->setTemplateId($filter_template,true);
		}
		$payrolls_data = $payrolls->populate(); 
		$this->template_data->set('payrolls', $payrolls_data);

		$payroll_years = new $this->Payroll_model;
		$payroll_years->setCompanyId($this->session->userdata('current_company_id'),true);
		$payroll_years->set_select('year');
		$payroll_years->set_group_by('year');
		$payroll_years->set_order('year', 'DESC');
		$payroll_years->set_limit(0);
		$this->template_data->set('payroll_years', $payroll_years->populate());

		$payroll_months = new $this->Payroll_model;
		$payroll_months->setCompanyId($this->session->userdata('current_company_id'),true);
		$payroll_months->set_select('month');
		$payroll_months->set_group_by('month');
		$payroll_months->set_order('month', 'ASC');
		$payroll_months->set_limit(0);
		$this->template_data->set('payroll_months', $payroll_months->populate());

		$payroll_templates = new $this->Payroll_model;
		$payroll_templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$payroll_templates->set_select('template_id');
		$payroll_templates->set_select('(SELECT name FROM payroll_templates WHERE id=payroll.template_id) as template_name');
		$payroll_templates->set_group_by('template_id');
		$payroll_templates->set_order('template_id', 'ASC'); 
		$payroll_templates->set_limit(0);
		$this->template_data->set('payroll_templates', $payroll_templates->populate());

		if( $filter_template ) {
			$template = new $this->Payroll_templates_model;
			$template->setId($filter_template,true);
			$this->template_data->set('current_template', $template->get());
		}

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 6,
			'base_url' => base_url($this->config->item('index_page') . "/payroll/index/{$filter_year}/{$filter_month}/{$filter_template}"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('payroll/payroll/payroll_list', $this->template_data->get_data());
	}

	public function template($id, $start=0) {

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());

		$payrolls = new $this->Payroll_model;
		$payrolls->setCompanyId($this->session->userdata('current_company_id'),true);
		$payrolls->setActive(1,true);
		$payrolls->set_select('*');
		$payrolls->set_select('(SELECT name FROM payroll_templates WHERE id=payroll.template_id) as template_name');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_employees WHERE payroll_id=payroll.id) as employees_count');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_inclusive_dates WHERE payroll_id=payroll.id) as working_days');
		$payrolls->setTemplateId($id,true);
		$payrolls->set_start($start);
		$payrolls->set_order('year', 'DESC');
		$payrolls->set_order('month', 'DESC');
		$payrolls->set_order('id', 'DESC');
		$this->template_data->set('payrolls', $payrolls->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url($this->config->item('index_page') . "/payroll/index"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('payroll/payroll/payroll_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('payroll', 'payroll', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
			if( $this->form_validation->run() ) {
				$payroll = new $this->Payroll_model;
				$payroll->setName($this->input->post('name'));
				$payroll->setTemplateId($this->input->post('template_id'));
				$payroll->setMonth($this->input->post('month'));
				$payroll->setYear($this->input->post('year'));
				$payroll->setCompanyId($this->session->userdata('current_company_id'));
				$payroll->setActive(1);
				$payroll->insert();
			}
			$this->postNext();
		}

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_add', $this->template_data->get_data());

	}

	public function edit($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);

		if( $this->input->get('lock') == 'update' ) {
			$payroll_data = $payroll->get();
			$payroll->setLock((($payroll_data->lock)?0:1),false,true);
			$payroll->update();
			redirect( $this->input->get('next') );
		}
		if( $payroll->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$payroll->setName($this->input->post('name'),false,true);
					$payroll->setTemplateId($this->input->post('template_id'),false,true);
					$payroll->setMonth($this->input->post('month'),false,true);
					$payroll->setYear($this->input->post('year'),false,true);
					$payroll->setLock((($this->input->post('lock'))?1:0),false,true);
					$payroll->update();
				}
				$this->postNext();
			}
		}
		$this->template_data->set('payroll', $payroll->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		$this->_isAuth('payroll', 'payroll', 'delete');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true,false);
		$payroll->setActive('0',false,true);
		$payroll->update();

		$this->getNext("payroll");
	}

	public function lock($id) {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->setLock(1,false,true);
		$payroll->update();
		redirect($this->input->get('next'));
	}

	public function unlock($id) {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->setLock(0,false,true);
		$payroll->update();
		redirect($this->input->get('next'));
	}

	public function config($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$this->template_data->set('payroll', $payroll->get());

		$generate = true;

		$payroll_group = new $this->Payroll_groups_model;
		$payroll_group->setPayrollId($id,true);
		if( $payroll_group->nonEmpty() ) {
			$generate = false;
		}
		$this->template_data->set('generate', $generate);

		$inclusive_dates = false;
		$dates = new $this->Payroll_inclusive_dates_model;
		$dates->setPayrollId($id,true);
		if( $dates->nonEmpty() ) {
			$inclusive_dates = true;
		}
		$this->template_data->set('inclusive_dates', $inclusive_dates);

		$this->template_data->set('generate', $generate);

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_config', $this->template_data->get_data());
	}

	public function print_group($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$this->template_data->set('payroll', $payroll->get());

		$options = new $this->Companies_options_model;
		$options->setCompanyId($this->session->userdata('current_company_id'),true);
		$options->setKey('print_group',true);
		$options_data = $options->get();
		$this->template_data->set('print_group_option', $options_data);

		if( $options_data ) {
			$print_groups = new $this->Terms_list_model;
			$print_groups->setTrash('0',true);
			$print_groups->setType('print_group',true);
			$print_groups->set_select("*");
			$print_groups->set_order('priority', 'ASC');
			$print_groups->set_order('name', 'ASC');
			$print_groups->set_limit(0);
			$print_groups->set_where_in('id', unserialize($options_data->value));
			$this->template_data->set('print_groups', $print_groups->populate());
		}

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_print', $this->template_data->get_data());
	}

	public function inclusive_dates($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$current_month = ($this->input->get('month')) ? $this->input->get('month') : $payroll_data->month;
		$current_year = ($this->input->get('year')) ? $this->input->get('year') : $payroll_data->year;

		if( $payroll->nonEmpty() ) {
			if( $this->input->post() ) {

				$this->form_validation->set_rules('inclusive_date[]', 'Inclusive Date', 'trim|required');
				
				if( $this->form_validation->run() ) {
					if( $this->input->post('selected') ) {
						foreach( $this->input->post('inclusive_date') as $list_date ) {
							if( ! in_array($list_date, $this->input->post('selected')) ) {
								$inc_date = new $this->Payroll_inclusive_dates_model;
								$inc_date->setPayrollId($id,true);
								$inc_date->setInclusiveDate($list_date,true);
								$inc_date->set_where("(SELECT company_id FROM payroll WHERE id=payroll_inclusive_dates.payroll_id) = " . $this->session->userdata('current_company_id'));
								if( $inc_date->nonEmpty() ) {
									$inc_date->delete();
								}
							}
						}

						foreach($this->input->post('selected') as $selected) {
							$sel_dates = new $this->Payroll_inclusive_dates_model;
							$sel_dates->setPayrollId($id, true);
							$sel_dates->setInclusiveDate($selected, true);
							if( $sel_dates->nonEmpty() == false) {
								$sel_dates->insert();
							}
						}
					} else {
						$inc_date = new $this->Payroll_inclusive_dates_model;
						$inc_date->setPayrollId($id,true);
						$inc_date->delete();
					}
				}

				$this->postNext();
			}

		}

		$dates = new $this->Payroll_inclusive_dates_model;
		$dates->setPayrollId($id,true);
		$dates->set_limit(0);
		$dates->set_order('inclusive_date', 'ASC');
		$this->template_data->set('inclusive_dates', $dates->populate());

		$not_available_days = new $this->Payroll_inclusive_dates_model;
		$not_available_days->set_where('payroll_id !=' . $id);
		$not_available_days->set_where('MONTH(inclusive_date)', $current_month);
		$not_available_days->set_where('YEAR(inclusive_date)', $current_year);
		$not_available_days->set_where('(SELECT payroll.active FROM payroll WHERE payroll.id=payroll_inclusive_dates.payroll_id ) = 1');
		$not_available_days->set_where('(SELECT payroll.company_id FROM payroll WHERE payroll.id=payroll_inclusive_dates.payroll_id ) = ' . $this->session->userdata('current_company_id'));
		$not_available_days->set_select('DAY(inclusive_date) as day');
		$not_available_days->set_select('inclusive_date');
		$not_available_days->set_limit(0);
		$not_available_days->set_order('inclusive_date', 'ASC');
		$this->template_data->set('not_available_days', $not_available_days->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_calendar', $this->template_data->get_data());
	}

	private function _generate_earnings($payroll_data,$earning_id,$employee) {

		 $ee_earnings = new $this->Employees_earnings_model;
		 $ee_earnings->setNameId($employee->name_id,true);
		 $ee_earnings->setCompanyId($this->session->userdata('current_company_id'),true);
		 $ee_earnings->setEarningId($earning_id,true);
		 $ee_earnings->setTrash(0,true);
		 $ee_earnings->setActive(1,true);
		 $ee_earnings->set_where('(start_date <= "' . date('Y-m-d', strtotime($payroll_data->inclusive_dates->end_date)) . '")');
		 $ee_earnings->set_select("*");
		 $ee_earnings->set_select('(SELECT SUM(amount) FROM payroll_employees_earnings ped WHERE ped.entry_id=employees_earnings.id AND ped.name_id=employees_earnings.name_id) as earned');
		 $ee_earnings->set_where("((SELECT COUNT(*) FROM `employees_earnings_templates` WHERE ee_id=employees_earnings.id AND template_id={$payroll_data->template_id}) > 0)");

		 $days_present = ($payroll_data->inclusive_dates->working_days);

		 $ee_ernings_data = $ee_earnings->populate();
		 if( $ee_ernings_data ) foreach( $ee_ernings_data as $earning2 ) {
		 	
		 	$pee_earning = new $this->Payroll_employees_earnings_model;
		 	$pee_earning->setPayrollId($payroll_data->id,true);
		 	$pee_earning->setNameId($earning2->name_id,true);
		 	$pee_earning->setEarningId($earning2->earning_id,true);
		 	$pee_earning->setEntryId($earning2->id,true);

		 	switch( $earning2->computed ) {
		 		case 'hour':
		 			$pee_earning->setNotes(number_format($earning2->amount,2) . " X " . $days_present . " days");
		 			$eamount = $earning2->amount * $days_present;
		 		break;
		 		case 'day':
		 			$pee_earning->setNotes(number_format($earning2->amount,2) . " X " . $days_present . " days");
		 			$eamount = $earning2->amount * $days_present;
		 		break;
		 		case 'month':
		 		default:
		 			$pee_earning->setNotes(number_format($earning2->amount,2) . " X 1 Month");
		 			$eamount = $earning2->amount;
		 		break;
		 	}

		 	switch( $earning2->multiplier ) { 
		 		case 'employment':
		 			$end_date = new DateTime($payroll_data->inclusive_dates->end_date);
					$hired = new DateTime($employee->hired);
					$diff = $hired->diff($end_date);
					$pee_earning->setNotes($pee_earning->getNotes() . " X Employment: " . $diff->y . " years");
					$eamount = $eamount * $diff->y;
		 		break;
		 		case 'birthday':
		 			$end_date = new DateTime($payroll_data->inclusive_dates->end_date);
		 			$birth_date = new DateTime($employee->birthday);
					$diff = $birth_date->diff($end_date);
					$pee_earning->setNotes($pee_earning->getNotes() . " X Birthday: " . $diff->y . " years");
					$eamount = $eamount * $diff->y;
		 		break;
		 	}

		 	if( floatval( $earning2->max_amount ) > 0 ) {
		 		$ebalance = $earning2->max_amount - $earning2->earned;
		 		$eamount = ( $ebalance >= $eamount) ? $eamount : $ebalance;
		 	}

		 	$pee_earning->setAmount( $eamount );
		 	
		 	if( ($pee_earning->nonEmpty() === false) && (floatval($eamount) > 0) ) {
				$pee_earning->insert();
			} 

		 }
		 
	}

	private function _generate_benefits($payroll_data,$benefit_id,$employee) {
			$ee_benefits = new $this->Employees_benefits_model;
			 $ee_benefits->setCompanyId($this->session->userdata('current_company_id'),true);
			 $ee_benefits->setNameId($employee->name_id,true);
			 $ee_benefits->setBenefitId($benefit_id,true);
			 $ee_benefits->setTrash(0,true);
			 $ee_benefits->setPrimary(1,true);
			 $ee_benefits->set_where('(start_date <= "' . date('Y-m-d', strtotime($payroll_data->inclusive_dates->end_date)) . '")');
			 $ee_benefits->set_where("((SELECT COUNT(*) FROM `employees_benefits_templates` WHERE eb_id=employees_benefits.id AND template_id={$payroll_data->template_id}) > 0)");

			 $ee_benefits_data = $ee_benefits->populate();
			 if( $ee_benefits_data ) foreach( $ee_benefits_data as $benefit2 ) {
			 	$peb_benefit = new $this->Payroll_employees_benefits_model;
			 	$peb_benefit->setPayrollId($payroll_data->id,true);
			 	$peb_benefit->setNameId($benefit2->name_id,true);
			 	$peb_benefit->setBenefitId($benefit2->benefit_id,true);
			 	$peb_benefit->setEntryId($benefit2->id,true);
			 	$peb_benefit->setEmployeeShare($benefit2->employee_share);
			 	$peb_benefit->setEmployerShare($benefit2->employer_share);
				if( $peb_benefit->nonEmpty() ) {
					$peb_benefit->update();
				} else {
					$peb_benefit->insert();
				}
			 }
	}

	private function _generate_deductions($payroll_data,$deduction_id,$employee) {
			 $ee_deductions = new $this->Employees_deductions_model;
			 $ee_deductions->setCompanyId($this->session->userdata('current_company_id'),true);
			 $ee_deductions->setNameId($employee->name_id,true);
			 $ee_deductions->setDeductionId($deduction_id,true);
			 $ee_deductions->setTrash(0,true);
			 $ee_deductions->setActive(1,true);
			 $ee_deductions->set_where('(start_date <= "' . date('Y-m-d', strtotime($payroll_data->inclusive_dates->end_date)) . '")');
			 $ee_deductions->set_limit(0);
			 $ee_deductions->set_select("*");
			 $ee_deductions->set_select('(SELECT SUM(amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=employees_deductions.id AND ped.name_id=employees_deductions.name_id) as deducted');
			 $ee_deductions->set_where("((SELECT COUNT(*) FROM `employees_deductions_templates` WHERE ed_id=employees_deductions.id AND template_id={$payroll_data->template_id}) > 0)");
			 
			 $days_present = ($payroll_data->inclusive_dates->working_days);

			 $ee_deductions_data = $ee_deductions->populate();
			 if( $ee_deductions_data ) foreach( $ee_deductions_data as $deduction2 ) {

			 	$ped_deduction = new $this->Payroll_employees_deductions_model;
			 	$ped_deduction->setPayrollId($payroll_data->id,true);
			 	$ped_deduction->setNameId($deduction2->name_id,true);
			 	$ped_deduction->setDeductionId($deduction2->deduction_id,true);
			 	$ped_deduction->setEntryId($deduction2->id,true);

			 	switch( $deduction2->computed ) {
			 		case 'hour':
			 			$ped_deduction->setNotes(number_format($deduction2->amount,2) . " X " . $days_present . " days");
			 			$damount = $deduction2->amount * $days_present;
			 		break;
			 		case 'day':
			 			$ped_deduction->setNotes(number_format($deduction2->amount,2) . " X " . $days_present . " days");
			 			$damount = $deduction2->amount * $days_present;
			 		break;
			 		case 'month':
			 		default:
			 			$ped_deduction->setNotes($days_present . " days");
			 			$damount = $deduction2->amount;
			 		break;
			 	}

			 	if( floatval( $deduction2->max_amount ) > 0 ) {
			 		$dbalance = $deduction2->max_amount - $deduction2->deducted;
			 		$damount = ( $dbalance >= $damount) ? $damount : $dbalance;
			 	}

			 	$ped_deduction->setAmount($damount);
			 	if( ($ped_deduction->nonEmpty() === false) && (floatval($damount) > 0)) {
					$ped_deduction->insert();
				}

			 }
	}

	private function _generate($payroll_data,$employees_data) {

			if( $employees_data ) foreach( $employees_data as $employee ) {
					$salary = new $this->Employees_salaries_model;
					$salary->setCompanyId($this->session->userdata('current_company_id'),true);
					$salary->setNameId($employee->name_id,true);
					$salary->setPrimary(1,true);
					$salary->setTrash(0,true);
				if( $salary->nonEmpty() ) {
					$salary_data = $salary->getResults();
					$payroll_salary = new $this->Payroll_employees_salaries_model;
					$payroll_salary->setPayrollId($payroll_data->id,true);
					$payroll_salary->setNameId($employee->name_id,true);
					$payroll_salary->setSalaryId($salary_data->id);
					$payroll_salary->setAmount($salary_data->amount);
					$payroll_salary->setRatePer($salary_data->rate_per);
					$payroll_salary->setAnnualDays($salary_data->annual_days);
					$payroll_salary->setMonths($salary_data->months);
					$payroll_salary->setDays($salary_data->days);
					$payroll_salary->setHours($salary_data->hours);
					$payroll_salary->setCola($salary_data->cola);
					$payroll_salary->setNotes($salary_data->notes);
					$payroll_salary->setManner($salary_data->manner);
					if( ! $payroll_salary->nonEmpty() ) {
						$payroll_salary->insert();
					}
				}
			}

			$temp_earnings = new $this->Payroll_templates_earnings_model;
			$temp_earnings->setTemplateId($payroll_data->template_id,true);
			$temp_earnings->set_limit(0);
			foreach( $temp_earnings->populate() as $earning ) {
				$payroll_earning = new $this->Payroll_earnings_model;
				$payroll_earning->setPayrollId($payroll_data->id,true);
				$payroll_earning->setEarningId($earning->earning_id,true);
				$payroll_earning->setOrder($earning->order);
				if( ! $payroll_earning->nonEmpty() ) {
					$payroll_earning->insert();
				}
			}

			$payroll_earnings = new $this->Payroll_earnings_model;
			$payroll_earnings->setPayrollId($payroll_data->id,true);
			foreach( $payroll_earnings->populate() as $earning ) {
				if( $employees_data ) foreach( $employees_data as $employee ) {
					$this->_generate_earnings($payroll_data,$earning->earning_id, $employee);
				}
			} 

			$temp_deductions = new $this->Payroll_templates_deductions_model;
			$temp_deductions->setTemplateId($payroll_data->template_id,true);
			$temp_deductions->set_limit(0);
			foreach( $temp_deductions->populate() as $deduction ) {
				$payroll_deduction = new $this->Payroll_deductions_model;
				$payroll_deduction->setPayrollId($payroll_data->id,true);
				$payroll_deduction->setDeductionId($deduction->deduction_id,true);
				$payroll_deduction->setOrder($deduction->order);
				if( ! $payroll_deduction->nonEmpty() ) {
					$payroll_deduction->insert();
				}
			}
			
			$payroll_deductions = new $this->Payroll_deductions_model;
			$payroll_deductions->setPayrollId($payroll_data->id,true);
			foreach( $payroll_deductions->populate() as $deduction ) {
				if( $employees_data ) foreach( $employees_data as $employee ) {
					 $this->_generate_deductions($payroll_data,$deduction->deduction_id, $employee);
				}
			}

			$temp_benefits = new $this->Payroll_templates_benefits_model;
			$temp_benefits->setTemplateId($payroll_data->template_id,true);
			$temp_benefits->set_limit(0);
			foreach( $temp_benefits->populate() as $benefit ) {
				$payroll_benefit = new $this->Payroll_benefits_model;
				$payroll_benefit->setPayrollId($payroll_data->id,true);
				$payroll_benefit->setBenefitId($benefit->benefit_id,true);
				$payroll_benefit->setOrder($benefit->order);
				if( ! $payroll_benefit->nonEmpty() ) {
					$payroll_benefit->insert();
				}
			}

			$payroll_benefits = new $this->Payroll_benefits_model;
			$payroll_benefits->setPayrollId($payroll_data->id,true);
			foreach( $payroll_benefits->populate() as $benefit ) {
				if( $employees_data ) foreach( $employees_data as $employee ) {
					 $this->_generate_benefits($payroll_data,$benefit->benefit_id,$employee);
				}
			}

	}

	public function generate($id,$output='') {
		
		$redirect_uri = ( $this->input->get('next') ) ? $this->input->get('next') : 'payroll_dtr/view/' . $id;

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		if( $payroll->nonEmpty() ) :
			
			$payroll_data = $payroll->getResults();

			$inclusive_dates = new $this->Payroll_inclusive_dates_model;
			$inclusive_dates->setPayrollId($id,true);
			$inclusive_dates->set_select('COUNT(*) as working_days');
			$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
			$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
			$payroll_dates = $inclusive_dates->get();

			$payroll_data->inclusive_dates = $payroll_dates;

			$payroll_absent = 0;

			$days_present = $payroll_dates->working_days - $payroll_absent;

			$payroll_group = new $this->Payroll_groups_model;
			$payroll_group->setPayrollId($id,true);

			$salary_data = false;
			$employees_data = array();
			$temp_groups = new $this->Payroll_templates_groups_model;
			$temp_groups->setTemplateId($payroll_data->template_id,true);
			$temp_groups->set_limit(0);
			$groups_data = $temp_groups->populate();

			foreach( $groups_data as $group ) {
				$payroll_group = new $this->Payroll_groups_model;
				$payroll_group->setPayrollId($id,true);
				$payroll_group->setGroupId($group->group_id,true);
				$payroll_group->setOrder($group->order);
				$payroll_group->setPage($group->page);
				if( $payroll_group->nonEmpty() === FALSE ) {
					$payroll_group->insert();
				} 

				$employees = new $this->Employees_model('e');
				$employees->setCompanyId($this->session->userdata('current_company_id'),true);
				$employees->setTrash(0,true);
				$employees->set_select('e.*');
				$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=e.position_id) as position_name');
				$employees->set_select('(SELECT ni.birthday FROM names_info ni WHERE ni.name_id=e.name_id) as birthday');
				$employees->set_limit(0);
				$employees->set_where('e.group_id', $group->group_id);
				$employees->set_where('pte.active', 1);
				$employees->set_join('payroll_templates_employees pte', 'pte.name_id=e.name_id', 'RIGHT');
				$employees->set_select('pte.active');
				$employees->set_select('pte.template');
				$employees->set_select('pte.print_group');
				$employees->set_select('pte.order');
				foreach( $employees->populate() as $employee ) {
					$employees_data[] = $employee;
					$payroll_employees = new $this->Payroll_employees_model;
					$payroll_employees->setPayrollId($id,true);
					$payroll_employees->setNameId($employee->name_id,true);
					$payroll_employees->setOrder($employee->order);
					$payroll_employees->setTemplate($employee->template);
					$payroll_employees->setPrintGroup($employee->print_group);
					$payroll_employees->setActive($employee->active);
					if( $payroll_employees->nonEmpty() === FALSE ) {
						$payroll_employees->insert();
					} 
				}
			}

			if( $employees_data ) {
				$this->_generate( $payroll_data, $employees_data );
			}

		endif;

		redirect( site_url($redirect_uri) . "#successful" );
	}

	public function groups($id, $output='') {

		if( $this->input->post() ) {
			foreach( $this->input->post('group') as $group_id ) {
				if( ! in_array($group_id, $this->input->post('selected')) ) {
					$pgroup = new $this->Payroll_groups_model;
					$pgroup->setPayrollId($id,true);
					$pgroup->setGroupId($group_id,true);
					if( $pgroup->nonEmpty() ) {
						$pgroup->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pgroup = new $this->Payroll_groups_model;
				$pgroup->setPayrollId($id,true);
				$pgroup->setGroupId($selected_id,true);
				$pgroup->setOrder(($len - $order));
				$pages = $this->input->post('page');
				$page = ( isset($pages[$selected_id]) ) ? $pages[$selected_id] : 1;
				$pgroup->setPage($page);
				if( $pgroup->nonEmpty() ) {
					$pgroup->update();
				} else {
					$pgroup->insert();
				}
			}
			$this->postNext();
		}

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT pages from payroll_templates WHERE id=payroll.template_id) as pages");
		$this->template_data->set('payroll', $payroll->get());
		
		$groups = new $this->Employees_groups_model('eg');
		$groups->setCompanyId($this->session->userdata('current_company_id'),true);
		$groups->set_select('eg.*');
		$groups->set_select("(SELECT ptg.group_id FROM payroll_groups ptg WHERE ptg.payroll_id = {$id} AND ptg.group_id = eg.id ) as selected");
		$groups->set_select("(SELECT ptg.order FROM payroll_groups ptg WHERE ptg.payroll_id = {$id} AND ptg.group_id = eg.id) as sort");
		$groups->set_select("(SELECT ptg.page FROM payroll_groups ptg WHERE ptg.payroll_id = {$id} AND ptg.group_id = eg.id) as page");
		$groups->set_order("(SELECT ptg.order FROM payroll_groups ptg WHERE ptg.payroll_id = {$id} AND ptg.group_id = eg.id)", 'DESC');
		$groups->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=eg.id) > 0)");
		$this->template_data->set('groups', $groups->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/payroll/payroll_groups', $this->template_data->get_data());

	}

	public function employees($id, $group_id, $output='') {

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		if( $payroll->nonEmpty() ) {
			$payroll_data = $payroll->getResults();
			$inclusive_dates = new $this->Payroll_inclusive_dates_model;
			$inclusive_dates->setPayrollId($id,true);
			$inclusive_dates->set_select('COUNT(*) as working_days');
			$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
			$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
			$payroll_dates = $inclusive_dates->get();
			$payroll_data->inclusive_dates = $payroll_dates;
		}
		$this->template_data->set('payroll', $payroll_data);

		if( $this->input->post() ) {
			foreach( $this->input->post('name_id') as $order=>$name_id ) {
				$pemployee = new $this->Payroll_employees_model;
				$pemployee->setPayrollId($id,true);
				$pemployee->setNameId($name_id,true);
				if( in_array($name_id, $this->input->post('selected')) ) {
					$pemployee->setActive('1');
				} else {
					$pemployee->setActive('0');
				}
				$pemployee->setOrder($order);

				$template = $this->input->post('payslip_template');
				$pemployee->setTemplate($template[$name_id]);

				$print_group = $this->input->post('print_group');
				$pemployee->setPrintGroup($print_group[$name_id]);

				if( $pemployee->nonEmpty() ) {
					$pemployee->set_exclude(array('payroll_id','name_id'));
					$pemployee->update();
				} else {
					$pemployee->insert();
					if( $pemployee->get() ) {
						$this->_generate( $payroll_data, array($pemployee->get()));
					}
				}
				
			}
			$this->postNext();
		}
		
		$employees = new $this->Employees_model('e');
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->set_select('e.*');
		$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=e.position_id) as position_name');
		$employees->set_limit(0);
		$employees->set_where('e.group_id', $group_id);
		$employees->set_join('payroll_employees pe', 'pe.name_id=e.name_id AND pe.payroll_id=' . $id);
		$employees->set_select('pe.active');
		$employees->set_select('pe.template');
		$employees->set_select('pe.print_group');
		$employees->set_select('pe.order'); 
		$employees->set_join('names_info ni', 'ni.name_id=e.name_id');
		$employees->set_select('ni.lastname');
		$employees->set_select('ni.firstname');
		$employees->set_select('ni.middlename');
		$employees->set_order('pe.order', 'ASC');
		if( $this->input->get('action') == 'sort') {
			$employees->set_where('pe.active', 1);
		} 
		$employees_data = $employees->populate();
		$this->template_data->set('employees', $employees_data);

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_employees', $this->template_data->get_data());

	}

	public function benefits($id, $output='') {

		if( $this->input->post() ) {
			$selected = ($this->input->post('selected')) ? $this->input->post('selected') : array();
			foreach( $this->input->post('benefit') as $benefit_id ) {
				if( ! in_array($benefit_id, $selected) ) {
					$pbenefit = new $this->Payroll_benefits_model;
					$pbenefit->setPayrollId($id,true);
					$pbenefit->setBenefitId($benefit_id,true);
					if( $pbenefit->nonEmpty() ) {
						$pbenefit->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pbenefit = new $this->Payroll_benefits_model;
				$pbenefit->setPayrollId($id,true);
				$pbenefit->setBenefitId($selected_id,true);
				$pbenefit->setOrder(($len - $order));
				if( $pbenefit->nonEmpty() ) {
					$pbenefit->update();
				} else {
					$pbenefit->insert();
				}
			}
			
			$this->postNext();
		}

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());
		
		$benefits = new $this->Benefits_list_model('bl');
		$benefits->set_select('bl.*');
		$benefits->set_select("(SELECT ptb.benefit_id FROM payroll_benefits ptb WHERE ptb.payroll_id = {$id} AND ptb.benefit_id = bl.id ) as selected");
		$benefits->set_select("(SELECT ptb.order FROM payroll_benefits ptb WHERE ptb.payroll_id = {$id} AND ptb.benefit_id = bl.id) as sort");
		$benefits->set_order("(SELECT ptb.order FROM payroll_benefits ptb WHERE ptb.payroll_id = {$id} AND ptb.benefit_id = bl.id)", 'DESC');
		$benefits->setLeave(0,true);
		$benefits->set_limit(0);
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('output', $output);
		$this->template_data->set('payroll_id', $id);
		
		$this->load->view('payroll/payroll/payroll_benefits', $this->template_data->get_data());

	}

	public function earnings($id, $output='') {

		if( $this->input->post() ) {
			$selected = ($this->input->post('selected')) ? $this->input->post('selected') : array();
			foreach( $this->input->post('earning') as $earning_id ) {
				if( ! in_array($earning_id, $selected) ) {
					$pearning = new $this->Payroll_earnings_model;
					$pearning->setPayrollId($id,true);
					$pearning->setEarningId($earning_id,true);
					if( $pearning->nonEmpty() ) {
						$pearning->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pearning = new $this->Payroll_earnings_model;
				$pearning->setPayrollId($id,true);
				$pearning->setEarningId($selected_id,true);
				$pearning->setOrder(($len - $order));
				if( $pearning->nonEmpty() ) {
					$pearning->update();
				} else {
					$pearning->insert();
				}
			}
			
			$this->postNext();
		}

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());
		
		$earnings = new $this->Earnings_list_model('el');
		$earnings->set_select('el.*');
		$earnings->set_select("(SELECT pte.earning_id FROM payroll_earnings pte WHERE pte.payroll_id = {$id} AND pte.earning_id = el.id ) as selected");
		$earnings->set_select("(SELECT pte.order FROM payroll_earnings pte WHERE pte.payroll_id = {$id} AND pte.earning_id = el.id) as sort");
		$earnings->set_order("(SELECT pte.order FROM payroll_earnings pte WHERE pte.payroll_id = {$id} AND pte.earning_id = el.id)", 'DESC');
		$earnings->set_limit(0);
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('output', $output);
		$this->template_data->set('payroll_id', $id);

		$this->load->view('payroll/payroll/payroll_earnings', $this->template_data->get_data());

	}

	public function deductions($id, $output='') {

		if( $this->input->post() ) {
			$selected = ($this->input->post('selected')) ? $this->input->post('selected') : array();
			foreach( $this->input->post('deduction') as $deduction_id ) {
				if( ! in_array($deduction_id, $selected) ) {
					$pdeduction = new $this->Payroll_deductions_model;
					$pdeduction->setPayrollId($id,true);
					$pdeduction->setDeductionId($deduction_id,true);
					if( $pdeduction->nonEmpty() ) {
						$pdeduction->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pdeduction = new $this->Payroll_deductions_model;
				$pdeduction->setPayrollId($id,true);
				$pdeduction->setDeductionId($selected_id,true);
				$pdeduction->setOrder(($len - $order));
				if( $pdeduction->nonEmpty() ) {
					$pdeduction->update();
				} else {
					$pdeduction->insert();
				}
			}
			
			$this->postNext();
		}

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());
		
		$deductions = new $this->Deductions_list_model('dl');
		$deductions->set_select('dl.*');
		$deductions->set_select("(SELECT ptd.deduction_id FROM payroll_deductions ptd WHERE ptd.payroll_id = {$id} AND ptd.deduction_id = dl.id ) as selected");
		$deductions->set_select("(SELECT ptd.order FROM payroll_deductions ptd WHERE ptd.payroll_id = {$id} AND ptd.deduction_id = dl.id) as sort");
		$deductions->set_order("(SELECT ptd.order FROM payroll_deductions ptd WHERE ptd.payroll_id = {$id} AND ptd.deduction_id = dl.id)", 'DESC');
		$deductions->set_limit(0);
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);
		$this->template_data->set('payroll_id', $id);

		$this->load->view('payroll/payroll/payroll_deductions', $this->template_data->get_data());

	}

	public function change_status($status_id) {
		$term = new $this->Terms_list_model('t');
		$term->setId($status_id,true);
		$term->setType('employment_status',true);
		if( $term->nonEmpty() ) {
			$this->session->set_userdata('employees_status', $term->getResults());
		} else {
			$this->session->set_userdata('employees_status', false);
		}
		redirect($this->input->get('uri'));
	}

	public function select_payroll($payroll_id) {
		
		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		if( $payroll->nonEmpty() ) {
			$this->session->set_userdata('current_payroll', $payroll->getResults() );
			
			//$this->session->set_userdata('employees_status', false);
			//$this->session->set_userdata('current_employee', false );
			

			if( get_company_option($this->session->userdata('current_company_id'), 'column_group_dtr') ) {
				redirect("payroll_dtr/view/{$payroll_id}");
			}
			if( get_company_option($this->session->userdata('current_company_id'), 'column_group_salaries') ) {
				redirect("payroll_salaries/view/{$payroll_id}");
			}
			if( get_company_option($this->session->userdata('current_company_id'), 'column_group_earnings') ) {
				redirect("payroll_earnings/view/{$payroll_id}");
			}
			if( get_company_option($this->session->userdata('current_company_id'), 'column_group_benefits')) {
				redirect("payroll_benefits/view/{$payroll_id}");
			}
			if( get_company_option($this->session->userdata('current_company_id'), 'column_group_deductions')) {
				redirect("payroll_deductions/view/{$payroll_id}");
			}
			if( get_company_option($this->session->userdata('current_company_id'), 'column_group_summary')) {
				redirect("payroll_summary/view/{$payroll_id}");
			}
		}

		redirect(site_url("welcome") . "?error_code=106");
	}

	public function page_session($payroll_id) {
		$page_session = $this->session->userdata('page_session');
		redirect("{$page_session}/view/{$payroll_id}");
	}

	public function select_employee($name_id) {
		$employee = new $this->Employees_model('e');
		$employee->setNameId($name_id,true);
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$this->session->set_userdata('current_employee', $employee->get() );
		redirect( site_url( $this->input->get('next') ) . "?error_code=101" );
	}

	public function clear_current_employee() {
		$this->session->unset_userdata('current_employee');
		redirect( site_url( $this->input->get('next') ) . "?error_code=102" );
	}

}
