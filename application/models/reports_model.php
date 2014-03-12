<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function get_followup($start, $end) 
    {
        $this->db->select('followup.*, parameter.parameter_name, enquiry.*');
        $this->db->where('followup_date >=', $start);
        $this->db->where('followup_date <=', $end);
        $this->db->from('followup');
        $this->db->join('parameter', 'followup.followup_type = parameter.parameter_id');
        $this->db->join('enquiry', 'enquiry.enquiry_id = followup.enquiry_id');
        return $this->db->get()->result_array();
    }

    function get_enquiry($start, $end) 
    {
        $this->db->select('enquiry.*, parameter.parameter_name, sum(ak_enquiry_product.product_amount) as amount');
        $this->db->where('enquiry_date >=', $start);
        $this->db->where('enquiry_date <=', $end);
        $this->db->from('enquiry');
        $this->db->join('parameter', 'enquiry.enquiry_source = parameter.parameter_id');
        $this->db->join('enquiry_product', 'enquiry.enquiry_id = enquiry_product.enquiry_id');
        return $this->db->get()->result_array();
    }

    function get_enquiry_product($start, $end) 
    {
        $this->db->select('enquiry.enquiry_id, enquiry.enquiry_date, enquiry.enquiry_name, product.product_code, product_category.product_category_name, parameter.parameter_name, enquiry_product.product_rate, enquiry_product.product_quantity, enquiry_product.product_amount');
        $this->db->where('enquiry_date >=', $start);
        $this->db->where('enquiry_date <=', $end);
        $this->db->from('enquiry');
        $this->db->join('parameter', 'enquiry.enquiry_source = parameter.parameter_id');
        $this->db->join('enquiry_product', 'enquiry.enquiry_id = enquiry_product.enquiry_id');
        $this->db->join('product', 'product.product_id = enquiry_product.enquiry_product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category');
        return $this->db->get()->result_array();
    }

}