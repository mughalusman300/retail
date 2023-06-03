<?php

namespace App\Models;

use CodeIgniter\Model;

class Mapsdocument_Model extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'saimtech_document';
	protected $primaryKey           = 'doc_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['doc_type','doc_name','doc_description','folder_id','doc_path','folder_name'];

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
//Search the data from DB and pass to controller
	public function getSearchData($match)
	{
	 $query  =$this->db->table('maps_docs')
	 ->join('saimtech_employees', 'saimtech_employees.emp_id = maps_docs.emp_id', 'inner')
	         ->like('doc_name',$match)
	         ->orLike('fname',$match)
	         ->orLike('lname',$match)
             ->get()
             ->getResultArray();	
    return $query;       
	}
//get and pass all docs to controller using this function	
	public function getAllDocuments()
	{
	 $query  =$this->db->table('maps_docs')
	// ->join('saimtech_employees', 'saimtech_employees.emp_id = saimtech_document.emp_id', 'inner')
	         ->orderBy('doc_id', 'DESC')
             ->get()
             ->getResultArray();	
    return $query;       
	}
	// show notification
	public function notification()
	{
	 $query  =$this->db->table('maps_docs')
	// ->join('saimtech_employees', 'saimtech_employees.emp_id = saimtech_document.emp_id', 'inner')
	         ->orderBy('doc_id', 'DESC')
	         ->where('status','1')
             ->get()
            //  ->num_rows();
             ->getResultArray();	
    return count($query);       
	}
	public function getFolder($folder_id)
	{
	 $query  =$this->db->table('saimtech_folder')
	         ->where('folder_id',$folder_id)
             ->get()
             ->getRow();	
    return $query;       
	}
	public function GetFileByFolder($folder_id)
	{
	 $query  =$this->db->table('saimtech_document')
	         ->where('folder_id',$folder_id)
             ->get()
             ->getResult();	
    return $query;       
	}
	public function GetFileById($doc_id)
	{
	 $query  =$this->db->table('saimtech_document')
	         ->where('doc_id',$doc_id)
             ->get()
             ->getRow();	
    return $query;       
	}
	
}
