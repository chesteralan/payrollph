<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_templates extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Templates');
		$this->template_data->set('current_uri', 'payroll_templates');
		$this->template_data->set('navbar_search', true);

		$this->_isCompanyId();

		$this->_isAuth('payroll', 'templates', 'view');

	}

	public function index($start=0) {

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_select('*');
		$templates->set_select('(SELECT COUNT(*) FROM `payroll` WHERE template_id=payroll_templates.id) as payroll_count');
		$templates->set_start($start);
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url($this->config->item('index_page') . "/payroll_templates/index"),
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
				$this->form_validation->set_rules('checked_by', 'Checked By', 'trim');
				$this->form_validation->set_rules('approved_by', 'Approved By', 'trim');
				if( $this->form_validation->run() ) {
					$template = new $this->Payroll_templates_model;
					$template->setName($this->input->post('name'));
					$template->setPages($this->input->post('pages'));
					$template->setCheckedBy($this->input->post('checked_by'));
					$template->setApprovedBy($this->input->post('approved_by'));
					$template->setCompanyId($this->session->userdata('current_company_id'));
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
				$this->form_validation->set_rules('checked_by', 'Checked By', 'trim');
				$this->form_validation->set_rules('approved_by', 'Approved By', 'trim');
				if( $this->form_validation->run() ) {
					$template->setName($this->input->post('name'),false,true);
					$template->setPages($this->input->post('pages'),false,true);
					$template->setCheckedBy($this->input->post('checked_by'),false,true);
					$template->setApprovedBy($this->input->post('approved_by'),false,true);
					$template->update();
				}
				$this->postNext();
			}
		}

		$template->set_join('names_list cnl', 'cnl.id=payroll_templates.checked_by');
		$template->set_join('names_list anl', 'anl.id=payroll_templates.approved_by');

		$template->set_select('payroll_templates.*');
		$template->set_select('cnl.full_name as checked_by_name');
		$template->set_select('anl.full_name as approved_by_name');
		$this->template_data->set('template', $template->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		$this->_isAuth('payroll', 'templates', 'delete');

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true,false);
		$template->setActive('0',false,true);
		$template->update();

		$this->getNext("payroll_templates");
	}

	public function config($id, $output='') {

		$template = new $this->Payroll_templates_model('pt');
		$template->setCompanyId($this->session->userdata('current_company_id'),true);
		$template->setId($id,true);
		$template->set_select('pt.*');
		$template->set_select('(SELECT COUNT(*) FROM `employees_groups` WHERE company_id='.$this->session->userdata('current_company_id').' ) as groups_count');
		$template->set_select('(SELECT COUNT(*) FROM `earnings_list`) as earnings_count');
		$template->set_select('(SELECT COUNT(*) FROM `benefits_list`) as benefits_count');
		$template->set_select('(SELECT COUNT(*) FROM `deductions_list`) as deductions_count');
		$template->set_select('(SELECT COUNT(*) FROM `terms_list` WHERE type="print_group") as print_columns_count');
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
				$pages = $this->input->post('page');
				$page = ( isset($pages[$selected_id]) ) ? $pages[$selected_id] : 1;
				$pgroup->setPage($page);
				if( $pgroup->nonEmpty() ) {
					$pgroup->update();
				} else {
					$pgroup->insert();
				}
				
				$employees = new $this->Employees_model('e');
				$employees->set_select('e.*');
				$employees->set_limit(0);
				$employees->set_where('e.group_id', $selected_id);
				foreach($employees->populate() as $employee) {
					$pte = new $this->Payroll_templates_employees_model('pte');
					$pte->setTemplateId($id,true);
					$pte->setNameId($employee->name_id,true);
					if( $pte->nonEmpty() === FALSE ) {
						$pte->insert();
					} else {
						$pte->update();
					}
				}
			}

			$this->postNext();
		}

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());
		
		$groups = new $this->Employees_groups_model('eg');
		$groups->setCompanyId($this->session->userdata('current_company_id'),true);
		$groups->set_select('eg.*');
		$groups->set_select("(SELECT ptg.group_id FROM payroll_templates_groups ptg WHERE ptg.template_id = {$id} AND ptg.group_id = eg.id ) as selected");
		$groups->set_select("(SELECT ptg.order FROM payroll_templates_groups ptg WHERE ptg.template_id = {$id} AND ptg.group_id = eg.id) as sort");
		$groups->set_select("(SELECT ptg.page FROM payroll_templates_groups ptg WHERE ptg.template_id = {$id} AND ptg.group_id = eg.id) as page");
		$groups->set_order("(SELECT ptg.order FROM payroll_templates_groups ptg WHERE ptg.template_id = {$id} AND ptg.group_id = eg.id)", 'DESC');
		$groups->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=eg.id) > 0)");
		$groups->set_limit(0);
		$this->template_data->set('groups', $groups->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_groups', $this->template_data->get_data());

	}

	public function employees($id, $group_id, $output='') {

		if( $this->input->post() ) {
			foreach( $this->input->post('name_id') as $order=>$name_id ) {
				$pemployee = new $this->Payroll_templates_employees_model;
				$pemployee->setTemplateId($id,true);
				$pemployee->setNameId($name_id,true);
				if( in_array($name_id, $this->input->post('selected')) ) {
					$pemployee->setOrder($order);

					$template = $this->input->post('payslip_template');
					$pemployee->setTemplate($template[$name_id]);

					$print_group = $this->input->post('print_group');
					$pemployee->setPrintGroup($print_group[$name_id]);

					if( $pemployee->nonEmpty() ) {
						$pemployee->set_exclude(array('template_id','name_id'));
						$pemployee->update();
					} else {
						$pemployee->insert();
					}
				} else {
					$pemployee->delete();
				}
				
			}
			$this->postNext();
		}

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());
		
		$employees = new $this->Employees_model('e');
		$employees->set_select('e.*');
		$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=e.position_id) as position_name');
		$employees->set_limit(0);
		$employees->set_where('e.group_id', $group_id);
		$employees->set_join('payroll_templates_employees pte', 'pte.name_id=e.name_id AND pte.template_id='.$id);
		$employees->set_select('pte.active');
		$employees->set_select('pte.template');
		$employees->set_select('pte.print_group');
		$employees->set_select('pte.template_id');
		$employees->set_group_by('e.name_id');
		//$employees->set_where('pte.template_id', $id);
		$employees->set_order('pte.order','ASC');
		//$employees->set_order('(SELECT pte.order FROM payroll_templates_employees pte WHERE pte.name_id=e.name_id AND pte.template_id='.$id.')', 'ASC'); 
		//$employees->set_select('(SELECT pte.active FROM payroll_templates_employees pte WHERE pte.name_id=e.name_id AND pte.template_id='.$id.') as active');
		//$employees->set_select('(SELECT pte.template FROM payroll_templates_employees pte WHERE pte.name_id=e.name_id AND pte.template_id='.$id.') as template');
		//$employees->set_select('(SELECT pte.print_group FROM payroll_templates_employees pte WHERE pte.name_id=e.name_id AND pte.template_id='.$id.') as print_group');
		//$employees->set_select('(SELECT pte.template_id FROM payroll_templates_employees pte WHERE pte.name_id=e.name_id AND pte.template_id='.$id.') as template_id');
		$this->template_data->set('employees', $employees->populate());

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$print_groups->set_limit(0);
		$this->template_data->set('print_groups', $print_groups->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_employees', $this->template_data->get_data());

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
		$benefits->setLeave(0,true);
		$benefits->set_limit(0);
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_benefits', $this->template_data->get_data());

	}

	public function earnings($id, $output='') {

		if( $this->input->post() ) {

			foreach( $this->input->post('earning') as $earning_id ) {
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
		$earnings->set_limit(0);
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
		$deductions->set_limit(0);
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);

		$this->load->view('payroll/templates/templates_deductions', $this->template_data->get_data());

	}

	public function print_columns($id, $output='') {

		if( $this->input->post('i') ) {
			foreach($this->input->post('i') as $term_id=>$data) {
				$columns = (isset($data['columns'])) ? $data['columns'] : array();
				$selected = (isset($data['selected'])) ? $data['selected'] : array();
				foreach($columns as $column) {
					if( ! in_array($column, $selected) ) {
						$tcol = new $this->Payroll_templates_columns_model;
						$tcol->setTemplateId($id,true);
						$tcol->setTermId($term_id,true);
						$tcol->setColumnId($column,true);
						if( $tcol->nonEmpty() ) {
							$tcol->delete();
						}
					}
				}
				foreach($selected as $column) {
					$tcol = new $this->Payroll_templates_columns_model;
					$tcol->setTemplateId($id,true);
					$tcol->setTermId($term_id,true);
					$tcol->setColumnId($column,true);
					if( $tcol->nonEmpty() ) {
						$tcol->update();
					} else {
						$tcol->insert();
					}
				}
			}
			$this->postNext();
		}

		$tcol = new $this->Payroll_templates_columns_model;
		$tcol->setTemplateId($id,true);
		$tcol->set_limit(0);
		$this->template_data->set('print_columns', $tcol->populate());

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$print_groups->set_limit(0);
		$this->template_data->set('print_groups', $print_groups->populate());

		$earnings = new $this->Earnings_list_model('el');
		$earnings->set_select('el.*');
		$earnings->set_select("(SELECT pte.earning_id FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id ) as selected");
		$earnings->set_select("(SELECT pte.order FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id) as sort");
		$earnings->set_order("(SELECT pte.order FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id)", 'DESC');
		$earnings->set_limit(0);
		$this->template_data->set('earnings', $earnings->populate());

		$benefits = new $this->Benefits_list_model('bl');
		$benefits->set_select('bl.*');
		$benefits->set_select("(SELECT ptb.benefit_id FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id ) as selected");
		$benefits->set_select("(SELECT ptb.order FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id) as sort");
		$benefits->set_order("(SELECT ptb.order FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id)", 'DESC');
		$benefits->setLeave(0,true);
		$benefits->set_limit(0);
		$this->template_data->set('benefits', $benefits->populate());

		$deductions = new $this->Deductions_list_model('dl');
		$deductions->set_select('dl.*');
		$deductions->set_select("(SELECT ptd.deduction_id FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id ) as selected");
		$deductions->set_select("(SELECT ptd.order FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id) as sort");
		$deductions->set_order("(SELECT ptd.order FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id)", 'DESC');
		$deductions->set_limit(0);
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_print_columns', $this->template_data->get_data());
	}

	public function ajax($action='') {
		$results = array();
		switch($action) {
			case 'search_name':
				$names = new $this->Names_list_model;
				if( $this->input->get('term') ) {
					$names->set_where('full_name LIKE "%' . $this->input->get('term') . '%"');
				}
				$data = array();
				foreach($names->populate() as $name) {
					$data[] = array(
						'label' => $name->full_name,
						'id' => $name->id,
						'desc' => $name->address . " - " . $name->contact_number,
						);
				}
				$results = $data;
			break;
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode( $results ));
	}

}
