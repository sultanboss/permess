<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Factory extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('factory_model');
	}

	function import()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		$data['title'] = 'Import';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'js/lib/Sticky/sticky.css'));

		$data['js'] = $this->tank_auth->load_admin_js(array(
			'js/lib/iCheck/jquery.icheck.min.js', 
			'js/lib/parsley/parsley.min.js', 
			'js/pages/ebro_form_validate.js', 
			'js/lib/dataTables/media/js/jquery.dataTables.min.js', 
			'js/lib/dataTables/extras/ColReorder/media/js/ColReorder.min.js',
			'js/lib/dataTables/extras/ColVis/media/js/ColVis.min.js', 
			'js/lib/dataTables/media/DT_bootstrap.js', 
			'js/pages/ebro_datatables.js', 
			'js/lib/bootbox/bootbox.min.js', 
			'js/lib/datepicker/js/bootstrap-datepicker.js', 
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js'));

		$this->breadcrumbs->push('Factory', '#');
		$this->breadcrumbs->push('Imports', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['raw_materials'] = $this->factory_model->get_raw();

		$this->load->view('common/header', $data);
		$this->load->view('factory/import', $data);
		$this->load->view('common/footer', $data);
	}

	function addimport()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($_POST['raw_name']) && isset($_POST['import_date']) ) {
			$data['data'] = array(
				'raw_id'					=> $this->input->post('raw_name'),
				'import_date'				=> $this->input->post('import_date'),
				'import_prev_balance'		=> $this->factory_model->get_import_prev_balance($this->input->post('raw_name'), 0),
				'import_received_balance'	=> $this->input->post('import_received_balance'),
				'import_invoice_challan'	=> $this->input->post('import_invoice_challan'),
				'import_lc_no'				=> $this->input->post('import_lc_no'),
				'import_issue_to'			=> $this->input->post('import_issue_to'),
				'import_inv_req_challan'	=> $this->input->post('import_inv_req_challan'),
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->factory_model->add_import($data['data']);
			$this->session->set_flashdata('msg', 'Import added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid import input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/factory/import');
	}

	function editimport()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if (isset($_POST['edit_import_id']) && isset($_POST['edit_raw_name']) ) {
			$offset = 1;
			if($this->input->post('edit_raw_name') != $this->input->post('current_raw_id'))
				$offset = 0;

			$data['data'] = array(
				'raw_id'					=> $this->input->post('edit_raw_name'),
				'import_date'				=> $this->input->post('edit_import_date'),
				'import_prev_balance'		=> $this->factory_model->get_import_prev_balance($this->input->post('edit_raw_name'), $offset),
				'import_received_balance'	=> $this->input->post('edit_import_received_balance'),
				'import_invoice_challan'	=> $this->input->post('edit_import_invoice_challan'),
				'import_lc_no'				=> $this->input->post('edit_import_lc_no'),
				'import_issue_to'			=> $this->input->post('edit_import_issue_to'),
				'import_inv_req_challan'	=> $this->input->post('edit_import_inv_req_challan'),
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->factory_model->edit_import($this->input->post('edit_import_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Import <b>\''.$this->input->post('edit_import_id').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid import input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/factory/import');
	}

	function deleteimport($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($id) ) {
			if($this->factory_model->delete_import($id)) {
				$this->session->set_flashdata('msg', 'Import deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid import delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid import delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/factory/import');
	}

	function dataimport()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		print_r($this->factory_model->get_import_data());
	}
}