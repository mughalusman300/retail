<?php
namespace App\Models;
use CodeIgniter\Model;
class Productmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_product_count($is_active){  
        $builder = $this->db->table('saimtech_product');
        if ($is_active != '') {
            $builder->where('is_active', $is_active);
        }
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_product($limit, $start, $is_active){  
        $builder = $this->db->table('saimtech_product'); 
        $builder->select('saimtech_product.*, title');
        $builder->join('saimtech_category','saimtech_category.category_id=saimtech_product.category_id'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        if ($is_active != '') {
            $builder->where('saimtech_product.is_active', $is_active);
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function product_search_count($search, $is_active){
        $builder = $this->db->table('saimtech_product');
        $builder->select('saimtech_product.*, title');
        $builder->join('saimtech_category','saimtech_category.category_id=saimtech_product.category_id'); 

        $builder->groupStart();
            $builder->like('product_name', $search);
            $builder->orLike('product_code', $search);
            $builder->orLike('product_desc', $search);
        $builder->groupEnd();

        if ($is_active != '') {
            $builder->where('saimtech_product.is_active', $is_active);
        }
        $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function product_search($limit,$start,$search, $is_active){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_product');
        $builder->select('saimtech_product.*, title');
        $builder->join('saimtech_category','saimtech_category.category_id=saimtech_product.category_id'); 

        $builder->groupStart();
            $builder->like('product_name', $search);
            $builder->orLike('product_code', $search);
            $builder->orLike('product_desc', $search);
        $builder->groupEnd();
            
        if ($is_active != '') {
            $builder->where('saimtech_product.is_active', $is_active);
        }
        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function check_conversion_apply($product_id){  
        $response = false;
        $builder = $this->db->table('saimtech_product');
        $builder->where('saimtech_product.product_id', $product_id);
        $query = $builder->get(); 
        $result = ($query->getNumRows() > 0) ? $query->getRow() : FALSE;
        
        if ($result) {
            if (($result->purch_unit != $result->inv_unit) || $result->inv_unit != $result->sale_unit) {
                $response = true;
            }
        }

        return $response;
    }


}