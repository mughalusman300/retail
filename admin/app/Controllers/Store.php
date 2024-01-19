<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Storemodel;
use CodeIgniter\API\ResponseTrait;
 
class Store extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Storemodel = new Storemodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Store List';
        // dd(countries);
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['variant'] ="nav-active";
        $data['main_content'] = 'store/store';
        return view('layouts/page',$data);
    }

    public function storeList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Storemodel->all_store_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $store = $this->Storemodel->all_store($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $store =  $this->Storemodel->store_search($limit,$start,$search);
            $totalFiltered = $this->Storemodel->store_search_count($search);

        }
        // echo '<pre>'; print_r($store); die;
        $data = array();
        if (!empty($store)) {
            $i = 1;
            foreach ($store as $row) {
                $action = '
                    <button class="btn btn-outline-theme edit-store"
                        data-store_id="'.$row->store_id.'"
                        data-store_name="'.$row->store_name.'"
                        data-store_code="'.$row->store_code.'" 
                        data-store_phone="'.$row->store_phone.'" 
                        >Edit
                    </button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['store_name'] = $row->store_name;
                $nestedData['store_code'] = $row->store_code;
                $nestedData['store_phone'] = $row->store_phone;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-store_id="'.$row->store_id.'" class="form-check-input" id="is_active" '. $checked .'>
                            <label class="form-check-label" for="customSwitch2">'. $status. '</label>
                        </div>'  ;                          
                $nestedData['is_active'] = $status;
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
        // dd($_POST);
        $result = array('success' =>  false);

        $type = $this->request->getVar('type');
        $store_name = $this->request->getVar('store_name');
        $store_code = $this->request->getVar('store_code');
        $store_phone = $this->request->getVar('store_phone');

        $data = array(
            'store_name' => $store_name,
            'store_code' => $store_code,
            'store_phone' => $store_phone,
        );

        if ($type == 'add') {
            $store_exist = $this->Commonmodel->Duplicate_check(array('store_name' => $store_name), 'saimtech_store');

            if (!$store_exist) {
                $store_code_exist = $this->Commonmodel->Duplicate_check(array('store_code' => $store_code), 'saimtech_store');
                if (!$store_code_exist) {
                    $this->Commonmodel->insert_record($data, 'saimtech_store');
                    $result = array('success' =>  true);
                } else {
                    $msg = 'This Store code '. $store_code . ' already exist. Please try diffrent name';
                    $result = array('success' =>  false, 'msg' => $msg);
                }
                
            } else {
                $msg = 'This Store '. $store_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }

        } else {
            $store_id = $this->request->getVar('store_id');
            $store_exist = $this->Commonmodel->Duplicate_check(array('store_name' => $store_name), 'saimtech_store', array('store_id' => $store_id));
            $this->db = \Config\Database::connect();  
            
            if (!$store_exist) {
                $store_code_exist = $this->Commonmodel->Duplicate_check(array('store_code' => $store_code), 'saimtech_store', array('store_id' => $store_id));
                if (!$store_code_exist) {
                    $store_id = $this->request->getVar('store_id');
                    $this->Commonmodel->update_record($data, array('store_id' => $store_id), 'saimtech_store');
                    $result = array('success' =>  true);
                } else {
                    $msg = 'This Store code '. $store_code . ' already exist. Please try diffrent name';
                    $result = array('success' =>  false, 'msg' => $msg);
                }

            } else {
                $msg = 'This Store '. $store_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        // dd('ok');
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $store_id = $this->request->getVar('store_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('store_id' => $store_id), 'saimtech_store');
        $msg = ($is_active) ? 'Store activated successfully!' : 'Store deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
}