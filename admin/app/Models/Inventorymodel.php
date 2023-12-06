<?php
namespace App\Models;
use CodeIgniter\Model;
class Inventorymodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_product_count(){  
        $builder = $this->db->table('saimtech_inventory_in');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_product($limit, $start){  
        $builder = $this->db->table('saimtech_inventory_in'); 
        $builder->select('saimtech_product.*, title, sale_qty, sale_unit_cost, sale_unit_price,barcode');
        $builder->join('saimtech_product','saimtech_product.product_id=saimtech_inventory_in.product_id'); 
        $builder->join('saimtech_category','saimtech_category.category_id=saimtech_product.category_id'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function product_search_count($search){
        $builder = $this->db->table('saimtech_inventory_in'); 
        $builder->select('saimtech_product.*, title, sale_qty, sale_unit_cost, sale_unit_price,barcode');
        $builder->join('saimtech_product','saimtech_product.product_id=saimtech_inventory_in.product_id'); 
        $builder->join('saimtech_category','saimtech_category.category_id=saimtech_product.category_id'); 

        $builder->groupStart();
            $builder->like('product_name', $search);
            $builder->orLike('product_code', $search);
        $builder->groupEnd();

        $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function product_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }
        $builder = $this->db->table('saimtech_inventory_in'); 
        $builder->select('saimtech_product.*, title, sale_qty, sale_unit_cost, sale_unit_price,barcode');
        $builder->join('saimtech_product','saimtech_product.product_id=saimtech_inventory_in.product_id'); 
        $builder->join('saimtech_category','saimtech_category.category_id=saimtech_product.category_id'); 

        $builder->groupStart();
            $builder->like('product_name', $search);
            $builder->orLike('product_code', $search);
        $builder->groupEnd();

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }


}