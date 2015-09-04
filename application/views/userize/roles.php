<div class="col-lg-12">
<h1>Roles</h1>
<hr>
</div>
<div class="col-lg-12">
	<table class="table table-bordered">
		<thead>
		 <tr>
		  <th>No</th>
		  <th>Role Name</th>
		  <th>Controller Access</th>
		 </tr>
		</thead>
		<tbody>
		<?php $no = 1; foreach($roles as $role) { ?>
		 <tr>
		  <td><?php echo $no++; ?></td>
		  <td><?php echo $role->role_name; ?></td>
		  <td>
		  <?php
		  if (!empty($role->can)) {
		  	
		  	foreach($role->can as $access) {

		  		echo $access->controller_name;
				echo "<span style='float:right;'>".anchor('userize_admin/delete_access/'.$access->id, 'Delete Access')."</span>";
				echo "<br>";

		  	}

		  } else {

		  	   echo "No controller access defined for this role";

		  }
		  ?>
		  </td>
		 </tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<div class="col-lg-12">
	<a href="<?php echo base_url('userize_admin/add_role'); ?>" class="btn btn-success">Add New Role</a>
</div>