<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
	}

	function get_import_data($start, $end, $type, $article, $construction, $width, $softness, $color, $source) 
	{
		$this->db->select('raw.raw_id, raw_date, raw_pi_no, raw_lc_no, article_name, construction_name, width_name, softness_name, color_name, source_name, (SELECT sum( r.raw_received_balance ) FROM ak_raw r WHERE r.raw_id < ak_raw.raw_id and ak_raw.article_id = r.article_id and ak_raw.construction_id = r.construction_id and ak_raw.width_id = r.width_id and ak_raw.softness_id = r.softness_id and ak_raw.color_id = r.color_id and ak_raw.source_id = r.source_id) AS prev_balance, raw_received_balance, raw.raw_id as total, (SELECT sum(issue_quantity) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 1) as production, (SELECT sum(total_finish_goods) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 1) as pfinish, (SELECT sum(issue_quantity) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 2) as finished, (SELECT sum(total_finish_goods) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 2) as ffinish');   

		$this->db->where('raw_date >=', $start);
		$this->db->where('raw_date <=', $end);

		if($type == 1) {
		   $this->db->where('raw.article_id =', $article); 
		   $this->db->where('raw.construction_id =', $construction); 
		   $this->db->where('raw.width_id =', $width); 
		   $this->db->where('raw.softness_id =', $softness); 
		   $this->db->where('raw.color_id =', $color); 
		   $this->db->where('raw.source_id =', $source); 
		}

		$this->db->from('raw'); 
		$this->db->join('article', 'article.article_id = raw.article_id');  
		$this->db->join('construction', 'construction.construction_id = raw.construction_id');  
		$this->db->join('width', 'width.width_id = raw.width_id');  
		$this->db->join('softness', 'softness.softness_id = raw.softness_id');  
		$this->db->join('color', 'color.color_id = raw.color_id');  
		$this->db->join('source', 'source.source_id = raw.source_id'); 

		return $this->db->get()->result_array();
	}

	function get_sales_data($start, $end) 
	{
		$product = array();

		$this->db->select('delivery_company_name, delivery_id, delivery_date, delivery_lc_date, delivery_by');   
		$this->db->where('delivery_date >=', $start);
		$this->db->where('delivery_date <=', $end);
		$this->db->from('delivery'); 

		$del = $this->db->get()->result_array();

		foreach ($del as $key => $value) {
			$product[$key]['delivery_company_name'] = $value['delivery_company_name'];
			$product[$key]['delivery_id'] 			= $value['delivery_id'];
			$product[$key]['delivery_date'] 		= $value['delivery_date'];
			$product[$key]['delivery_lc_date'] 		= 'Cash';
			if($value['delivery_lc_date'] != '0000-00-00') {
				$product[$key]['delivery_lc_date'] 	= $value['delivery_lc_date'];
			}
			$product[$key]['delivery_by'] 			= $this->get_delivery_user($value['delivery_by']);

			$this->db->select('SUM(order_quantity * unit_price) as delivery_amount, SUM(order_quantity) as delivery_qty, GROUP_CONCAT(over_invoice_unit_price SEPARATOR "/") as delivery_com, SUM(order_quantity * over_invoice_unit_price) as delivery_tcom, SUM(delivery_quantity) as delivery_done');
			$this->db->where('delivery_id =', $value['delivery_id']);
			$this->db->from('delivery_product');
			$pro = $this->db->get()->result_array();

			$product[$key]['delivery_amount'] 		= '0.00';
			$product[$key]['delivery_qty'] 			= '0.00';
			$product[$key]['delivery_com'] 			= '0.00';
			$product[$key]['delivery_tcom'] 		= '0.00';
			$product[$key]['delivery_done'] 		= '0.00';
			$product[$key]['delivery_left'] 		= '0.00';

			foreach ($pro as $k => $p) {
				if($p['delivery_amount'] != null) {
					$product[$key]['delivery_amount'] 	= number_format((float)$p['delivery_amount'], 4, '.', '');
					$product[$key]['delivery_qty'] 		= number_format((float)$p['delivery_qty'], 4, '.', '');
					$product[$key]['delivery_com'] 		= $p['delivery_com'];
					$product[$key]['delivery_tcom'] 	= number_format((float)$p['delivery_tcom'], 4, '.', '');

					if($p['delivery_qty'] == $p['delivery_done']) {
						$product[$key]['delivery_done'] = 'Done';
						$product[$key]['delivery_left'] = '0.00';
					}
					else if($p['delivery_done'] == 0) {
						$product[$key]['delivery_done'] = '0.00';
						$product[$key]['delivery_left'] = number_format((float)$p['delivery_qty'], 4, '.', '');;
					}
					else {
						$product[$key]['delivery_done'] = number_format((float)$p['delivery_done'], 4, '.', '');;
						$product[$key]['delivery_left'] = number_format((float)($p['delivery_qty'] - $p['delivery_done']), 4, '.', '');
					}
				}
			}
		}

		return $product;
	}

	function get_stock_data() 
	{
		$this->db->select('ak_raw.raw_id, article_name, width_name, softness_name, color_name, construction_name, SUM(total_finish_goods) as total, (SELECT SUM(delivery_quantity) FROM ak_delivery_product WHERE ak_delivery_product.article_id = ak_raw.article_id AND ak_delivery_product.width_id = ak_raw.width_id AND ak_delivery_product.softness_id = ak_raw.softness_id AND ak_delivery_product.color_id = ak_raw.color_id) as sold');   
		$this->db->from('raw'); 
		$this->db->join('article', 'article.article_id = raw.article_id');   
		$this->db->join('width', 'width.width_id = raw.width_id');  
		$this->db->join('softness', 'softness.softness_id = raw.softness_id');  
		$this->db->join('color', 'color.color_id = raw.color_id');  
		$this->db->join('construction', 'construction.construction_id = raw.construction_id');  
		$this->db->join('issue', 'issue.raw_id = raw.raw_id');  
		$this->db->group_by('article_name, width_name, softness_name, color_name');

		return $this->db->get()->result_array();
	}

	function get_commercial_data($start, $end) 
	{
		$this->db->select('
            ak_delivery.delivery_id, delivery_date, delivery_company_name, lc_no, lc_date, exp_date,
            bank_name, party_name, bank_submit_value, purchase_date, purchase_tk,
            delivery_status, delivery_lc_status, delivery_doc_status,
			(select SUM(order_quantity*(unit_price+over_invoice_unit_price)) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as total,
			submit_party_rdate');         
        $this->db->from('delivery'); 
        $this->db->where('delivery_payment', '0');
        $this->db->where('delivery_date >=', $start);
		$this->db->where('delivery_date <=', $end);
		$this->db->join('statements', 'statements.delivery_id = delivery.delivery_id');

		return $this->db->get()->result_array();
	}

	function get_marketing_data($start, $end, $by) 
	{
		$this->db->select('delivery_id, delivery_date, delivery_company_name, 
            (select SUM(order_quantity) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as order_quantity,
            (select SUM(order_quantity*unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as pi_value,
            (select SUM(order_quantity*over_invoice_unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as over_invoice,
            (select SUM(order_quantity*(unit_price+over_invoice_unit_price)) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as total,
            buyer_order_reference, delivery_lc_status, delivery_status, delivery_request');
        $this->db->from('delivery');
        $this->db->where('delivery_date >=', $start);
		$this->db->where('delivery_date <=', $end);

		if($by != '') {
			$this->db->where('delivery_by', $by);
		}

		return $this->db->get()->result_array();
	}

	function get_account_data($start, $end) 
	{
		$this->db->select('delivery_id, delivery_date, delivery_company_name, 
            (select SUM(order_quantity*unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as pi_value,
            (select bill_usd_rate from ak_bill where ak_bill.delivery_id = ak_delivery.delivery_id) as usd,
            (select SUM(order_quantity*(unit_price+over_invoice_unit_price)) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as total,
            (select bill_received from ak_bill where ak_bill.delivery_id = ak_delivery.delivery_id) as total_received,
            delivery_status, delivery_request');   
        $this->db->where("delivery_payment", '1'); 
        $this->db->from('delivery'); 
        $this->db->where('delivery_date >=', $start);
		$this->db->where('delivery_date <=', $end);

		return $this->db->get()->result_array();
	}


	// Extra Function

	function get_all_article() 
	{
		$this->db->select('article_id, article_name, article_alt');
		$query = $this->db->get('article');
		return $query->result_array();        
	}

	function get_all_construction() 
	{
		$query = $this->db->get('construction');
		return $query->result_array();        
	}

	function get_all_width() 
	{
		$query = $this->db->get('width');
		return $query->result_array();        
	}

	function get_all_softness() 
	{
		$query = $this->db->get('softness');
		return $query->result_array();        
	}

	function get_all_color() 
	{
		$query = $this->db->get('color');
		return $query->result_array();        
	}

	function get_all_source() 
	{
		$query = $this->db->get('source');
		return $query->result_array();        
	}

	function get_delivery_user($user) 
    {
        $query = $this->db->get_where('users', array('id' => $user), 1);
        return $query->row()->fname.' '.$query->row()->lname;
    }

    function get_normal_users()
	{
		$this->db->select('id, fname, lname');
		$this->db->where('group_id', '501');
		$query = $this->db->get('users');
		return $query->result_array();
	}

}