<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Description extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('description_model');
	}

	function index()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Description - Settings';

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
		$this->breadcrumbs->push('Descriptions', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('description/index', $data);
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

		if ( isset($_POST['description_name']) ) {
			$data['data'] = array(
				'description_name'			=> $this->input->post('description_name'),
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->description_model->add_description($data['data']);
			$this->session->set_flashdata('msg', 'Description <b>\''.$this->input->post('description_name').'\'</b> added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid description input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/products/description');
	}

	function edit()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if (isset($_POST['description_id']) && isset($_POST['description_name']) ) {
			$data['data'] = array(
				'description_name'			=> $this->input->post('description_name'),		
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->description_model->edit_description($this->input->post('description_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Description <b>\''.$this->input->post('description_name').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid description input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/settings/products/description');
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
			if($this->description_model->delete_description($id)) {
				$this->session->set_flashdata('msg', 'Description deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid description delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid description delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/products/description');
	}

	function data()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->description_model->get_description_data());
	}
}