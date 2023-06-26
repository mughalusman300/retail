<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use CodeIgniter\API\ResponseTrait;

class Category extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Categorymodel = new Categorymodel();
	    $session = \Config\Services::session();
    }
    public function index(){

        $data['title'] = 'Category List';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $categories = $this->Commonmodel->getAllRecords('saimtech_category');
        $data['main_content'] = 'category/category';
        return view('layouts/page',$data);;
    }

    public function categoryList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Categorymodel->all_categories_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $categories = $this->Categorymodel->all_categories($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $categories =  $this->Categorymodel->categories_search($limit,$start,$search);
            $totalFiltered = $this->Categorymodel->categories_search_count($search);

        }

        $data = array();
        if (!empty($categories)) {

            $i = 1;
            foreach ($categories as $row) {

                $btn_text = ($is_active) ? 'Deactive' : 'Active';
                $action = '<button class="btn btn-primary change-status" 
                    data-category_id="'.$row->category_id.'"
                    data-is_active="'.$row->is_active.'"
                    >'.$btn_text.'</button>
                ';

                $action .= '<button class="btn btn-primary edit-category"
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

                $status = ($is_active) ? 'Active' : 'Deactive';
                $nestedData['status'] = $status;
                $nestedData['Action'] = $action;

                $data[] = $nestedData;

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

        $type = $this->request->getVar('category_id');
        $title = $this->request->getVar('title');
        $code = $this->request->getVar('code');
        $desc = $this->request->getVar('desc');

        $data = array(
            'title' => $title,
            'code' => $code,
            'desc' => $desc,
        );
        if ($type == 'add') {
            $code_exist = $this->Commonmodel->Duplicate_check(array('code' => $code), $tablename);
            
            if (!$code_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_category');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Category code '. $code . 'already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {

            $code_exist = $this->Commonmodel->Duplicate_check(array('code' => $code), $tablename, array('category_id' => $category_id));

            if (!$code_exist) {
                $category_id = $this->request->getVar('category_id');
                $this->Commonmodel->update_record($data,array('category_id' => $category_id), 'saimtech_category');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Category code '. $code . 'already exist. Please try diffrent code';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
}