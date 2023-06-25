<?php

namespace App\Controllers;

//------Use Engines
use channelEngine;

class Channel extends BaseController
{

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
	    $this->Commonmodel = new Commonmodel();
	    $session = \Config\Services::session();
        $_SESSION['title']="Shop";
    }

    public function index()
    {   $data = array();
        //-----data
        $data['title']="Shop";
        $data['shops']=$this->Commonmodel->getRows(array('conditions' => array('created_by' => $_SESSION['user_id'])), 'saimtech_channel');
        //----output
        return view('channel/view');
    }

    public function add()
    {
        //channelEngine.create();
    }

    public function edit()
    {

    }

    public function delete()
    {

    }


}
