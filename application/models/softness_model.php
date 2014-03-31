<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Softness_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_softness($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('softness', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_softness($id, $data)
    {
        $this->db->where('softness_id', $id);
        if ($this->db->update('softness', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_softness($id) 
    {
        $this->db->where('softness_id',$id);
        $this->db->delete('softness');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_softness_data() 
    {
        $this->datatables->select('softness_id, softness_name, editor_id');   
        $this->datatables->from('softness');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_softness"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'softness/delete/$2"><span class="icon-trash"></span></a>', 'softness_name, softness_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}