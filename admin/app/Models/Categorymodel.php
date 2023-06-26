<?php
namespace App\Models;
use CodeIgniter\Model;
class Categorymodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db      = \Config\Database::connect();  
    }

    public function all_categories_count(){  
        $query = $this->db->get('saimtech_category');
        return $query->num_rows();  
    }

    public function all_categories($limit,$start){   
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $this->db->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $this->db->get('saimtech_category');  
        $result = ($query->num_rows() > 0) ? $query->result() : FALSE;
        return $result; 
        
    }

    public function categories_search_count($search){
        $this->db->like('title', $search);
        $this->db->or_like('code', $search);
        $this->db->or_like('category_title', $desc);

       $query = $this->db->get('saimtech_category');
    
        return $query->num_rows();
    }

    public function categories_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $this->db->like('title', $search);
        $this->db->or_like('code', $search);
        $this->db->or_like('category_title', $desc);

        $this->db->limit($limit,$start)
        // $this->db->order_by('category_id',"asc")
       $query = $this->db->get('saimtech_category');
    
        $result = ($query->num_rows() > 0) ? $query->result() : FALSE;
        return $result; 
    }


}