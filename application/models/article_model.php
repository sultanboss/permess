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
        $this->datatables->select('article_id, article_name, article_alt, editor_id');   
        $this->datatables->from('article');       

        $this->datatables->edit_column('editor_id', '<a class="simple_edit" data-name="$1" data-id="$2" data-alt="$3" data-toggle="modal" href="#edit_article"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a class=" bootbox_confirm" href="'.base_url().'article/delete/$2"><span class="icon-trash"></span></a>', 'article_name, article_id, article_alt');

        $res = $this->datatables->generate();

        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) { 
            $res->aaData[$key][2] = $this->get_article_name($res->aaData[$key][2]);    
        }
        
        return json_encode($res);
    }

    function get_all_article() 
    {
        $query = $this->db->get('article');
        return $query->result_array();        
    }

    function get_article_name($string)
    {
        $val = '-';
        if($string != '')
        {
            $alt = explode(',', $string);
            $i = 1;                
            foreach($alt as $key => $value) {
                if($i == 1) {
                    $query = $this->db->get_where('article', array('article_id' => $value), 1);
                    $val = $query->row()->article_name;
                }
                else {
                    $query = $this->db->get_where('article', array('article_id' => $value), 1);
                    $val.= ' &nbsp;&nbsp;|&nbsp;&nbsp; '.$query->row()->article_name;
                }
                $i++;
            } 
        }
        return $val;
    }

    function check_alt_article($id)
    {
        $this->db->select('article_alt');
        $query = $this->db->get('article');
        $res = $query->result_array();
        foreach ($res as $key => $value) {
            $alt = explode(',', $value['article_alt']);
            var_dump($alt);
            foreach ($alt as $k => $v) {
                if($v == $id) {
                    return true;
                }
            }
        }
        return false;
    }

}