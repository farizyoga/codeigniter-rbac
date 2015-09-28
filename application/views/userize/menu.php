<div class="col-lg-12">
<h1>Menus / Controllers</h1>
<hr>
</div>
<div class="col-lg-12">
	<table class="table table-bordered">
		<thead>
		 <tr>
		  <th>No</th>
		  <th>Controller Name</th>
		  <th>Controller Allias</th>
		  <th>Description</th>
		 </tr>
		</thead>
		<tbody>
		<?php $no = 1; foreach($menus as $key => $menu) { if (empty($menu)) continue; ?>
		 <tr>
		  <td><?php echo $no++; ?></td>
		  <td><?php echo $key; ?></td>
		  <td><?php echo $menu['allias']; ?></td>
		  <td><?php echo $menu['description']; ?></td>
		 </tr>
		<?php } ?>
		</tbody>
	</table>
</div>