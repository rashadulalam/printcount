<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Insert new print' ); ?></h1>
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="print-type">Print type</label></th>
					<td>
						<select name="print-type" id="print-type">
							<option value="">Please select an option</option>
							<option value="Computer print regular" selected>Computer print regular</option>
							<option value="Color print">Color print</option>
							<option value="Photocopy">Photocopy</option>
						</select>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="print-title">Print title</label></th>
					<td>
						<input type="text" name="print-title" id="print-title" class="regular-text">
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="total-print">Total print</label></th>
					<td>
						<input type="text" name="total-print" id="total-print" class="regular-text">
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="print-note">Print note</label></th>
					<td>
						<textarea name="print-note" id="print-note" class="regular-text"></textarea>
					</td>
				</tr>

				<?php wp_nonce_field( 'new-print' ); ?>

				<tr>
					<th scope="row"></th>
					<td>
						<?php submit_button( __( 'Add new print', 'print-count' ), 'primary', 'submit_print' ); ?>
							
					</td>
				</tr>
				

			</tbody>
		</table>


	</form>
</div>