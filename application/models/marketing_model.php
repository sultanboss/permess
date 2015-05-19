<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Marketing_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function update_order($id, $data)
    {
        $this->db->where('delivery_id', $id);
        if ($this->db->update('delivery', $data)) {
            return true;
        }
        return NULL;
    }

    function get_order_data() 
    {
        if($this->tank_auth->is_group_member('Users')) {
            $this->datatables->select('delivery_id, delivery_date, delivery_company_name, 
                (select SUM(order_quantity) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as order_quantity,
                (select SUM(order_quantity*unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as pi_value,
                (select SUM(order_quantity*over_invoice_unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as over_invoice,
                (select SUM(order_quantity*(unit_price+over_invoice_unit_price)) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as total,
                buyer_order_reference, delivery_lc_status, delivery_status, delivery_request, 
                editor_id, delivery_details, delivery_payment'); 
            $this->datatables->where('delivery_by', $this->session->userdata('user_id'));
            $this->datatables->from('delivery');  
        }
        else if($this->tank_auth->is_group_member('Accounts')) {
            $this->datatables->select('delivery_id, delivery_date, delivery_company_name, 
                (select SUM(order_quantity) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as order_quantity,
                (select SUM(order_quantity*unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as pi_value,
                (select SUM(order_quantity*over_invoice_unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as over_invoice,
                (select SUM(order_quantity*(unit_price+over_invoice_unit_price)) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as total,
                buyer_order_reference, delivery_lc_status, delivery_status, delivery_request, 
                editor_id, delivery_details, delivery_payment');
            $this->datatables->where("delivery_payment", '1'); 
            $this->datatables->from('delivery');    
        }  
        else {
            $this->datatables->select('delivery_id, delivery_date, delivery_company_name, 
                (select SUM(order_quantity) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as order_quantity,
                (select SUM(order_quantity*unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as pi_value,
                (select SUM(order_quantity*over_invoice_unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as over_invoice,
                (select SUM(order_quantity*(unit_price+over_invoice_unit_price)) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as total,
                buyer_order_reference, delivery_lc_status, delivery_status, delivery_request, 
                editor_id, delivery_details, delivery_payment');
            $this->datatables->from('delivery');
        }       

        $res = $this->datatables->generate();
        
        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {
            if($res->aaData[$key][9] == '0') {
                $res->aaData[$key][9] = 'Pending';
                $res->aaData[$key][11] = '<a title="Edit Order" href="'.base_url().'marketing/orderdetails/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-red"></span></a>';
            }
            else if($res->aaData[$key][9] == '2') {
                $res->aaData[$key][9] = 'Complete';
                $res->aaData[$key][11] = '<a title="Edit Order" href="'.base_url().'marketing/orderdetails/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-green"></span></a>';
            }
            else {
                $res->aaData[$key][9] = 'Partial';
                $res->aaData[$key][11] = '<a title="Edit Order" href="'.base_url().'marketing/orderdetails/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-orange"></span></a>';
            }

            if($res->aaData[$key][10] == '0') {
                $res->aaData[$key][10] = 'Pending';
            }
            else if($res->aaData[$key][10] == '2') {
                $res->aaData[$key][10] = 'Complete';
            }
            else {
                $res->aaData[$key][10] = 'Partial';
            }

            if($res->aaData[$key][13] == 0)
            {
                if($res->aaData[$key][8] == '0') {
                    $res->aaData[$key][8] = 'No';
                }
                else {
                    $res->aaData[$key][8] = 'Yes';
                }
            }
            else
                $res->aaData[$key][8] = '-';

            if($res->aaData[$key][7] == '') {
                $res->aaData[$key][7] = '-';
            }

        }
        
        return json_encode($res);
    }

    function update_lcstatements($id, $data)
    {
        $this->db->where('delivery_id', $id);
        if ($this->db->update('delivery', $data)) {
            return true;
        }
        return NULL;
    }

    function update_statements($id, $data)
    {
        $this->db->where('delivery_id', $id);
        if ($this->db->update('statements', $data)) {
            return true;
        }
        return NULL;
    }

    function get_delivery_status_by_id($delivery_id)
    {
        $this->db->select('delivery_id, delivery_status, delivery_doc_status, delivery_lc_status, delivery_request, delivery_payment');
        $this->db->from('delivery');
        $this->db->where('delivery_id', $delivery_id);
        $q = $this->db->get();
        return $q->result_array();
    }

    function get_order_details_by_id($delivery_id)
    {
        $this->db->select('delivery_id, delivery_request, buyer_order_reference, delivery_details');
        $this->db->from('delivery');
        $this->db->where('delivery_id', $delivery_id);
        $q = $this->db->get();
        return $q->result_array();
    }

    function get_delivery_statemetns_by_id($delivery_id)
    {
        $this->db->from('statements');
        $this->db->where('delivery_id', $delivery_id);
        $q = $this->db->get();
        return $q->result_array();
    }

    function get_delivery_comission_by_id($delivery_id)
    {
        $this->db->select('SUM(order_quantity*over_invoice_unit_price) as comission');
        $this->db->from('delivery_product');
        $this->db->where('delivery_id', $delivery_id);
        $q = $this->db->get();
        $res = $q->result_array();
        return $res[0]['comission'];
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

    function accounts_delivery_check($delivery_id)
    {
        $query = $this->db->get_where('delivery', array('delivery_id' => $delivery_id), 1);
        $pay = $query->row()->delivery_payment;
        if($pay == '1') {
            return true;
        }
        return false;
    }

    function lc_exist($delivery_id)
    {
        $query = $this->db->get_where('statements', array('delivery_id' => $delivery_id), 1);
        return $query->row()->delivery_id;
    }

    function get_lcstatements_data() 
    {
        $this->datatables->select('
            ak_delivery.delivery_id, delivery_date, delivery_company_name, lc_no, lc_date, exp_date,
            bank_name, party_name, bank_submit_value, purchase_date, purchase_tk,
            delivery_status, delivery_lc_status, delivery_doc_status, ak_delivery.editor_id');   
        $this->datatables->where('delivery_payment', '0');
        $this->datatables->from('delivery');  
        $this->db->join('statements', 'statements.delivery_id = delivery.delivery_id');  

        $res = $this->datatables->generate();
        
        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {
            if($res->aaData[$key][11] == '0') {
                $res->aaData[$key][11] = 'Pending';
                $res->aaData[$key][14] = '<a title="Edit Statements" class="simple_edit" href="'.base_url().'commercial/editlcstatements/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-red"></span></a>';
            }
            else if($res->aaData[$key][11] == '2') {
                $res->aaData[$key][11] = 'Complete';
                $res->aaData[$key][14] = '<a title="Edit Statements" class="simple_edit" href="'.base_url().'commercial/editlcstatements/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-green"></span></a>';
            }
            else {
                $res->aaData[$key][11] = 'Partial';
                $res->aaData[$key][14] = '<a title="Edit Statements" class="simple_edit" href="'.base_url().'commercial/editlcstatements/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-orange"></span></a>';
            }

            if($res->aaData[$key][12] == '0') { 
                $res->aaData[$key][12] = 'No';
            }
            else {
                $res->aaData[$key][12] = 'Yes';
            }

            if($res->aaData[$key][13] == '0') {
                $res->aaData[$key][13] = 'No';
            }
            else {
                $res->aaData[$key][13] = 'Yes';
            }
        }
        
        return json_encode($res);
    }

    function add_exp($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('export', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_exp($id, $data)
    {
        $this->db->where('export_id', $id);
        if ($this->db->update('export', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_exp($id) 
    {
        $this->db->where('export_id',$id);
        $this->db->delete('export');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_export_by_id($exp_id)
    {
        $this->db->from('export');
        $this->db->where('export_id', $exp_id);
        $q = $this->db->get();
        return $q->result_array();
    }

    function get_expissues_data() 
    {
        $this->datatables->select('export_id, issue_date, party_name, editor_id');   
        $this->datatables->from('export');   

        $this->datatables->edit_column('editor_id', '<a title="edit" href="'.base_url().'commercial/editexpissues/$1"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a title="delete" class="bootbox_confirm" href="'.base_url().'commercial/deleteexpissues/$1"><span class="icon-trash"></span></a>', 'export_id');

        $res = $this->datatables->generate();        
        return $res;
    }

    function get_payment_status($id) 
    {
        $query = $this->db->get_where('bill', array('delivery_id' => $id), 1);
        if($query->num_rows() > 0)
            return $query->row()->bill_payment_status;   
        return null;         
    }

}