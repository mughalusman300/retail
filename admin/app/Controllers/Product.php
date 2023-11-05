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
                $edit_url = URL. '/product/edit/'. $row->product_id;
                                            
                $action = '<a  href="'. $edit_url .'" class="btn btn-outline-theme edit-product"
                    data-product_id="'.$row->product_id.'"
                    data-product_code="'.$row->product_code.'" 
                    data-product_desc="'.$row->product_desc.'"
                    >Edit</a>
                ';

                $check = $this->Productmodel->check_conversion_apply($row->product_id);

                $conversion = 0;
                $purch_inv_conv = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $row->product_id, 'active' => 1)), 'saimtech_purch_to_inv_conversion');
                $inv_sale_conv = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $row->product_id, 'active' => 1)), 'saimtech_inv_to_sale_conversion');

                if ($purch_inv_conv) {
                    $conversion = 1;
                }

                if ($inv_sale_conv) {
                    $conversion = 1;
                }

                $purch_inv_conv = json_encode($purch_inv_conv);
                $inv_sale_conv = json_encode($inv_sale_conv);
                if ($check) {
                    $action .= "<button type='button' class='btn btn-outline-theme conversion'
                        data-conversion='".$conversion."'
                        data-purch_inv_conv='".$purch_inv_conv."'
                        data-inv_sale_conv='".$inv_sale_conv."'
                        data-product_id='".$row->product_id."'
                        data-purch_unit='".$row->purch_unit."'
                        data-inv_unit='".$row->inv_unit."' 
                        data-sale_unit='".$row->sale_unit."' 
                        >Conversion</button>
                    ";
                }

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

    public function create(){ 
        $product_name = $this->request->getVar('product_name');
        $product_code = $this->request->getVar('product_code');
        $product_desc = $this->request->getVar('product_desc');
        $v1 = $this->request->getVar('v1');
        $v2 = $this->request->getVar('v2');
        $v3 = $this->request->getVar('v3');
        $inv_unit = $this->request->getVar('inv_unit');
        $purch_unit = $this->request->getVar('purch_unit');
        $sale_unit = $this->request->getVar('sale_unit');
        $group_id = $this->request->getVar('group_id');
        $category_id = $this->request->getVar('category_id');
        $keywords = $this->request->getVar('keywords');
        $product_code_exist = $this->Commonmodel->Duplicate_check(array('product_code' => $product_code), 'saimtech_product');
         // dd($_FILES);
        if (!$product_code_exist) {
            $data = array( 
                'product_name' =>  $product_name,
                'product_code' =>  $product_code,
                'product_desc' =>  $product_desc,
                'v1' =>  $v1,
                'v2' =>  $v2,
                'v3' =>  $v3,
                'inv_unit' =>  $inv_unit,
                'purch_unit' =>  $purch_unit,
                'sale_unit' =>  $sale_unit,
                'group_id' =>  $group_id,
                'category_id' =>  $category_id,
                'keywords' =>  $keywords,
            );

            $product_id = $this->Commonmodel->insert_record($data, 'saimtech_product');


            foreach($_POST['default_image'] as $key => $value){
                $default_image = $this->request->getVar("default_image")[$key];
                $img = $this->request->getFileMultiple("product_img")[$key];

                if ($img != ""){ 
                    $path     = 'assets/img/product';
                    $img_name = $img->getRandomName();
                    $full_db_path = $path."".$img_name;
                    $img->move($path, $img_name);

                    $imag_data = [
                       'product_img' =>  'product/'. $img_name,
                    ];


                }
                if ($img != "") {
                    $img_arr = [
                        'table_name' => 'saimtech_product',
                        'rec_id' => $product_id,
                        'file' =>  'product/'. $img_name,
                    ];
                    $this->Commonmodel->insert_record($img_arr, 'saimtech_attachments');
                }
                if ($default_image == 1 && $img != "") {
                    
                    $this->Commonmodel->update_record($imag_data, array('product_id' => $product_id), 'saimtech_product');
                }
            }
        }

        return redirect()->to('/product/');
    }

    public function edit($product_id){
        $data['title'] = 'Update Product';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";
        // $data['categories'] = $this->Categorymodel->get_active_categories();
        $data['uom'] = $this->Commonmodel->getAllRecords('saimtech_uom');
        $data['categories'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_category');
        $data['variants'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_variant');
        $data['groups'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_group');
        $data['attahements'] = $this->Commonmodel->getRows(array('conditions' => array('rec_id' => $product_id)), 'saimtech_attachments');

        // dd($data['attahements']);
        
        $data['product'] = $product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id)), 'saimtech_product');
        if ($product) {
            $data['main_content'] = 'product/updateProduct';
            return view('layouts/page',$data);;
        } else {
            echo '404 page not found';
        }
        // dd($data['groups']);
    }

    public function update(){ 

        $product_id = $this->request->getVar('product_id');
        $product_name = $this->request->getVar('product_name');
        $product_code = $this->request->getVar('product_code');
        $product_desc = $this->request->getVar('product_desc');
        $v1 = $this->request->getVar('v1');
        $v2 = $this->request->getVar('v2');
        $v3 = $this->request->getVar('v3');
        $inv_unit = $this->request->getVar('inv_unit');
        $purch_unit = $this->request->getVar('purch_unit');
        $sale_unit = $this->request->getVar('sale_unit');
        $group_id = $this->request->getVar('group_id');
        $category_id = $this->request->getVar('category_id');
        $keywords = $this->request->getVar('keywords');
        $product_code_exist = $this->Commonmodel->Duplicate_check(array('product_code' => $product_code), 'saimtech_product' , array('product_id' => $product_id));
        if(!$product_code_exist) {
            
            $update_data = array( 
                'product_name' =>  $product_name,
                'product_code' =>  $product_code,
                'product_desc' =>  $product_desc,
                'v1' =>  $v1,
                'v2' =>  $v2,
                'v3' =>  $v3,
                'inv_unit' =>  $inv_unit,
                'purch_unit' =>  $purch_unit,
                'sale_unit' =>  $sale_unit,
                'group_id' =>  $group_id,
                'category_id' =>  $category_id,
                'keywords' =>  $keywords,
            );
            // dd($update_data);

            $this->Commonmodel->update_record($update_data, array('product_id' => $product_id), 'saimtech_product');
        }

        return redirect()->to('/product/');
    }

    public function add_conversion() {
        // dd(date('Y-m-d H:i:s'));
        $product_id = $this->request->getVar('product_id');
        $purch_unit = $this->request->getVar('purch_unit');
        $inv_unit = $this->request->getVar('inv_unit');
        $sale_unit = $this->request->getVar('sale_unit');

        //Purchase to Inventory Conversion
        $big_unit = $this->request->getVar('big_unit');
        $small_unit_qty = $this->request->getVar('small_unit_qty');
        $small_unit = $this->request->getVar('small_unit');
        $type = $this->request->getVar('type');
        if($type == 'update') {
            $data = array('active' => 0, 'deactivated_by' => $_SESSION['user_id'], 'deactivated_at' => date('Y-m-d H:i:s'));
            $this->Commonmodel->update_record($data, array('product_id' => $product_id, 'active' => 1), 'saimtech_purch_to_inv_conversion');
            $this->Commonmodel->update_record($data, array('product_id' => $product_id, 'active' => 1), 'saimtech_inv_to_sale_conversion');
        }
        if ($big_unit != '' && $small_unit_qty != '' && $small_unit != '') {
            $data = array(
                'product_id' => $product_id,
                'big_unit' => $big_unit,
                'small_unit_qty' => $small_unit_qty,
                'small_unit' => $small_unit,
                'created_by' => $_SESSION['user_id']
            );
            $this->Commonmodel->insert_record($data, 'saimtech_purch_to_inv_conversion');
        }

        //Inventory To Sale Conversion
        $big_unit_2 = $this->request->getVar('big_unit_2');
        $small_unit_qty_2 = $this->request->getVar('small_unit_qty_2');
        $small_unit_2 = $this->request->getVar('small_unit_2');

        if ($big_unit_2 != '' && $small_unit_qty_2 != '' && $small_unit_2 != '') {
            $data = array(
                'product_id' => $product_id,
                'big_unit' => $big_unit_2,
                'small_unit_qty' => $small_unit_qty_2,
                'small_unit' => $small_unit_2,
                'created_by' => $_SESSION['user_id']
            );

            $this->Commonmodel->insert_record($data, 'saimtech_inv_to_sale_conversion');
        }

        return redirect()->to('/product/');
    }

    public function remove_image() {
        $attachment_id = $this->request->getVar('attachment_id');
        $attachment = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('attachment_id' => $attachment_id)), 'saimtech_attachments');

        $this->Commonmodel->Delete_record('saimtech_attachments', 'attachment_id', $attachment_id);
        unlink("assets/img/" . $attachment->file);

        $product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $attachment->rec_id)), 'saimtech_product');

        if ($attachment->file == $product->product_img) {
            // $attachments = $this->Commonmodel->getRows(array('conditions' => array('rec_id' => $product->product_id)), 'saimtech_attachments');
            $this->Commonmodel->update_record(array('product_img' => ''), array('product_id' => $product->product_id), 'saimtech_product');
        }

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }

    public function add_image(){
        $product_id = $this->request->getVar('product_id');
        $default_image = $this->request->getVar('default_image');
        $img = $this->request->getFile("file");

        if ($img != ""){ 
            $path     = 'assets/img/product';
            $img_name = $img->getRandomName();
            $full_db_path = $path."".$img_name;
            $img->move($path, $img_name);

            $imag_data = [
               'product_img' =>  'product/'. $img_name,
            ];


        }
        if ($img != "") {
            $img_arr = [
                'table_name' => 'saimtech_product',
                'rec_id' => $product_id,
                'file' =>  'product/'. $img_name,
            ];
            $attachment_id = $this->Commonmodel->insert_record($img_arr, 'saimtech_attachments');
        }
        if ($default_image == 1 && $img != "") {
            
            $this->Commonmodel->update_record($imag_data, array('product_id' => $product_id), 'saimtech_product');
        }
        $result = array('success' =>  true, 'attachment_id' => $attachment_id);
        return $this->response->setJSON($result);
    }

    public function default_image(){
        $product_id = $this->request->getVar('product_id');
        $attachment_id = $this->request->getVar('attachment_id');
        $attachment = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('attachment_id' => $attachment_id)), 'saimtech_attachments');

        $imag_data = [
            'product_img' =>  $attachment->file,
        ];
        $this->Commonmodel->update_record($imag_data, array('product_id' => $product_id), 'saimtech_product');
        $result = array('success' =>  true);
        return $this->response->setJSON($result);
    }

















}