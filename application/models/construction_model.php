<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Construction_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_construction($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('construction', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_construction($id, $data)
    {
        $this->db->where('construction_id', $id);
        if ($this->db->update('construction', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_construction($id) 
    {
        $this->db->where('construction_id',$id);
        $this->db->delete('construction');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_construction_data() 
    {
        $this->datatables->select('construction_id, construction_name, editor_id');   
        $this->datatables->from('construction');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_construction"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'construction/delete/$2"><span class="icon-trash"></span></a>', 'construction_name, construction_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}