<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use CodeIgniter\API\ResponseTrait;

class Category extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
	    $this->Commonmodel = new Commonmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['error'] = '';    
    	$data['main_content'] = 'category/category';
        $categories = $this->Commonmodel->getAllRecords('saimtech_category');	
        $data['categories'] = $categories;
        // echo "<pre>"; print_r($categories);die;
        return view('layouts/page',$data);
    }
}