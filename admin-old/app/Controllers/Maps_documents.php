<?php

namespace App\Controllers;
use App\Models\Mapsdocument_Model;
use App\Models\Commonmodel;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\API\ResponseTrait;
// use CodeIgniter\HTTP\Files\UploadedFile;

use App\Controllers\BaseController;

class Maps_documents extends BaseController
{
use ResponseTrait;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        date_default_timezone_set('Asia/Karachi');
        // $session = \Config\Services::session($config);
        $this->Mapsdocument_Model = new Mapsdocument_Model();
        $this->Commonmodel = new Commonmodel();
         helper(['form', 'url']);
         $session = \Config\Services::session();
    }
    // go to the UI docs and perform (CRUD)
    public function index()
    {
          $nm = new Mapsdocument_Model();
        $badge['bd'] = $nm->notification();
        
        return view('mapsdocuments/index',$badge);
    }
    // Create the folder
     public function folder()
    {
        $data['folders']=$this->Commonmodel->Get_all_record('saimtech_folder');
        // print_r($data['folders']);exit;
        return view('document/folder_view',$data);
    }
    // Show Other Maps Member Folder
    public function showonly()
    {   
        $dataf['folders']=$this->Commonmodel->Get_all_record('saimtech_folder');
        return view('document/only_folder_view',$dataf);
    }
    public function create_folder(){
        $folder_name = $this->request->getVar('folder_name');
        $folder_name = str_replace(' ', '', $folder_name);
        $folder_desc = $this->request->getVar('folder_desc');
        if(!is_dir('uploads/'.$folder_name)){
            mkdir('./uploads/'.$folder_name,0777,true);
            $data = array(
                'folder_name'=> $folder_name,
                'folder_descryption'=> $folder_desc,
                );
                $this->Commonmodel->Insert_record('saimtech_folder',$data);
                return redirect()->to('folder');
            
        }
        else{
            $data["error"] ="folder already exist";
            return redirect()->to('folder');
        }
    }
    public function update_folder(){
        $session = \Config\Services::session();
        $folder_name = $this->request->getVar('folder_name');
        $folder_name = str_replace(' ', '', $folder_name);
        $folder_old_name = $this->request->getVar('folder_old_name');
        $folder_desc = $this->request->getVar('folder_desc');
        $folder_id = $this->request->getVar('folder_id');
        $data = array(
            'folder_name'=> $folder_name,
            'folder_descryption'=> $folder_desc,
            );
        // rename("/uploads/usman", "/uploads/waqar");
       $oldname = './uploads/'.$folder_old_name;
        $newname = './uploads/'.$folder_name;
        if(is_dir('uploads/'.$folder_old_name)){
            if(rename($oldname, $newname)){
               echo "Directory has been renamed";
            } else {
               echo "Fail to rename directory";
            }
            $this->Commonmodel->Update_record('saimtech_folder','folder_id',$folder_id,$data);
            $session->setFlashdata("message_type", "success");
            $session->setFlashdata("message","Folder Rename Successfully");
        }    
        $this->Commonmodel->Update_record('saimtech_folder','folder_id',$folder_id,$data);
        return redirect()->to('folder');
    }
    public function view_folder($folder_id){
        $result  = $this->Mapsdocument_Model->getFolder($folder_id);
        $data['folder_id'] = $result->folder_id;
        $data['folder_name'] = $result->folder_name;
        $data['files']=$this->Mapsdocument_Model->GetFileByFolder($result->folder_id);
        // print_r($data['files']);
        return view('mapsdocuments/view_folder',$data);
        
    }
    public function show_only_maps_member_view_folder($folder_id){
        $result  = $this->Mapsdocument_Model->getFolder($folder_id);
        $data['folder_id'] = $result->folder_id;
        $data['folder_name'] = $result->folder_name;
        $data['files']=$this->Mapsdocument_Model->GetFileByFolder($result->folder_id);
        // print_r($data['files']);
        return view('mapsdocuments/show_members_folder_files',$data);
        
    }
    public function create_file(){
        $doc_name = $this->request->getVar('doc_name');
        $doc_description = $this->request->getVar('doc_description');
        $folder_id = $this->request->getVar('folder_id');
        $folder_name = $this->request->getVar('folder_name');
        $user_id = $_SESSION['user_id'];
         $rules = [
            'doc_name' => ['rules' => 'required|min_length[2]|max_length[50]', 'label' => 'Name'],
            'doc_description' => ['rules' => 'required|min_length[3]|max_length[250]', 'label' => 'Description'],
           // 'emp_id' => ['rules' => 'required', 'label' => 'Employee'],
            'onefile' =>['rules' => 'uploaded[onefile]|max_size[onefile,204800]|mime_in[onefile,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,video/mp4]', 'label' => 'File'],

        
        ];
         if (!$this->validate($rules)) {
             $errors = $this->validator->getErrors();
            return $this->fail($errors);
        }
        else{
            
            $img = $this->request->getFile('onefile');
            if($img!=""){
             $extension = $img->getClientExtension();
             $newName = $img->getName();
             $path = "uploads/".$folder_name."/";
             $full_db_path = $path."".$newName;
             $img->move($path, $newName);
             }
             $data =[
                 'doc_name'  => $this->request->getVar('doc_name'),
                 'folder_id'  => $folder_id,
                 'doc_description'  => $this->request->getVar('doc_description'),
                 'doc_type'  => $extension,
                 'doc_path'  => $full_db_path,

            ];
            $this->Mapsdocument_Model->insert($data);
            return redirect()->to('view_folder/'.$folder_id);
            }   
            
    }
    // Fetch the docs and show in each portal
    public function mapsDocuments(){
        $nm = new Mapsdocument_Model();
        $badge['bd'] = $nm->notification();        

         return view('mapsdocuments/mapsdocuments_Show',$badge);
    }
    // Fetch the docs
    public function getAllDocuments()
    {

        $documents = $this->Mapsdocument_Model->getAllDocuments();
   
        return $this->response->setJSON($documents);
    }
    // Create the docs and store in DB and send to each portal
    public function create()
    {
        
         
         $user_id = $_SESSION['user_id'];
         $rules = [
            'doc_name' => ['rules' => 'required|min_length[2]|max_length[50]', 'label' => 'Name'],
            'doc_description' => ['rules' => 'required|min_length[3]|max_length[250]', 'label' => 'Description'],
           // 'emp_id' => ['rules' => 'required', 'label' => 'Employee'],
            'onefile' =>['rules' => 'uploaded[onefile]|max_size[onefile,204800]|mime_in[onefile,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,video/mp4]', 'label' => 'File'],

        
        ];
         if (!$this->validate($rules)) {
             $errors = $this->validator->getErrors();
            return $this->fail($errors);
        }
        else{
            // $em = new Excel_import_model();
           // $allmails = $em->getemails();   
            $img = $this->request->getFile('onefile');
            // changes
            // $folder = $this->request->getVar('doc_name');
            // $path = "public/Mapsdocs/";
            // if(!is_dir($path)){
            // $newfolder = mkdir($path.$folder.'/');   
            // }
            // $fpath = "public/Mapsdocs/".$folder."/";
            if($img!=""){
             $extension = $img->getClientExtension();
             $newName = $img->getName();
             $path = "public/Mapsdocs/";
             $full_db_path = $path."".$newName;
             $img->move($path, $newName);
             }
             $data =[
                 'doc_name'  => $this->request->getVar('doc_name'),
                 'doc_description'  => $this->request->getVar('doc_description'),
                 'doc_type'  => $extension,
                 'doc_path'  => $full_db_path,
                //  'folder_name' => $folder,
                 //'created_by'  => $user_id,
                 //'emp_id'  => $this->request->getVar('emp_id'),

            ];
            $this->Mapsdocument_Model->insert($data);
            // return view('mapsdocuments/index');
           // return $this->response->redirect(base_url('/mapsdoc'));
            
            
                // // //    ======EMAIL --- SENDING --- CODE =================             
                //      $email = \Config\Services::email();
                //     //  $token = $userdata['emp_id'];
                //       $email->setTo($allmails);
                //       $email->setFrom('hr@tritechnologies.net', 'MAPS');     
                //       $email->setSubject('Referral Uploaded');
                //       $email->setMessage('Hi '.'<br><br>'
                //      . 'Referral has been Uploaded.<br> Please click'
                //       . ' the below link to open your Account.<br><br>'
                //                 . '<a href="'. base_url().'/login/'.'">Click here to Login</a><br><br>'
                //                 . 'Thanks<br>Maps'); 

                //       if ($email->send(false)) 
                //             {
                              
                //             } 
                //         else 
                //         {
                //                 $data = $email->printDebugger(['headers']);
                //                 print_r($data);
                //             }

            }   
            
          
    }
    // Delete the Docs
    public function delete($doc_id){
        $file=$this->Mapsdocument_Model->GetFileById($doc_id);
        $folder_id = $file->folder_id;
        $this->Commonmodel->Delete_record('saimtech_document','doc_id',$doc_id);
        return redirect()->to('/Maps_documents/view_folder/'.$folder_id);
        
    }
    public function deleteDocument($id)
    {
         //$this->Mapsdocument_Model->where('doc_id', $id)->delete();
    }
    // public function download($file)
    // {

    //    // echo $file;
    // // $pathToFile = storage_path('public/img/'.$file);
    //  $path ='/public/img/1.jpg';
    //  //echo $path;
    //     return $this->response->download($path, null);
    // }
    // Search the docs
    public function search(){
        $searchkeyword = $this->request->getVar('s');
        $search = $this->Mapsdocument_Model->getSearchData($searchkeyword);
        return $this->response->setJSON($search);
    }
    Public function getEmployees(){
        $employees = $this->Commonmodel->Get_all_record('saimtech_employees');  
        return $this->response->setJSON($employees);
    }
    
    // Show Notification 
     public function showbadge()
    {
        $nm = new Mapsdocument_Model();
        $badge['bd'] = $nm->notification();
       // return $this->response->setJSON($badge);

        return view('layouts/sidebar',$badge);
    }
    // change status of Documents
    // Disable the  User by clicking Button
     public function changestatus(){
   
        $builder = new Mapsdocument_Model();
        $builder->set('status',0)->update();
        //console.log($builer);
       // return $this->response->redirect(base_url('/users-list'));
    }
}
