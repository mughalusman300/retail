<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Inventorymodel;
use CodeIgniter\API\ResponseTrait;

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
        $data['title'] = 'Inventory In';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $data['products'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1, 'is_deleted' => 0)), 'saimtech_product');
        $data['locations'] = $this->Commonmodel->getRows(array('conditions' => array('is_active' => 1)), 'saimtech_location');
        $data['main_content'] = 'inventory/inventoryin';
        return view('layouts/page',$data);
    }


    public function checkVariants() {
        $product_id = $this->request->getVar('product_id');
        $data['product'] = $product = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id)), 'saimtech_product');
        $data['purchase_conversion'] = $purchase_conversion = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('product_id' => $product_id)), 'saimtech_purch_to_inv_conversion');
        // dd($purchase_conversion);
        if ($product->v1 != '' || $product->v2 != '' || $product->v3 != '') {

            $html = view('inventory/variants_section', $data);
            // $html = $parser->setData($data)->render('inventory/variants_section');
            $result = array('success' =>  true, 'html' => $html);
            return $this->response->setJSON($result);
        } else if($purchase_conversion){

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
}