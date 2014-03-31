<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Price extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('price_model');
		$this->load->model('factory_model');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		$data['title'] = 'Price';

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
		$this->breadcrumbs->push('Prices', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['articles'] = $this->factory_model->get_all_article();
		$data['constructions'] = $this->factory_model->get_all_construction();
		$data['widths'] = $this->factory_model->get_all_width();
		$data['softnesses'] = $this->factory_model->get_all_softness();
		$data['colors'] = $this->factory_model->get_all_color();
		$data['sources'] = $this->factory_model->get_all_source();

		$this->load->view('common/header', $data);
		$this->load->view('price/index', $data);
		$this->load->view('common/footer', $data);
	}

	function add()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($_POST['buy_price']) && isset($_POST['sell_price']) ) {
			$data['data'] = array(
				'article_id'			=> $this->input->post('article_name'),
				'construction_id'		=> $this->input->post('construction_name'),
				'width_id'				=> $this->input->post('width_name'),
				'softness_id'			=> $this->input->post('softness_name'),
				'color_id'				=> $this->input->post('color_name'),
				'source_id'				=> $this->input->post('source_name'),
				'buy_price'				=> $this->input->post('buy_price'),
				'sell_price'			=> $this->input->post('sell_price'),
				'editor_id' 			=> $this->session->userdata('user_id')
			);

			$this->price_model->add_price($data['data']);
			$this->session->set_flashdata('msg', 'Price added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid price input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/price');
	}

	function edit()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if (isset($_POST['edit_price_id']) && isset($_POST['edit_buy_price']) && isset($_POST['edit_sell_price'])  ) {
			$data['data'] = array(
				'article_id'			=> $this->input->post('edit_article_name'),
				'construction_id'		=> $this->input->post('edit_construction_name'),
				'width_id'				=> $this->input->post('edit_width_name'),
				'softness_id'			=> $this->input->post('edit_softness_name'),
				'color_id'				=> $this->input->post('edit_color_name'),
				'source_id'				=> $this->input->post('edit_source_name'),
				'edit_buy_price'		=> $this->input->post('edit_buy_price'),
				'edit_sell_price'		=> $this->input->post('edit_sell_price'),	
				'editor_id' 			=> $this->session->userdata('user_id')
			);

			$this->price_model->edit_price($this->input->post('edit_price_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Price <b>\''.$this->input->post('edit_price_id').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid price input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/price');
	}

	function delete($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		if ( isset($id) ) {
			if($this->price_model->delete_price($id)) {
				$this->session->set_flashdata('msg', 'Price deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid price delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid price delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/price');
	}

	function data()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		}

		print_r($this->price_model->get_price_data());
	}
}