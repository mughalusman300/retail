<?php
namespace App\Models;
use CodeIgniter\Model;
class Varientmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_variants_count(){  
        $builder = $this->db->table('saimtech_variant');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_variants($limit,$start){  
        $builder = $this->db->table('saimtech_variant'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function variants_search_count($search){
        $builder = $this->db->table('saimtech_variant');
        $builder->like('variant_name', $search);
        $builder->orLike('variant_desc', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function variants_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_variant');
        $builder->like('variant_name', $search);
        $builder->orLike('variant_desc', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_active_variants(){  
        $builder = $this->db->table('saimtech_variant'); 

        // $this->db->order_by('category_id',"asc");
        $builder->where('is_active', 1);
        $query = $builder->get(); 
         
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function all_variants_detail_count($variant_id){  
        $builder = $this->db->table('saimtech_variant_detail');
        $builder->Where('variant_id', $variant_id);
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_variants_detail($limit,$start,$variant_id){  
        $builder = $this->db->table('saimtech_variant_detail'); 
        $builder->Where('variant_id', $variant_id);
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function variants_detail_search_count($search,$variant_id){
        $builder = $this->db->table('saimtech_variant_detail');
        $builder->groupStart();
            $builder->like('variant_detail_name', $search);
            $builder->orLike('variant_detail_desc', $search);
        $builder->groupEnd();
        $builder->Where('variant_id', $variant_id);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function variants_detail_search($limit,$start,$search,$variant_id){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_variant_detail');
        $builder->groupStart();
            $builder->like('variant_detail_name', $search);
            $builder->orLike('variant_detail_desc', $search);
        $builder->groupEnd();
        $builder->Where('variant_id', $variant_id);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

}