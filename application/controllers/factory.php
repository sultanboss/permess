<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Factory extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->load->library('breadcrumbs');
		$this->lang->load('tank_auth');
		$this->load->model('factory_model');
	}

	function import()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		$data['title'] = 'Import - Factory';

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
		$this->breadcrumbs->push('Import', '#');

		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['articles'] = $this->factory_model->get_all_article();
		$data['constructions'] = $this->factory_model->get_all_construction();
		$data['widths'] = $this->factory_model->get_all_width();
		$data['softnesses'] = $this->factory_model->get_all_softness();
		$data['colors'] = $this->factory_model->get_all_color();
		$data['sources'] = $this->factory_model->get_all_source();

		$this->load->view('common/header', $data);
		$this->load->view('factory/raw', $data);
		$this->load->view('common/footer', $data);
	}

	function addraw()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($_POST['article_name']) && isset($_POST['raw_date']) ) {
			$data['data'] = array(
				'article_id'			=> $this->input->post('article_name'),
				'construction_id'		=> $this->input->post('construction_name'),
				'width_id'				=> $this->input->post('width_name'),
				'softness_id'			=> $this->input->post('softness_name'),
				'color_id'				=> $this->input->post('color_name'),
				'source_id'				=> $this->input->post('source_name'),
				'raw_date'				=> $this->input->post('raw_date'),
				'raw_received_balance'	=> $this->input->post('raw_received_balance'),
				'raw_lc_no'				=> $this->input->post('raw_lc_no'),
				'raw_pi_no'				=> $this->input->post('raw_pi_no'),
				'editor_id' 			=> $this->session->userdata('user_id')
			);

			$this->factory_model->add_raw($data['data']);
			$this->session->set_flashdata('msg', 'Raw added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid raw input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/factory/import');
	}

	function editraw()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($_POST['edit_article_name']) && isset($_POST['edit_raw_date']) ) {
			$data['data'] = array(
				'article_id'			=> $this->input->post('edit_article_name'),
				'construction_id'		=> $this->input->post('edit_construction_name'),
				'width_id'				=> $this->input->post('edit_width_name'),
				'softness_id'			=> $this->input->post('edit_softness_name'),
				'color_id'				=> $this->input->post('edit_color_name'),
				'source_id'				=> $this->input->post('edit_source_name'),
				'raw_date'				=> $this->input->post('edit_raw_date'),
				'raw_received_balance'	=> $this->input->post('edit_raw_received_balance'),
				'raw_lc_no'				=> $this->input->post('edit_raw_lc_no'),
				'raw_pi_no'				=> $this->input->post('edit_raw_pi_no'),
				'editor_id' 			=> $this->session->userdata('user_id')
			);

			$this->factory_model->edit_raw($this->input->post('edit_raw_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Raw <b>\''.$this->input->post('edit_raw_id').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid raw input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		redirect('/factory/import');
	}

	function deleteraw($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($id) ) {
			if($this->factory_model->delete_raw($id)) {
				$this->session->set_flashdata('msg', 'Raw deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid raw delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid raw delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/factory/import');
	}

	function dataraw()
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->factory_model->get_raw_data());
	}

	function rawissuedto($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($id) ) {

			$data['raw'] = $this->factory_model->get_raw_by_id($id);
			if(empty($data['raw'])) {
				$this->session->set_flashdata('msg', 'Invalid raw input!');
				$this->session->set_flashdata('msg_type', 'warning');
				redirect('/factory/import');
			}
			
			$data['title'] = 'Raw Issued To';

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
				'js/pages/ebro_notifications.js'));

			$this->breadcrumbs->push('Factory', '#');
			$this->breadcrumbs->push('Import', '../../factory/import');
			$this->breadcrumbs->push('Issued To', '#');

			$data['breadcrumbs'] = $this->breadcrumbs->show();
			
			$data['total_issued'] = $this->factory_model->count_total_issued($id);
			$data['issue_types'] = $this->factory_model->get_all_issue_type();

			$this->load->view('common/header', $data);
			$this->load->view('factory/rawissuedto', $data);
			$this->load->view('common/footer', $data);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Invalid raw input!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('/factory/import');
		}		
	}

	function addrawissuedto($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($_POST['issue_date']) && isset($_POST['issue_quantity']) ) {
			$data['data'] = array(
				'issue_date'			=> $this->input->post('issue_date'),
				'raw_id'				=> $this->input->post('raw_id'),
				'issue_type_id'			=> $this->input->post('issue_type'),
				'issue_quantity'		=> $this->input->post('issue_quantity'),
				'total_finish_goods'	=> $this->input->post('total_finish_goods'),
				'wastage_detail'		=> $this->input->post('wastage_detail'),
				'editor_id' 			=> $this->session->userdata('user_id')
			);

			$this->factory_model->add_raw_issue($data['data']);
			$this->session->set_flashdata('msg', 'Issue added successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid Issue input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/factory/rawissuedto/'.$id);
	}

	function editrawissuedto($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($_POST['edit_issue_date']) && isset($_POST['edit_issue_quantity']) ) {
			$data['data'] = array(
				'issue_date'			=> $this->input->post('edit_issue_date'),
				'issue_type_id'			=> $this->input->post('edit_issue_type'),
				'issue_quantity'		=> $this->input->post('edit_issue_quantity'),
				'total_finish_goods'	=> $this->input->post('edit_total_finish_goods'),				
				'wastage_detail'	=> $this->input->post('edit_wastage_detail'),
				'editor_id' 			=> $this->session->userdata('user_id')
			);

			$this->factory_model->edit_raw_issue($this->input->post('edit_issue_id'), $data['data']);
			$this->session->set_flashdata('msg', 'Issue <b>\''.$this->input->post('edit_issue_id').'\'</b> updated successfully!');
			$this->session->set_flashdata('msg_type', 'success');
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid Issue input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}
		
		redirect('/factory/rawissuedto/'.$id);
	}

	function deleterawissuedto($id, $raw_id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		if ( isset($id) ) {
			if($this->factory_model->delete_raw_issue($id)) {
				$this->session->set_flashdata('msg', 'Issue deleted successfully!');
				$this->session->set_flashdata('msg_type', 'success');
			}
			else {
				$this->session->set_flashdata('msg', 'Invalid issue delete input!');
				$this->session->set_flashdata('msg_type', 'warning');
			}						
		}
		else {
			$this->session->set_flashdata('msg', 'Invalid issue delete input!');
			$this->session->set_flashdata('msg_type', 'warning');
		}

		redirect('/factory/rawissuedto/'.$raw_id);
	}

	function datarawissue($id)
	{
		$this->tank_auth->check_login();

		if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Commercial') && !$this->tank_auth->is_group_member('Factory')) {
			$this->session->set_flashdata('msg', 'Invalid Access!');
			$this->session->set_flashdata('msg_type', 'warning');
			redirect('');
		}

		print_r($this->factory_model->get_raw_issue_data_by_id($id));
	}

}