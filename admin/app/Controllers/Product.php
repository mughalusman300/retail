<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Productmodel;
use App\Models\Categorymodel;
use CodeIgniter\API\ResponseTrait;

class Product extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
        $this->Productmodel = new Productmodel();
	    $this->Categorymodel = new Categorymodel();
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
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        $is_active = $this->request->getVar('is_active');
        // dd($search);
        $totalData = $this->Productmodel->all_product_count($is_active);
        $totalFiltered = $totalData;

        if (empty($search)) {
            $products = $this->Productmodel->all_product($limit, $start, $is_active);
        } else {
            $products =  $this->Productmodel->product_search($limit,$start,$search, $is_active);
            $totalFiltered = $this->Productmodel->product_search_count($search, $is_active);

        }
        // echo '<pre>'; print_r($products); die;
        $data = array();
        if (!empty($products)) {

            $i = 1;
            foreach ($products as $row) {
                $nestedData['check'] = '<div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox"
                                                data-product_id="'.$row->product_id.'"
                                                data-product_code="'.$row->product_code.'" 
                                                data-product_desc="'.$row->product_desc.'"
                                                >
                                                <label class="form-check-label" for="checkbox"></label>
                                            </div>';
                $action = '<button class="btn btn-outline-theme edit-product"
                    data-product_id="'.$row->product_id.'"
                    data-product_code="'.$row->product_code.'" 
                    data-product_desc="'.$row->product_desc.'"
                    >Edit</button>
                ';

                $img = IMGURL.$row->product_img;
                $nestedData['product'] = '<div class="d-flex align-items-center">
                                                <div class="w-60px h-60px bg-gray-100 d-flex align-items-center justify-content-center">
                                                    <img alt="" class="mw-100 mh-100" src="'. $img .'">
                                                </div>
                                                <div class="ms-3">
                                                    <a href="page_product_details.html">'. $row->product_name. '</a>
                                                </div>
                                            </div>';
                $nestedData['product_code'] = $row->product_code;
                $nestedData['category_title'] = $row->title;

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
        $data['title'] = 'Product';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";
        // $data['categories'] = $this->Categorymodel->get_active_categories();
        $data['uom'] = $this->Commonmodel->getAllRecords('saimtech_uom');
        $data['categories'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_category');
        $data['variants'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_variant');
        $data['groups'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_group');
        // dd($data['groups']);
        $data['main_content'] = 'product/addProduct';
        return view('layouts/page',$data);;
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