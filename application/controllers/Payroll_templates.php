<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_templates extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Templates');
		$this->template_data->set('current_uri', 'payroll_templates');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'templates', 'view');

		$this->load->model('Payroll_templates_model');
		$this->load->model('Payroll_templates_groups_model');
		$this->load->model('Payroll_templates_benefits_model');
		$this->load->model('Payroll_templates_earnings_model');
		$this->load->model('Payroll_templates_deductions_model');
		$this->load->model('Employees_groups_model');
		$this->load->model('Benefits_list_model');
		$this->load->model('Earnings_list_model');
		$this->load->model('Deductions_list_model');

	}

	public function index($start=0) {

		$templates = new $this->Payroll_templates_model;
		$templates->set_select('*');
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url("payroll_templates/index"),
			'total_rows' => $templates->count_all_results(),
			'per_page' => $templates->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('payroll/templates/templates_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('payroll', 'templates', 'add');


			if( $this->input->post() ) {
				$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$template = new $this->Payroll_templates_model;
					$template->setName($this->input->post('name'));
					$template->setActive(1);
					$template->insert();
				}
				$this->postNext();
			}

		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_add', $this->template_data->get_data());

	}

	public function edit($id,$output='') {
		$this->_isAuth('payroll', 'templates', 'edit');

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);

		if( $template->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$template->setName($this->input->post('name'));
					$template->update();
				}
				$this->postNext();
			}
		}
		$this->template_data->set('template', $template->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		$this->_isAuth('payroll', 'templates', 'delete');

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$template->delete();

		$this->getNext("payroll_templates");
	}

	public function config($id, $output='') {

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());
		
		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_config', $this->template_data->get_data());

	}

	public function groups($id, $output='') {

		if( $this->input->post() ) {

			foreach( $this->input->post('group') as $group_id ) {
				if( ! in_array($group_id, $this->input->post('selected')) ) {
					$pgroup = new $this->Payroll_templates_groups_model;
					$pgroup->setTemplateId($id,true);
					$pgroup->setGroupId($group_id,true);
					if( $pgroup->nonEmpty() ) {
						$pgroup->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pgroup = new $this->Payroll_templates_groups_model;
				$pgroup->setTemplateId($id,true);
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

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());
		
		$groups = new $this->Employees_groups_model('eg');
		$groups->set_select('eg.*');
		$groups->set_select("(SELECT ptg.group_id FROM payroll_templates_groups ptg WHERE ptg.template_id = {$id} AND ptg.group_id = eg.id ) as selected");
		$groups->set_select("(SELECT ptg.order FROM payroll_templates_groups ptg WHERE ptg.template_id = {$id} AND ptg.group_id = eg.id) as sort");
		$groups->set_order("(SELECT ptg.order FROM payroll_templates_groups ptg WHERE ptg.template_id = {$id} AND ptg.group_id = eg.id)", 'DESC');
		$this->template_data->set('groups', $groups->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_groups', $this->template_data->get_data());

	}

	public function benefits($id, $output='') {

		if( $this->input->post() ) {

			foreach( $this->input->post('benefit') as $benefit_id ) {
				if( ! in_array($benefit_id, $this->input->post('selected')) ) {
					$pbenefit = new $this->Payroll_templates_benefits_model;
					$pbenefit->setTemplateId($id,true);
					$pbenefit->setBenefitId($benefit_id,true);
					if( $pbenefit->nonEmpty() ) {
						$pbenefit->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pbenefit = new $this->Payroll_templates_benefits_model;
				$pbenefit->setTemplateId($id,true);
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
		$benefits->set_select("(SELECT ptb.benefit_id FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id ) as selected");
		$benefits->set_select("(SELECT ptb.order FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id) as sort");
		$benefits->set_order("(SELECT ptb.order FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id)", 'DESC');
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_benefits', $this->template_data->get_data());

	}

	public function earnings($id, $output='') {

		if( $this->input->post() ) {

			foreach( $this->input->post('group') as $earning_id ) {
				if( ! in_array($earning_id, $this->input->post('selected')) ) {
					$pearning = new $this->Payroll_templates_earnings_model;
					$pearning->setTemplateId($id,true);
					$pearning->setEarningId($earning_id,true);
					if( $pearning->nonEmpty() ) {
						$pearning->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pearning = new $this->Payroll_templates_earnings_model;
				$pearning->setTemplateId($id,true);
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
		$earnings->set_select("(SELECT pte.earning_id FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id ) as selected");
		$earnings->set_select("(SELECT pte.order FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id) as sort");
		$earnings->set_order("(SELECT pte.order FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id)", 'DESC');
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_earnings', $this->template_data->get_data());

	}

	public function deductions($id, $output='') {

		if( $this->input->post() ) {

			foreach( $this->input->post('deduction') as $deduction_id ) {
				if( ! in_array($deduction_id, $this->input->post('selected')) ) {
					$pdeduction = new $this->Payroll_templates_deductions_model;
					$pdeduction->setTemplateId($id,true);
					$pdeduction->setDeductionId($deduction_id,true);
					if( $pdeduction->nonEmpty() ) {
						$pdeduction->delete();
					}
				}
			}
			
			$len = count($this->input->post('selected'));
			foreach( $this->input->post('selected') as $order=>$selected_id ) {
				$pdeduction = new $this->Payroll_templates_deductions_model;
				$pdeduction->setTemplateId($id,true);
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
		$deductions->set_select("(SELECT ptd.deduction_id FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id ) as selected");
		$deductions->set_select("(SELECT ptd.order FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id) as sort");
		$deductions->set_order("(SELECT ptd.order FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id)", 'DESC');
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_deductions', $this->template_data->get_data());

	}

}
