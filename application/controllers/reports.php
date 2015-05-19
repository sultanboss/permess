<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('reports_model');
	}

	function import()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Import - Reports';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/select2/select2.css', 
			'js/lib/select2/ebro_select2.css', 
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'js/lib/Sticky/sticky.css'));

		$data['js'] = $this->tank_auth->load_admin_js(array(
			'js/lib/iCheck/jquery.icheck.min.js', 
			'js/lib/parsley/parsley.min.js', 
			'js/pages/ebro_form_validate.js', 
			'js/lib/select2/select2.min.js', 
			'js/lib/dataTables/media/js/jquery.dataTables.min.js', 
			'js/lib/dataTables/extras/ColReorder/media/js/ColReorder.min.js',
			'js/lib/dataTables/extras/ColVis/media/js/ColVis.min.js', 
			'js/lib/dataTables/extras/TableTools/media/js/TableTools.min.js',
			'js/lib/dataTables/extras/TableTools/media/js/ZeroClipboard.js',
			'js/lib/dataTables/media/DT_bootstrap.js', 
			'js/pages/ebro_datatables.js', 
			'js/lib/bootbox/bootbox.min.js', 
			'js/lib/datepicker/js/bootstrap-datepicker.js', 
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_reports.js'));

		$this->breadcrumbs->push('Reports', '#');
		$this->breadcrumbs->push('Import', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['articles'] = $this->reports_model->get_all_article();
		$data['constructions'] = $this->reports_model->get_all_construction();
		$data['widths'] = $this->reports_model->get_all_width();
		$data['softnesses'] = $this->reports_model->get_all_softness();
		$data['colors'] = $this->reports_model->get_all_color();
		$data['sources'] = $this->reports_model->get_all_source();

		$data['start_date'] 		= '';
		$data['end_date'] 			= '';
		$data['type'] 				= '';
		$data['article_name'] 		= '';
		$data['construction_name'] 	= '';
		$data['width_name'] 		= '';
		$data['softness_name'] 		= '';
		$data['color_name'] 		= '';
		$data['source_name'] 		= '';

		$data['import'] = array();
		if ( isset($_POST['start_date']) && isset($_POST['end_date']) && ($_POST['start_date'] != '') && ($_POST['end_date'] != '')) {
			$data['import'] = $this->reports_model->get_import_data($_POST['start_date'], $_POST['end_date'], $_POST['type'], $_POST['article_name'], $_POST['construction_name'], $_POST['width_name'], $_POST['softness_name'], $_POST['color_name'], $_POST['source_name']);

			$data['start_date'] 		= $_POST['start_date'];
			$data['end_date'] 			= $_POST['end_date'];
			$data['type'] 				= $_POST['type'];
			$data['article_name'] 		= $_POST['article_name'];
			$data['construction_name'] 	= $_POST['construction_name'];
			$data['width_name'] 		= $_POST['width_name'];
			$data['softness_name'] 		= $_POST['softness_name'];
			$data['color_name'] 		= $_POST['color_name'];
			$data['source_name'] 		= $_POST['source_name'];
		}	

		$this->load->view('common/header', $data);
		$this->load->view('reports/import', $data);
		$this->load->view('common/footer', $data);
	}

	function sales()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Sales - Reports';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/select2/select2.css', 
			'js/lib/select2/ebro_select2.css', 
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'js/lib/Sticky/sticky.css'));

		$data['js'] = $this->tank_auth->load_admin_js(array(
			'js/lib/iCheck/jquery.icheck.min.js', 
			'js/lib/parsley/parsley.min.js', 
			'js/pages/ebro_form_validate.js', 
			'js/lib/select2/select2.min.js', 
			'js/lib/dataTables/media/js/jquery.dataTables.min.js', 
			'js/lib/dataTables/extras/ColReorder/media/js/ColReorder.min.js',
			'js/lib/dataTables/extras/ColVis/media/js/ColVis.min.js', 
			'js/lib/dataTables/extras/TableTools/media/js/TableTools.min.js',
			'js/lib/dataTables/extras/TableTools/media/js/ZeroClipboard.js',
			'js/lib/dataTables/media/DT_bootstrap.js', 
			'js/pages/ebro_datatables.js', 
			'js/lib/bootbox/bootbox.min.js', 
			'js/lib/datepicker/js/bootstrap-datepicker.js', 
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_reports.js'));

		$this->breadcrumbs->push('Reports', '#');
		$this->breadcrumbs->push('Sales', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['start_date'] 		= '';
		$data['end_date'] 			= '';
		$data['sales'] = array();
		if ( isset($_POST['start_date']) && isset($_POST['end_date']) && ($_POST['start_date'] != '') && ($_POST['end_date'] != '')) {
			$data['sales'] = $this->reports_model->get_sales_data($_POST['start_date'], $_POST['end_date']);

			$data['start_date'] 		= $_POST['start_date'];
			$data['end_date'] 			= $_POST['end_date'];
		}	

		$this->load->view('common/header', $data);
		$this->load->view('reports/sales', $data);
		$this->load->view('common/footer', $data);
	}

	function stock()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Stocks - Reports';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/select2/select2.css', 
			'js/lib/select2/ebro_select2.css', 
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'js/lib/Sticky/sticky.css'));

		$data['js'] = $this->tank_auth->load_admin_js(array(
			'js/lib/iCheck/jquery.icheck.min.js', 
			'js/lib/parsley/parsley.min.js', 
			'js/pages/ebro_form_validate.js', 
			'js/lib/select2/select2.min.js', 
			'js/lib/dataTables/media/js/jquery.dataTables.min.js', 
			'js/lib/dataTables/extras/ColReorder/media/js/ColReorder.min.js',
			'js/lib/dataTables/extras/ColVis/media/js/ColVis.min.js', 
			'js/lib/dataTables/extras/TableTools/media/js/TableTools.min.js',
			'js/lib/dataTables/extras/TableTools/media/js/ZeroClipboard.js',
			'js/lib/dataTables/media/DT_bootstrap.js', 
			'js/pages/ebro_datatables.js', 
			'js/lib/bootbox/bootbox.min.js', 
			'js/lib/datepicker/js/bootstrap-datepicker.js', 
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_reports.js'));

		$this->breadcrumbs->push('Reports', '#');
		$this->breadcrumbs->push('Stocks', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['stock'] = $this->reports_model->get_stock_data();

		$this->load->view('common/header', $data);
		$this->load->view('reports/stock', $data);
		$this->load->view('common/footer', $data);
	}

	function commercial()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Commercial - Reports';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/select2/select2.css', 
			'js/lib/select2/ebro_select2.css', 
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'js/lib/Sticky/sticky.css'));

		$data['js'] = $this->tank_auth->load_admin_js(array(
			'js/lib/iCheck/jquery.icheck.min.js', 
			'js/lib/parsley/parsley.min.js', 
			'js/pages/ebro_form_validate.js', 
			'js/lib/select2/select2.min.js', 
			'js/lib/dataTables/media/js/jquery.dataTables.min.js', 
			'js/lib/dataTables/extras/ColReorder/media/js/ColReorder.min.js',
			'js/lib/dataTables/extras/ColVis/media/js/ColVis.min.js', 
			'js/lib/dataTables/extras/TableTools/media/js/TableTools.min.js',
			'js/lib/dataTables/extras/TableTools/media/js/ZeroClipboard.js',
			'js/lib/dataTables/media/DT_bootstrap.js', 
			'js/pages/ebro_datatables.js', 
			'js/lib/bootbox/bootbox.min.js', 
			'js/lib/datepicker/js/bootstrap-datepicker.js', 
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_reports.js'));

		$this->breadcrumbs->push('Reports', '#');
		$this->breadcrumbs->push('Commercial', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['start_date'] 		= '';
		$data['end_date'] 			= '';
		$data['commercial'] = array();
		if ( isset($_POST['start_date']) && isset($_POST['end_date']) && ($_POST['start_date'] != '') && ($_POST['end_date'] != '')) {
			$data['commercial'] = $this->reports_model->get_commercial_data($_POST['start_date'], $_POST['end_date']);

			$data['start_date'] 		= $_POST['start_date'];
			$data['end_date'] 			= $_POST['end_date'];
		}	

		$this->load->view('common/header', $data);
		$this->load->view('reports/commercial', $data);
		$this->load->view('common/footer', $data);
	}

	function marketing()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Marketing - Reports';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/select2/select2.css', 
			'js/lib/select2/ebro_select2.css', 
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'js/lib/Sticky/sticky.css'));

		$data['js'] = $this->tank_auth->load_admin_js(array(
			'js/lib/iCheck/jquery.icheck.min.js', 
			'js/lib/parsley/parsley.min.js', 
			'js/pages/ebro_form_validate.js', 
			'js/lib/select2/select2.min.js', 
			'js/lib/dataTables/media/js/jquery.dataTables.min.js', 
			'js/lib/dataTables/extras/ColReorder/media/js/ColReorder.min.js',
			'js/lib/dataTables/extras/ColVis/media/js/ColVis.min.js', 
			'js/lib/dataTables/extras/TableTools/media/js/TableTools.min.js',
			'js/lib/dataTables/extras/TableTools/media/js/ZeroClipboard.js',
			'js/lib/dataTables/media/DT_bootstrap.js', 
			'js/pages/ebro_datatables.js', 
			'js/lib/bootbox/bootbox.min.js', 
			'js/lib/datepicker/js/bootstrap-datepicker.js', 
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_reports.js'));

		$this->breadcrumbs->push('Reports', '#');
		$this->breadcrumbs->push('Marketing', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['start_date'] 		= '';
		$data['end_date'] 			= '';
		$data['normal_users']  		= $this->reports_model->get_normal_users();
		$data['marketing'] 			= array();

		if ( isset($_POST['start_date']) && isset($_POST['end_date']) && ($_POST['start_date'] != '') && ($_POST['end_date'] != '')) {
			$data['marketing'] = $this->reports_model->get_marketing_data($_POST['start_date'], $_POST['end_date'], $_POST['delivery_by']);

			$data['start_date'] 		= $_POST['start_date'];
			$data['end_date'] 			= $_POST['end_date'];
			$data['delivery_by'] 		= $_POST['delivery_by'];
		}	

		$this->load->view('common/header', $data);
		$this->load->view('reports/marketing', $data);
		$this->load->view('common/footer', $data);
	}

	function account()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Account - Reports';

		$data['css'] = $this->tank_auth->load_admin_css(array(
			'js/lib/datepicker/css/datepicker.css',
			'js/lib/select2/select2.css', 
			'js/lib/select2/ebro_select2.css', 
			'js/lib/dataTables/media/DT_bootstrap.css', 
			'js/lib/dataTables/extras/TableTools/media/css/TableTools.css',
			'js/lib/Sticky/sticky.css'));

		$data['js'] = $this->tank_auth->load_admin_js(array(
			'js/lib/iCheck/jquery.icheck.min.js', 
			'js/lib/parsley/parsley.min.js', 
			'js/pages/ebro_form_validate.js', 
			'js/lib/select2/select2.min.js', 
			'js/lib/dataTables/media/js/jquery.dataTables.min.js', 
			'js/lib/dataTables/extras/ColReorder/media/js/ColReorder.min.js',
			'js/lib/dataTables/extras/ColVis/media/js/ColVis.min.js', 
			'js/lib/dataTables/extras/TableTools/media/js/TableTools.min.js',
			'js/lib/dataTables/extras/TableTools/media/js/ZeroClipboard.js',
			'js/lib/dataTables/media/DT_bootstrap.js', 
			'js/pages/ebro_datatables.js', 
			'js/lib/bootbox/bootbox.min.js', 
			'js/lib/datepicker/js/bootstrap-datepicker.js', 
			'js/lib/Sticky/sticky.js', 
			'js/pages/ebro_notifications.js',
			'js/pages/ebro_reports.js'));

		$this->breadcrumbs->push('Reports', '#');
		$this->breadcrumbs->push('Account', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['start_date'] 		= '';
		$data['end_date'] 			= '';
		$data['account'] = array();
		if ( isset($_POST['start_date']) && isset($_POST['end_date']) && ($_POST['start_date'] != '') && ($_POST['end_date'] != '')) {
			$data['account'] = $this->reports_model->get_account_data($_POST['start_date'], $_POST['end_date']);

			$data['start_date'] 		= $_POST['start_date'];
			$data['end_date'] 			= $_POST['end_date'];
		}	

		$this->load->view('common/header', $data);
		$this->load->view('reports/account', $data);
		$this->load->view('common/footer', $data);
	}
}