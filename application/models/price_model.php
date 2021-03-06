<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Price_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function add_price($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('price', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_price($id, $data)
    {
        $this->db->where('price_id', $id);
        if ($this->db->update('price', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_price($id) 
    {
        $this->db->where('price_id',$id);
        $this->db->delete('price');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_price_data() 
    {
        $this->datatables->select('price_id, article_name, width_name, softness_name, color_name, buy_price, sell_price, price_id as data, article.article_id, width.width_id, softness.softness_id, color.color_id');   
        $this->datatables->from('price'); 
        $this->datatables->join('article', 'article.article_id = price.article_id');   
        $this->datatables->join('width', 'width.width_id = price.width_id');  
        $this->datatables->join('softness', 'softness.softness_id = price.softness_id');  
        $this->datatables->join('color', 'color.color_id = price.color_id');        

        $this->datatables->edit_column('data', '<a class="simple_edit" data-id="$1" data-lc="$4" data-article="$2" data-width="$3" data-softness="$4" data-color="$5" data-buy-price="$6" data-sell-price="$6" data-toggle="modal" href="#edit_price"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'price/delete/$1"><span class="icon-trash"></span></a>', 'price_id, article.article_id, width.width_id, softness.softness_id, color.color_id, buy_price, sell_price');

        $res = $this->datatables->generate();
        
        return $res;
    }

}