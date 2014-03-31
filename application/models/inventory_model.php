<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function get_stock_data() 
    {
        $this->datatables->select('ak_raw.raw_id, article_name, construction_name, width_name, softness_name, color_name, source_name, SUM(total_finish_goods) as total');   
        $this->datatables->from('raw'); 
        $this->datatables->join('article', 'article.article_id = raw.article_id');  
        $this->datatables->join('construction', 'construction.construction_id = raw.construction_id');  
        $this->datatables->join('width', 'width.width_id = raw.width_id');  
        $this->datatables->join('softness', 'softness.softness_id = raw.softness_id');  
        $this->datatables->join('color', 'color.color_id = raw.color_id');  
        $this->datatables->join('source', 'source.source_id = raw.source_id'); 
        $this->datatables->join('issue', 'issue.raw_id = raw.raw_id');  
        $this->datatables->group_by('article_name, construction_name, width_name, softness_name, color_name, source_name');

        $res = $this->datatables->generate();

        $res = json_decode($res);

        $i = 1;
        foreach ($res->aaData as $key => $value) {
            $res->aaData[$key][0] = $i;
            $i++;
        }
        
        return json_encode($res);
    }

    // extra function
    
    function get_normal_users()
    {
        $this->db->select('id, fname, lname');
        $this->db->where('group_id', '501');
        $query = $this->db->get('users');
        return $query->result_array();
    }

}