<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_groups($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('users', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_users($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('users', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_users($id) 
    {
        $this->db->where('id',$id);
        $this->db->delete('users');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_all_groups() 
    {
        $query = $this->db->get('user_groups');
        return $query->result_array();        
    }

    function get_data() 
    {
        $this->datatables->select('id, email, fname, lname, group_id, created');   
        $this->datatables->from('users');       

        $this->datatables->edit_column('created', '<a class="user_edit" data-id="$1" data-email="$2" data-fname="$3" data-lname="$4" data-group="$5" data-toggle="modal" href="#edit_users"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'user/delete/$1"><span class="icon-trash"></span></a>', 'id, email, fname, lname, group_id');

        $res = $this->datatables->generate();
        
        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {
            $this->db->where('group_id', $res->aaData[$key][4]);
            $res->aaData[$key][4] = $this->db->get('user_groups')->row()->group_name;
        }
        
        return json_encode($res);
    }

}