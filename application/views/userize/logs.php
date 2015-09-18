<div class="col-lg-12">
<h1>Roles</h1>
<hr>
</div>
<div class="col-lg-12">
	<table class="table table-bordered table-stripped" id="example" class="display">
		<thead>
		 <tr>
		  <th>No</th>
		  <th>Log Type</th>
		  <th>Log Detail</th>
		  <th>Accessed From</th>
		  <th>Timestamp</th>
		 </tr>
		</thead>
		<tbody>
		<?php $no = 1; foreach($logs as $log) { ?>
		 <tr>
		  <td><?php echo $no++; ?></td>
		  <td><?php echo $log->logs ?></td>
		  <td><?php echo $log->detail; ?></td>
		  <td><?php echo $log->from; ?></td>
		  <td><?php echo $log->timestamp; ?></td>
		 </tr>
		<?php } ?>
		</tbody>
		<tfoot>
		 <tr>
		  <th>No</th>
		  <th>Log Type</th>
		  <th>Log Detail</th>
		  <th>Accessed From</th>
		  <th>Timestamp</th>
		 </tr>
		</foot>
	</table>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo base_url('userize_admin/get_logs'); ?>"
    } );
} );	
</script>