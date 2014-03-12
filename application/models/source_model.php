<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Source_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_source($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('source', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_source($id, $data)
    {
        $this->db->where('source_id', $id);
        if ($this->db->update('source', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_source($id) 
    {
        $this->db->where('source_id',$id);
        $this->db->delete('source');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_source_data() 
    {
        $this->datatables->select('source_id, source_name, editor_id');   
        $this->datatables->from('source');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_source"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'source/delete/$2"><span class="icon-trash"></span></a>', 'source_name, source_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}