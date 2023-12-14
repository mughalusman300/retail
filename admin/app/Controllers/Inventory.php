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
        $totalData = $this->Inventorymodel->all_inv_count();
        $totalFiltered = $totalData;

        if (empty($search)) {
            $products = $this->Inventorymodel->all_inv($limit, $start);
        } else {
            $products =  $this->Inventorymodel->inv_search($limit,$start,$search);
            $totalFiltered = $this->Inventorymodel->inv_search_count($search);

        }
        // echo '<pre>'; print_r($products); die;
        $data = array();
        if (!empty($products)) {

            $i = 1;
            foreach ($products as $row) {
                $barcode_url = URL. '/inventory/product_barcode/'. $row->barcode;
                $detail_url = URL. '/inventory/detail/'. $row->inv_in_id;
                
                if ($row->barcode != '') {
                    $action = '<a  href="'. $barcode_url .'" target="_blank" class="btn btn-outline-theme" style="width:140px">Print Barcode <i class="fa fa-barcode" aria-hidden="true"></i></a>
                    ';
                } else {
                    $action = '<button  type="button" class="btn btn-outline-success generate_barcode" style="width:140px"
                        data-inv_in_id="'.$row->inv_in_id.'"
                        data-product_id="'.$row->product_id.'"
                        data-product_code="'.$row->product_code.'" 
                        >Generate Barcode <i class="fa fa-barcode" aria-hidden="true"></i></button>
                    ';
                }      

                $action.= '<a  href="'. $detail_url .'" target="_blank" class="btn btn-outline-theme" style="width:140px">View Detail <i class="fa fa-eye" aria-hidden="true"></i></a>
                ';                  

                $img = IMGURL.$row->product_img;
                $proudct_detail = URL. '/product/edit/'. $row->product_id;
                $nestedData['product'] = '<div class="d-flex align-items-center">
                                                <div class="w-60px h-60px bg-gray-100 d-flex align-items-center justify-content-center">
                                                    <img alt="" class="mw-100 mh-100" src="'. $img .'">
                                                </div>
                                                <div class="ms-3">
                                                    <a href="'.$proudct_detail.'" target="_blank">'. $row->product_name. '</a>
                                                </div>
                                            </div>';

                $variation = 'N/A';
                if ($row->v1 != '' || $row->v2 != '' || $row->v3 != '') {
                    $variation_arr = array();
                    $variants = $this->Inventorymodel->getProductVariants($row->product_id);
                    if ($row->v1 != '') {
                        $variation_arr[] = '<span class="text-primary" style="font-weight:700">'. $variants['v1'] .'</span>: '. $row->v1;
                    }
                    if ($row->v2 != '') {
                        $variation_arr[] = '<span class="text-success" style="font-weight:700">'. $variants['v2'] .'</span>: '. $row->v2;
                    }
                    if ($row->v3 != '') {
                        $variation_arr[] = '<span class="text-danger" style="font-weight:700">'. $variants['v3'] .'</span>: '. $row->v3;
                    }
                    $variation = implode('<br>', $variation_arr);
                }

                $nestedData['variation'] = $variation;                            
                $nestedData['product_code'] = $row->product_code;
                $nestedData['category_title'] = $row->title;                
                $nestedData['sale_qty'] =  str_replace('.00', '', $row->sale_qty);  
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

    public function create(){
        $result = array('success' =>  true);

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

        $insert_data = array(
            'product_id' => $product_id, 
            'v1' => $v1, 
            'v2' => $v2, 
            'v3' => $v3, 
            'sale_qty' => $sale_qty, 
            'sale_unit_price' => $sale_unit_price, 
            'barcode' => $barcode, 
            // 'created_by' => $_SESSION['user_id'],
            'created_by' => 1,
        );

        
        if ($barcode != '') {

            $already_exits_barcode_detail = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('barcode' => $barcode)), 'saimtech_inventory_in');
            if ($already_exits_barcode_detail) {
                $already_exits_product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $already_exits_barcode_detail->product_id)), 'saimtech_product');

                    if ($product_id != $already_exits_barcode_detail->product_id) {
                        $result = array('success' =>  false, 'msg' => 'Barocde '.$barcode.' is linked with other product '.$already_exits_product->product_name.' please try with different one');
                    } else if($product_id == $already_exits_barcode_detail->product_id && ($v1 != $already_exits_barcode_detail->v1 || $v2 != $already_exits_barcode_detail->v2 || $v3 != $already_exits_barcode_detail->v3)) {
                            $result = array('success' =>  false, 'msg' => 'Barocde '.$barcode.' is linked with an alternate variation of the product '.$already_exits_product->product_name);
                    } else {
                        $updat_inv_in_data['sale_unit_price'] =  $sale_unit_price;
                        $updat_inv_in_data['sale_qty'] =  $already_exits_barcode_detail->sale_qty + $sale_qty;
                        $updat_inv_in_data['update_by'] =  1;
                        $this->Commonmodel->update_record($updat_inv_in_data, array('inv_in_id' => $already_exits_barcode_detail->inv_in_id), 'saimtech_inventory_in');
                        $inv_in_id = $already_exits_barcode_detail->inv_in_id;
                    }

            } else {
                $inv_in_id = $this->Commonmodel->insert_record($insert_data, 'saimtech_inventory_in');
            }
        } else {
            $already_exits_barcode_detail = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id, 'v1' => $v1, 'v2' => $v2, 'v3')), 'saimtech_inventory_in');
            if ($already_exits_barcode_detail) {
                $updat_inv_in_data['sale_unit_price'] =  $sale_unit_price;
                $updat_inv_in_data['sale_qty'] =  $already_exits_barcode_detail->sale_qty + $sale_qty;
                $updat_inv_in_data['update_by'] =  1;
                $this->Commonmodel->update_record($updat_inv_in_data, array('inv_in_id' => $already_exits_barcode_detail->inv_in_id), 'saimtech_inventory_in');
                $inv_in_id = $already_exits_barcode_detail->inv_in_id;
            } else {
                $inv_in_id = $this->Commonmodel->insert_record($insert_data, 'saimtech_inventory_in');
            }
        }
        if ($inv_in_id) {
            $data_detail = array(
                'inv_in_id' => $inv_in_id,
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
                'inv_in_desc' => $desc, 
                // 'created_by' => $_SESSION['user_id'],
                'created_by' => 1,
            );
            $this->Commonmodel->insert_record($data_detail, 'saimtech_inventory_in_detail');
        }
        return $this->response->setJSON($result);
    }

    public function validateBarcode(){
        // ALTER TABLE `saimtech_inventory_in` CHANGE `barcode` `barcode` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '';
        $result = array('success' =>  true, 'msg' => '');
        $barcode = trim($this->request->getVar('barcode'));
        $product_id = trim($this->request->getVar('product_id'));
        $sale_unit_price = trim($this->request->getVar('sale_unit_price'));
        $v1 = trim($this->request->getVar('v1'));
        $v2 = trim($this->request->getVar('v2'));
        $v3 = trim($this->request->getVar('v3'));

        $length = strlen($barcode);
        if ($length < 11){
            $result = array('success' =>  false, 'msg' => 'Barcode length should not be less than 11 digits');
        } else if ($length > 13) {
            $result = array('success' =>  false, 'msg' => 'Barcode length should not be greater than 13 digits');
        } else {
            $already_exits_barcode_detail = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('barcode' => $barcode)), 'saimtech_inventory_in');
            if ($already_exits_barcode_detail) {
                $already_exits_product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $already_exits_barcode_detail->product_id)), 'saimtech_product');

                if ($product_id != $already_exits_barcode_detail->product_id) {
                    $result = array('success' =>  false, 'msg' => 'Barocde '.$barcode.' is linked with other product '.$already_exits_product->product_name.' please try with different one');
                } else if($product_id == $already_exits_barcode_detail->product_id) {
                    if ($v1 != $already_exits_barcode_detail->v1 || $v2 != $already_exits_barcode_detail->v2 || $v3 != $already_exits_barcode_detail->v3) {
                        $result = array('success' =>  false, 'msg' => 'Barocde '.$barcode.' is linked with an alternate variation of the product '.$already_exits_product->product_name);
                    }
                }

                if ($sale_unit_price != $already_exits_barcode_detail->sale_unit_price) {
                    $msg = 'Sale unit price already exist for this product as '. $already_exits_barcode_detail->sale_unit_price. '. It will be updated to the latest sale unit price';
                    $result = array('success' =>  true, 'msg' => $msg);
                }
            } else {
                $already_exits_barcode_detail = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id, 'v1' => $v1, 'v2' => $v2, 'v3')), 'saimtech_inventory_in');
                if ($already_exits_barcode_detail) {
                    $result = array('success' =>  false, 'msg' => 'This product is linked with differnt barcode '.$already_exits_barcode_detail->barcode);
                }

            }


            // $barcode_exist = $this->Commonmodel->Duplicate_check(array('barcode' => $barcode), 'saimtech_inventory_in');
            // if ($barcode_exist) {
            //     $result = array('success' =>  false, 'msg' => 'Barcode already exist');
            // }
        }

        return $this->response->setJSON($result);
    }

    public function product_barcode($barcode){
        $length = strlen($barcode);
        $inv_in_line = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('barcode' => $barcode)), 'saimtech_inventory_in');
        if ($inv_in_line) {
            $product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $inv_in_line->product_id)), 'saimtech_product');
            $data['product'] = $product;
            if ($length == 13) {
                $barcode = substr($barcode, 1);
            } 
            if($length == 13 || $length == 12) {
                $barcode = substr($barcode, 0, -1);
            }
            $data['barcode'] = $barcode;
            return view('product/print_barcode', $data);
        } else {
            echo 'Product Barcode Not Found';
        }
    }

    public function generate_product_barcode(){
        $inv_in_id = trim($this->request->getVar('inv_in_id'));
        $product_id = trim($this->request->getVar('product_id'));

        $new_barcode = $this->Commonmodel->generateProductNewBarcode();
        $data = array('barcode' => $new_barcode);

        $this->Commonmodel->update_record($data, array('inv_in_id' => $inv_in_id), 'saimtech_inventory_in');

        $result = array('success' =>  true);
        return $this->response->setJSON($result);
    }

    public function detail($inv_in_id){
        $data['title'] = 'Inventory Detail';
        $data['main_content'] = 'inventory/inv_detail';
        $data['inv_in_id'] = $inv_in_id;

        //Inventory in parent line
        $row = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('inv_in_id' => $inv_in_id)), 'saimtech_inventory_in');
        $product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $row->product_id)), 'saimtech_product');

        $data['img'] = IMGURL.$product->product_img;
        $data['proudct_detail'] = URL. '/product/edit/'. $product->product_id;
        $data['product_name'] = $product->product_name;
        $data['product'] = $product;

        $barcode = $row->barcode;
        $length = strlen($barcode);
        if ($length == 13) {
            $barcode = substr($barcode, 1);
        } 
        if ($length == 13 || $length == 12) {
            $barcode = substr($barcode, 0, -1);
        }
        
        $data['barcode'] = $barcode;
        $this->Commonmodel->generateProductBarcode($barcode);

        $variation = '';
        if ($row->v1 != '' || $row->v2 != '' || $row->v3 != '') {
            $variation_arr = array();
            $variants = $this->Inventorymodel->getProductVariants($row->product_id);
            if ($row->v1 != '') {
                $variation_arr[] = '<div class="me-3">Variantion =></div> <div class="me-4"><span class="text-primary" style="font-weight:700">'. $variants['v1'] .'</span> : '. $row->v1 .'</div>';
            }
            if ($row->v2 != '') {
                $variation_arr[] = '<div class="me-4"> <span class="text-success" style="font-weight:700">'. $variants['v2'] .'</span> : '. $row->v2 .'</div>';
            }
            if ($row->v3 != '') {
                $variation_arr[] = '<div class="me-4"> <span class="text-danger" style="font-weight:700">'. $variants['v3'] .'</span> : '. $row->v3 .'</div>';
            }
            $variation = implode(' ', $variation_arr);
        }

        $data['variation'] = $variation;

        return view('layouts/page',$data);
    
    }

    public function detailList(){
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        $inv_in_id = $this->request->getVar('inv_in_id');
        // dd($search);
        $totalData = $this->Inventorymodel->all_inv_detail_count($inv_in_id);
        $totalFiltered = $totalData;

        if (empty($search)) {
            $products = $this->Inventorymodel->all_inv_detail($inv_in_id, $limit, $start);
        } else {
            $products =  $this->Inventorymodel->inv_detail_search($inv_in_id, $limit, $start, $search);
            $totalFiltered = $this->Inventorymodel->inv_detail_search_count($inv_in_id, $search);

        }
        $data = array();
        if (!empty($products)) {

            $i = 1;
            foreach ($products as $row) {   

                $nestedData['location'] = $row->location_name;
                $nestedData['category_title'] = $row->title;                
                $nestedData['purch_total_price'] = $row->purch_total_price;                
                $nestedData['sale_qty'] =  str_replace('.00', '', $row->sale_qty);  
                $nestedData['sale_unit_cost'] =  $row->sale_unit_cost;  
                $nestedData['sale_unit_price'] =  $row->sale_unit_price;  

                $date = $row->created_at;
                $date =  strtotime($date);
                $nestedData['date'] =  date('Y-m-d h:i A',$date);  

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
}