<?php 
use App\Models\Commonmodel; 
$this->Commonmodel = new Commonmodel();
?>
<div class="row">

		<div class="table-responsive">
			<table id="inventory" class="table text-nowrap w-100">
				<thead class="w-100">
					<tr>
						<th>Barcode</th>
						<th>Qty</th>
						<th>Action</th>
					</tr>
					</tr>
				</thead>
				<tbody>
					<?php foreach($barcode_data as $row): ?>
						<tr>
							<td>
								<?php 
									$barcode = $row->barcode;
									$full_barcode = $barcode;

									$length = strlen($barcode);
									if ($length == 13) {
									    $barcode = substr($barcode, 1);
									} 
									if ($length == 13 || $length == 12) {
									    $barcode = substr($barcode, 0, -1);
									}

									$this->Commonmodel->generateProductBarcode($barcode, 'upca', false);
								?>

								<img src="<?= URL?>/pdf/<?= $barcode?>.png" alt="barcode">
							</td>
							<td>
								<input type="hidden" class="print_barcode" value="<?=$barcode ?>">
								<input type="number" class="form-control validate-input barcode_qty number w-100px" min="1" max="100" placeholder="1" value="1" required="">
							</td>
							<td>
								<button type="button" class="btn btn-theme mb-1 Proceed">Print</button>
							</td>
						</tr>
			
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
</div>
