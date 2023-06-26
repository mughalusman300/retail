
<!-- BEGIN #content -->
<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		Categories 
		<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalLg">Add Category</button>
		<!-- Categories <small>page header description goes here...</small> -->
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->
		<div class="card">
			<div class="card-body">
				<table id="category" class="table text-nowrap w-100">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>code</th>
							<th>Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($categories):?>
							<?php $i = 1 ;?>
							<?php foreach ($categories as $row):?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $row->title ?></td>
									<td><?= $row->code ?></td>
									<td><?= $row->desc ?></td>
									<td>Active</td>
									<td><button type="button" class="btn btn-primary mb-1">Edit</button></td>
								</tr>
								<?php $i++ ;?>
							<?php endforeach; ?>
						<?php endif; ?>
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
<?php include(APPPATH . 'views/modals/category-modal.php') ?>