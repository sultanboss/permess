<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('accounts_model');
		$this->load->model('marketing_model');
		$this->load->model('inventory_model');
		$this->load->model('factory_model');
	}

	function cashpayment()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Accounts')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Cash Payment - Accounts';

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

		$this->breadcrumbs->push('Accounts', '#');
		$this->breadcrumbs->push('Cash Payment', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('accounts/cashpayment', $data);
		$this->load->view('common/footer', $data);
	}

	function paymentdetails($id)
	{
		$this->tank_auth->check_login();

		if ( isset($id) ) {

			$data['status'] = $this->marketing_model->get_delivery_status_by_id($id);
			if(empty($data['status'])) {
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/accounts/lcstatements');
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

			$data['title'] = 'Update Payment';

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
				'js/pages/ebro_invoices.js',
				'js/pages/ebro_accounts.js'));

			$this->breadcrumbs->push('Accounts', '#');
			$this->breadcrumbs->push('Update Payment', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();

			$data['payment'] = $this->accounts_model->get_payment_details_by_id($id);

			$data['delivery'] = $this->inventory_model->get_delivery_by_id($id);
			$data['delivery_user'] = $this->factory_model->get_delivery_user($data['delivery'][0]['delivery_by']);
			$data['delivery_products'] = $this->inventory_model->get_delivery_products_by_id($id);

			foreach ($data['delivery_products'] as $key => $value) {
				$data['delivery_products'][$key]['article_name'] = $this->factory_model->get_article_alt_name($value['article_alt']);
				$data['delivery_products'][$key]['description_name'] = $this->factory_model->get_description($value['description_id']);
				$data['delivery_products'][$key]['width_name'] = $this->factory_model->get_width($value['width_id']);
				$data['delivery_products'][$key]['softness_name'] = $this->factory_model->get_softness($value['softness_id']);
				$data['delivery_products'][$key]['color_name'] = $this->factory_model->get_color($value['color_id']);
			}


			$this->load->view('common/header', $data);
			$this->load->view('accounts/paymentdetails', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/accounts/cashpayment');
		}
	}

	function editpayment()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Accounts')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}


		if (isset($_POST['delivery_id'])) {

			if($this->tank_auth->is_group_member('Accounts')) {
				if(!$this->marketing_model->accounts_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}
			
			$data['data'] = array(
				'bill_date'						=> $this->input->post('bill_date'),	
				'bill_from' 					=> $this->input->post('bill_from'),
				'bill_to' 						=> $this->input->post('bill_to'),
				'bill_usd_rate' 				=> $this->input->post('bill_usd_rate'),
				'bill_received'					=> $this->input->post('bill_received'),
				'bill_challan' 					=> $this->input->post('bill_challan'),
				'bill_payment_status' 			=> $this->input->post('bill_payment_status'),
				'bill_payment_method' 			=> $this->input->post('bill_payment_method'),	
				'bill_mr_no' 					=> $this->input->post('bill_mr_no'),	
				'bill_mr_date' 					=> $this->input->post('bill_mr_date'),		
				'bill_cheque_no'				=> $this->input->post('bill_cheque_no'),		
				'bill_cheque_date' 				=> $this->input->post('bill_cheque_date'),			
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->accounts_model->update_payment($this->input->post('delivery_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Payment <b>\''.$this->input->post('delivery_id').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');

			redirect('/accounts/paymentdetails/'.$this->input->post('delivery_id'));
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid payment input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/marketing/order');
		}
	}

	function datacashpayment()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Accounts')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->accounts_model->get_cash_payment_order_data());
	}

}