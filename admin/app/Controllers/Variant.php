<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Varientmodel;
use CodeIgniter\API\ResponseTrait;

class Variant extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Varientmodel = new Varientmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Variants List';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['variant'] ="nav-active";
        $data['main_content'] = 'variant/variant';
        return view('layouts/page',$data);
    }

    public function variantList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Varientmodel->all_variants_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $variants = $this->Varientmodel->all_variants($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $variants =  $this->Varientmodel->variants_search($limit,$start,$search);
            $totalFiltered = $this->Varientmodel->variants_search_count($search);

        }
        // echo '<pre>'; print_r($variants); die;
        $data = array();
        if (!empty($variants)) {
            $i = 1;
            foreach ($variants as $row) {
                $detial_url = URL.'/variant/view/'.$row->variant_id;
                $action = '
                    <button class="btn btn-outline-theme edit-variant"
                        data-variant_id="'.$row->variant_id.'"
                        data-variant_name="'.$row->variant_name.'"
                        data-variant_desc="'.$row->variant_desc.'" 
                        >Edit
                    </button>
                    <a href="'.$detial_url.'" target="_blank" class="btn btn-outline-theme view-variant">View</a>
                ';

                $nestedData['sr'] = $i;
                $nestedData['variant_name'] = $row->variant_name;
                $nestedData['variant_desc'] = $row->variant_desc;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-variant_id="'.$row->variant_id.'" class="form-check-input" id="is_active" '. $checked .'>
                            <label class="form-check-label" for="customSwitch2">'. $status. '</label>
                        </div>'  ;                          
                $nestedData['status'] = $status;
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
        $variant_name = $this->request->getVar('variant_name');
        $variant_desc = $this->request->getVar('variant_desc');

        $data = array(
            'variant_name' => $variant_name,
            'variant_desc' => $variant_desc,
        );

        if ($type == 'add') {
            $variant_exist = $this->Commonmodel->Duplicate_check(array('variant_name' => $variant_name), 'saimtech_variant');

            if (!$variant_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_variant');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Variant '. $variant_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $variant_id = $this->request->getVar('variant_id');
            $variant_exist = $this->Commonmodel->Duplicate_check(array('variant_name' => $variant_name), 'saimtech_variant', array('variant_id' => $variant_id));
            $this->db = \Config\Database::connect();  

            if (!$variant_exist) {
                $variant_id = $this->request->getVar('variant_id');
                $this->Commonmodel->update_record($data,array('variant_id' => $variant_id), 'saimtech_variant');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Variant '. $variant_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        // dd('ok');
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $variant_id = $this->request->getVar('variant_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('variant_id' => $variant_id), 'saimtech_variant');
        $msg = ($is_active) ? 'Variant activated successfully!' : 'Variant deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
    public function view($id){
        $data['title'] = 'Variants Detail';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['variant'] ="nav-active";
        $variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_id' => $id)), 'saimtech_variant');
        // dd($variant);
        $data['variant'] = $variant;
        $data['main_content'] = 'variant/detail';
        return view('layouts/page',$data);
    }
    public function detailList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $variant_id = $this->request->getVar('variant_id');

        $totalData = $this->Varientmodel->all_variants_detail_count($variant_id);

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $variants_detail = $this->Varientmodel->all_variants_detail($limit, $start, $variant_id);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $variants_detail =  $this->Varientmodel->variants_detail_search($limit,$start,$search, $variant_id);
            $totalFiltered = $this->Varientmodel->variants_detail_search_count($search, $variant_id);

        }
        // echo '<pre>'; print_r($variants_detail); die;
        $data = array();
        if (!empty($variants_detail)) {
            $i = 1;
            foreach ($variants_detail as $row) {
                $action = '
                    <button class="btn btn-outline-theme edit-variant-detail"
                        data-variant_detail_id="'.$row->variant_detail_id.'"
                        data-variant_id="'.$row->variant_id.'"
                        data-variant_detail_name="'.$row->variant_detail_name.'"
                        data-variant_detail_desc="'.$row->variant_detail_desc.'" 
                        >Edit
                    </button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['variant_detail_name'] = $row->variant_detail_name;
                $nestedData['variant_detail_desc'] = $row->variant_detail_desc;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-variant_detail_id="'.$row->variant_detail_id.'" class="form-check-input" id="is_active" '. $checked .'>
                            <label class="form-check-label" for="customSwitch2">'. $status. '</label>
                        </div>'  ;                          
                $nestedData['status'] = $status;
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

    public function add_detail(){
        $result = array('success' =>  false);

        $type = $this->request->getVar('type');
        $variant_detail_name = $this->request->getVar('variant_detail_name');
        $variant_detail_desc = $this->request->getVar('variant_detail_desc');
        $variant_id = $this->request->getVar('variant_id');

        $data = array(
            'variant_id' => $variant_id,
            'variant_detail_name' => $variant_detail_name,
            'variant_detail_desc' => $variant_detail_desc,
        );

        if ($type == 'add') {
            $variant_exist = $this->Commonmodel->Duplicate_check(array('variant_detail_name' => $variant_detail_name), 'saimtech_variant_detail');

            if (!$variant_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_variant_detail');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Variant '. $variant_detail_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $variant_detail_id = $this->request->getVar('variant_detail_id');
            $variant_exist = $this->Commonmodel->Duplicate_check(array('variant_detail_name' => $variant_detail_name), 'saimtech_variant_detail', array('variant_detail_id' => $variant_detail_id));
            $this->db = \Config\Database::connect();  

            if (!$variant_exist) {
                $variant_detail_id = $this->request->getVar('variant_detail_id');
                $this->Commonmodel->update_record($data,array('variant_detail_id' => $variant_detail_id), 'saimtech_variant_detail');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Variant '. $variant_detail_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        // dd('ok');
        return $this->response->setJSON($result);
    }

    public function statusUpdateDetail(){
        $variant_detail_id = $this->request->getVar('variant_detail_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('variant_detail_id' => $variant_detail_id), 'saimtech_variant_detail');
        $msg = ($is_active) ? 'Variant activated successfully!' : 'Variant deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
}