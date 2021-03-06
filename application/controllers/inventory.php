<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('inventory_model');
		$this->load->model('factory_model');
		$this->load->model('accounts_model');
	}

	function stock()
	{
		$this->tank_auth->check_login();

		$data['title'] = 'Stocks - Factory';

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
		$this->breadcrumbs->push('Stocks', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('inventory/stock', $data);
		$this->load->view('common/footer', $data);
	}

	function datastock()
	{
		$this->tank_auth->check_login();

		print_r($this->inventory_model->get_stock_data());
	}

	function delivery()
	{
		$this->tank_auth->check_login();

		$data['title'] = 'Delivery - Factory';

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
		$this->breadcrumbs->push('Delivery', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('inventory/delivery', $data);
		$this->load->view('common/footer', $data);
	}

	function datadelivery()
	{
		$this->tank_auth->check_login();

		print_r($this->inventory_model->get_delivery_data());
	}

	function newdelivery()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'New P.I. No.';

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
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_delivery.js'));

		$this->breadcrumbs->push('New P.I. No.', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['articles'] = $this->factory_model->get_all_article_with_alt();
		$data['descriptions'] = $this->factory_model->get_all_description();
		$data['widths'] = $this->factory_model->get_all_width();
		$data['softnesses'] = $this->factory_model->get_all_softness();
		$data['colors'] = $this->factory_model->get_all_color();

		$data['normal_users'] 	 = $this->inventory_model->get_normal_users();
		$data['companies']		 = $this->inventory_model->get_companies();

		$this->load->view('common/header', $data);
		$this->load->view('inventory/newdelivery', $data);
		$this->load->view('common/footer', $data);
	}

	function editdelivery($id)
	{
		$this->tank_auth->check_login();

		if ( isset($id) ) {

			if($this->tank_auth->is_group_member('Users')) {
				if(!$this->inventory_model->users_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}
			/*else if($this->tank_auth->is_group_member('Accounts')) {
				if(!$this->inventory_model->accounts_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}*/

			$data['delivery'] = $this->inventory_model->get_delivery_by_id($id);
			if(empty($data['delivery'])) {
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/factory/delivery');
			}

			$data['title'] = 'Edit Delivery';

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
				'js/pages/ebro_delivery.js'));

			$this->breadcrumbs->push('Factory', '#');
			$this->breadcrumbs->push('Delivery', '../../factory/delivery');
			$this->breadcrumbs->push('Edit Delivery', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();
			$data['articles'] = $this->factory_model->get_all_article_with_alt();
			$data['descriptions'] = $this->factory_model->get_all_description();
			$data['widths'] = $this->factory_model->get_all_width();
			$data['softnesses'] = $this->factory_model->get_all_softness();
			$data['colors'] = $this->factory_model->get_all_color();

			$data['normal_users'] = $this->inventory_model->get_normal_users();
			$data['payment'] = $this->inventory_model->get_payment_status($id);
			$data['companies'] = $this->inventory_model->get_companies();

			$data['delivery_products'] = $this->inventory_model->get_delivery_products_by_id($id);

			$this->load->view('common/header', $data);
			$this->load->view('inventory/editdelivery', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/factory/delivery');
		}
	}

	function adddelivery()
	{
		$this->tank_auth->check_login();

		$_POST = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
                
		if ( isset($_POST['delivery_date']) && isset($_POST['delivery_by']) ) {
			$data['data'] = array(
				'delivery_date'				=> $this->input->post('delivery_date'),
				'delivery_pi_name'			=> $this->input->post('delivery_pi_name'),
				'delivery_po_no'			=> $this->input->post('delivery_po_no'),
				'delivery_by'				=> $this->input->post('delivery_by'),
				'delivery_status'			=> $this->input->post('delivery_status'),
				'delivery_doc_status'       => $this->input->post('delivery_doc_status'),
				'delivery_lc_status'		=> $this->input->post('delivery_lc_status'),
				'delivery_lc_date'			=> $this->input->post('delivery_lc_date'),
				'delivery_item_no'          => $this->input->post('delivery_item_no'),
				'delivery_type'             => $this->input->post('delivery_type'),
				'delivery_company_name'		=> $this->input->post('delivery_company_name'),
				'delivery_company_address'	=> $this->input->post('delivery_company_address'),
				'delivery_address'          => $this->input->post('delivery_address'),
				'delivery_contact_person'	=> $this->input->post('delivery_contact_person'),
				'delivery_buyer'			=> $this->input->post('delivery_buyer'),
				'delivery_bank'				=> $this->input->post('delivery_bank'),
				'delivery_payment'			=> $this->input->post('delivery_payment'),
				'delivery_style'            => $this->input->post('delivery_style'),
				'delivery_commission_status'=> $this->input->post('delivery_commission_status'),
				'delivery_commission'       => $this->input->post('delivery_commission'),
				'delivery_remarks'       	=> $this->input->post('delivery_remarks'),
                'hs_code'					=> $this->input->post('delivery_hs_code'),
				'editor_id' 				=> $this->session->userdata('user_id')				
			);

			if ( isset($_POST['delivery_pi_no']) && $_POST['delivery_pi_no'] != '' ) {
				$data['data']['delivery_id'] = $this->input->post('delivery_pi_no');
			}
                             
			$delivery_id = $this->inventory_model->add_delivery($data['data']);

			if($delivery_id != NULL) {
				for($i=0; $i<100; $i++)
				{
					if( isset($_POST['article_id_'.$i]) )
					{	
						$article_id = explode('-', $this->input->post('article_id_'.$i));
						$article_id = $article_id[0];	

						$data['eq_product'] = array(
							'delivery_id'				=> $delivery_id,
							'article_id'				=> $article_id,
							'article_alt'				=> $this->input->post('article_id_'.$i),
							'description_id'			=> $this->input->post('description_id_'.$i),
							'softness_id'				=> $this->input->post('softness_id_'.$i),
							'width_id'					=> $this->input->post('width_id_'.$i),
							'color_id'					=> $this->input->post('color_id_'.$i),
							'order_quantity'			=> $this->input->post('order_quantity_'.$i),
							'delivery_quantity'			=> $this->input->post('delivery_quantity_'.$i),
							'unit_price'				=> $this->input->post('unit_price_'.$i),
							'over_invoice_unit_price'	=> $this->input->post('over_invoice_unit_price_'.$i),
							'editor_id' 				=> $this->session->userdata('user_id'),
	                        'mtype'						=> $this->input->post('mtype_'.$i)
						);
						$this->inventory_model->add_delivery_product($data['eq_product']);
					}
					else
						$i = 100;
				}

				if($this->input->post('delivery_payment') == '0')
				{
					$cost = $this->inventory_model->get_delivery_cost($delivery_id);

					$data['statemetns'] = array(
						'delivery_id'		=> $delivery_id,
						'lc_date'			=> $this->input->post('delivery_lc_date'),
						'value'				=> $cost,
						'editor_id' 		=> $this->session->userdata('user_id')
					);

					$this->inventory_model->add_statements($data['statemetns']);
				}
				else
				{
					$data['bill'] = array(
						'delivery_id'		=> $delivery_id,
						'editor_id' 		=> $this->session->userdata('user_id')
					);

					$this->accounts_model->add_bill($data['bill']);
				}

				$this->inventory_model->add_challan($delivery_id);

				echo $delivery_id;

				$this->session->set_flashdata('msg', 'Delivery added successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				echo '';
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
	}

	function updatedelivery($id)
	{
		$this->tank_auth->check_login();

		if ( isset($id) ) {

			$_POST = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

			if ( isset($_POST['delivery_date']) && isset($_POST['delivery_by']) ) {

				if($this->tank_auth->is_group_member('Factory')) {
					$data['data'] = array(
						'delivery_status'			=> $this->input->post('delivery_status'),
						'editor_id' 				=> $this->session->userdata('user_id')
					);
				}
				else if($this->tank_auth->is_group_member('Commercial')) {
					$data['data'] = array(
						'delivery_doc_status'		=> $this->input->post('delivery_doc_status'),
						'delivery_lc_status'		=> $this->input->post('delivery_lc_status'),
						'editor_id' 				=> $this->session->userdata('user_id')
					);
				}
				else if($this->tank_auth->is_group_member('Users')) {
					$data['data'] = array();
				}
				else if($this->tank_auth->is_group_member('Accounts')) {
					$data['data'] = array(
						'delivery_commission_status'=> $this->input->post('delivery_commission_status'),
						'delivery_commission'       => $this->input->post('delivery_commission')
					);
				}
				else {
					$data['data'] = array(
						'delivery_date'				=> $this->input->post('delivery_date'),
						'delivery_pi_name'			=> $this->input->post('delivery_pi_name'),
						'delivery_po_no'			=> $this->input->post('delivery_po_no'),
						'delivery_by'				=> $this->input->post('delivery_by'),
						'delivery_status'			=> $this->input->post('delivery_status'),
						'delivery_doc_status'       => $this->input->post('delivery_doc_status'),
						'delivery_lc_status'		=> $this->input->post('delivery_lc_status'),
						'delivery_lc_date'			=> $this->input->post('delivery_lc_date'),
						'delivery_item_no'          => $this->input->post('delivery_item_no'),
						'delivery_type'             => $this->input->post('delivery_type'),
						'delivery_company_name'		=> $this->input->post('delivery_company_name'),
						'delivery_company_address'	=> $this->input->post('delivery_company_address'),
						'delivery_address'          => $this->input->post('delivery_address'),
						'delivery_contact_person'	=> $this->input->post('delivery_contact_person'),
						'delivery_buyer'			=> $this->input->post('delivery_buyer'),
						'delivery_bank'				=> $this->input->post('delivery_bank'),
						'delivery_payment'			=> $this->input->post('delivery_payment'),
						'delivery_style'            => $this->input->post('delivery_style'),
						'delivery_revised'          => $this->input->post('delivery_revised'),
						'delivery_commission_status'=> $this->input->post('delivery_commission_status'),
						'delivery_commission'       => $this->input->post('delivery_commission'),		
						'delivery_remarks'       	=> $this->input->post('delivery_remarks'),
                        'hs_code'					=> $this->input->post('delivery_hs_code'),
						'editor_id' 				=> $this->session->userdata('user_id')
					);
				}

				$this->inventory_model->update_delivery($this->input->post('delivery_id'), $data['data']);

				if($this->tank_auth->is_group_member('Commercial') || $this->tank_auth->is_group_member('Accounts') || $this->tank_auth->is_group_member('Users')) {
					
				}
				else if($this->tank_auth->is_group_member('Factory')) {
					for($i=0; $i<100; $i++)
					{
						if( isset($_POST['article_id_'.$i]) )
						{
							$delivery_product_id = explode('-', $this->input->post('delivery_product_id_'.$i));
							$delivery_product_id = $delivery_product_id[0];	
											
							$data['eq_product'] = array(
								'delivery_quantity'			=> $this->input->post('delivery_quantity_'.$i),
								'editor_id' 				=> $this->session->userdata('user_id')
							);

							$check_product = $this->inventory_model->check_delivery_product_factory($delivery_product_id);

							$data['eq_product']['delivery_quantity'] = $check_product + $data['eq_product']['delivery_quantity'];
							$this->inventory_model->update_delivery_product($delivery_product_id, $data['eq_product']);						
						}
						else
							$i = 100;
					}
				}
				else {
					//$this->inventory_model->remove_delivery_product($this->input->post('delivery_id'));

					$remove_array = array();

					for($i=0; $i<100; $i++)
					{
						if( isset($_POST['article_id_'.$i]) )
						{
							$article_id = explode('-', $this->input->post('article_id_'.$i));
							$article_id = $article_id[0];	

							$delivery_product_id = explode('-', $this->input->post('delivery_product_id_'.$i));
							$delivery_product_id = $delivery_product_id[0];	

							$remove_array[$delivery_product_id] = true;
											
							$data['eq_product'] = array(
								'delivery_id'				=> $this->input->post('delivery_id'),
								'article_id'				=> $article_id,
								'article_alt'				=> $this->input->post('article_id_'.$i),
								'description_id'			=> $this->input->post('description_id_'.$i),
								'softness_id'				=> $this->input->post('softness_id_'.$i),
								'width_id'					=> $this->input->post('width_id_'.$i),
								'color_id'					=> $this->input->post('color_id_'.$i),
								'order_quantity'			=> $this->input->post('order_quantity_'.$i),
								'delivery_quantity'			=> $this->input->post('delivery_quantity_'.$i),
								'unit_price'				=> $this->input->post('unit_price_'.$i),
								'over_invoice_unit_price'	=> $this->input->post('over_invoice_unit_price_'.$i),
								'editor_id' 				=> $this->session->userdata('user_id'),
                                'mtype'						=> $this->input->post('mtype_'.$i)
							);

							$check_product = $this->inventory_model->check_delivery_product($delivery_product_id, $data['eq_product']);

							if($check_product != false) {
								$data['eq_product']['delivery_quantity'] = $check_product + $data['eq_product']['delivery_quantity'];
								$this->inventory_model->update_delivery_product($delivery_product_id, $data['eq_product']);
								$remove_array[$delivery_product_id] = false;
							}
							else {
								$this->inventory_model->add_delivery_product($data['eq_product']);
							}							
						}
						else
							$i = 100;
					}

					foreach ($remove_array as $key => $value) {
						if($value == true) {
							$this->inventory_model->remove_single_delivery_product($key);
						}
					}

					if($this->input->post('delivery_payment') == '0')
					{
						$this->accounts_model->delete_bill($this->input->post('delivery_id'));

						$cost = $this->inventory_model->get_delivery_cost($this->input->post('delivery_id'));

						$data['statemetns'] = array(
							'delivery_id'		=> $this->input->post('delivery_id'),
							'lc_date'			=> $this->input->post('delivery_lc_date'),
							'value'				=> $cost,
							'editor_id' 		=> $this->session->userdata('user_id')
						);

						$this->inventory_model->update_statements($this->input->post('delivery_id'), $data['statemetns']);
					}
					else
					{
						$this->inventory_model->delete_statements($this->input->post('delivery_id'));

						$data['bill'] = array(
							'delivery_id'		=> $this->input->post('delivery_id'),
							'editor_id' 		=> $this->session->userdata('user_id')
						);

						$this->accounts_model->update_bill($this->input->post('delivery_id'), $data['bill']);
					}
				}

				$this->inventory_model->add_challan($this->input->post('delivery_id'));

				$this->session->set_flashdata('msg', 'Delivery updated successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/factory/delivery');
		}
	}

	function printdelivery($id)
	{
		$this->tank_auth->check_login();

		if ( isset($id) ) {

			if($this->tank_auth->is_group_member('Users')) {
				if(!$this->inventory_model->users_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}
			/*else if($this->tank_auth->is_group_member('Accounts')) {
				if(!$this->inventory_model->accounts_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}*/

			$data['delivery'] = $this->inventory_model->get_delivery_by_id($id);
			if(empty($data['delivery'])) {
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/factory/delivery');
			}

			$data['title'] = 'Print Delivery';

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
				'js/pages/ebro_invoices.js'));

			$this->breadcrumbs->push('Factory', '#');
			$this->breadcrumbs->push('Delivery', '../../factory/delivery');
			$this->breadcrumbs->push('Print Delivery', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();	
			$data['delivery_user'] = $this->factory_model->get_delivery_user($data['delivery'][0]['delivery_by']);
			$data['delivery_products'] = $this->inventory_model->get_delivery_products_by_id($id);
			$data['payment'] = $this->inventory_model->get_payment_status($id);

			foreach ($data['delivery_products'] as $key => $value) {
				$data['delivery_products'][$key]['article_name'] = $this->factory_model->get_article_alt_name($value['article_alt']);
				$data['delivery_products'][$key]['description_name'] = $this->factory_model->get_description($value['description_id']);
				$data['delivery_products'][$key]['width_name'] = $this->factory_model->get_width($value['width_id']);
				$data['delivery_products'][$key]['softness_name'] = $this->factory_model->get_softness($value['softness_id']);
				$data['delivery_products'][$key]['color_name'] = $this->factory_model->get_color($value['color_id']);
			}

			$this->load->view('common/header', $data);
			$this->load->view('inventory/printdelivery', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/factory/delivery');
		}
	}

	function printchallan($id = null, $challanid = 0,$rt=NULL)
	{
		$this->tank_auth->check_login();
                $data['report_type']=$rt;
		if ($id != null) {

			if($this->tank_auth->is_group_member('Users')) {
				if(!$this->inventory_model->users_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}
			/*else if($this->tank_auth->is_group_member('Accounts')) {
				if(!$this->inventory_model->accounts_delivery_check($id)) {
					$this->session->set_flashdata('msg', 'Invalid Access!');
					$this->session->set_flashdata('msg_type', 'warning');
					redirect('');
				}
			}*/

			$data['delivery'] = $this->inventory_model->get_delivery_by_id($id);
			if(empty($data['delivery'])) {
				$this->session->set_flashdata('msg', 'Invalid delivery input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/factory/delivery');
			}

			$data['title'] = 'Delivery Challan';

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
				'js/pages/ebro_invoices.js'));

			$this->breadcrumbs->push('Factory', '#');
			$this->breadcrumbs->push('Delivery', '../../factory/delivery');
			$this->breadcrumbs->push('Print Challan', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();	
			$data['delivery_user'] = $this->factory_model->get_delivery_user($data['delivery'][0]['delivery_by']);
			$data['payment'] = $this->inventory_model->get_payment_status($id);

			$data['challan_list'] = $this->inventory_model->get_challan_list_by_id($id);
			if($challanid == 0) {
				$data['challan_details_data'] = $this->inventory_model->get_first_challan_by_id($id);
				$data['challan_details'] = $data['challan_details_data']['challan_details'];
				$challanid = $data['challan_details_data']['challan_id'];
			}
			else {
				$data['challan_details'] = $this->inventory_model->get_challan_by_id($challanid);
			}	

			if($data['challan_details'] != null) {	

				$data['cid'] = $challanid;	

				$data['challan_details'] = unserialize($data['challan_details']);

				foreach ($data['challan_details'] as $key => $value) {
					$data['delivery_products'][$key]['type'] 				= 'normal';
					$data['delivery_products'][$key]['delivery_product_id'] = $value['delivery_product_id'];
				    $data['delivery_products'][$key]['delivery_id'] 		= $value['delivery_id'];
				    $data['delivery_products'][$key]['article_id'] 			= $value['article_id'];
				    $data['delivery_products'][$key]['article_alt'] 		= $value['article_alt'];
				    $data['delivery_products'][$key]['width_id'] 			= $value['width_id'];
				    $data['delivery_products'][$key]['softness_id'] 		= $value['softness_id'];
				    $data['delivery_products'][$key]['color_id'] 			= $value['color_id'];
				    $data['delivery_products'][$key]['description_id'] 		= $value['description_id'];
				    $data['delivery_products'][$key]['order_quantity'] 		= $value['order_quantity'];
				    $data['delivery_products'][$key]['delivery_quantity'] 	= $value['delivery_quantity'];
				    $data['delivery_products'][$key]['unit_price'] 			= $value['unit_price'];
				    $data['delivery_products'][$key]['over_invoice_unit_price'] = $value['over_invoice_unit_price'];
				    $data['delivery_products'][$key]['editor_id'] 			= $value['editor_id'];
				    $data['delivery_products'][$key]['created'] 			= $value['created'];
				    $data['delivery_products'][$key]['modified'] 			= $value['modified'];
					$data['delivery_products'][$key]['article_name'] 		= $this->factory_model->get_article_alt_name($value['article_alt']);
					$data['delivery_products'][$key]['description_name'] 	= $this->factory_model->get_description($value['description_id']);
					$data['delivery_products'][$key]['width_name'] 			= $this->factory_model->get_width($value['width_id']);
					$data['delivery_products'][$key]['softness_name'] 		= $this->factory_model->get_softness($value['softness_id']);
					$data['delivery_products'][$key]['color_name'] 			= $this->factory_model->get_color($value['color_id']);

				    $data['delivery_products'][$key]['cur_delivery_quantity'] = $value['delivery_quantity'];
				}

				$data['challan_returned'] = $this->inventory_model->get_previous_challan($data['cid']);

				$csize = count($data['delivery_products']);

				if($data['challan_returned'] != null) {
				
					foreach ($data['challan_returned'] as $key => $value) {
						$is_returned = false;
						foreach ($data['challan_details'] as $k => $v) {
							if(($value['article_id'] == $v['article_id']) && ($value['width_id'] == $v['width_id']) && ($value['softness_id'] == $v['softness_id']) && ($value['color_id'] == $v['color_id']) && ($value['description_id'] == $v['description_id'])) {
								//break;
							}
							else {
								$is_returned = true;
								break;
							}
						}

						if($is_returned == true) {
							$data['delivery_products'][$csize]['type'] 					= 'returned';
							$data['delivery_products'][$csize]['delivery_product_id'] 	= $value['delivery_product_id'];
						    $data['delivery_products'][$csize]['delivery_id'] 			= $value['delivery_id'];
						    $data['delivery_products'][$csize]['article_id'] 			= $value['article_id'];
						    $data['delivery_products'][$csize]['article_alt'] 			= $value['article_alt'];
						    $data['delivery_products'][$csize]['width_id'] 				= $value['width_id'];
						    $data['delivery_products'][$csize]['softness_id'] 			= $value['softness_id'];
						    $data['delivery_products'][$csize]['color_id'] 				= $value['color_id'];
						    $data['delivery_products'][$csize]['description_id'] 		= $value['description_id'];
						    $data['delivery_products'][$csize]['order_quantity'] 		= $value['order_quantity'];
						    $data['delivery_products'][$csize]['delivery_quantity'] 	= $value['delivery_quantity'];
						    $data['delivery_products'][$csize]['unit_price'] 			= $value['unit_price'];
						    $data['delivery_products'][$csize]['over_invoice_unit_price'] = $value['over_invoice_unit_price'];
						    $data['delivery_products'][$csize]['editor_id'] 			= $value['editor_id'];
						    $data['delivery_products'][$csize]['created'] 				= $value['created'];
						    $data['delivery_products'][$csize]['modified'] 				= $value['modified'];
							$data['delivery_products'][$csize]['article_name'] 			= $this->factory_model->get_article_alt_name($value['article_alt']);
							$data['delivery_products'][$csize]['description_name'] 		= $this->factory_model->get_description($value['description_id']);
							$data['delivery_products'][$csize]['width_name'] 			= $this->factory_model->get_width($value['width_id']);
							$data['delivery_products'][$csize]['softness_name'] 		= $this->factory_model->get_softness($value['softness_id']);
							$data['delivery_products'][$csize]['color_name'] 			= $this->factory_model->get_color($value['color_id']);

				    		$data['delivery_products'][$csize]['cur_delivery_quantity'] = $value['delivery_quantity'];
							$csize++;
						}
						else {
							$data['delivery_products'][$key]['cur_delivery_quantity'] = $data['delivery_products'][$key]['cur_delivery_quantity']-$value['delivery_quantity'];
						}
					}
				}
			}

			$this->load->view('common/header', $data);
			$this->load->view('inventory/printchallan', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid delivery input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/factory/delivery');
		}
	}

	function getDeliveryAddress($company_name = null)
	{
		if($company_name != null) {
			$company_name = urldecode($company_name);
			$company_name = str_replace('&#40;', '(', $company_name);
			$company_name = str_replace('&#41;', ')', $company_name);
			$this->tank_auth->check_login();
			$res = $this->inventory_model->get_delivery_address($company_name);	
			foreach ($res as $key => $value) {				
				$ar['contact_person'] 	= $value['contact_person'];
				$ar['buyer'] 			= $value['buyer'];
				$ar['company_address'] 	= $value['company_address'];
				$ar['delivery_address'] = $value['delivery_address'];

				echo json_encode($ar);
			}
		}
	}

	function getArticleAddressPrice($address_id = null, $article_id = null)
	{
		if($article_id != null && $address_id != null) {
			$article_id = urldecode($article_id);
			$article = explode('-', $article_id);
			$this->tank_auth->check_login();
			$res = $this->inventory_model->get_article_address_price($address_id, $article[0]);	
			echo $res;
		}
	}

}