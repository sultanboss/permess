<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function get_cash_payment_order_data() 
    {
        $this->datatables->select('delivery_id, delivery_date, delivery_company_name, delivery_lc_status, delivery_status, delivery_request, editor_id');   
        $this->datatables->where("delivery_payment", '1'); 
        $this->datatables->from('delivery');         

        $res = $this->datatables->generate();
        
        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {
            if($res->aaData[$key][4] == '0') {
                $res->aaData[$key][4] = 'Pending';
                $res->aaData[$key][6] = '<a title="Edit Order" href="#"><span class="icon-print color-black"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-red"></span></a>';
            }
            else if($res->aaData[$key][4] == '2') {
                $res->aaData[$key][4] = 'Complete';
                $res->aaData[$key][6] = '<a title="Edit Order" href="#"><span class="icon-print color-black"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-green"></span></a>';
            }
            else {
                $res->aaData[$key][4] = 'Partial';
                $res->aaData[$key][6] = '<a title="Edit Order" href="#"><span class="icon-print color-black"></span></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'factory/editdelivery/'.$res->aaData[$key][0].'" title="View Issue"><span class="glyphicon glyphicon-th-large color-orange"></span></a>';
            }

            if($res->aaData[$key][5] == '0') {
                $res->aaData[$key][5] = 'No';
            }
            else {
                $res->aaData[$key][5] = 'Yes';
            }

            if($res->aaData[$key][3] == '0') {
                $res->aaData[$key][3] = 'No';
            }
            else {
                $res->aaData[$key][3] = 'Yes';
            }

        }
        
        return json_encode($res);
    }

}