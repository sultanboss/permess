<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
	}

	function get_stock_data() 
	{
		$this->datatables->select('ak_raw.raw_id, article_name, article_alt, width_name, softness_name, color_name, construction_name, SUM(total_finish_goods) as total, (SELECT SUM(delivery_quantity) FROM ak_delivery_product WHERE ak_delivery_product.article_id = ak_raw.article_id AND ak_delivery_product.width_id = ak_raw.width_id AND ak_delivery_product.softness_id = ak_raw.softness_id AND ak_delivery_product.color_id = ak_raw.color_id) as sold');   
		$this->datatables->from('raw'); 
		$this->datatables->join('article', 'article.article_id = raw.article_id');   
		$this->datatables->join('width', 'width.width_id = raw.width_id');  
		$this->datatables->join('softness', 'softness.softness_id = raw.softness_id');  
		$this->datatables->join('color', 'color.color_id = raw.color_id');  
		$this->datatables->join('construction', 'construction.construction_id = raw.construction_id');  
		$this->datatables->join('issue', 'issue.raw_id = raw.raw_id');  
		$this->datatables->group_by('article_name, width_name, softness_name, color_name');

		$res = $this->datatables->generate();

		$res = json_decode($res);

		$i = 1;
		foreach ($res->aaData as $key => $value) {
			$res->aaData[$key][0] = $i;

			$res->aaData[$key][2] = $this->get_article_name($res->aaData[$key][2]);

			if($res->aaData[$key][8] == null)
				$res->aaData[$key][8] = 0;
			$res->aaData[$key][7] = $res->aaData[$key][7] - $res->aaData[$key][8];
			$i++;
		}
		
		return json_encode($res);
	}

	function get_article_name($string)
	{
		$val = '-';
		if($string != '')
		{
			$alt = explode(',', $string);
			$i = 1;                
			foreach($alt as $key => $value) {
				if($i == 1) {
					$query = $this->db->get_where('article', array('article_id' => $value), 1);
					$val = $query->row()->article_name;
				}
				else {
					$query = $this->db->get_where('article', array('article_id' => $value), 1);
					$val.= ' &nbsp;&nbsp;|&nbsp;&nbsp; '.$query->row()->article_name;
				}
				$i++;
			} 
		}
		return $val;
	}

	function get_delivery_data() 
	{
		if($this->tank_auth->is_group_member('Users')) {
			$this->datatables->select("delivery_id, delivery_date, delivery_company_name, delivery_doc_status, delivery_status, delivery_lc_status, fname, lname, delivery_payment");  
			$this->datatables->from("delivery"); 
			$this->datatables->join('users', 'users.id = delivery.delivery_by AND ak_users.id = '.$this->session->userdata('user_id'));
		}
		/*else if($this->tank_auth->is_group_member('Accounts')) {
			$this->datatables->select("delivery_id, delivery_date, delivery_company_name, delivery_doc_status, delivery_status, delivery_lc_status, fname, lname, delivery_payment"); 
			$this->datatables->where("delivery_payment", '1');  
			$this->datatables->from("delivery"); 
			$this->datatables->join('users', 'users.id = delivery.delivery_by'); 
		}*/ 
		else {
			$this->datatables->select("delivery_id, delivery_date, delivery_company_name, delivery_doc_status, delivery_status, delivery_lc_status, fname, lname, delivery_payment");  
			$this->datatables->from("delivery"); 
			$this->datatables->join('users', 'users.id = delivery.delivery_by'); 
		}  

		$res = $this->datatables->generate();

		$res = json_decode($res);

		foreach ($res->aaData as $key => $value) {
			$res->aaData[$key][3] = $res->aaData[$key][6].' '.$res->aaData[$key][7];
			if($res->aaData[$key][4] == '0') {
				$res->aaData[$key][4] = 'Pending';
				$res->aaData[$key][6] = '<a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="Edit Delivery"><span class="glyphicon glyphicon-th-large color-red"></span></a>';
			}
			else if($res->aaData[$key][4] == '2') {
				$res->aaData[$key][4] = 'Complete';
				$res->aaData[$key][6] = '<a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="Edit Delivery"><span class="glyphicon glyphicon-th-large color-green"></span></a>';
			}
			else {
				$res->aaData[$key][4] = 'Partial';
				$res->aaData[$key][6] = '<a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="Edit Delivery"><span class="glyphicon glyphicon-th-large color-orange"></span></a>';
			}


			if($res->aaData[$key][8] == 0)
			{
				if($res->aaData[$key][5] == '0') {
					$res->aaData[$key][5] = 'No';
				}
				else {
					$res->aaData[$key][5] = 'Yes';
				}
			}
			else
				$res->aaData[$key][5] = '-';
		}
		
		return json_encode($res);
	}

	function add_delivery($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		if(isset($data['delivery_id'])) {
			$query = $this->db->get_where('delivery', array('delivery_id' => $data['delivery_id']));
	        $count = $query->num_rows();

	        if ($count === 0) {
				if ($this->db->insert('delivery', $data)) {
					return $this->db->insert_id();
				}
			}
			return NULL;
		}
		else {
			if ($this->db->insert('delivery', $data)) {
				return $this->db->insert_id();
			}
		}
		return NULL;
	}

	function add_statements($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		if ($this->db->insert('statements', $data)) {
			return $this->db->insert_id();
		}
		return NULL;
	}

	function add_delivery_product($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		if ($this->db->insert('delivery_product', $data)) {
			return $this->db->insert_id();
		}
		return NULL;
	}

	function update_delivery_product($id, $data)
	{
		if($data['delivery_quantity'] != '0') {
			$this->db->set('prev_delivery_quantity', 'delivery_quantity', FALSE);
			$this->db->where('delivery_product_id', $id);
			$this->db->update('delivery_product');

			$this->db->where('delivery_product_id', $id);
			if ($this->db->update('delivery_product', $data)) {
				return true;	
			}
			return NULL;
		}
		return true;
	}

	function update_delivery($id, $data)
	{
		$this->db->where('delivery_id', $id);
		if ($this->db->update('delivery', $data)) {
			return true;
		}
		return NULL;
	}

	function update_statements($id, $data)
	{
		$query = $this->db->get_where('statements', array('delivery_id' => $id));
		$count= $query->num_rows(); 

		if ($count === 0)
		{
			$this->add_statements($data);
		}
		else
		{            
			$this->db->where('delivery_id', $id);
			if ($this->db->update('statements', $data)) {
				return true;
			}
		}
		return NULL;
	}

	function remove_delivery_product($id) 
	{
		$this->db->where('delivery_id',$id);
		$this->db->delete('delivery_product');
		if($this->db->affected_rows() > 0)
			return true;
		return false;
	}

	function check_delivery_product($id, $data)
	{
		$this->db->where('delivery_id',$data['delivery_id']);
		$this->db->where('article_id',$data['article_id']);
		$this->db->where('article_alt',$data['article_alt']);
		$this->db->where('description_id',$data['description_id']);
		$this->db->where('softness_id',$data['softness_id']);
		$this->db->where('width_id',$data['width_id']);
		$this->db->where('color_id',$data['color_id']);

		$query = $this->db->get('delivery_product');

		if ($query->num_rows() > 0){
			foreach ($query->result() as $row) {
			    return $row->delivery_quantity;
			}
		}

		return false;
	}

	function check_delivery_product_factory($id)
	{
		$this->db->where('delivery_product_id',$id);

		$query = $this->db->get('delivery_product');

		if ($query->num_rows() > 0){
			foreach ($query->result() as $row) {
			    return $row->delivery_quantity;
			}
		}

		return false;
	}

	function remove_single_delivery_product($id) 
	{
		$this->db->where('delivery_product_id',$id);
		$this->db->delete('delivery_product');
		if($this->db->affected_rows() > 0)
			return true;
		return false;
	}

	function add_challan($delivery_id)
	{
		$query = $this->db->get_where('delivery_product', array('delivery_id' => $delivery_id));
		if($query->num_rows() > 0) {
			$res = $query->result_array();

			$add = false;	

			$q = $this->db->get_where('challan', array('delivery_id' => $delivery_id), 1);
			if($q->num_rows() > 0) {
				foreach ($res as $key => $value) {
					$res[$key]['delivery_quantity'] = (int)$value['delivery_quantity'] - (int)$value['prev_delivery_quantity'];
					if($res[$key]['delivery_quantity'] > 0) {
						$add = true;
					}					
				}
			}
			else {
				foreach ($res as $key => $value) {
					$res[$key]['delivery_quantity'] = (int)$value['delivery_quantity'] - (int)$value['prev_delivery_quantity'];
					if($res[$key]['delivery_quantity'] > 0) {
						$add = true;
					}
				}
			}

			if($add === true) {
				$challan_data['delivery_id'] 	= $delivery_id;
				$challan_data['challan_info'] 	= serialize($res);
				$challan_data['editor_id'] 		= $this->session->userdata('user_id');
				$challan_data['created'] 		= date('Y-m-d H:i:s');

				$this->db->insert('challan', $challan_data);
			}
		}
		return null; 
	}

	function get_challan_list_by_id($id) 
	{
		$this->db->from('challan');
		$this->db->where('delivery_id',$id);
		$q = $this->db->get();
		return $q->result_array();
	}

	function get_challan_by_id($challanid) 
	{
		$query = $this->db->get_where('challan', array('challan_id' => $challanid), 1);
		if($query->num_rows() > 0)
			return $query->row()->challan_info;   
		return null;      
	}

	function get_first_challan_by_id($delivery_id) 
	{
		$query = $this->db->get_where('challan', array('delivery_id' => $delivery_id), 1);
		if($query->num_rows() > 0) {
			$data['challan_details'] = $query->row()->challan_info; 
			$data['challan_id'] = $query->row()->challan_id;    

			return $data; 
		}
		return null;      
	}

	function get_previous_challan($challanid) 
	{
		$this->db->from('challan');
		$this->db->where('challan_id <', $challanid);
		$this->db->order_by('challan_id', 'DESC');
		$this->db->limit(1, 0);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$data = $query->row()->challan_info; 
			return unserialize($data); 
		}
		return null;      
	}

	function get_delivery_by_id($delivery_id)
	{
		$this->db->from('delivery');
		$this->db->where('delivery_id', $delivery_id);
		$q = $this->db->get();
		return $q->result_array();
	}

	function get_delivery_products_by_id($delivery_id)
	{
		$this->db->from('delivery_product');
		$this->db->where('delivery_id', $delivery_id);
		$this->db->order_by('description_id, width_id');
		$q = $this->db->get();
		return $q->result_array();
	}

	function get_delivery_cost($delivery_id)
	{
		$this->db->select('SUM(order_quantity*(unit_price+over_invoice_unit_price)) as cost');
		$this->db->from('delivery_product');
		$this->db->where('delivery_id', $delivery_id);
		$q = $this->db->get();
		$res = $q->result_array();
		if($res[0]['cost'] != NULL) {
			return $res[0]['cost'];
		}
		return '0';
	}

	function accounts_delivery_check($delivery_id)
	{
		$query = $this->db->get_where('delivery', array('delivery_id' => $delivery_id), 1);
		$pay = $query->row()->delivery_payment;
		if($pay == 1) {
			return true;
		}
		return false;
	}

	function users_delivery_check($delivery_id)
	{
		$query = $this->db->get_where('delivery', array('delivery_id' => $delivery_id), 1);
		$usr = $query->row()->delivery_by;
		if($usr == $this->session->userdata('user_id')) {
			return true;
		}
		return false;
	}

	function delete_statements($delivery_id) 
	{
		$this->db->where('delivery_id', $delivery_id);
		$this->db->delete('statements');
		if($this->db->affected_rows() > 0)
			return true;
		return false;
	}


	// extra function
	
	function get_normal_users()
	{
		$this->db->select('id, fname, lname');
		$this->db->where('group_id', '501');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	function get_companies()
	{
		$this->db->select('address_id, company_name');
		$this->db->order_by('company_name');
		$query = $this->db->get('address');
		return $query->result_array();
	}

	function get_payment_status($id) 
	{
		$query = $this->db->get_where('bill', array('delivery_id' => $id), 1);
		if($query->num_rows() > 0)
			return $query->row()->bill_payment_status;   
		return null;      
	}

	function get_delivery_address($company_name) 
	{
		$this->db->from('address');
		$this->db->where('company_name', $company_name);
		$this->db->limit(1);
		$q = $this->db->get();
		return $q->result_array();
	}

	function get_article_address_price($address_id, $article_id) 
	{
		$this->db->select('price, over_invoice');
		$this->db->from('address_price');
		$this->db->where('address_id', $address_id);
		$this->db->where('article_id', $article_id);
		$this->db->limit(1);
		$q = $this->db->get();
		foreach ($q->result_array() as $key => $value) {				
			return $value['price'] . '|' . $value['over_invoice'];
		}

		return '0.0000|0.0000';		
	}

}