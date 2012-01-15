<script>
function change_countries(value) {
	document.getElementById('europe').style.display = 'none';
	document.getElementById('asia').style.display = 'none';
	document.getElementById('america').style.display = 'none';
	document.getElementById('africa').style.display = 'none';
	document.getElementById('oceania').style.display = 'none';
	document.getElementById('europe').disabled = true;
	document.getElementById('asia').disabled = true;
	document.getElementById('america').disabled = true;
	document.getElementById('africa').disabled = true;
	document.getElementById('oceania').disabled = true;
	document.getElementById(value).style.display = '';
	document.getElementById(value).disabled = false;
}
</script>
<div class="form">
	<?php
	if(!empty($_REQUEST['zone'])) {
		$zone = $_REQUEST['zone'];
	} else {
		$zone = 'europe';
	}
	?>
	<form method="post" action="results.php">
		<select name="zone" onchange="change_countries(this.value)">
			<option <?php if($zone == 'europe') echo 'selected'; ?> value="europe"><?php echo __('Europa'); ?></option>
			<option <?php if($zone == 'america') echo 'selected'; ?> value="america"><?php echo __('América'); ?></option>
			<option <?php if($zone == 'asia') echo 'selected'; ?> value="asia">Asia</option>
			<option <?php if($zone == 'africa') echo 'selected'; ?> value="africa"><?php echo __('África'); ?></option>
			<option <?php if($zone == 'oceania') echo 'selected'; ?> value="oceania"><?php echo __('Oceanía'); ?></option>
		</select>
		<?php
		$array_zones = array('europe', 'america', 'africa', 'asia', 'oceania');
		foreach($array_zones as $current_zone) {
			?>
			<select name="country" id="<?php echo $current_zone; ?>" style="display: <?php echo $zone==$current_zone?'':'none'; ?>" <?php echo $zone==$current_zone?'':'disabled="disabled"'; ?>>
				<?php
				$countries = mysql_query("select country from oficinas where continent like '%$current_zone%' group by country");
				echo '<option value="">' . __('Cualquiera') . '</option>';
				while($country = mysql_fetch_object($countries)) {
					if($country->country == $_POST['country']) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
					echo '<option ' . $selected . ' value="' . $country->country . '">' . $country->country . '</option>';
				}
				?>
			</select>
			<?php
		}
		?>
		<input type="text" name="text" value="<?php echo !empty($_POST['text'])?$_POST['text']:''; ?>" />
		<input type="submit" value="<?php echo __('Buscar'); ?>" />
	</form>
</div>
