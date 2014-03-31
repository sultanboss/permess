<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Issue extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('issue_model');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		$data['title'] = 'Issue Type';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/dataTables/media/DT_bootstrap.css', 
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
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js'));

		$this->breadcrumbs->push('Settings', '#');
		$this->breadcrumbs->push('Finished Goods', '#');
		$this->breadcrumbs->push('Issues', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('issue/index', $data);
		$this->load->view('common/footer', $data);
	}

	function add()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($_POST['issue_name']) ) {
			$data['data'] = array(
				'issue_type_name'			=> $this->input->post('issue_name'),
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->issue_model->add_issue($data['data']);
			$this->session->set_flashdata('msg', 'Issue <b>\''.$this->input->post('issue_name').'\'</b> added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid issue input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/issue');
	}

	function edit()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if (isset($_POST['issue_id']) && isset($_POST['issue_name']) ) {
			$data['data'] = array(
				'issue_type_name'			=> $this->input->post('issue_name'),		
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->issue_model->edit_issue($this->input->post('issue_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Issue <b>\''.$this->input->post('issue_name').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid issue input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/issue');
	}

	function delete($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($id) ) {
			if($this->issue_model->delete_issue($id)) {
				$this->session->set_flashdata('msg', 'Issue deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid issue delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid issue delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/issue');
	}

	function data()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		print_r($this->issue_model->get_issue_data());
	}
}