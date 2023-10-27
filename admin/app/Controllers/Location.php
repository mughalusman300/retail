<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Locationmodel;
use CodeIgniter\API\ResponseTrait;
 
class Location extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Locationmodel = new Locationmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Location List';
        // dd(countries);
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['variant'] ="nav-active";
        $data['main_content'] = 'location/location';
        return view('layouts/page',$data);
    }

    public function locationList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Locationmodel->all_locations_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $locations = $this->Locationmodel->all_locations($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $locations =  $this->Locationmodel->locations_search($limit,$start,$search);
            $totalFiltered = $this->Locationmodel->locations_search_count($search);

        }
        // echo '<pre>'; print_r($locations); die;
        $data = array();
        if (!empty($locations)) {
            $i = 1;
            foreach ($locations as $row) {
                $action = '
                    <button class="btn btn-outline-theme edit-location"
                        data-location_id="'.$row->location_id.'"
                        data-location_name="'.$row->location_name.'"
                        data-location_city="'.$row->location_city.'" 
                        data-location_country="'.$row->location_country.'" 
                        >Edit
                    </button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['location_name'] = $row->location_name;
                $nestedData['location_city'] = $row->location_city;
                $nestedData['location_country'] = $row->location_country;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-location_id="'.$row->location_id.'" class="form-check-input" id="is_active" '. $checked .'>
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
        $location_name = $this->request->getVar('location_name');
        $location_city = $this->request->getVar('location_city');
        $location_country = $this->request->getVar('location_country');

        $data = array(
            'location_name' => $location_name,
            'location_city' => $location_city,
            'location_country' => $location_country,
        );

        if ($type == 'add') {
            $location_exist = $this->Commonmodel->Duplicate_check(array('location_name' => $location_name), 'saimtech_location');

            if (!$location_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_location');
                $result = array('success' =>  true);
            } else {
                $msg = 'This location '. $location_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $location_id = $this->request->getVar('location_id');
            $location_exist = $this->Commonmodel->Duplicate_check(array('location_name' => $location_name), 'saimtech_location', array('location_id' => $location_id));
            $this->db = \Config\Database::connect();  

            if (!$location_exist) {
                $location_id = $this->request->getVar('location_id');
                $this->Commonmodel->update_record($data, array('location_id' => $location_id), 'saimtech_location');
                $result = array('success' =>  true);
            } else {
                $msg = 'This location '. $location_name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        // dd('ok');
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $location_id = $this->request->getVar('location_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('location_id' => $location_id), 'saimtech_location');
        $msg = ($is_active) ? 'Location activated successfully!' : 'Location deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
}