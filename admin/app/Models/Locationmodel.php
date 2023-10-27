<?php
namespace App\Models;
use CodeIgniter\Model;
class Locationmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_locations_count(){  
        $builder = $this->db->table('saimtech_location');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_locations($limit,$start){  
        $builder = $this->db->table('saimtech_location'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function locations_search_count($search){
        $builder = $this->db->table('saimtech_location');
        $builder->like('location_name', $search);
        $builder->orLike('location_city', $search);
        $builder->orLike('location_country', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function locations_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_location');
        $builder->like('location_name', $search);
        $builder->orLike('location_city', $search);
        $builder->orLike('location_country', $search);
        
        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_active_locations(){  
        $builder = $this->db->table('saimtech_location'); 

        // $this->db->order_by('category_id',"asc");
        $builder->where('is_active', 1);
        $query = $builder->get(); 
         
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }
}