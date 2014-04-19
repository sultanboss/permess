<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Description_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_description($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('description', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_description($id, $data)
    {
        $this->db->where('description_id', $id);
        if ($this->db->update('description', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_description($id) 
    {
        $this->db->where('description_id',$id);
        $this->db->delete('description');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_description_data() 
    {
        $this->datatables->select('description_id, description_name, editor_id');   
        $this->datatables->from('description');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_description"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'description/delete/$2"><span class="icon-trash"></span></a>', 'description_name, description_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}