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
		 </tr>
		</thead>
		<tbody>
		<?php $no = 1; foreach($menus as $menu) { if (empty($menu)) continue; ?>
		 <tr>
		  <td><?php echo $no++; ?></td>
		  <td><?php echo $menu; ?></td>
		 </tr>
		<?php } ?>
		</tbody>
	</table>
</div>