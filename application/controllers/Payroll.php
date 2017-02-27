<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll');
		$this->template_data->set('current_uri', 'payroll');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		$this->load->model('Payroll_model');
		$this->load->model('Payroll_templates_model');
		$this->load->model('Payroll_inclusive_dates_model');
		$this->load->model('Payroll_groups_model');
		$this->load->model('Payroll_earnings_model');
		$this->load->model('Payroll_deductions_model');
		$this->load->model('Payroll_benefits_model');

		$this->load->model('Payroll_employees_model');
		$this->load->model('Payroll_employees_salaries_model');
		$this->load->model('Payroll_employees_earnings_model');
		$this->load->model('Payroll_employees_deductions_model');
		$this->load->model('Payroll_employees_benefits_model');

		$this->load->model('Payroll_templates_groups_model');
		$this->load->model('Payroll_templates_employees_model');
		$this->load->model('Payroll_templates_benefits_model');
		$this->load->model('Payroll_templates_earnings_model');
		$this->load->model('Payroll_templates_deductions_model');
		$this->load->model('Payroll_templates_columns_model');

		$this->load->model('Employees_model');
		$this->load->model('Employees_groups_model');
		$this->load->model('Employees_salaries_model');
		$this->load->model('Employees_earnings_model');
		$this->load->model('Employees_benefits_model');
		$this->load->model('Employees_deductions_model');

		$this->load->model('Earnings_list_model');
		$this->load->model('Benefits_list_model');
		$this->load->model('Deductions_list_model');
		$this->load->model('Terms_list_model');


	}

	public function index($start=0) {

		$payrolls = new $this->Payroll_model;
		$payrolls->setActive(1,true);
		$payrolls->set_select('*');
		$payrolls->set_select('(SELECT name FROM payroll_templates WHERE id=payroll.template_id) as template_name');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_employees WHERE payroll_id=payroll.id) as employees_count');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_inclusive_dates WHERE payroll_id=payroll.id) as working_days');
		$payrolls->set_start($start);
		$payrolls->set_order('year', 'DESC');
		$payrolls->set_order('month', 'DESC');
		$payrolls->set_order('id', 'DESC');
		
		$payrolls_data = $payrolls->populate(); 
		$this->template_data->set('payrolls', $payrolls_data);

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url($this->config->item('index_page') . "/payroll/index"),
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
		$payrolls->setActive(1,true);
		$payrolls->set_select('*');
		$payrolls->set_select('(SELECT name FROM payroll_templates WHERE id=payroll.template_id) as template_name');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_employees WHERE payroll_id=payroll.id) as employees_count');
		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_inclusive_dates WHERE payroll_id=payroll.id) as working_days');
		$payrolls->setTemplateId($id,true);
		$payrolls->set_start($start);
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
				$payroll->setActive(1);
				$payroll->insert();
			}
			$this->postNext();
		}

		$templates = new $this->Payroll_templates_model;
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_add', $this->template_data->get_data());

	}

	public function edit($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);

		if( $payroll->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$payroll->setName($this->input->post('name'));
					$payroll->setTemplateId($this->input->post('template_id'));
					$payroll->setMonth($this->input->post('month'));
					$payroll->setYear($this->input->post('year'));
					$payroll->update();
				}
				$this->postNext();
			}
		}
		$this->template_data->set('payroll', $payroll->get());

		$templates = new $this->Payroll_templates_model;
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

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_start(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());

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
								if( $inc_date->nonEmpty() ) {
									$inc_date->delete();
								}
							}
						}

						foreach($this->input->post('selected') as $selected) {
							$sel_dates = new $this->Payroll_inclusive_dates_model;
							$sel_dates->setPayrollId($id);
							$sel_dates->setInclusiveDate($selected,true);
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
		$not_available_days->set_select('DAY(inclusive_date) as day');
		$not_available_days->set_select('inclusive_date');
		$not_available_days->set_limit(0);
		$not_available_days->set_order('inclusive_date', 'ASC');
		$this->template_data->set('not_available_days', $not_available_days->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_calendar', $this->template_data->get_data());
	}

	private function _generate($id,$payroll_data,$employees_data) {

			if( $employees_data ) foreach( $employees_data as $employee ) {
					$salary = new $this->Employees_salaries_model;
					$salary->setNameId($employee->name_id,true);
					$salary->setPrimary(1,true);
					$salary->setTrash(0,true);
				if( $salary->nonEmpty() ) {
					$salary_data = $salary->getResults();
					$payroll_salary = new $this->Payroll_employees_salaries_model;
					$payroll_salary->setPayrollId($id,true);
					$payroll_salary->setNameId($employee->name_id,true);
					$payroll_salary->setSalaryId($salary_data->id);
					if( $payroll_salary->nonEmpty() ) {
						$payroll_salary->update();
					} else {
						$payroll_salary->insert();
					}
				}
			}

			$temp_earnings = new $this->Payroll_templates_earnings_model;
			$temp_earnings->setTemplateId($payroll_data->template_id,true);
			$temp_earnings->set_limit(0);
			foreach( $temp_earnings->populate() as $earning ) {
				$payroll_earning = new $this->Payroll_earnings_model;
				$payroll_earning->setPayrollId($id,true);
				$payroll_earning->setEarningId($earning->earning_id,true);
				$payroll_earning->setOrder($earning->order);
				if( $payroll_earning->nonEmpty() ) {
					$payroll_earning->update();
				} else {
					$payroll_earning->insert();
				}

				if( $employees_data ) foreach( $employees_data as $employee ) {
					 $ee_earnings = new $this->Employees_earnings_model;
					 $ee_earnings->setNameId($employee->name_id,true);
					 $ee_earnings->setEarningId($earning->earning_id,true);
					 $ee_earnings->setTrash(0,true);
					 $ee_earnings->setActive(1,true);
					 $ee_earnings->set_where('(start_date <= "' . date('Y-m-d') . '")');
					 $ee_earnings->set_select("*");
					 $ee_earnings->set_select('(SELECT SUM(amount) FROM payroll_employees_earnings ped WHERE ped.entry_id=employees_earnings.id AND ped.name_id=employees_earnings.name_id) as earned');

					 foreach( $ee_earnings->populate() as $earning2 ) {
					 	
					 	$pee_earning = new $this->Payroll_employees_earnings_model;
					 	$pee_earning->setPayrollId($id,true);
					 	$pee_earning->setNameId($earning2->name_id,true);
					 	$pee_earning->setEarningId($earning2->earning_id,true);
					 	$pee_earning->setEntryId($earning2->id,true);

					 	switch( $earning2->computed ) {
					 		case 'hour':
					 			$eamount = $earning2->amount * $days_present;
					 		break;
					 		case 'day':
					 			$eamount = $earning2->amount * $days_present;
					 		break;
					 		case 'month':
					 		default:
					 			$eamount = $earning2->amount;
					 		break;
					 	}

					 	if( floatval( $earning2->max_amount ) > 0 ) {
					 		$ebalance = $earning2->max_amount - $earning2->earned;
					 		$eamount = ( $ebalance >= $eamount) ? $eamount : $ebalance;
					 	}

					 	$pee_earning->setAmount($eamount);
					 	if( ($pee_earning->nonEmpty() === false) && (floatval($eamount) > 0) ) {
							$pee_earning->insert();
						}

					 }
				}
			} 

			$temp_deductions = new $this->Payroll_templates_deductions_model;
			$temp_deductions->setTemplateId($payroll_data->template_id,true);
			$temp_deductions->set_limit(0);
			foreach( $temp_deductions->populate() as $deduction ) {

				$payroll_deduction = new $this->Payroll_deductions_model;
				$payroll_deduction->setPayrollId($id,true);
				$payroll_deduction->setDeductionId($deduction->deduction_id,true);
				$payroll_deduction->setOrder($deduction->order);
				if( $payroll_deduction->nonEmpty() ) {
					$payroll_deduction->update();
				} else {
					$payroll_deduction->insert();
				}

				if( $employees_data ) foreach( $employees_data as $employee ) {
					 $ee_deductions = new $this->Employees_deductions_model;
					 $ee_deductions->setNameId($employee->name_id,true);
					 $ee_deductions->setDeductionId($deduction->deduction_id,true);
					 $ee_deductions->setTrash(0,true);
					 $ee_deductions->setActive(1,true);
					 $ee_deductions->set_where('(start_date <= "' . date('Y-m-d') . '")');
					 $ee_deductions->set_limit(0);
					 $ee_deductions->set_select("*");
					 $ee_deductions->set_select('(SELECT SUM(amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=employees_deductions.id AND ped.name_id=employees_deductions.name_id) as deducted');
					 foreach( $ee_deductions->populate() as $deduction2 ) {

					 	$ped_deduction = new $this->Payroll_employees_deductions_model;
					 	$ped_deduction->setPayrollId($id,true);
					 	$ped_deduction->setNameId($deduction2->name_id,true);
					 	$ped_deduction->setDeductionId($deduction2->deduction_id,true);
					 	$ped_deduction->setEntryId($deduction2->id,true);

					 	switch( $deduction2->computed ) {
					 		case 'hour':
					 			$damount = $deduction2->amount * $days_present;
					 		break;
					 		case 'day':
					 			$damount = $deduction2->amount * $days_present;
					 		break;
					 		case 'month':
					 		default:
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
			}

			$temp_benefits = new $this->Payroll_templates_benefits_model;
			$temp_benefits->setTemplateId($payroll_data->template_id,true);
			$temp_benefits->set_limit(0);
			foreach( $temp_benefits->populate() as $benefit ) {
				$payroll_benefit = new $this->Payroll_benefits_model;
				$payroll_benefit->setPayrollId($id,true);
				$payroll_benefit->setBenefitId($benefit->benefit_id,true);
				$payroll_benefit->setOrder($benefit->order);
				if( $payroll_benefit->nonEmpty() ) {
					$payroll_benefit->update();
				} else {
					$payroll_benefit->insert();
				}

				if( $employees_data ) foreach( $employees_data as $employee ) {
					 $ee_benefits = new $this->Employees_benefits_model;
					 $ee_benefits->setNameId($employee->name_id,true);
					 $ee_benefits->setBenefitId($benefit->benefit_id,true);
					 $ee_benefits->setTrash(0,true);
					 $ee_benefits->setPrimary(1,true);
					 $ee_benefits->set_where('(start_date <= "' . date('Y-m-d') . '")');
					 foreach( $ee_benefits->populate() as $benefit2 ) {
					 	$peb_benefit = new $this->Payroll_employees_benefits_model;
					 	$peb_benefit->setPayrollId($id,true);
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
				if( $payroll_group->nonEmpty() ) {
					$payroll_group->update();
				} else {
					$payroll_group->insert();
				}

				$employees = new $this->Employees_model('e');
				$employees->set_select('e.*');
				$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=e.position_id) as position_name');
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
					if( $payroll_employees->nonEmpty() ) {
						$payroll_employees->set_exclude(array('payroll_id','name_id'));
						$payroll_employees->update();
					} else {
						$payroll_employees->insert();
					}
				}
			}

			if( $employees_data ) {
				$this->_generate( $id, $payroll_data, $employees_data );
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
		$this->template_data->set('payroll', $payroll->get());
		
		$groups = new $this->Employees_groups_model('eg');
		$groups->set_select('eg.*');
		$groups->set_select("(SELECT ptg.group_id FROM payroll_groups ptg WHERE ptg.payroll_id = {$id} AND ptg.group_id = eg.id ) as selected");
		$groups->set_select("(SELECT ptg.order FROM payroll_groups ptg WHERE ptg.payroll_id = {$id} AND ptg.group_id = eg.id) as sort");
		$groups->set_order("(SELECT ptg.order FROM payroll_groups ptg WHERE ptg.payroll_id = {$id} AND ptg.group_id = eg.id)", 'DESC');
		$groups->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=eg.id) > 0)");
		$this->template_data->set('groups', $groups->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/payroll/payroll_groups', $this->template_data->get_data());

	}

	public function employees($id, $group_id, $output='') {

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
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
						$this->_generate($id, $payroll_data, array($pemployee->get()));
					}
				}
				
			}
			$this->postNext();
		}
		
		$employees = new $this->Employees_model('e');
		$employees->set_select('e.*');
		$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=e.position_id) as position_name');
		$employees->set_limit(0);
		$employees->set_where('e.group_id', $group_id);
		$employees->set_join('payroll_employees pe', 'pe.name_id=e.name_id AND pe.payroll_id=' . $id);
		$employees->set_select('pe.active');
		$employees->set_select('pe.template');
		$employees->set_select('pe.print_group');
		$employees->set_select('pe.order');
		$this->template_data->set('employees', $employees->populate());

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_start(0);
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
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('output', $output);

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
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('output', $output);

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
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/payroll/payroll_deductions', $this->template_data->get_data());

	}

}
