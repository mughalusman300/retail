<?php
namespace App\Models;
use CodeIgniter\Model;
class Uommodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_uom_count(){  
        $builder = $this->db->table('saimtech_uom');
        $builder->Where('is_deleted', 0);
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_uom($limit,$start){  
        $builder = $this->db->table('saimtech_uom'); 
        $builder->Where('is_deleted', 0);
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function uom_search_count($search){
        $builder = $this->db->table('saimtech_uom');
        $builder->groupStart();
            $builder->like('uom_code', $search);
            $builder->orLike('uom_name', $search);
        $builder->groupEnd();
        $builder->Where('is_deleted', 0);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function uom_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_uom');
        $builder->groupStart();
            $builder->like('uom_code', $search);
            $builder->orLike('uom_name', $search);
        $builder->groupEnd();
        $builder->Where('is_deleted', 0);
        
        $builder->limit($limit,$start);
        $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }


}