<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Factory_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    function get_raw_by_id($raw_id)
    {
        $this->db->select('r.*, a.article_name, c.construction_name, w.width_name, s.softness_name, t.color_name, p.source_name, d.description_name');
        $this->db->from('raw r');
        $this->db->where('r.raw_id', $raw_id);
        $this->db->join('article a', 'r.article_id = a.article_id');
        $this->db->join('construction c', 'r.construction_id = c.construction_id');
        $this->db->join('width w', 'r.width_id = w.width_id');
        $this->db->join('softness s', 'r.softness_id = s.softness_id');
        $this->db->join('color t', 'r.color_id = t.color_id');
        $this->db->join('source p', 'r.source_id = p.source_id');
        $this->db->join('description d', 'r.description_id = d.description_id');
        $q = $this->db->get();
        return $q->result_array();
    }

    function add_raw($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('raw', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function add_raw_issue($data)
    {
        $data['created'] = date('Y-m-d H:i:s');

        if ($this->db->insert('issue', $data)) {
            return $this->db->insert_id();
        }
        return NULL;
    }

    function edit_raw($id, $data)
    {
        $this->db->where('raw_id', $id);
        if ($this->db->update('raw', $data)) {
            return true;
        }
        return NULL;
    }

    function edit_raw_issue($id, $data)
    {
        $this->db->where('issue_id', $id);
        if ($this->db->update('issue', $data)) {
            return true;
        }
        return NULL;
    }

    function delete_raw($id) 
    {
        $this->db->where('raw_id',$id);
        $this->db->delete('raw');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function delete_raw_issue($id) 
    {
        $this->db->where('issue_id',$id);
        $this->db->delete('issue');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    function get_raw_data() 
    {
        $this->datatables->select('raw_id, raw_date, raw_pi_no, raw_lc_no, article_name, construction_name, width_name, softness_name, color_name, source_name, ((SELECT sum( r.raw_received_balance - ri.total_finish_goods) FROM ak_raw r, ak_issue ri WHERE r.raw_id < ak_raw.raw_id and ak_raw.article_id = r.article_id and ak_raw.construction_id = r.construction_id and ak_raw.width_id = r.width_id and ak_raw.softness_id = r.softness_id and ak_raw.color_id = r.color_id and ak_raw.source_id = r.source_id and r.raw_id = ri.raw_id ) - (SELECT rr.raw_received_balance FROM ak_raw rr WHERE rr.raw_id < ak_raw.raw_id and ak_raw.article_id = rr.article_id and ak_raw.construction_id = rr.construction_id and ak_raw.width_id = rr.width_id and ak_raw.softness_id = rr.softness_id and ak_raw.color_id = rr.color_id and ak_raw.source_id = rr.source_id LIMIT 1)) AS prev_balance, raw_received_balance, raw_id as total, raw_date as date, article.article_id, construction.construction_id, width.width_id, softness.softness_id, color.color_id, source.source_id, description.description_id, raw_supplier, raw_remarks');   
        $this->datatables->from('raw'); 
        $this->datatables->join('article', 'article.article_id = raw.article_id');  
        $this->datatables->join('construction', 'construction.construction_id = raw.construction_id');  
        $this->datatables->join('width', 'width.width_id = raw.width_id');  
        $this->datatables->join('softness', 'softness.softness_id = raw.softness_id');  
        $this->datatables->join('color', 'color.color_id = raw.color_id');  
        $this->datatables->join('source', 'source.source_id = raw.source_id');  
        $this->datatables->join('description', 'description.description_id = raw.description_id'); 

        $this->datatables->edit_column('date', '<a title="edit" class="raw_edit" data-id="$1" data-date="$2" data-pi="$3" data-lc="$4" data-article="$5" data-construction="$6" data-width="$7" data-softness="$8" data-color="$9" data-source="$a" data-received="$b" data-description="$c" data-supplier="$d" data-remarks="$e" data-toggle="modal" href="#edit_raw"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a title="delete" class=" bootbox_confirm" href="'.base_url().'factory/deleteraw/$1"><span class="icon-trash"></span></a> &nbsp; &nbsp; &nbsp; &nbsp;<a href="'.base_url().'factory/rawissuedto/$1" title="issued to"><span class="glyphicon glyphicon-stop color-x"></span></a>', 'raw_id, raw_date, raw_pi_no, raw_lc_no, article.article_id, construction.construction_id, width.width_id, softness.softness_id, color.color_id, source.source_id, raw_received_balance, description.description_id, raw_supplier, raw_remarks');

        $res = $this->datatables->generate();

        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {

            if($value[10] == NULL) {
                $res->aaData[$key][10] = '-';
                $res->aaData[$key][12] = $res->aaData[$key][11];
            }
            else 
                $res->aaData[$key][12] = $res->aaData[$key][10] + $res->aaData[$key][11];

            $res->aaData[$key][13] = str_replace('$a', $res->aaData[$key][19], $res->aaData[$key][13]);
            $res->aaData[$key][13] = str_replace('$b', $res->aaData[$key][11], $res->aaData[$key][13]);
            $res->aaData[$key][13] = str_replace('$c', $res->aaData[$key][20], $res->aaData[$key][13]);
            $res->aaData[$key][13] = str_replace('$d', $res->aaData[$key][21], $res->aaData[$key][13]);
            $res->aaData[$key][13] = str_replace('$e', $res->aaData[$key][22], $res->aaData[$key][13]);

            if(!$this->tank_auth->is_admin() && !$this->tank_auth->is_group_member('Super Users') && !$this->tank_auth->is_group_member('Factory')) 
            {
                 $res->aaData[$key][13] = '<a href="'.base_url().'factory/rawissuedto/'.$res->aaData[$key][0].'" title="issued to"><span class="glyphicon glyphicon-bookmark color-x"></span></a>';
            }

            $total_issued = $this->factory_model->count_total_issued($res->aaData[$key][0]);
            if($total_issued == 0)
                 $res->aaData[$key][13] = str_replace('color-x', 'color-red', $res->aaData[$key][13]);
            else if($total_issued == $res->aaData[$key][11])
                 $res->aaData[$key][13] = str_replace('color-x', 'color-green', $res->aaData[$key][13]);
            else
                 $res->aaData[$key][13] = str_replace('color-x', 'color-orange', $res->aaData[$key][13]);
        }
        
        return json_encode($res);
    }

    function get_raw_issue_data_by_id($raw_id) 
    {
        $this->datatables->select('issue_id, issue_date, issue_type_name, issue_quantity, total_finish_goods, ak_issue.created, ak_issue.editor_id, raw_id, ak_issue.issue_type_id, wastage_detail');   
        $this->datatables->from('issue'); 
        $this->datatables->where('raw_id', $raw_id); 
        $this->datatables->join('issue_type', 'issue_type.issue_type_id = issue.issue_type_id'); 

        $this->datatables->edit_column('ak_issue.editor_id', '<a title="edit" class="raw_edit_issue" data-id="$1" data-date="$2" data-type="$3" data-quantity="$4" data-total="$5" data-raw="$6" data-detail="$7" data-toggle="modal" href="#edit_rawissue_type"><span class="icon-edit"></span></a> &nbsp; &nbsp;<a title="delete" class=" bootbox_confirm" href="'.base_url().'factory/deleterawissuedto/$1/$6"><span class="icon-trash"></span></a>', 'issue_id, issue_date,  ak_issue.issue_type_id, issue_quantity, total_finish_goods, raw_id,  wastage_detail');

        $res = $this->datatables->generate();

        $res = json_decode($res);

        foreach ($res->aaData as $key => $value) {
            $res->aaData[$key][5] = number_format((float)($res->aaData[$key][3] - $res->aaData[$key][4]), 4, '.', '');
        }
        
        return json_encode($res);
    }

    function count_total_issued($raw_id)
    {
        $this->db->select_sum('issue_quantity');
        $this->db->where('raw_id', $raw_id); 
        $query = $this->db->get('issue');
        $query = $query->result_array(); 
        return $query[0]['issue_quantity']; 
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

    function get_all_issue_type() 
    {
        $query = $this->db->get('issue_type');
        return $query->result_array();        
    }

    function get_all_description() 
    {
        $query = $this->db->get('description');
        return $query->result_array();        
    }


    function get_delivery_user($user) 
    {
        $query = $this->db->get_where('users', array('id' => $user), 1);
        return $query->row()->fname.' '.$query->row()->lname;
    }

    function get_article($id) 
    {
        $query = $this->db->get_where('article', array('article_id' => $id), 1);
        return $query->row()->article_name;       
    }

    function get_width($id) 
    {
        $query = $this->db->get_where('width', array('width_id' => $id), 1);
        return $query->row()->width_name;        
    }

    function get_softness($id) 
    {
        $query = $this->db->get_where('softness', array('softness_id' => $id), 1);
        return $query->row()->softness_name;        
    }

    function get_color($id) 
    {
        $query = $this->db->get_where('color', array('color_id' => $id), 1);
        return $query->row()->color_name;        
    }

    function get_description($id) 
    {
        $query = $this->db->get_where('description', array('description_id' => $id), 1);
        return $query->row()->description_name;         
    }

    function get_article_alt_name($alt)
    {
        $str = explode('-', $alt);
        if(count($str) == 2)
        {
            return $this->get_article($str[1]);
        }
        else
        {
            return $this->get_article($str[0]);
        }
    }


    function get_all_article_with_alt() 
    {
        $res = $this->get_all_article(); 
        $i = 0;  
        foreach($res as $key => $value) {
            $res[$i]['class'] = 'parent';
            $i++;
            if($value['article_alt'] != '')
            {
                $alt = explode(',', $value['article_alt']);
                foreach ($alt as $k => $v) {  
                    $str = array();                  
                    $str['article_id'] = $value['article_id'].'-'.$v;
                    $str['article_name'] = '&nbsp;&nbsp;- '.$this->get_article($v);
                    $str['article_alt'] = '';
                    $str['class'] = 'child';

                    array_splice($res, $i, 0, array($str));
                    $i++;
                }
            }
        } 
        
        return $res;  
    }

}