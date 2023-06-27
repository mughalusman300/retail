<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Productmodel;
use CodeIgniter\API\ResponseTrait;

class Product extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Productmodel = new Productmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Product List';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";
        $data['main_content'] = 'product/product';
        return view('layouts/page',$data);;
    }

    public function productList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Productmodel->all_product_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $products = $this->Productmodel->all_product($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $products =  $this->Productmodel->product_search($limit,$start,$search);
            $totalFiltered = $this->Productmodel->product_search_count($search);

        }
        // echo '<pre>'; print_r($products); die;
        $data = array();
        if (!empty($products)) {

            $i = 1;
            foreach ($products as $row) {
                $action = '<button class="btn btn-outline-theme edit-product"
                    data-product_id="'.$row->product_id.'"
                    data-title="'.$row->title.'"
                    data-code="'.$row->code.'" 
                    data-desc="'.$row->desc.'"
                    >Edit</button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['title'] = $row->title;
                $nestedData['code'] = $row->code;
                $nestedData['desc'] = $row->desc;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-product_id="'.$row->product_id.'" class="form-check-input" id="is_active" '. $checked .'>
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
        $title = $this->request->getVar('title');
        $code = $this->request->getVar('code');
        $desc = $this->request->getVar('desc');

        $data = array(
            'title' => $title,
            'code' => $code,
            'desc' => $desc,
        );

        if ($type == 'add') {
            $code_exist = $this->Commonmodel->Duplicate_check(array('code' => $code), 'saimtech_product');

            if (!$code_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_product');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Product code '. $code . ' already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $product_id = $this->request->getVar('product_id');
            $code_exist = $this->Commonmodel->Duplicate_check(array('code' => $code), 'saimtech_product', array('product_id' => $product_id));

            if (!$code_exist) {
                $product_id = $this->request->getVar('product_id');
                $this->Commonmodel->update_record($data,array('product_id' => $product_id), 'saimtech_product');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Product code '. $code . 'already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $product_id = $this->request->getVar('product_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('product_id' => $product_id), 'saimtech_product');
        $msg = ($is_active) ? 'Product activated successfully!' : 'Product deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
}