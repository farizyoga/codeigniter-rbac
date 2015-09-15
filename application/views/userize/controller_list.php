<?php
if (empty($list)) {
	echo "All access has been granted to ".$role;
}
foreach($list as $controller) {
	?>
	<input type="checkbox" name="controller[]" value="<?php echo $controller; ?>">&nbsp;&nbsp;<?php echo $controller; ?></option>
	<br>
	<?php
}
?>