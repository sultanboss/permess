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

	function enquiry()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		$data['title'] = 'Reports';

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

		$this->breadcrumbs->push('Admin', '#');
		$this->breadcrumbs->push('Reports', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['enquiry'] = array();
		$data['enquiry_product'] = array();
		if ( isset($_POST['start_date']) && isset($_POST['end_date']) && ($_POST['start_date'] != '') && ($_POST['end_date'] != '')) {
			$data['enquiry'] = $this->reports_model->get_enquiry($_POST['start_date'], $_POST['end_date']);
			$data['enquiry_product'] = $this->reports_model->get_enquiry_product($_POST['start_date'], $_POST['end_date']);
		}		

		$this->load->view('common/header', $data);
		$this->load->view('reports/enquiry', $data);
		$this->load->view('common/footer', $data);
	}

	function followup()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		$data['title'] = 'Reports';

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

		$this->breadcrumbs->push('Admin', '#');
		$this->breadcrumbs->push('Reports', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['followup'] = array();
		if ( isset($_POST['start_date']) && isset($_POST['end_date']) && ($_POST['start_date'] != '') && ($_POST['end_date'] != '')) {
			$data['followup'] = $this->reports_model->get_followup($_POST['start_date'], $_POST['end_date']);
		}	

		$this->load->view('common/header', $data);
		$this->load->view('reports/followup', $data);
		$this->load->view('common/footer', $data);
	}
}