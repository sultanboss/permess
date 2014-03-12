<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_groups($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('user_groups', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_groups($id, $data)
    {
        $this->db->where('group_id', $id);
        if ($this->db->update('user_groups', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_groups($id) 
    {
        $this->db->where('group_id',$id);
        $this->db->delete('user_groups');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_data() 
    {
        $this->datatables->select('group_id, group_name, created');   
        $this->datatables->from('user_groups');       

        $this->datatables->edit_column('created', '<a class="group_edit" data-id="$1" data-name="$2" data-toggle="modal" href="#edit_groups"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'groups/delete/$1"><span class="icon-trash"></span></a>', 'group_id, group_name');

        $res = $this->datatables->generate();
        
        return $res;
    }

}