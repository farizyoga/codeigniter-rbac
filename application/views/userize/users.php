<div class="col-lg-12">
<h1>Users</h1>
<hr>
</div>
<div class="col-lg-12">
	<table class="table table-bordered">
		<thead>
		 <tr>
		  <th>No</th>
		  <th>ID User</th>
		  <th>Email</th>
		  <th>Role</th>
		  <th>Actions</th>
		 </tr>
		</thead>
		<tbody>
		<?php $no = 1; foreach($users as $user) { ?>
		 <tr>
		  <td><?php echo $no++; ?></td>
		  <td><?php echo $user->id_user; ?></td>
		  <td><?php echo $user->email; ?></td>
		  <td><?php echo $user->role_name; ?></td>
		  <td><a href="">Edit</a>&nbsp;|&nbsp;<a href="">Delete</a></td>
		 </tr>
		<?php } ?>
		</tbody>
	</table>
</div>