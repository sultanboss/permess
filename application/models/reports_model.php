<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function get_import_data($start, $end, $type, $article, $construction, $width, $softness, $color, $source) 
    {
        $this->db->select('raw.raw_id, raw_date, raw_pi_no, raw_lc_no, article_name, construction_name, width_name, softness_name, color_name, source_name, (SELECT sum( r.raw_received_balance ) FROM ak_raw r WHERE r.raw_id < ak_raw.raw_id and ak_raw.article_id = r.article_id and ak_raw.construction_id = r.construction_id and ak_raw.width_id = r.width_id and ak_raw.softness_id = r.softness_id and ak_raw.color_id = r.color_id and ak_raw.source_id = r.source_id) AS prev_balance, raw_received_balance, raw.raw_id as total, (SELECT sum(issue_quantity) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 1) as production, (SELECT sum(total_finish_goods) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 1) as pfinish, (SELECT sum(issue_quantity) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 2) as finished, (SELECT sum(total_finish_goods) FROM ak_issue i WHERE i.raw_id = ak_raw.raw_id and i.issue_type_id = 2) as ffinish');   

        $this->db->where('raw_date >=', $start);
        $this->db->where('raw_date <=', $end);

        if($type == 1) {
           $this->db->where('raw.article_id =', $article); 
           $this->db->where('raw.construction_id =', $construction); 
           $this->db->where('raw.width_id =', $width); 
           $this->db->where('raw.softness_id =', $softness); 
           $this->db->where('raw.color_id =', $color); 
           $this->db->where('raw.source_id =', $source); 
        }

        $this->db->from('raw'); 
        $this->db->join('article', 'article.article_id = raw.article_id');  
        $this->db->join('construction', 'construction.construction_id = raw.construction_id');  
        $this->db->join('width', 'width.width_id = raw.width_id');  
        $this->db->join('softness', 'softness.softness_id = raw.softness_id');  
        $this->db->join('color', 'color.color_id = raw.color_id');  
        $this->db->join('source', 'source.source_id = raw.source_id'); 

        return $this->db->get()->result_array();
    }

    function get_stock_data() 
    {
        $this->db->select('ak_raw.raw_id, article_name, width_name, softness_name, color_name, construction_name, SUM(total_finish_goods) as total, (SELECT SUM(delivery_quantity) FROM ak_delivery_product WHERE ak_delivery_product.article_id = ak_raw.article_id AND ak_delivery_product.width_id = ak_raw.width_id AND ak_delivery_product.softness_id = ak_raw.softness_id AND ak_delivery_product.color_id = ak_raw.color_id) as sold');   
        $this->db->from('raw'); 
        $this->db->join('article', 'article.article_id = raw.article_id');   
        $this->db->join('width', 'width.width_id = raw.width_id');  
        $this->db->join('softness', 'softness.softness_id = raw.softness_id');  
        $this->db->join('color', 'color.color_id = raw.color_id');  
        $this->db->join('construction', 'construction.construction_id = raw.construction_id');  
        $this->db->join('issue', 'issue.raw_id = raw.raw_id');  
        $this->db->group_by('article_name, width_name, softness_name, color_name');

        return $this->db->get()->result_array();

        // $res = $this->db->generate();

        // $res = json_decode($res);

        // $i = 1;
        // foreach ($res->aaData as $key => $value) {
        //     $res->aaData[$key][0] = $i;
        //     if($res->aaData[$key][7] == null)
        //         $res->aaData[$key][7] = 0;
        //     $res->aaData[$key][6] = $res->aaData[$key][6] - $res->aaData[$key][7];
        //     $i++;
        // }
        
        // return json_encode($res);
    }


    // Extra Function

    function get_all_article() 
    {
        $this->db->select('article_id, article_name, article_alt');
        $query = $this->db->get('article');
        return $query->result_array();        
    }

    function get_all_construction() 
    {
        $query = $this->db->get('construction');
        return $query->result_array();        
    }

    function get_all_width() 
    {
        $query = $this->db->get('width');
        return $query->result_array();        
    }

    function get_all_softness() 
    {
        $query = $this->db->get('softness');
        return $query->result_array();        
    }

    function get_all_color() 
    {
        $query = $this->db->get('color');
        return $query->result_array();        
    }

    function get_all_source() 
    {
        $query = $this->db->get('source');
        return $query->result_array();        
    }

}