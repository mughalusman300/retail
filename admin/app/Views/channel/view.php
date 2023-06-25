<!DOCTYPE html>
<html lang="en">

<head>
 <?= $this->include('layouts/head') ?>   
</head>

<body>
    <!-- BEGIN #app -->
    <div id="app" class="app">

        <?php if(!isset($_SESSION['user_id'])): ?>
            <?php header("Location:".URL);
            exit();
        ?>
        <?php else :?>
        <?= $this->include('layouts/header') ?> 
        <?= $this->include('layouts/sidebar') ?>    
        
        <div class="container">
				<!-- BEGIN row -->
				<div class="row justify-content-center">
					<!-- BEGIN col-10 -->
					<div class="col-xl-10">
						<!-- BEGIN row -->
						<div class="row">
							<!-- BEGIN col-9 -->
							
                            <div class="d-flex align-items-center mb-3">
                                <div>
								    <ul class="breadcrumb">
									    <li class="breadcrumb-item"><a href="#">Shops</a></li>
									    <li class="breadcrumb-item active">Shops List</li>
								    </ul>
								    <h1 class="page-header">
									    Shops List <small>Your store's information</small>
								    </h1>
                                </div>
                                <div class="ms-auto">
					                <a href="#" class="btn btn-theme"><i class="fa fa-plus-circle fa-fw me-1"></i> Create Shop</a>
				                </div>
                            </div>
                            
                            <div class="mb-md-4 mb-3 d-md-flex">
				                <div class="mt-md-0 mt-2"><a href="#" class="text-body text-decoration-none"><i class="fa fa-download fa-fw me-1 text-muted"></i> Export</a></div>
				                    <div class="ms-md-4 mt-md-0 mt-2 dropdown-toggle">
					                    <a href="#" data-bs-toggle="dropdown" class="text-body text-decoration-none" aria-expanded="false">More Actions</a>
					                    <div class="dropdown-menu" style="">
						                    <a class="dropdown-item" href="#">Action</a>
						                    <a class="dropdown-item" href="#">Active All</a>
						                    <a class="dropdown-item" href="#">De Active All</a>
						                    <div role="separator" class="dropdown-divider"></div>
						                    <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
				                    </div>
			                    </div>
			

                                <div class="card">
				                    <ul class="nav nav-tabs nav-tabs-v2 px-4" role="tablist">
					                    <li class="nav-item me-3" role="presentation"><a href="#allTab" class="nav-link px-2 active" data-bs-toggle="tab" aria-selected="true" role="tab">All</a></li>
					                </ul>
				                    <div class="tab-content p-4">
					                    <div class="tab-pane fade active show" id="allTab" role="tabpanel">
						                    <!-- BEGIN input-group -->
						                    <div class="input-group mb-4">
							                    <div class="flex-fill position-relative">
								                    <div class="input-group">
									                    <input type="text" class="form-control ps-35px" placeholder="Filter orders">
									                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0" style="z-index: 1020;">
										                    <i class="fa fa-search opacity-5"></i>
									                    </div>
								                    </div>
							                    </div>
						                    </div>
						                    <!-- END input-group -->
						
						                    <!-- BEGIN table -->
						                    <div class="table-responsive">
							                    <table class="table table-hover text-nowrap">
								                    <thead>
									                    <tr>
										                    <th class="border-top-0 pt-0 pb-2">Shop</th>
										                    <th class="border-top-0 pt-0 pb-2">Date</th>
										                    <th class="border-top-0 pt-0 pb-2">Customer</th>
										                    <th class="border-top-0 pt-0 pb-2">Currency</th>
										                    <th class="border-top-0 pt-0 pb-2">Shop Status</th>
										                    <th class="border-top-0 pt-0 pb-2">Address</th>
										                    <th class="border-top-0 pt-0 pb-2">Phone</th>
										                    <th class="border-top-0 pt-0 pb-2">Delivery Time</th>
									                    </tr>
								                    </thead>
								                    <tbody>
									                <tr>
										                <td class="align-middle"><a href="page_order_details.html">Eatbunny</a></td>
										                <td class="align-middle">Thu 26 Nov, 12:23pm</td>
										                <td class="align-middle">1001-Walking Customer</td>
										                <td>PKR</td>
										                <td class="align-middle">Active</td>
                                                        <td class="align-middle">Lahore, Punjab, Pakistan</td>
										                <td class="align-middle">03334616162</td>
										                <td class="align-middle">45 Minutes</td>
									                </tr>
									                </tbody>
							                    </table>
						                    </div>
						                    <!-- END table -->
						
											</div>
				                        </div>
			                        </div>




     
                            
                        </div>         
                    </div>
                </div>
            </div>        






        <?= $this->include('layouts/footer') ?>     
        <?php endif ;?>

    </div>    
    
</body>

</html>