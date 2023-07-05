<?php

namespace App\Controllers;
use channelEngine;
use numSeq;
use App\Models\Commonmodel;

class Channel extends BaseController
{

      
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->ChannelEngine = new channelEngine();    
	    $session = \Config\Services::session();
    }

   
    public function index()
    {   
        $data['title']          = "Shop List";
        
        $data["channel_list"]   = $this->Commonmodel->getAllRecords('saimtech_channel');
        
        $data['main_content']   = "channel/channel";
        
        return view('layouts/page',$data);
    }
            
    public function channelList(){
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

}
