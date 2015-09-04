<div class="col-lg-12">
<h1>Assign Access</h1>
<hr>
</div>
<div class="col-lg-4">
<form action="<?php echo base_url('userize_admin/add_controller_access'); ?>" method="post">
		<label>Assign Access for</label>
		<select name="role" class="form-control" onchange="get_controller(this.value)">
		<option value="">Choose</option>
		<?php
		foreach($roles as $role) { ?>		
		<option value="<?php echo $role->id_role; ?>" ><?php echo $role->role_name; ?></option>
		<?php } ?>
		</select>
	<br>
	<label>Menu Name / Controller Name</label>
	<br>
	<div id="controller-result">
	<?php
	/*
	foreach($menus as $menu) {
	?>
		<input type="checkbox" name="assigned_menu[]" value="<?php echo $menu; ?>"><?php echo $menu; ?><br>
	<?php
	}
	*/
	?>
	</div>
	<br>
	<input type="submit" value="Assign Access" class="btn btn-success">
</div>
</form>
<script type="text/javascript">
function get_controller(role) {
	$(document).ready(function() {
		$.post( "<?php echo base_url('userize_admin/get_free_controller_by_role'); ?>/"+role, function( data ) {
  		$( "#controller-result" ).html( data );
		});
	});
}
</script>