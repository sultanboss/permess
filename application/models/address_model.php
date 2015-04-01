<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_address($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('address', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_address($id, $data)
    {
        $this->db->where('address_id', $id);
        if ($this->db->update('address', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_address($id) 
    {
        $this->db->where('address_id',$id);
        $this->db->delete('address');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_address_data() 
    {
        $this->datatables->select('address_id, company_name, contact_person, buyer, editor_id, company_address, delivery_address');   
        $this->datatables->from('address');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-id="$1" data-name="$2" data-contact="$3" data-buyer="$4" data-address="$5" data-delivery="$6" data-toggle="modal" href="#edit_address"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'address/delete/$1"><span class="icon-trash"></span></a>', 'address_id, company_name, contact_person, buyer, company_address, delivery_address');

        $res = $this->datatables->generate();
        
        return $res;
    }

}