	<!-- BEGIN #content -->
<?php 
	$saved_tags = array();
	if ($product->keywords != '') {
		$saved_tags = explode(',', $product->keywords);
	}
	// dd($saved_tags);
?>	
<script type="text/javascript">
	var saved_tags = <?php echo json_encode($saved_tags) ?>;
</script>	

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
		
		<form action="<?=URL?>/Product/update" method="POST" enctype="multipart/form-data" class="product-form">
			<div class="row gx-4 add-product">
					<div class="col-xl-8">
						<div class="card mb-4">
							<div class="card-header bg-none fw-bold">
								Product Information
							</div>
							<div class="card-body">
								<div class="row mb-3">
									<div class="col-6">
										<input type="hidden" name="product_id" class="product_id" value="<?= $product->product_id; ?>">
										<label class="form-label">Product Name <span class="text-danger">*</span></label>
										<input type="text" class="form-control validate-input product_name" name="product_name" placeholder="Product name" value="<?= $product->product_name ?>">
									</div>

									<div class="col-6">
										<label class="form-label">Product Code <span class="text-danger">*</span></label>
										<input type="text" class="form-control validate-input product_code uppercase" name="product_code" placeholder="Product code" value="<?= $product->product_code ?>">
									</div>
								</div>
								<div class="">
									<label class="form-label">Description <span class="text-danger">*</span></label>
									<textarea class="summernote validate-input product_desc" name="product_desc" rows="10"><?= $product->product_desc ?></textarea>
								</div>
							</div>
						</div>

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
												<option value="<?= $row->variant_name ?>" 
													<?= ($row->variant_name == $product->v1) ? 'selected' :'' ?>
												>
													<?= $row->variant_name ?>	
												</option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Variant 2</label>
										<select name="v2" id="v2" class="form-control select2 v2">
											<option value="">Select</option>
											<?php foreach($variants as $row) :?>
												<option value="<?= $row->variant_name ?>" 
													<?= ($row->variant_name == $product->v2) ? 'selected' :'' ?>
												>
													<?= $row->variant_name ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Variant 3</label>
										<select name="v3" id="v3" class="form-control select2 v3">
											<option value="">Select</option>
											<?php foreach($variants as $row) :?>
												<option value="<?= $row->variant_name ?>" 
													<?= ($row->variant_name == $product->v3) ? 'selected' :'' ?>
												>
													<?= $row->variant_name ?>
												</option>
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
										<label class="form-label">Inventory Unit</label>
										<select name="inv_unit" id="inv_unit" class="form-control inv_unit validate-input select">
											<option value="">Select</option>
											<?php foreach($uom as $row) :?>
												<option value="<?= $row->uom_code ?>"
													<?= ($row->uom_code == $product->inv_unit) ? 'selected' : '' ?>
												>
													<?= $row->uom_code ?>
														
												</option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Purchasing Unit</label>
										<select name="purch_unit" id="purch_unit" class="form-control select2 purch_unit validate-input select">
											<option value="">Select</option>
											<?php foreach($uom as $row) :?>
												<option value="<?= $row->uom_code ?>"
													<?= ($row->uom_code == $product->purch_unit) ? 'selected' : '' ?>
												>
													<?= $row->uom_code ?>	
												</option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="col-4">
										<label class="form-label">Sale Unit</label>
										<select name="sale_unit" id="sale_unit" class="form-control select2 sale_unit validate-input select ">
											<option value="">Select</option>
											<?php foreach($uom as $row) :?>
												<option value="<?= $row->uom_code ?>"
													<?= ($row->uom_code == $product->sale_unit) ? 'selected' : '' ?>
												>
													<?= $row->uom_code ?>
												</option>
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
								<div class="image-parent-div">
									<div class="row mb-2">
										<div> Default: </div> 
									</div>
									<?php if($attahements) :?>
										<?php foreach($attahements as $row) :?>
											<div class="row mb-3 main-row">
												<div class="col-2 text-center">
													<div class="form-check form-switch mt-1">
						                            	<input type="checkbox" class="form-check-input default" name="default" value="1" <?= ($product->product_img == $row->file) ? 'checked' : '' ?>>
														<input type="hidden" class="default_image" name="default_image" value="">
														<input type="hidden" class="attachment_id" name="attachment_id" value="<?= $row->attachment_id ?>">
						                        	</div>
												</div>

												<div class="col-10 upload-row text-end">
													<div class="img-col">
														<img  src="<?=URL?>/assets/img/<?= $row->file.img_version ?>" alt="no file" class="img-preview product-img-preview saved-img"/>			
													</div>
													<button 
														type="button" 
														class="btn btn-sm btn-danger remove-img mt-1"
														data-attachment_id="<?= $row->attachment_id ?>"
													>
														Delete
													</button>
												</div>
											</div>
										<?php endforeach;?>
									<?php else: ?>
										<div class="row mb-3 main-row">
											<div class="col-2 text-center">
												<div class="form-check form-switch mt-1">
					                            	<input type="checkbox" class="form-check-input default" name="default" value="1">
													<input type="hidden" class="default_image" name="default_image" value="">
													<input type="hidden" class="attachment_id" name="attachment_id" value="">
					                        	</div>
											</div>

											<div class="col-10 upload-row text-end">
												<div style="width: 92%" class="img-col">
													<img  class="img-preview product-img-preview" style="display: none;" title="Click here to remove this file" src="">
												</div>
												<button
													style="display: none;" 
													type="button" 
													class="btn btn-sm btn-danger remove-img mt-1"
													data-attachment_id=""
												>
													Delete
												</button>
												<input type="file" name="product_img[]" id="product_img" placeholder=" Attachments" class="form-control attachment-file  product_img" accept="gif, .jpg, .png," style="display: none">

												<button type="button" class=" btn btn-default btn-browse form-control ">
								                    <i class="fa fa-cloud-upload"></i>
								                    Upload Image           
								                </button>
											</div>
										</div>
									<?php endif; ?>
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
											<option value="<?= $row->group_id ?>"
												<?= ($row->group_id == $product->group_id) ? 'selected' : '' ?>
											>
												<?= $row->group_name ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="mb-3">
									<label class="form-label">Category</label>
									<select name="category_id" id="category_id" class="form-control select2 category_id validate-input select ">
										<option value="">Select</option>
										<?php foreach($categories as $row) :?>
											<option value="<?= $row->category_id ?>"
												<?= ($row->category_id == $product->category_id) ? 'selected' : '' ?>
											>
												<?= $row->title ?>
											</option>
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
								<input type="hidden" id='keywords' class="form-control keywords" name="keywords" value="<?= $product->keywords ?>">
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