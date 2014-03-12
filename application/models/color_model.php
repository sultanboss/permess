<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Color_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_color($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('color', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_color($id, $data)
    {
        $this->db->where('color_id', $id);
        if ($this->db->update('color', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_color($id) 
    {
        $this->db->where('color_id',$id);
        $this->db->delete('color');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_color_data() 
    {
        $this->datatables->select('color_id, color_name, editor_id');   
        $this->datatables->from('color');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_color"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'color/delete/$2"><span class="icon-trash"></span></a>', 'color_name, color_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}