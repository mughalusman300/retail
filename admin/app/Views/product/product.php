
<!-- BEGIN #content -->
<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		Products 
		<a type="button" href="<?= URL?>/product/add" class="btn btn-outline-theme me-2 add-product">Add Product</a>
		<!-- Categories <small>page header description goes here...</small> -->
	</h1>

	<div class="mb-sm-4 mb-3 d-sm-flex">
		<div class="mt-sm-0 mt-2"><a href="#" class="text-body text-decoration-none"><i class="fa fa-download fa-fw me-1 text-muted"></i> Export</a></div>
		<div class="ms-sm-4 mt-sm-0 mt-2"><a href="#" class="text-body text-decoration-none"><i class="fa fa-upload fa-fw me-1 text-muted"></i> Import</a></div>
		<div class="ms-sm-4 mt-sm-0 mt-2 dropdown-toggle">
			<a href="#" data-bs-toggle="dropdown" class="text-body text-decoration-none">More Actions</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="#">Action</a>
				<a class="dropdown-item" href="#">Another action</a>
				<a class="dropdown-item" href="#">Something else here</a>
				<div role="separator" class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Separated link</a>
			</div>
		</div>
	</div>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<div class="card">
			<ul class="nav nav-tabs nav-tabs-v2 px-4">
				<li class="nav-item me-3"><a href="#allTab" class="nav-link active px-2" data-bs-toggle="tab">All</a></li>
				<li class="nav-item me-3"><a href="#activeTab" class="nav-link px-2" data-bs-toggle="tab">Active</a></li>
				<li class="nav-item me-3"><a href="#deactiveTab" class="nav-link px-2" data-bs-toggle="tab">Deactive</a></li>
				<!-- <li class="nav-item me-3"><a href="#deletedTab" class="nav-link px-2" data-bs-toggle="tab">Deleted</a></li> -->
			</ul>
			<div class="tab-content p-4">
				<div class="tab-pane fade show active" id="allTab">
					<!-- BEGIN input-group -->
					<div class="input-group mb-4">
						<button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter products &nbsp;</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div role="separator" class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
						<div class="flex-fill position-relative z-1">
							<div class="input-group">
								<div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0" style="z-index: 1020;">
									<i class="fa fa-search opacity-5"></i>
								</div>
								<input type="text" class="form-control ps-35px search" placeholder="Search products">
							</div>
						</div>
					</div>
					<!-- END input-group -->
					
					<!-- BEGIN table -->
					<div class="table-responsive">
						<table id="product" class="table text-nowrap w-100">
							<thead class="w-100">
								<tr>
									<th></th>
									<th>Product</th>
									<th>Code</th>
									<th>Category</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
						
							</tbody>
						</table>
					</div>
					<!-- END table -->
				</div>

				<div class="tab-pane fade show" id="activeTab">
					<!-- BEGIN input-group -->
					<div class="input-group mb-4">
						<button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter products &nbsp;</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div role="separator" class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
						<div class="flex-fill position-relative z-1">
							<div class="input-group">
								<div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0" style="z-index: 1020;">
									<i class="fa fa-search opacity-5"></i>
								</div>
								<input type="text" class="form-control ps-35px active_search" placeholder="Search products">
							</div>
						</div>
					</div>
					<!-- END input-group -->
					
					<!-- BEGIN table -->
					<div class="table-responsive">
						<table id="active_product" class="table text-nowrap w-100">
							<thead class="w-100">
								<tr>
									<th></th>
									<th>Product</th>
									<th>Code</th>
									<th>Category</th>
									<!-- <th>Status</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
						
							</tbody>
						</table>
					</div>
					<!-- END table -->
				</div>

				<div class="tab-pane fade show" id="deactiveTab">
					<!-- BEGIN input-group -->
					<div class="input-group mb-4">
						<button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter products &nbsp;</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div role="separator" class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
						<div class="flex-fill position-relative z-1">
							<div class="input-group">
								<div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0" style="z-index: 1020;">
									<i class="fa fa-search opacity-5"></i>
								</div>
								<input type="text" class="form-control ps-35px deactive_search" placeholder="Search products">
							</div>
						</div>
					</div>
					<!-- END input-group -->
					
					<!-- BEGIN table -->
					<div class="table-responsive">
						<table id="deactive_product" class="table text-nowrap w-100">
							<thead class="w-100">
								<tr>
									<th></th>
									<th>Product</th>
									<th>Code</th>
									<th>Category</th>
									<!-- <th>Status</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
						
							</tbody>
						</table>
					</div>
					<!-- END table -->
				</div>
			</div>
		</div>
	</div>
	<!-- END #datatable -->
</div>
<?php include(APPPATH . 'views/modals/conversion-modal.php') ?>