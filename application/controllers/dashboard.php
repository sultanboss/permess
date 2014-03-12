<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('dashboard_model');
	}

	function index()
	{
		$this->tank_auth->check_login();

		$data['title'] = 'Dashboard';	

		$this->breadcrumbs->push('Dashboard', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->load->view('common/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('common/footer', $data);
	}
}
