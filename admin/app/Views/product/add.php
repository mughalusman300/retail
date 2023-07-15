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
		
		<div class="row gx-4">
			<div class="col-xl-8">
				<div class="card mb-4">
					<div class="card-header bg-none fw-bold">
						Product Information
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Title <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="title" placeholder="Product name">
						</div>
						<div class="">
							<label class="form-label">Description <span class="text-danger">*</span></label>
							<textarea class="summernote" rows="10"></textarea>
						</div>
					</div>
				</div>
				<div class="card mb-4">
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
				</div>
				<div class="card mb-4">
					<div class="card-header d-flex align-items-center bg-none fw-bold">
						Variants
					</div>
					<div class="card-body">
						<div class="alert alert-success py-2">
							Add variants if this product comes in multiple versions, like different sizes or colors.
						</div>
						<div class="row mb-2">
							<div class="col-4">Option name</div>
							<div class="col-8">Option values</div>
						</div>
						<div class="row mb-3 gx-3">
							<div class="col-4"><input type="text" class="form-control" name="variant[0][name]" placeholder="e.g Size" value="Size"></div>
							<div class="col-7">
								<ul id="tag-size" class="tagit form-control">
									<li>XL</li>
									<li>S</li>
								</ul>
							</div>
							<div class="col-1">
								<a href="#" class="btn btn-default d-block"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="row mb-3 gx-3">
							<div class="col-4"><input type="text" class="form-control" name="variant[1][name]" placeholder="e.g Color" value="Color"></div>
							<div class="col-7">
								<ul id="tag-color" class="tagit form-control">
									<li>Black</li>
								</ul>
							</div>
							<div class="col-1">
								<a href="#" class="btn btn-default d-block"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="row mb-3 gx-3">
							<div class="col-4"><input type="text" class="form-control" name="variant[1][name]" placeholder="e.g Color" value="Material"></div>
							<div class="col-7">
								<ul id="tag-material" class="tagit form-control">
								</ul>
							</div>
							<div class="col-1">
								<a href="#" class="btn btn-default d-block"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<p>Modify the variants to be created:</p>
						<table class="table">
							<thead>
								<tr>
									<th class="w-10px"></th>
									<th>Variant</th>
									<th class="w-150px">SKU</th>
									<th class="w-150px">Price</th>
									<th class="w-50px">Quantity</th>
									<th class="w-150px"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="align-middle">
										<div class="form-check">
											<input type="checkbox" name="variant[0][enabled]" id="variant_0_enabled" value="1" checked class="form-check-input">
											<label class="form-check-label">&nbsp;</label>
										</div>
									</td>
									<td class="align-middle">
										<span class="text-theme">XL</span>
										<span class="text-muted mx-1"> • </span>
										<span class="text-body">Black</span>
									</td>
									<td><input type="text" class="form-control" value="" placeholder="#SKU000001"></td>
									<td><input type="text" class="form-control" value="" placeholder="0.00"></td>
									<td><input type="text" class="form-control" value="" placeholder="0"></td>
									<td><a href="#" class="btn btn-theme d-block">Upload Image</a></td>
								</tr>
								<tr>
									<td class="align-middle">
										<div class="form-check">
											<input type="checkbox" name="variant[1][enabled]" id="variant_1_enabled" value="1" class="form-check-input">
											<label class="form-check-label">&nbsp;</label>
										</div>
									</td>
									<td class="align-middle">
										<span class="text-theme">S</span>
										<span class="text-muted mx-1"> • </span>
										<span class="text-body">Black</span>
									</td>
									<td><input type="text" class="form-control" value="" placeholder="#SKU000001"></td>
									<td><input type="text" class="form-control" value="" placeholder="0.00"></td>
									<td><input type="text" class="form-control" value="" placeholder="0"></td>
									<td><a href="#" class="btn btn-theme d-block">Upload Image</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header d-flex align-items-center bg-none fw-bold">
						Warranty
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-lg-0 mb-3">
									<label class="form-label">Warranty Type</label>
									<select class="form-select" name="warranty_type_id">
										<option value="">-- Select Warranty Type --</option>
										<option value="1">No Warranty</option>
										<option value="2">Local Supplier Warranty</option>
										<option value="3">Local Manufacturer Warranty</option>
										<option value="4">International Manufacturer Warranty</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-lg-0 mb-3">
									<label class="form-label">Warranty Period</label>
									<select class="form-select" name="warranty_id">
										<option value="">-- Select Warranty Period --</option>
										<option value="1">1 Month</option>
										<option value="2">3 Months</option>
										<option value="3">6 Months</option>
										<option value="4">1 Year</option>
										<option value="5">2 Years</option>
										<option value="6">3 Years</option>
										<option value="7">4 Years</option>
										<option value="8">5 Years</option>
										<option value="9">6 Years</option>
										<option value="10">7 Years</option>
										<option value="11">8 Years</option>
										<option value="12">9 Years</option>
										<option value="13">10 Years</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header d-flex align-items-center bg-none fw-bold">
						Package Content
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">What's in the box</label>
							<input type="text" class="form-control" placeholder="e.g T-shirt" name="package_content">
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Weight</label>
									<input type="text" class="form-control" name="weight" placeholder="(kg)">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-label">Parcel Size</label>
									<div class="row">
										<div class="col-4">
											<div class="input-group">
												<span class="input-group-text">W</span>
												<input type="text" class="form-control" placeholder="(cm)" name="width">
											</div>
										</div>
										<div class="col-4">
											<div class="input-group">
												<span class="input-group-text">L</span>
												<input type="text" class="form-control" placeholder="(cm)" name="length">
											</div>
										</div>
										<div class="col-4">
											<div class="input-group">
												<span class="input-group-text">H</span>
												<input type="text" class="form-control" placeholder="(cm)" name="height">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="p-3 bg-body rounded">
							<div class="form-group mb-0">
								<label class="form-label fw-semibold">Shipping</label>
								<div class="shipping-container">
									<hr class="mt-0 mb-2 opacity-1">
									<div class="row align-items-center">
										<div class="col-6 pt-1 pb-1">No shipping fee</div>
										<div class="col-6 d-flex align-items-center">
											<div class="form-check form-switch ms-auto">
												<input type="checkbox" class="form-check-input" id="shippingFree" name="shipping_free_enable" checked value="1">
												<label class="form-check-label" for="shippingFree">&nbsp;</label>
											</div>
										</div>
									</div>
									<hr class="my-2 opacity-1">
									<div class="row align-items-center">
										<div class="col-6 pt-1 pb-1">
											AliExpress
										</div>
										<div class="col-6 d-flex align-items-center">
											<div class="form-check form-switch ms-auto">
												<input type="checkbox" class="form-check-input" id="shippingAliExpress" name="shipping_enable" value="AliExpress">
												<label class="form-check-label" for="shippingAliExpress">&nbsp;</label>
											</div>
										</div>
									</div>
									<hr class="my-2 opacity-1">
									<div class="row align-items-center">
										<div class="col-6 pt-1 pb-1">
											SaleHoo
										</div>
										<div class="col-6 d-flex align-items-center">
											<div class="form-check form-switch ms-auto">
												<input type="checkbox" class="form-check-input" id="shippingSaleHoo" name="shipping_enable" value="SaleHoo">
												<label class="form-check-label" for="shippingSaleHoo">&nbsp;</label>
											</div>
										</div>
									</div>
									<hr class="my-2 opacity-1">
									<div class="row align-items-center">
										<div class="col-6 pt-1 pb-1">
											Megagoods
										</div>
										<div class="col-6 d-flex align-items-center">
											<div class="form-check form-switch ms-auto">
												<input type="checkbox" class="form-check-input" id="shippingMegagoods" name="shipping_enable" value="Megagoods">
												<label class="form-check-label" for="shippingMegagoods">&nbsp;</label>
											</div>
										</div>
									</div>
									<hr class="my-2 opacity-1">
									<div class="row align-items-center">
										<div class="col-6 pt-1 pb-1">
											Wholesale2B
										</div>
										<div class="col-6 d-flex align-items-center">
											<div class="form-check form-switch ms-auto">
												<input type="checkbox" class="form-check-input" id="shippingWholesale2B" name="shipping_enable" value="Wholesale2B">
												<label class="form-check-label" for="shippingWholesale2B">&nbsp;</label>
											</div>
										</div>
									</div>
									<hr class="my-2 opacity-1">
									<div class="row align-items-center">
										<div class="col-6 pt-1 pb-1">
											Sunrise Wholesale
										</div>
										<div class="col-6 d-flex align-items-center">
											<div class="form-check form-switch ms-auto">
												<input type="checkbox" class="form-check-input" id="shippingSunriseWholesale" name="shipping_enable" value="Sunrise Wholesale">
												<label class="form-check-label" for="shippingSunriseWholesale">&nbsp;</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="card mb-4">
					<div class="card-header bg-none fw-bold d-flex align-items-center">
						<div class="flex-1">
							<div>Sales channels (2/3)</div>
						</div>
						<div><a href="#" class="text-decoration-none fw-normal link-secondary">Manage</a></div>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-1 d-flex">
								<div class="me-3"><i class="fa fa-store fa-lg fa-fw text-body text-opacity-25"></i></div>
								<div>Online Store</div>
								<span class="badge bg-theme-subtle text-theme fw-bold fs-12px ms-auto me-2 d-flex align-items-center">2022-01-05</span>
							</div>
							<div class="w-50px text-center"><a href="#" class="text-decoration-none link-secondary"><i class="fa fa-calendar fa-lg"></i></a></div>
						</div>
						<hr class="my-3 opacity-1">
						<div class="d-flex">
							<div class="flex-1 d-flex">
								<div class="me-3"><i class="fab fa-shopify fa-lg fa-fw text-body text-opacity-25"></i></div>
								<div>Shopify</div>
								<span class="badge bg-theme-subtle text-theme fw-bold fs-12px ms-auto me-2 d-flex align-items-center">2022-01-05</span>
							</div>
							<div class="w-50px text-center"><a href="#" class="text-decoration-none link-secondary"><i class="fa fa-calendar fa-lg"></i></a></div>
						</div>
						<hr class="my-3 opacity-1">
						<div class="d-flex">
							<div class="flex-1 d-flex">
								<div class="me-3"><i class="fab fa-amazon fa-lg fa-fw text-body text-opacity-25"></i></div>
								<div>
									<div>Amazon</div>
									<div class="d-flex mt-1 text-body text-opacity-50 small">
										<div><i class="fa fa-circle text-warning fs-6px d-block mt-2"></i></div>
										<div class="flex-1 ps-2">
											<div class="mb-2">
												Amazon is disconnected. Connect your Amazon Seller Central account to continue using this sales channel.
											</div>
											<a href="#">Learn more</a>
										</div>
									</div>
								</div>
							</div>
							<div class="w-50px text-center"><a href="#" class="text-decoration-none link-secondary"><i class="fa fa-circle-xmark fa-lg fa-fw"></i></a></div>
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
						<div class="mb-3">
							<label class="form-label">Product type</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Product type">
								<button class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
						<div class="mb-0">
							<label class="form-label">Vendor</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Apple store supplies">
								<button class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header bg-none fw-bold d-flex align-items-center">
						<div class="flex-1">
							<div>Collections</div>
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex align-items-center position-relative mb-2">
							<span class="position-absolute top-0 bottom-0 start-0 d-flex align-items-center px-10px"><i class="fa fa-search"></i></span>
							<input type="text" class="form-control ps-30px" placeholder="Search for collections">
						</div>
						<p class="mb-0 small text-body text-opacity-50">
							<i class="fa fa-question-circle fa-fw"></i> Add this product to a collection so it's easy to find in your store.
						</p>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header bg-none fw-bold d-flex align-items-center">
						<div class="flex-1">
							<div>Tags</div>
						</div>
					</div>
					<div class="card-body">
						<ul id="tags" class="tagit form-control mb-3">
							<li>Laptop</li>
							<li>Apple</li>
						</ul>
						<div class="small"><a href="#">View all tags</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END #content -->