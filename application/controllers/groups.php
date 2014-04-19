<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('groups_model');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Groups';

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

		$this->breadcrumbs->push('Admin', '#');
		$this->breadcrumbs->push('Groups', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('groups/index', $data);
		$this->load->view('common/footer', $data);
	}

	function add()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if(!$this->tank_auth->is_admin()) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if (isset($_POST['group_name']) ) {
			$data['data'] = array(
				'group_name'			=> $this->input->post('group_name')
			);

			$this->groups_model->add_groups($data['data']);
			$this->session->set_flashdata('msg', 'Groups <b>\''.$this->input->post('group_name').'\'</b> added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid group input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/admin/groups');
	}

	function edit()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if(!$this->tank_auth->is_admin()) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if (isset($_POST['group_id']) && isset($_POST['group_name']) ) {
			$data['data'] = array(
				'group_name'			=> $this->input->post('group_name')
			);

			$this->groups_model->edit_groups($this->input->post('group_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Group <b>\''.$this->input->post('group_name').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid group input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/admin/groups');
	}

	function delete($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if(!$this->tank_auth->is_admin()) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($id) ) {
			if($this->groups_model->delete_groups($id)) {
				$this->session->set_flashdata('msg', 'Groups deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid groups delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid groups delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/admin/groups');
	}

	function data()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->groups_model->get_data());
	}
}