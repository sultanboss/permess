<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Issue_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_issue($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('issue_type', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_issue($id, $data)
    {
        $this->db->where('issue_type_id', $id);
        if ($this->db->update('issue_type', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_issue($id) 
    {
        $this->db->where('issue_type_id',$id);
        $this->db->delete('issue_type');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_issue_data() 
    {
        $this->datatables->select('issue_type_id, issue_type_name, editor_id');   
        $this->datatables->from('issue_type');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_issue"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'issue/delete/$2"><span class="icon-trash"></span></a>', 'issue_type_name, issue_type_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}