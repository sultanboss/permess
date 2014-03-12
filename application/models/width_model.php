<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Width_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_width($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('width', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_width($id, $data)
    {
        $this->db->where('width_id', $id);
        if ($this->db->update('width', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_width($id) 
    {
        $this->db->where('width_id',$id);
        $this->db->delete('width');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_width_data() 
    {
        $this->datatables->select('width_id, width_name, editor_id');   
        $this->datatables->from('width');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_width"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'width/delete/$2"><span class="icon-trash"></span></a>', 'width_name, width_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}