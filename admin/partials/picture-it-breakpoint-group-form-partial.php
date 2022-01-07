<?php
/**
 * @file Creates the various form pieces needed for repeating breakpoint groups.
 */

?>

<div class="pi-breakpoint-groups">
	<table class="pi-breakpoint-groups-form">
		<tr class="pi-breakpoint-group">
			<td>
				<label>Name</label>
				<input type="text" name="pi_breakpoint_groups[<?php echo $key ?>][name]" value="<?php echo $data['name'] ?>" class="field-pi-breakpoint-groups-name" />
			</td>
			<td>
				<strong>Sizes</strong>
				<table class="pi-image-sizes-form">
				<?php foreach($data['sizes'] as $k => $size) { ?>
                <tr class="pi-image-size">
                    <td>
                        <label>Name</label>
						<input type="text" name="pi_breakpoint_groups[<?php echo $key ?>][sizes][<?php echo $k ?>][name]" value="<?php echo $size['name'] ?>" class="field-pi-breakpoint-groups-size-name" />
                    </td>
                    <td>
						<label>Minimum Width (px)</label>
						<input type="number" name="pi_breakpoint_groups[<?php echo $key ?>][sizes][<?php echo $k ?>][width]" value="<?php echo $size['width'] ?>" class="field-pi-breakpoint-groups-size-width" />
                    </td>
                </tr>
				<?php } ?>
				<tfoot>
					<tr>
						<td>
							<button class="add-more add-more-image-sizes">Add another</button>
						</td>
					</tr>
				</tfoot>
			</td>
		</tr>
	</table>
</div>