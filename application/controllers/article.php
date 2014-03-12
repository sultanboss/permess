<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('article_model');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		$data['title'] = 'Article';

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
		$this->breadcrumbs->push('Finished Goods', '#');
		$this->breadcrumbs->push('Articles', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->load->view('common/header', $data);
		$this->load->view('article/index', $data);
		$this->load->view('common/footer', $data);
	}

	function add()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($_POST['article_name']) ) {
			$data['data'] = array(
				'article_name'			=> $this->input->post('article_name'),
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->article_model->add_article($data['data']);
			$this->session->set_flashdata('msg', 'Article <b>\''.$this->input->post('article_name').'\'</b> added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid article input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/article');
	}

	function edit()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if (isset($_POST['article_id']) && isset($_POST['article_name']) ) {
			$data['data'] = array(
				'article_name'			=> $this->input->post('article_name'),		
				'editor_id' 					=> $this->session->userdata('user_id')
			);

			$this->article_model->edit_article($this->input->post('article_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Article <b>\''.$this->input->post('article_name').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid article input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/article');
	}

	function delete($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($id) ) {
			if($this->article_model->delete_article($id)) {
				$this->session->set_flashdata('msg', 'Article deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid article delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid article delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/article');
	}

	function data()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		print_r($this->article_model->get_article_data());
	}
}