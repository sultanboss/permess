<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Factory_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_import($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('import', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_import($id, $data)
    {
        $this->db->where('import_id', $id);
        if ($this->db->update('import', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_import($id) 
    {
        $this->db->where('import_id',$id);
        $this->db->delete('import');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_import_data() 
    {
        $this->datatables->select('import_id, raw_name, import_date, (SELECT sum( e.import_received_balance ) FROM ak_import e WHERE e.import_id < ak_import.import_id and ak_import.raw_id = e.raw_id) AS prev_balance, import_received_balance, import_invoice_challan, import_lc_no, import_id as total, import_issue_to, import_inv_req_challan, import_inv_req_challan as challan, raw.raw_id');   
        $this->datatables->from('import'); 
        $this->datatables->join('raw', 'raw.raw_id = import.raw_id');  

        $this->datatables->edit_column('challan', '<a class="import_edit" data-id="$1" data-raw="$2" data-date="$3" data-recev="$4" data-challan="$5" data-lc="$6" data-issue="$7" data-irc="$8" data-toggle="modal" href="#edit_import"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'factory/deleteimport/$1"><span class="icon-trash"></span></a>', 'import_id, raw.raw_id, import_date, import_received_balance, import_invoice_challan, import_lc_no, import_issue_to, import_inv_req_challan');

        $res = $this->datatables->generate();

        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {
            if($value[3] == NULL) {
                $res->aaData[$key][3] = '-';
                $res->aaData[$key][7] = $res->aaData[$key][4];
            }
            else 
                $res->aaData[$key][7] = $res->aaData[$key][3] + $res->aaData[$key][4];
        }
        
        return json_encode($res);
    }

    
    // Extra Function

    function get_raw() 
    {
        $query = $this->db->get('raw');
        return $query->result_array();        
    }

    function get_import_prev_balance($raw_id, $offset) {
        $this->db->where('raw_id',$raw_id);
        $this->db->order_by('import_id', 'DESC'); 
        $query = $this->db->get('import', 1, $offset);
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                return $row->import_prev_balance + $row->import_received_balance;
            }
        }
        else
            return 0;
    }

}