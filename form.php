<?php
if(!empty($_REQUEST['zone'])) {
	$zone = $_REQUEST['zone'];
} else {
	$zone = 'europe';
}
?>
<form method="post" action="results.php">
	<select name="zone">
		<option <?php if($zone == 'europe') echo 'selected'; ?> value="europe">Europa</option>
		<option <?php if($zone == 'north_america') echo 'selected'; ?> value="north_america">América</option>
		<option <?php if($zone == 'south_america') echo 'selected'; ?> value="south_america">Sudamérica</option>
		<option <?php if($zone == 'asia') echo 'selected'; ?> value="asia">Asia</option>
		<option <?php if($zone == 'africa') echo 'selected'; ?> value="africa">África</option>
		<option <?php if($zone == 'oceania') echo 'selected'; ?> value="oceania">Oceanía</option>
	</select>
	<select name="country">
		<option value="1">España</option>
		<option value="2">Portugal</option>
		<option value="3">Francia</option>
		<option value="4">Italia</option>
		<option value="5">Alemania</option>
		<option value="6">Holanda</option>
	</select>
	<!-- <input type="text" />-->
	<input type="submit" value="Buscar" />
</form>
