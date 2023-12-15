		
		<div class="modal fade barcode-modal" id="barcode-modal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Print Barcode</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 mb-4">
								<input type="hidden" class="print_barcode">
								
								<label for="title" class="form-label">Quantity</label> <span class="color-red">*</span>
								<input type="number" class="form-control validate-input barcode_qty number" min="1" max="100" placeholder="1" id="barcode_qty" value="1" required="">
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 Proceed">Print</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>