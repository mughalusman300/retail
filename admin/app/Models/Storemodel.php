<?php
namespace App\Models;
use CodeIgniter\Model;
class Storemodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_store_count(){  
        $builder = $this->db->table('saimtech_store');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_store($limit,$start){  
        $builder = $this->db->table('saimtech_store'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function store_search_count($search){
        $builder = $this->db->table('saimtech_store');
        $builder->like('store_name', $search);
        $builder->orLike('store_code', $search);
        $builder->orLike('store_phone', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function store_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_store');
        $builder->like('store_name', $search);
        $builder->orLike('store_code', $search);
        $builder->orLike('store_phone', $search);
        
        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_active_store(){  
        $builder = $this->db->table('saimtech_store'); 

        // $this->db->order_by('category_id',"asc");
        $builder->where('is_active', 1);
        $query = $builder->get(); 
         
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }
}