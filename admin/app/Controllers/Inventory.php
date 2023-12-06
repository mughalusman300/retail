<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Inventorymodel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\FpdfLib;
use Zend\Barcode\Barcode;

class Inventory extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Inventorymodel = new Inventorymodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Inventory List';
        $data['main_content'] = 'inventory/inventory';
        return view('layouts/page',$data);
    }

    public function invntoryList(){
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        // dd($search);
        $totalData = $this->Inventorymodel->all_product_count();
        $totalFiltered = $totalData;

        if (empty($search)) {
            $products = $this->Inventorymodel->all_product($limit, $start);
        } else {
            $products =  $this->Inventorymodel->product_search($limit,$start,$search);
            $totalFiltered = $this->Inventorymodel->product_search_count($search);

        }
        // echo '<pre>'; print_r($products); die;
        $data = array();
        if (!empty($products)) {

            $i = 1;
            foreach ($products as $row) {
                $barcode_url = URL. '/inventory/product_barcode/'. $row->barcode;
                                            
                $action = '<a  href="'. $barcode_url .'" target="_blank" class="btn btn-outline-theme"
                    data-product_id="'.$row->product_id.'"
                    data-product_code="'.$row->product_code.'" 
                    data-barcode="'.$row->barcode.'"
                    >Barcode</a>
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
                $nestedData['sale_qty'] =  str_replace('.00', '', $row->sale_qty);  
                $nestedData['sale_unit_cost'] =  $row->sale_unit_cost;  
                $nestedData['sale_unit_price'] =  $row->sale_unit_price;  
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

    public function in(){
        $data['title'] = 'Inventory In';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $data['products'] = $products = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1, 'is_deleted' => 0)), 'saimtech_product');
        // dd($products);
        $data['locations'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_location');
        $data['main_content'] = 'inventory/inventoryin';
        return view('layouts/page',$data);
    }


    public function inv_section() {
        $product_id = $this->request->getVar('product_id');
        $data['product'] = $product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id)), 'saimtech_product');
        // dd($product);
        $data['purchase_conversion'] = $purchase_conversion = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id)), 'saimtech_purch_to_inv_conversion');

        $data['inv_conversion'] = $inv_conversion = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id)), 'saimtech_inv_to_sale_conversion');

        $html = view('inventory/inv_section', $data);
        // $html = $parser->setData($data)->render('inventory/inv_section');
        $result = array('success' =>  true, 'html' => $html);
        return $this->response->setJSON($result);
        
        if ($product->v1 != '' || $product->v2 != '' || $product->v3 != '' || $purchase_conversion || $inv_conversion) {
            $html = view('inventory/inv_section', $data);
            // $html = $parser->setData($data)->render('inventory/inv_section');
            $result = array('success' =>  true, 'html' => $html);
            return $this->response->setJSON($result);
        } else {
            $result = array('success' =>  false, 'msg' => 'Not any variant exist');
            return $this->response->setJSON($result);
        }
    }

    public function categoryList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Inventorymodel->all_categories_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $categories = $this->Inventorymodel->all_categories($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $categories =  $this->Inventorymodel->categories_search($limit,$start,$search);
            $totalFiltered = $this->Inventorymodel->categories_search_count($search);

        }
        // echo '<pre>'; print_r($categories); die;
        $data = array();
        if (!empty($categories)) {

            $i = 1;
            foreach ($categories as $row) {
                $action = '<button class="btn btn-outline-theme edit-category"
                    data-category_id="'.$row->category_id.'"
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
                            <input type="checkbox" data-category_id="'.$row->category_id.'" class="form-check-input" id="is_active" '. $checked .'>
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
            $code_exist = $this->Commonmodel->Duplicate_check(array('code' => $code), 'saimtech_category');

            if (!$code_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_category');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Category code '. $code . ' already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $category_id = $this->request->getVar('category_id');
            $code_exist = $this->Commonmodel->Duplicate_check(array('code' => $code), 'saimtech_category', array('category_id' => $category_id));

            if (!$code_exist) {
                $category_id = $this->request->getVar('category_id');
                $this->Commonmodel->update_record($data,array('category_id' => $category_id), 'saimtech_category');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Category code '. $code . 'already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $category_id = $this->request->getVar('category_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('category_id' => $category_id), 'saimtech_category');
        $msg = ($is_active) ? 'Category activated successfully!' : 'Category deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }

    public function create(){
        $result = array('success' =>  false);

        $product_id = $this->request->getVar('product_id');
        $supplier_id = $this->request->getVar('supplier_id');
        $location_id = $this->request->getVar('location_id');
        $date = $this->request->getVar('date');

        $v1 = $v2 = $v3 = '';
        if (isset($_POST['v1'])) {
            $v1 = $this->request->getVar('v1');
        }
        if (isset($_POST['v2'])) {
            $v2 = $this->request->getVar('v2');
        }
        if (isset($_POST['v3'])) {
            $v3 = $this->request->getVar('v3');
        }

        $purch_qty = $this->request->getVar('purch_qty');
        $inv_qty = $this->request->getVar('inv_qty');
        $sale_qty = $this->request->getVar('sale_qty');

        $purch_total_price = $this->request->getVar('purch_total_price');
        $purch_unit_cost = $purch_total_price / $purch_qty;
        $inv_unit_cost = $purch_total_price / $inv_qty;
        $sale_unit_cost = $this->request->getVar('sale_unit_cost');

        $sale_unit_price = $this->request->getVar('sale_unit_price');
        $barcode = trim($this->request->getVar('barcode'));
        $desc = trim($this->request->getVar('desc'));

        $data = array(
            'product_id' => $product_id, 
            'supplier_id' => $supplier_id, 
            'location_id' => $location_id, 
            'v1' => $v1, 
            'v2' => $v2, 
            'v3' => $v3, 
            'purch_qty' => $purch_qty, 
            'inv_qty' => $inv_qty, 
            'sale_qty' => $sale_qty, 
            'purch_total_price' => $purch_total_price, 
            'purch_unit_cost' => $purch_unit_cost, 
            'inv_unit_cost' => $inv_unit_cost, 
            'sale_unit_cost' => $sale_unit_cost, 
            'sale_unit_price' => $sale_unit_price, 
            'barcode' => $barcode, 
            'inv_in_desc' => $desc, 
            'created_by' => $_SESSION['user_id'],
        );

        $insert_id = $this->Commonmodel->insert_record($data, 'saimtech_inventory_in');
        if ($insert_id) {
            $result = array('success' =>  true, 'insert_id' => $insert_id);
        }
        return $this->response->setJSON($result);
    }

    public function validateBarcode(){
        $result = array('success' =>  true);
        $barcode = trim($this->request->getVar('barcode'));
        $length = strlen($barcode);
        if ($length < 12){
            $result = array('success' =>  false, 'msg' => 'Barcode length should not be less than 12 digits');
        } else {
            // $barcode_exist = $this->Commonmodel->Duplicate_check(array('barcode' => $barcode), 'saimtech_inventory_in');
            // if ($barcode_exist) {
            //     $result = array('success' =>  false, 'msg' => 'Barcode already exist');
            // }
        }

        return $this->response->setJSON($result);
    }

    public function product_barcode($barcode){
        // dd($_SESSION);
        // $data['inv_in_id'] = $inv_in_id;

        // dd($inv_in_id);
        $data['barcode'] = $barcode;
        return view('product/print_barcode', $data);
    }
}