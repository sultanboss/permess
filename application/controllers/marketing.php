<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Marketing extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('marketing_model');
	}

	function order()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Orders - Marketing';

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

		$this->breadcrumbs->push('Marketing', '#');
		$this->breadcrumbs->push('Orders', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('marketing/order', $data);
		$this->load->view('common/footer', $data);
	}

	function orderdetails($id)
	{
		$this->tank_auth->check_login();

		if ( isset($id) ) {

			$data['status'] = $this->marketing_model->get_delivery_status_by_id($id);
			if(empty($data['status'])) {
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/commercial/lcstatements');
			}

			if($this->tank_auth->is_group_member('Accounts')) {
				if(!$this->marketing_model->accounts_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}
			else if($this->tank_auth->is_group_member('Users')) {
				if(!$this->marketing_model->users_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}

			$data['title'] = 'Update Order';

			$data['css'] = $this->tank_auth->load_admin_css(array(
				'js/lib/dataTables/media/DT_bootstrap.css', 
				'js/lib/datepicker/css/datepicker.css',
				'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
				'css/hint-css/hint.css',
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
				'js/pages/ebro_notifications.js',
				'js/pages/ebro_marketing.js'));

			$this->breadcrumbs->push('Marketing', '#');
			$this->breadcrumbs->push('Update Order', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();

			$data['order'] = $this->marketing_model->get_order_details_by_id($id);
			$data['payment'] = $this->marketing_model->get_payment_status($id);

			$this->load->view('common/header', $data);
			$this->load->view('marketing/orderdetails', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/commercial/lcstatements');
		}
	}

	function editorder()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}


		if (isset($_POST['delivery_id'])) {

			if($this->tank_auth->is_group_member('Users') )	{
				if(!$this->marketing_model->users_delivery_check($this->input->post('delivery_id'))) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}
			
			$data['data'] = array(
				'buyer_order_reference'			=> $this->input->post('buyer_order_reference'),		
				'delivery_request' 				=> $this->input->post('delivery_request'),	
				'delivery_details' 				=> $this->input->post('delivery_details')
			);

			$this->marketing_model->update_order($this->input->post('delivery_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Order <b>\''.$this->input->post('delivery_id').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');

			redirect('/marketing/orderdetails/'.$this->input->post('delivery_id'));
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid order input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/marketing/order');
		}
	}

	function dataorder()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->marketing_model->get_order_data());
	}

	function lcstatements()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'LC Statements - Commercial';

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

		$this->breadcrumbs->push('Commercial', '#');
		$this->breadcrumbs->push('LC Statements', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('marketing/lcstatements', $data);
		$this->load->view('common/footer', $data);
	}

	function editlcstatements($id)
	{
		$this->tank_auth->check_login();

		if ( isset($id) ) {

			$data['check'] = $this->marketing_model->lc_exist($id);

			if(empty($data['check'])) {
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/commercial/lcstatements');
			}

			if($this->tank_auth->is_group_member('Accounts')) {
				if(!$this->marketing_model->accounts_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}
			else if($this->tank_auth->is_group_member('Users')) {
				if(!$this->marketing_model->users_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}

			$data['title'] = 'Edit LC Statements';

			$data['css'] = $this->tank_auth->load_admin_css(array(
				'js/lib/dataTables/media/DT_bootstrap.css', 
				'js/lib/datepicker/css/datepicker.css',
				'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
				'css/hint-css/hint.css',
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
				'js/pages/ebro_notifications.js',
				'js/pages/ebro_marketing.js'));

			$this->breadcrumbs->push('Commercial', '#');
			$this->breadcrumbs->push('Edit LC Statements', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();
			$data['status'] = $this->marketing_model->get_delivery_status_by_id($id);

			$data['statements'] = $this->marketing_model->get_delivery_statemetns_by_id($id);			
			$data['commission'] = $this->marketing_model->get_delivery_comission_by_id($id);

			$this->load->view('common/header', $data);
			$this->load->view('marketing/editlcstatements', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/commercial/lcstatements');
		}
	}

	function updatelcstatements()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if (isset($_POST['delivery_id'])) {

			$data['data'] = array(	
				'file_no' 				=> $this->input->post('file_no'),		
				'lc_no' 				=> $this->input->post('lc_no'),		
				'lc_date' 				=> $this->input->post('lc_date'),		
				'lc_rdate' 				=> $this->input->post('lc_rdate'),		
				'value' 				=> $this->input->post('value'),		
				'ship_date' 			=> $this->input->post('ship_date'),		
				'exp_date' 				=> $this->input->post('exp_date'),		
				'party_name' 			=> $this->input->post('party_name'),		
				'bank_name' 			=> $this->input->post('bank_name'),		
				'submit_party_date' 	=> $this->input->post('submit_party_date'),		
				'submit_party_rdate' 	=> $this->input->post('submit_party_rdate'),		
				'bank_submit' 			=> $this->input->post('bank_submit'),		
				'bank_submit_date' 		=> $this->input->post('bank_submit_date'),		
				'bank_submit_value' 	=> $this->input->post('bank_submit_value'),		
				'acc_date' 				=> $this->input->post('acc_date'),		
				'purchase_date' 		=> $this->input->post('purchase_date'),		
				'purchase_tk' 			=> $this->input->post('purchase_tk'),		
				'due_date' 				=> $this->input->post('due_date'),		
				'due_rdate' 			=> $this->input->post('due_rdate'),	
				'editor_id' 			=> $this->session->userdata('user_id')
			);

			$this->marketing_model->update_statements($this->input->post('delivery_id'), $data['data']);

			$data['data'] = array(	
				'delivery_lc_date' 		=> $this->input->post('lc_date'),	
				'delivery_lc_status' 	=> $this->input->post('lc_status'),		
				'delivery_doc_status' 	=> $this->input->post('doc_status'),	
			);

			$this->marketing_model->update_lcstatements($this->input->post('delivery_id'), $data['data']);

			$this->session->set_flashdata('msg', 'Statements updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');

			redirect('/commercial/editlcstatements/'.$this->input->post('delivery_id'));
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid issue input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/commercial/lcstatements');
	}

	function datalcstatements()
	{
		$this->tank_auth->check_login();

		print_r($this->marketing_model->get_lcstatements_data());
	}

	function expissues()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Export Issues - Commercial';

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

		$this->breadcrumbs->push('Commercial', '#');
		$this->breadcrumbs->push('Export Issues', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('marketing/expissues', $data);
		$this->load->view('common/footer', $data);
	}

	function addexpissues()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Add Export Issue - Commercial';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'css/hint-css/hint.css',
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
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_marketing.js'));

		$this->breadcrumbs->push('Commercial', '#');
		$this->breadcrumbs->push('Export Issues', base_url().'commercial/expissues');
		$this->breadcrumbs->push('Add Export Issue', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('marketing/addexpissues', $data);
		$this->load->view('common/footer', $data);
	}

	function addexp()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($_POST['issue_date']) ) {
			$data['data'] = array(
				'issue_date'					=> $this->input->post('issue_date'),
				'send_date'						=> $this->input->post('send_date'),
				'receive_date'					=> $this->input->post('receive_date'),
				'ip_date'						=> $this->input->post('ip_date'),
				'up_date'						=> $this->input->post('up_date'),
				'party_name'					=> $this->input->post('party_name'),
				'value'							=> $this->input->post('value'),
				'status'						=> $this->input->post('status'),
				'bank_submit_date'				=> $this->input->post('exp_bank_submit_date'),
				'due_date'						=> $this->input->post('exp_due_date'),
				'payment_collection_date'		=> $this->input->post('payment_collection_date'),
				'charge'						=> $this->input->post('charte'),
				'remarks'						=> $this->input->post('remarks'),
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$id = $this->marketing_model->add_exp($data['data']);
			$this->session->set_flashdata('msg', 'Export Issue added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
			redirect('/commercial/editexpissues/'.$id);
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid Export Issue input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/commercial/expissues');
	}

	function editexpissues($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($id) ) {		

			$data['export'] = $this->marketing_model->get_export_by_id($id);

			if(empty($data['export'])) {
				$this->session->set_flashdata('msg', 'Invalid Export Issue Input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/commercial/expissues');
			}

			$data['title'] = 'Update Export Issue';

			$data['css'] = $this->tank_auth->load_admin_css(array(
				'js/lib/dataTables/media/DT_bootstrap.css', 
				'js/lib/datepicker/css/datepicker.css',
				'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
				'css/hint-css/hint.css',
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
				'js/pages/ebro_notifications.js',
				'js/pages/ebro_marketing.js'));

			$this->breadcrumbs->push('Commercial', '#');
			$this->breadcrumbs->push('Export Issues', base_url().'commercial/expissues');
			$this->breadcrumbs->push('Update Export Issue', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();

			$this->load->view('common/header', $data);
			$this->load->view('marketing/editexpissues', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/commercial/expissues');
		}
	}

	function updateexpissues()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($_POST['export_id']) ) {
			$data['data'] = array(
				'issue_date'					=> $this->input->post('issue_date'),
				'send_date'						=> $this->input->post('send_date'),
				'receive_date'					=> $this->input->post('receive_date'),
				'ip_date'						=> $this->input->post('ip_date'),
				'up_date'						=> $this->input->post('up_date'),
				'party_name'					=> $this->input->post('party_name'),
				'value'							=> $this->input->post('value'),
				'status'						=> $this->input->post('status'),
				'bank_submit_date'				=> $this->input->post('exp_bank_submit_date'),
				'due_date'						=> $this->input->post('exp_due_date'),
				'payment_collection_date'		=> $this->input->post('payment_collection_date'),
				'charge'						=> $this->input->post('charte'),
				'remarks'						=> $this->input->post('remarks'),
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->marketing_model->edit_exp($this->input->post('export_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Export Issue updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
			redirect('/commercial/editexpissues/'.$this->input->post('export_id'));
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid Export Issue input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/commercial/expissues');
	}

	function deleteexpissues($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($id) ) {
			if($this->marketing_model->delete_exp($id)) {
				$this->session->set_flashdata('msg', 'Export Issue deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid Export Issue delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid Export Issue delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/commercial/expissues');
	}

	function dataexpissues()
	{
		$this->tank_auth->check_login();

		print_r($this->marketing_model->get_expissues_data());
	}
}