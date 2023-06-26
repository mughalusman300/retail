		
		<div class="modal fade category-modal" id="category-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Category</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="col-md-6 mb-3">
							<input type="text" class="category_id">
							
							<label for="title" class="form-label">Title</label>
							<input type="text" class="form-control is-invalid validate-input title" id="title" value="" required="">
							<div class="invalid-feedback" id="validationInvalidInputFeedback">
								Please provide a title
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<label for="code" class="form-label">Code</label>
							<input type="text" class="form-control is-invalid validate-input code" id="code" value="" required="">
							<div class="invalid-feedback" id="validationInvalidInputFeedback">
								Please provide a code
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<label for="desc" class="form-label">Description</label>
							<input type="text" class="form-control is-invalid validate-input desc" id="desc" value="" required="">
							<div class="invalid-feedback" id="validationInvalidInputFeedback">
								Please provide a description
							</div>
						</div>

						<div class="col-md-12">
							<button type="button" class="btn btn-primary mb-1" data-type="add">Save</button>
						</div>

					</div>
				</div>
			</div>
		</div>