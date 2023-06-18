<?= $this->extend('layouts/app') ?>
<?= $this->section('main-content') ?>
<main id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--<a href="javascript:history.back()" class="btn btn-danger">Go Back</a><br>-->
                     <a href="javascript:history.back()" ><img src="<?= base_url(); ?>/public/asset/back.png" style="width:30px;"></a><br><br>
                    <h1>Folder Creation</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">MAPS PH MANAGEMENT</a>
                            </li>
                        </ol>
                    </nav>
                    <div class="separator"></div>
                </div>
            </div>
            
            <!--  CRUD OF MAPS Policies     -->
            <div class="card col-12">
                  <div class="position-absolute card-top-buttons">
                      <button class="btn btn-header-light icon-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <!--<i class="simple-icon-refresh"></i>-->
                      </button>
                  </div>
                    <div class="card-body">
                    
                    <p class="mb-0">
                        <button type="button" id="createFolder" class="btn btn-outline-primary" >Add New Folder</button>

                    </p>
                   
                      <!--  <div class="input-group typeahead-container">-->
                      <!--      <input type="text" v-model="searchWord"  class="form-control" name="query" id="query" placeholder="Search By Name,Employee First and Last Name..."  autocomplete="off" v-on:keyup="search">-->

                      <!--      <div class="input-group-append ">-->
                      <!--          <button type="submit" class="btn btn-primary default" @click="search">-->
                      <!--              <i class="simple-icon-magnifier"></i>-->
                      <!--          </button>-->
                      <!--      </div>-->
                      <!--  </div>-->
                <!--<div class="separator mb-3"></div>-->
                
                
                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <!--     <table id="myTable"> -->
                        <thead>
                            <tr>
                               
                                <th>Folder Name</th>
                                 <th>Folder Description</th>
                                <th>Action</th>

                                
                            </tr>
                        </thead>
                        <!-- Fetch rows from DB using key-->
                        <tbody>
                            <?php foreach($folders as $row):
                                $i =1;
                            ?>
                            
                            <tr>
                               
                                <td><?= $row['folder_name'];?></td>
                                <td><?= $row['folder_descryption'];?></td>
                                <td>
                                    <a href="<?php echo base_url();?>/Maps_documents/view_folder/<?php echo $row['folder_id'];?>" type="button" class="btn btn-info default btn-xs">View</a>
                                    <button type="button" id="edit" 
                                    data-folder_id = "<?php echo $row['folder_id'];?>"
                                    data-folder_name = "<?php echo $row['folder_name'];?>"
                                    data-folder_desc = "<?php echo $row['folder_descryption'];?>"
                                     class="btn btn-warning btn-xs edit default">Edit</button>
                                    <button type="button"  id="delete" class="btn btn-danger btn-xs default delete">Delete</button>
                                </td>
                                
                            </tr>
                            <?php $i++; endforeach;?>
                          
                        </tbody>
                    </table>
                    <div class="text-center" v-if="loading">
                       <b-spinner variant="info" class="mt-5 mb-5" style="width: 4rem; height: 4rem;" label="Large Spinner"></b-spinner>
                    </div>
                </div>
            
            </div>
        </div>
<!------floder Add Model ---->      
<div class="modal fade modal-right" id="createDocument" tabindex="-1" role="dialog" aria-labelledby="createDocument" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Add New Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- <form> -->
                <form method="POST" action="<?php echo base_url()?>/Maps_documents/create_folder">

                    <div class="alert alert-info form-group" role="alert">
                        Note: All Fields Required.
                    </div>
                    <div class="form-group required">
                        <label class="has-float-label"><span>Folder Name <font style="color: red;">*</font></span></label>
                        <input type="text" name="folder_name" tabindex="1" class="form-control" placeholder="">
                    <p style="color: red" ></p>    
                    </div>
                     <div class="form-group required">
                        <label class="has-float-label"><span>Folder Description <font style="color: red;">*</font></span></label>
                        <input type="text" name="folder_desc" tabindex="1" class="form-control" placeholder="">
                    <p style="color: red" ></p>    
                    </div>
                    <!-- <div class="form-group">
                        <label class="has-float-label"><span>Description<font style="color: red;">*</font></span></span></label>
                       <input v-model="doc_description" type="text" tabindex="2" class="form-control" placeholder="">
                        <p style="color: red" v-if="doc_description_error!=''">{{doc_description_error}}</p>    
                    </div>
                    <div class="form-group">
                        <label class="has-float-label"><span>Employee<font style="color: red;">*</font></span></label>
                        <select v-model="emp_id" tabindex="4" class="form-control">
                             <option value="">Choose</option>
                              <option v-for="option in allEmployees" v-bind:value="option.emp_id">
                              {{ option.emp_id }}   {{ option.fname }} {{ option.lname }} 
                             </option>
                        </select>
                        <p style="color: red" v-if="emp_id!=''">{{emp_id_error}}</p> 
                    </div> -->
                    <!--<label>File<font style="color: red;">*</font></label></br>-->
                    <!--<input type="file" name="onefile" id="onefile">-->
                    <!--<p>Etc. Word,Excel,Pdf</p>-->
                    <!--    <p></p></p> -->

                
               
            </div>
            <div class="modal-footer">
                <button type="button"  tabindex="6" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <button  type="submit"  tabindex="5" class="btn btn-primary" >Submit</button>
            </div>
              </form> 
        </div>
    </div>
</div>  
<!------- folder end------->
<div class="modal fade modal-right" id="updateDocument" tabindex="-1" role="dialog" aria-labelledby="createDocument" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Update Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- <form> -->
                <form method="POST" action="<?php echo base_url()?>/Maps_documents/update_folder">

                    <div class="alert alert-info form-group" role="alert">
                        Note: All Fields Required.
                    </div>
                    <div class="form-group required">
                        <label class="has-float-label"><span>Folder Name <font style="color: red;">*</font></span></label>
                        <input type="hidden" name="folder_id" id="folder_id" tabindex="1" class="form-control" placeholder="">
                        <input type="hidden" name="folder_old_name" id="folder_old_name" tabindex="1" class="form-control" placeholder="">
                        <input type="text" name="folder_name" id="folder_name" tabindex="1" class="form-control" placeholder="">
                        <p style="color: red;display: none" id="folder_name_error">Required!</p> 
                    <p style="color: red" ></p>    
                    </div>
                     <div class="form-group required">
                        <label class="has-float-label"><span>Folder Description <font style="color: red;">*</font></span></label>
                        <input type="text" name="folder_desc" id="folder_desc" tabindex="1" class="form-control" placeholder="">
                    <p style="color: red;display: none" id="folder_desc_error">Folder Name Required!</p>   
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button"  tabindex="6" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <button  type="submit" id="update" tabindex="5" class="btn btn-primary" >Update</button>
            </div>
              </form> 
        </div>
    </div>
</div>  
<!---- update modal end----->       
    </main>
<script type="text/javascript">
// Validation
 
$(document).ready(function(){
    $("#createFolder").click(function(){
        $("#createDocument").modal("show");
        
    });
    $(".edit").click(function(){
        $("#updateDocument").modal("show");
        var folder_id = $(this).data("folder_id");
        var folder_name = $(this).data("folder_name");
        var folder_desc = $(this).data("folder_desc");
        $("#folder_id").val(folder_id);
        $("#folder_name").val(folder_name);
        $("#folder_old_name").val(folder_name);
        $("#folder_desc").val(folder_desc);
    })
    $("#update").click(function(){
        var check = "Pass";
       var name =$("#folder_name").val();
        var folder_desc = $("#folder_desc").val();
        if(name!=""){
            $('#folder_name_error').css("display","none");
        }
        else{
            $('#folder_name_error').css("display","block");
            check = "Fail";
        }
        if(check=="Fail"){
            return false;
        }
    })
})  
</script>    

<?php 
$session = \Config\Services::session();
    $message = $session->getFlashdata('message');
    $message_type = $session->getFlashdata('message_type');
    if (isset($message)){ ?>
        <script type="text/javascript">
            var message_type = "<?php echo $message_type;?>";
            var message = "<?php echo $message;?>";
            console.log(message_type);
            $(document).ready(function() {
                Swal.fire({
                  position: 'top-end',
                  icon: message_type,
                  title: message,
                  showConfirmButton: false,
                  timer: 1500
                })
    });
</script>
        <?php } ?>  
<?= $this->endSection() ?>    
