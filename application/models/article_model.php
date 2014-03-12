<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_article($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('article', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_article($id, $data)
    {
        $this->db->where('article_id', $id);
        if ($this->db->update('article', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_article($id) 
    {
        $this->db->where('article_id',$id);
        $this->db->delete('article');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_article_data() 
    {
        $this->datatables->select('article_id, article_name, editor_id');   
        $this->datatables->from('article');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-toggle="modal" href="#edit_article"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'article/delete/$2"><span class="icon-trash"></span></a>', 'article_name, article_id');

        $res = $this->datatables->generate();
        
        return $res;
    }

}