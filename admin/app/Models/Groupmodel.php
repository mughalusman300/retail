<?php
namespace App\Models;
use CodeIgniter\Model;
class Groupmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_groups_count(){  
        $builder = $this->db->table('saimtech_group');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_groups($limit,$start){  
        $builder = $this->db->table('saimtech_group'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function groups_search_count($search){
        $builder = $this->db->table('saimtech_group');
        $builder->like('group_name', $search);
        $builder->orLike('group_desc', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function groups_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_group');
        $builder->like('group_name', $search);
        $builder->orLike('group_desc', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_active_groups(){  
        $builder = $this->db->table('saimtech_group'); 

        // $this->db->order_by('category_id',"asc");
        $builder->where('is_active', 1);
        $query = $builder->get(); 
         
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }


}