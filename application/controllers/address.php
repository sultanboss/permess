<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('address_model');
	}

	function index()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Address - Settings';

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
		$this->breadcrumbs->push('Address', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('address/index', $data);
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

		if ( isset($_POST['company_name']) ) {
			$data['data'] = array(
				'company_name'				=> $this->input->post('company_name'),
				'contact_person'			=> $this->input->post('contact_person'),
				'buyer'						=> $this->input->post('buyer'),
				'company_address'			=> $this->input->post('company_address'),
				'delivery_address'			=> $this->input->post('delivery_address'),
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->address_model->add_address($data['data']);
			$this->session->set_flashdata('msg', 'Address <b>\''.$this->input->post('company_name').'\'</b> added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid address input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/address');
	}

	function edit()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if (isset($_POST['edit_address_id']) && isset($_POST['edit_company_name']) ) {
			$data['data'] = array(
				'company_name'				=> $this->input->post('edit_company_name'),
				'contact_person'			=> $this->input->post('edit_contact_person'),
				'buyer'						=> $this->input->post('edit_buyer'),
				'company_address'			=> $this->input->post('edit_company_address'),
				'delivery_address'			=> $this->input->post('edit_delivery_address'),		
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->address_model->edit_address($this->input->post('edit_address_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Address <b>\''.$this->input->post('edit_company_name').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid address input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/settings/address');
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
			if($this->address_model->delete_address($id)) {
				$this->session->set_flashdata('msg', 'Address deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid address delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid address delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/address');
	}

	function data()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->address_model->get_address_data());
	}
}