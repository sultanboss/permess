<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Construction extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('construction_model');
	}

	function index()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Construction - Settings';

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
		$this->breadcrumbs->push('Products', '#');
		$this->breadcrumbs->push('Constructions', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('construction/index', $data);
		$this->load->view('common/footer', $data);
	}

	function add()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($_POST['construction_name']) ) {
			$data['data'] = array(
				'construction_name'			=> $this->input->post('construction_name'),
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->construction_model->add_construction($data['data']);
			$this->session->set_flashdata('msg', 'Construction <b>\''.$this->input->post('construction_name').'\'</b> added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid construction input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/products/construction');
	}

	function edit()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if (isset($_POST['construction_id']) && isset($_POST['construction_name']) ) {
			$data['data'] = array(
				'construction_name'			=> $this->input->post('construction_name'),		
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->construction_model->edit_construction($this->input->post('construction_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Construction <b>\''.$this->input->post('construction_name').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid construction input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/settings/products/construction');
	}

	function delete($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($id) ) {
			if($this->construction_model->delete_construction($id)) {
				$this->session->set_flashdata('msg', 'Construction deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid construction delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid construction delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/products/construction');
	}

	function data()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->construction_model->get_construction_data());
	}
}