<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Uommodel;
use CodeIgniter\API\ResponseTrait;

class Uom extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Uommodel = new Uommodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'UOM List';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $uom = $this->Commonmodel->getAllRecords('saimtech_uom');
        $data['uom'] = $uom;
        $data['main_content'] = 'uom';
        return view('layouts/page',$data);
    }

    public function uomList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Uommodel->all_uom_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $uom = $this->Uommodel->all_uom($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $uom =  $this->Uommodel->uom_search($limit,$start,$search);
            $totalFiltered = $this->Uommodel->uom_search_count($search);

        }
        // echo '<pre>'; print_r($uom); die;
        $data = array();
        if (!empty($uom)) {

            $i = 1;
            foreach ($uom as $row) {
                $action = '
                    <button class="btn btn-outline-theme edit-uom"
                        data-uom_id="'.$row->uom_id.'"
                        data-uom_name="'.$row->uom_name.'"
                        data-uom_code="'.$row->uom_code.'" 
                    >Edit</button>
                    <button class="btn btn-outline-theme delete-uom"
                        data-uom_id="'.$row->uom_id.'"
                    >Delete</button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['uom_name'] = $row->uom_name;
                $nestedData['uom_code'] = $row->uom_code;
                $nestedData['Action'] = $action;

                $data[] = $nestedData;

                $i++;
            }

        }

        $json_data = array(
            "draw"            => intval($this->request->getVar('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function add(){
        $result = array('success' =>  false);

        $type = $this->request->getVar('type');
        $uom_name = $this->request->getVar('uom_name');
        $uom_code = $this->request->getVar('uom_code');

        $data = array(
            'uom_name' => $uom_name,
            'uom_code' => $uom_code,
        );

        if ($type == 'add') {
            $code_exist = $this->Commonmodel->Duplicate_check(array('uom_code' => $uom_code), 'saimtech_uom');
 
            if (!$code_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_uom');
                $result = array('success' =>  true);
            } else {
                $msg = 'This UOM code '. $uom_code . ' already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $uom_id = $this->request->getVar('uom_id');
            $code_exist = $this->Commonmodel->Duplicate_check(array('uom_code' => $uom_code), 'saimtech_uom', array('uom_id' => $uom_id));

            if (!$code_exist) {
                $uom_id = $this->request->getVar('uom_id');
                $this->Commonmodel->update_record($data, array('uom_id' => $uom_id), 'saimtech_uom');
                $result = array('success' =>  true);
            } else {
                $msg = 'This UOM code '. $uom_code . ' already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function delete(){
        $uom_id = $this->request->getVar('uom_id');
        $this->Commonmodel->update_record(array('is_deleted' => 1), array('uom_id' => $uom_id), 'saimtech_uom');
        $result = array('success' =>  true);
        return $this->response->setJSON($result);
    }
}