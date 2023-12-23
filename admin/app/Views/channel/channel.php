
<!-- BEGIN #content -->
<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active">Shop</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		Shops 
		<button type="button" class="btn btn-outline-theme me-2 add-category">Add Shop</button>
		<!-- Categories <small>page header description goes here...</small> -->
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->
		<div class="card">
			<div class="card-body">
				<table id="channel" class="table text-nowrap w-100">
					<thead>
<!---SELECT `recid`, `email`, `phone`, `mobile`, `fax`, `ntn`, `address`, `city`, `country`, `sologo`, `name`, `code`, `default_customer`, `functionality_profile`, `price_list`, `apply_tax`, `tax_group`, `currency_code`, `dimensions`, `is_active`, `data`, `created_by`, `created_at`, `modify_by`, `modify_at` FROM `saimtech_channel` WHERE 1-->						
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				
					</tbody>
				</table>
			</div>
			<!-- <div class="hljs-container rounded-bottom">
				<pre><code class="xml" data-url="assets/data/table-plugins/code-1.json"></code></pre>
			</div> -->
		</div>
	</div>
	<!-- END #datatable -->
</div>
<!-- END #content -->
<?php include(APPPATH . 'Views/modals/category-modal.php') ?>