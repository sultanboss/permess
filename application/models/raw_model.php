<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Raw_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_raw($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('raw', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_raw($id, $data)
    {
        $this->db->where('raw_id', $id);
        if ($this->db->update('raw', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_raw($id) 
    {
        $this->db->where('raw_id',$id);
        $this->db->delete('raw');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_raw_data() 
    {
        $this->datatables->select('raw_id, raw_name, editor_id');   
        $this->datatables->from('raw');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_raw"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'raw/delete/$2"><span class="icon-trash"></span></a>', 'raw_name, raw_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}