<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address_price_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_address_price($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('address_price', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_address_price($id, $data)
    {
        $this->db->where('address_price_id', $id);
        if ($this->db->update('address_price', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_address_price($id) 
    {
        $this->db->where('address_price_id',$id);
        $this->db->delete('address_price');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_address_price_data() 
    {
        $this->datatables->select('address_price_id, ak_address.company_name, ak_article.article_name, price, ak_address_price.editor_id, ak_address_price.address_id, ak_address_price.article_id');   
        $this->datatables->from('address_price');  

        $this->datatables->join('article', 'ak_article.article_id = ak_address_price.article_id');
        $this->datatables->join('address', 'ak_address.address_id = ak_address_price.address_id');     

        $this->datatables->edit_column('ak_address_price.editor_id', '<a class="simple_edit" data-id="$1" data-address="$2" data-article="$3" data-price="$4" data-toggle="modal" href="#edit_address_price"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'addressprice/delete/$1"><span class="icon-trash"></span></a>', 'address_price_id, ak_address_price.address_id, ak_address_price.article_id, price');

        $res = $this->datatables->generate();
        
        return $res;
    }

    function get_companies()
    {
        $this->db->select('address_id, company_name');
        $this->db->order_by('company_name');
        $query = $this->db->get('address');
        return $query->result_array();
    }

    function get_articles() 
    {
        $this->db->select('article_id, article_name');
        $this->db->order_by('article_name');
        $query = $this->db->get('article');
        return $query->result_array();        
    }

}