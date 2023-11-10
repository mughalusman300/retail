<?php
use App\Models\Commonmodel;
$this->Commonmodel = new Commonmodel();
?>
	
	<?php if ($product->v1 != '' || $product->v2 != '' || $product->v3 != ''):?>
		<div class="card mb-4">
			<div class="card-header bg-none fw-bold">
				Variants
			</div>
			<div class="card-body">
				<!---- <div class="row mb-3">
					<?php if($product->v1 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v1)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
							<?php if($variant_detail):?>
								<?php foreach($variant_detail as $row):?>
									<input type="checkbox" id="html" name="fav_language" value="HTML">
									 <label for="html"><?= $row->variant_detail_name ?></label><br>
								<?php endforeach;?>
							<?php endif;?>
						</div>
					<?php } ?>

					<?php if($product->v2 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v2)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v2 ?> <span class="text-danger">*</span></label><br>
							<?php if($variant_detail):?>
								<?php foreach($variant_detail as $row):?>
									<input type="checkbox" id="html" name="fav_language" value="HTML">
									 <label for="html"><?= $row->variant_detail_name ?></label><br>
								<?php endforeach;?>
							<?php endif;?>
						</div>
					<?php } ?>

					<?php if($product->v3 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v3)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v3 ?> <span class="text-danger">*</span></label><br>
							<?php if($variant_detail):?>
								<?php foreach($variant_detail as $row):?>
									<input type="checkbox" id="html" name="fav_language" value="HTML">
									 <label for="html"><?= $row->variant_detail_name ?></label><br>
								<?php endforeach;?>
							<?php endif;?>
						</div>
					<?php } ?>

				</div> ---->

				<div class="row mb-3">
					<?php if($product->v1 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v1)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
							<select name="v1" id="v1" class="form-control select2 v1">
								<option value="">Select</option>
								<?php if($variant_detail):?>
									<?php foreach($variant_detail as $row):?>
										<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					<?php } ?>

					<?php if($product->v2 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v2)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
							<select name="v2" id="v2" class="form-control select2 v2">
								<option value="">Select</option>
								<?php if($variant_detail):?>
									<?php foreach($variant_detail as $row):?>
										<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					<?php } ?>

					<?php if($product->v3 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v3)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
							<select name="v3" id="v3" class="form-control select2 v3">
								<option value="">Select</option>
								<?php if($variant_detail):?>
									<?php foreach($variant_detail as $row):?>
										<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					<?php } ?>

				</div>

			</div>
		</div>
	<?php endif;?>

	<?php if ($purchase_conversion):?>
		<div class="card mb-4">
			<div class="card-header bg-none fw-bold">
				Conversion
			</div>
			<div class="card-body">

				<div class="row mb-3">
					<?php if($product->v1 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v1)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
							<select name="v1" id="v1" class="form-control select2 v1">
								<option value="">Select</option>
								<?php if($variant_detail):?>
									<?php foreach($variant_detail as $row):?>
										<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					<?php } ?>

					<?php if($product->v2 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v2)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
							<select name="v2" id="v2" class="form-control select2 v2">
								<option value="">Select</option>
								<?php if($variant_detail):?>
									<?php foreach($variant_detail as $row):?>
										<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					<?php } ?>

					<?php if($product->v3 != '') {
						$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v3)), 'saimtech_variant');
						$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
						// dd($variant);
					?>
						<div class="col-4">
							<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
							<select name="v3" id="v3" class="form-control select2 v3">
								<option value="">Select</option>
								<?php if($variant_detail):?>
									<?php foreach($variant_detail as $row):?>
										<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					<?php } ?>

				</div>

			</div>
		</div>
	<?php endif;?>