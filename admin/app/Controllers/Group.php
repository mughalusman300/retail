<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Groupmodel;
use CodeIgniter\API\ResponseTrait;

class Group extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Groupmodel = new Groupmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Group List';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";
        $data['main_content'] = 'group/group';
        return view('layouts/page',$data);
    }

    public function groupList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Groupmodel->all_groups_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $groups = $this->Groupmodel->all_groups($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $groups =  $this->Groupmodel->groups_search($limit,$start,$search);
            $totalFiltered = $this->Groupmodel->groups_search_count($search);

        }
        // echo '<pre>'; print_r($categories); die;
        $data = array();
        if (!empty($groups)) {

            $i = 1;
            foreach ($groups as $row) {
                $action = '<button class="btn btn-outline-theme edit-group"
                    data-group_id="'.$row->group_id.'"
                    data-group_name="'.$row->group_name.'"
                    data-group_desc="'.$row->group_desc.'"
                    >Edit</button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['group_name'] = $row->group_name;
                $nestedData['group_desc'] = $row->group_desc;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-group_id="'.$row->group_id.'" class="form-check-input" id="is_active" '. $checked .'>
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
        $group_name = $this->request->getVar('group_name');
        $group_desc = $this->request->getVar('group_desc');

        $data = array(
            'group_name' => $group_name,
            'group_desc' => $group_desc,
        );

        if ($type == 'add') {
            $group_exist = $this->Commonmodel->Duplicate_check(array('group_name' => $group_name), 'saimtech_group');

            if (!$group_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_group');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Group '. $group_name . ' Already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $group_id = $this->request->getVar('group_id');
            $group_exist = $this->Commonmodel->Duplicate_check(array('group_name' => $group_name), 'saimtech_group', array('group_id' => $group_id));

            if (!$group_exist) {
                $group_id = $this->request->getVar('group_id');
                $this->Commonmodel->update_record($data,array('group_id' => $group_id), 'saimtech_group');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Group '. $group_name . ' Already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $group_id = $this->request->getVar('group_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('group_id' => $group_id), 'saimtech_group');
        $msg = ($is_active) ? 'Group activated successfully!' : 'Group deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
}