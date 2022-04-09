<table id="add-row" class="display table table-striped table-hover" >
	<thead>
		<tr>
			<th>Status</th>
			<th>Date & Time</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $row) { ?>
			<tr>
				<td><?= $row['text']; ?></td>
				<td><?php echo date("d F Y, h:i A", strtotime($row['time'])); ?></td>	
			</tr>
		<?php } ?>
	</tbody>
</table>
