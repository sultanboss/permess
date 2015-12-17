<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Addressprice extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('address_price_model');
	}

	function index()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Address Price - Settings';

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
		$this->breadcrumbs->push('Address Price', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['companies']	= $this->address_price_model->get_companies();
		$data['articles']	= $this->address_price_model->get_articles();

		$this->load->view('common/header', $data);
		$this->load->view('addressprice/index', $data);
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

		if ( isset($_POST['address_id']) ) {
			$data['data'] = array(
				'address_id'				=> $this->input->post('address_id'),
				'article_id'				=> $this->input->post('article_id'),
				'price'						=> $this->input->post('price'),
				'over_invoice'				=> $this->input->post('over_invoice'),
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->address_price_model->add_address_price($data['data']);
			$this->session->set_flashdata('msg', 'Address price <b>\''.$this->input->post('company_name').'\'</b> added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid address price input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/addressprice');
	}

	function edit()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if (isset($_POST['edit_address_price_id']) && isset($_POST['edit_address_id']) ) {
			$data['data'] = array(
				'address_id'				=> $this->input->post('edit_address_id'),
				'article_id'				=> $this->input->post('edit_article_id'),
				'price'						=> $this->input->post('edit_price'),
				'over_invoice'				=> $this->input->post('edit_over_invoice'),
				'editor_id' 				=> $this->session->userdata('user_id')
			);

			$this->address_price_model->edit_address_price($this->input->post('edit_address_price_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Address price <b>\''.$this->input->post('edit_company_name').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid address price input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/settings/addressprice');
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
			if($this->address_price_model->delete_address_price($id)) {
				$this->session->set_flashdata('msg', 'Address Price deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid address price delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid address price delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/settings/addressprice');
	}

	function data()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->address_price_model->get_address_price_data());
	}
}