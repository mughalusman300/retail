<?php

namespace App\Models;

use CodeIgniter\Model;

class Usermodel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'saimtech_users';
	protected $primaryKey           = 'id';
	protected $allowedFields = ['comp_id','name','password','email','power'];
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowed_http_methods = ['get', 'delete', 'post', 'put', 'options', 'patch', 'head'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
    
    public function db(){
	  return $db      = \Config\Database::connect();  
	}
	public function getSearchData($match)
	{
	 $query  =$this->db->table('saimtech_users')
	         ->like('name',$match)
	         ->orLike('email',$match)
             ->get()
             ->getResultArray();	
    return $query;       
	}
}
