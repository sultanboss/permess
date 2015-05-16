<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function get_cash_payment_order_data() 
    {
        $this->datatables->select('delivery_id, delivery_date, delivery_company_name, 
            (select SUM(order_quantity*unit_price) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as pi_value,
            (select bill_usd_rate from ak_bill where ak_bill.delivery_id = ak_delivery.delivery_id) as usd,
            (select SUM(order_quantity*(unit_price+over_invoice_unit_price)) from ak_delivery_product where ak_delivery_product.delivery_id = ak_delivery.delivery_id) as total,
            (select bill_received from ak_bill where ak_bill.delivery_id = ak_delivery.delivery_id) as total_received,
            delivery_status, delivery_request, editor_id');   
        $this->datatables->where("delivery_payment", '1'); 
        $this->datatables->from('delivery');         

        $res = $this->datatables->generate();
        
        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {
            if($res->aaData[$key][7] == '0') {
                $res->aaData[$key][7] = 'Pending';
                $res->aaData[$key][9] = '<a title="Edit Payment" href="'.base_url().'accounts/paymentdetails/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-red"></span></a>';
            }
            else if($res->aaData[$key][7] == '2') {
                $res->aaData[$key][7] = 'Complete';
                $res->aaData[$key][9] = '<a title="Edit Payment" href="'.base_url().'accounts/paymentdetails/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-green"></span></a>';
            }
            else {
                $res->aaData[$key][7] = 'Partial';
                $res->aaData[$key][9] = '<a title="Edit Payment" href="'.base_url().'accounts/paymentdetails/'.$res->aaData[$key][0].'"><span class="icon-edit"></span></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-orange"></span></a>';
            }

            if($res->aaData[$key][8] == '0') {
                $res->aaData[$key][8] = 'Pending';
            }
            else if($res->aaData[$key][8] == '2') {
                $res->aaData[$key][8] = 'Complete';
            }
            else {
                $res->aaData[$key][8] = 'Partial';
            }

        }
        
        return json_encode($res);
    }

    function add_bill($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('bill', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function delete_bill($delivery_id) 
    {
        $this->db->where('delivery_id',$delivery_id);
        $this->db->delete('bill');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function update_bill($id, $data)
    {
        $query = $this->db->get_where('bill', array('delivery_id' => $id));
        $count= $query->num_rows(); 

        if ($count === 0)
        {
            $this->add_bill($data);
        }
        else
        {            
            $this->db->where('delivery_id', $id);
            if ($this->db->update('bill', $data)) {
                return true;
            }
        }
        return NULL;
    }

    function get_payment_details_by_id($delivery_id)
    {
        $this->db->from('bill');
        $this->db->where('delivery_id', $delivery_id);
        $q = $this->db->get();
        return $q->result_array();
    }

    function update_payment($id, $data)
    {
        $this->db->where('delivery_id', $id);
        if ($this->db->update('bill', $data)) {
            return true;
        }
        return NULL;
    }

}