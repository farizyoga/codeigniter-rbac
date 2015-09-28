<div class="col-lg-12">
<h1>Logs</h1>
<hr>
</div>
<div class="col-lg-12">
	<table class="table table-bordered table-stripped" id="example" class="display">
		<thead>
		 <tr>
		  <th>Log Type</th>
		  <th>Log Detail</th>
		  <th>Accessed From</th>
		  <th>Timestamp</th>
		 </tr>
     <tbody>
      <?php foreach($logs as $log) {
        ?>
        <tr>
          <td><?php echo $log->logs; ?></td>
          <td><?php echo $log->detail; ?></td>
          <td><?php echo $log->from; ?></td>
          <td><?php echo $log->timestamp; ?></td>
        </tr>
        <?php
      }
      ?>
		</thead>
		<tbody></tbody>
	</table>
</div>
<script type="text/javascript">
$(document).ready(function() {
    table = $('#example').DataTable();
}
</script>