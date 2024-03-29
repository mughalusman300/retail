	<!-- BEGIN #content -->
	<div id="content" class="app-content">
		<div class="d-flex align-items-center mb-3">
			<div>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:;">PAGES</a></li>
					<li class="breadcrumb-item active">PRODUCT DETAILS</li>
				</ol>
				<h1 class="page-header mb-0">Product Details</h1>
			</div>
		</div>
		
		<form action="<?=URL?>/Product/create" method="POST" enctype="multipart/form-data" class="product-form">
			<div class="row gx-4 add-product">
					<div class="col-xl-8">
						<div class="card mb-4">
							<div class="card-header bg-none fw-bold">
								Product Information
							</div>
							<div class="card-body">
								<div class="row mb-3">
									<div class="col-6">
										<label class="form-label">Product Name <span class="text-danger">*</span></label>
										<input type="text" class="form-control validate-input product_name" name="product_name" placeholder="Product name">
									</div>

									<div class="col-6">
										<label class="form-label">Product Code <span class="text-danger">*</span></label>
										<input type="text" class="form-control validate-input product_code uppercase" name="product_code" placeholder="Product code">
									</div>
								</div>
								<div class="">
									<label class="form-label">Description <span class="text-danger">*</span></label>
									<textarea class="summernote validate-input product_desc" name="product_desc" rows="10"></textarea>
								</div>
							</div>
						</div>
						<!--- <div class="card mb-4 d-none">
							<div class="card-header d-flex align-items-center bg-none fw-bold">
								Media
							</div>
							<form id="fileupload" action="//jquery-file-upload.appspot.com/" name="file_upload_form" method="POST" enctype="multipart/form-data">
								<div class="card-body pb-2">
									<div class="fileupload-buttonbar mb-2">
										<div class="d-block d-lg-flex align-items-center">
											<span class="btn btn-theme fs-13px fw-semibold fileinput-button me-2 mb-1">
												<i class="fa fa-fw fa-plus"></i>
												<span>Add files...</span>
												<input type="file" name="files[]" multiple>
											</span>
											<button type="submit" class="btn btn-default fs-13px fw-semibold me-2 mb-1 start">
												<i class="fa fa-fw fa-upload"></i>
												<span>Start upload</span>
											</button>
											<button type="reset" class="btn btn-default fs-13px fw-semibold me-2 mb-1 cancel">
												<i class="fa fa-fw fa-ban"></i>
												<span>Cancel upload</span>
											</button>
											<button type="button" class="btn btn-default fs-13px fw-semibold me-2 mb-1 delete">
												<i class="fa fa-fw fa-trash"></i>
												<span>Delete</span>
											</button>
											<div class="form-check ms-2 mb-1">
												<input type="checkbox" id="toggle-delete" class="form-check-input toggle">
												<label for="toggle-delete" class="form-check-label">Select Files</label>
											</div>
										</div>
									</div>
									<div id="error-msg"></div>
								</div>
								<table class="table table-card mb-0 fs-13px">
									<thead>
										<tr class="fs-12px">
											<th class="pt-2 pb-2 w-25">Preview</th>
											<th class="pt-2 pb-2 w-25">Filename</th>
											<th class="pt-2 pb-2 w-25">Size</th>
											<th class="pt-2 pb-2 w-25">Action</th>
										</tr>
									</thead>
									<tbody class="files">
										<tr class="empty-row">
											<td colspan="4" class="text-center p-3">
												<div class="text-body text-opacity-25 my-3"><i class="fa fa-file-archive fa-3x"></i></div> 
												No file uploaded
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						</div> --->
						<div class="card mb-4">
							<div class="card-header d-flex align-items-center bg-none fw-bold">
								Variants
							</div>
							<div class="card-body">
								<div class="row mb-2">
									<div class="col-4">
										<label class="form-label">Variant 1</label>
										<select name="v1" id="v1" class="form-control select2 v1">
											<option value="">Select</option>
											<?php foreach($variants as $row) :?>
												<option value="<?= $row->variant_name ?>"><?= $row->variant_name ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Variant 2</label>
										<select name="v2" id="v2" class="form-control select2 v2">
											<option value="">Select</option>
											<?php foreach($variants as $row) :?>
												<option value="<?= $row->variant_name ?>"><?= $row->variant_name ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Variant 3</label>
										<select name="v3" id="v3" class="form-control select2 v3">
											<option value="">Select</option>
											<?php foreach($variants as $row) :?>
												<option value="<?= $row->variant_name ?>"><?= $row->variant_name ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-4">
							<div class="card-header d-flex align-items-center bg-none fw-bold">
								Units
							</div>
							<div class="card-body">
								<div class="row mb-2">

									<div class="col-4">
										<label class="form-label">Purchasing Unit</label>
										<select name="purch_unit" id="purch_unit" class="form-control select2 purch_unit validate-input select">
											<option value="">Select</option>
											<?php foreach($uom as $row) :?>
												<option value="<?= $row->uom_code ?>"><?= $row->uom_code ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Inventory Unit</label>
										<select name="inv_unit" id="inv_unit" class="form-control inv_unit validate-input select">
											<option value="">Select</option>
											<?php foreach($uom as $row) :?>
												<option value="<?= $row->uom_code ?>"><?= $row->uom_code ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Sale Unit</label>
										<select name="sale_unit" id="sale_unit" class="form-control select2 sale_unit validate-input select ">
											<option value="">Select</option>
											<?php foreach($uom as $row) :?>
												<option value="<?= $row->uom_code ?>"><?= $row->uom_code ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="card mb-4">
							<div class="card-header d-flex align-items-center bg-none fw-bold">
								Product Images
							</div>

							<div class="card-body">
								<div class="">
									<div class="row mb-2">
										<div> Default: </div> 
									</div>
									<div class="row mb-3 image-parent-div">
										<div class="main-row col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-2">
											<div class="row">
												<div class="product-upload-radio-btn-div text-center">
													<div class="form-check form-switch mt-1">
						                            	<input type="checkbox" class="form-check-input default" name="default" value="1">
														<input type="hidden" class="default_image" name="default_image[]" value="">
						                        	</div>
												</div>

												<div class="product-upload-img-div upload-row text-end">
													<div style="width: 100%" class="img-col">
														<img  class="img-preview product-img-preview" style="display: none;" title="Click here to remove this file" src="">
													</div>
													<button
														style="display: none;" 
														type="button" 
														class="btn btn-sm btn-outline-danger remove-img mt-2"
														data-attachment_id=""
													>
														Delete
													</button>

													<input type="file" name="product_img[]" id="product_img" placeholder=" Attachments" class="form-control attachment-file  product_img" accept="gif, .jpg, .png," style="display: none">

													<button type="button" class=" btn btn-default btn-browse product-upload-btn form-control">
									                    <i class="fa fa-cloud-upload"></i>
									                    Upload Image           
									                </button>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="mt-3 mb-2 text-end">
									<button type="button" class="btn btn-default add-more-image">Add More</button>
								</div>
							</div>
						</div>

						<div class="card mb-4">
							<div class="card-header bg-none fw-bold d-flex align-items-center">
								<div class="flex-1">
									<div>Organization</div>
								</div>
							</div>
							<div class="card-body">
								<div class="mb-1">
									<label class="form-label">Group</label>
									<select name="group_id" id="group_id" class="form-control select2 group_id validate-input select ">
										<option value="">Select</option>
										<?php foreach($groups as $row) :?>
											<option value="<?= $row->group_id ?>"><?= $row->group_name ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="mb-3">
									<label class="form-label">Category</label>
									<select name="category_id" id="category_id" class="form-control select2 category_id validate-input select ">
										<option value="">Select</option>
										<?php foreach($categories as $row) :?>
											<option value="<?= $row->category_id ?>"><?= $row->title ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

						</div>
						<div class="card mb-4">
							<div class="card-header bg-none fw-bold d-flex align-items-center">
								<div class="flex-1">
									<div>Keywords</div>
								</div>
							</div>
							<div class="card-body">
								<input type="hidden" id='keywords' class="form-control keywords" name="keywords">
								<ul id="tags" class="tagit form-control mb-3 keywords-ul"> </ul>
								<!-- <div class="small"><a href="#">View all tags</a></div> -->
							</div>
						</div>

						<div class="text-end">
							<button type="sumbit" class="btn btn-theme mr-auto w-100 save">Save</button>
						</div>
					</div>
			</div>
		</form>
	</div>
	<!-- END #content -->


	<!-- BEGIN template-upload -->
	<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px"></span>
			</td>
			<td>
				<p class="name mb-1">{%=file.name%}</p>
				<strong class="error text-danger"></strong>
			</td>
			<td>
				<p class="size mb-2">Processing...</p>
				<div class="progress progress-sm mb-0 h-10px progress-striped active"><div class="progress-bar bg-theme" style="min-width: 2em; width:0%;"></div></div>
			</td>
			<td nowrap>
				{% if (!i && !o.options.autoUpload) { %}
					<button class="btn btn-theme btn-sm d-block w-100 start" disabled>
						<span>Start</span>
					</button>
				{% } %}
				{% if (!i) { %}
					<button class="btn btn-default btn-sm d-block w-100 cancel mt-2">
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>
	<!-- END template-upload -->
	
	<!-- BEGIN template-download -->
	<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px">
					{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
					{% } %}
				</span>
			</td>
			<td>
				<p class="name">
					{% if (file.url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
					{% } else { %}
						<span>{%=file.name%}</span>
					{% } %}
				</p>
				{% if (file.error) { %}
					<div><span class="label label-danger">Error</span> {%=file.error%}</div>
				{% } %}
			</td>
			<td>
				<span class="size">{%=o.formatFileSize(file.size)%}</span>
			</td>
			<td nowrap>
				{% if (file.deleteUrl) { %}
					<button class="btn btn-outline-danger btn-sm btn-block delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
						<span>Delete</span>
					</button>
					<div class="form-check mt-2">
						<input type="checkbox" id="{%=file.deleteUrl%}" name="delete" value="1" class="form-check-input toggle">
						<label for="{%=file.deleteUrl%}" class="form-check-label"></label>
					</div>
				{% } else { %}
					<button class="btn btn-default btn-sm d-block w-100 cancel">
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>
	<!-- END template-download -->