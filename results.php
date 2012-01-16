<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('functions.php');

if(empty($_POST['zone'])) {
	$zone = 'europe';
} else {
	$zone = $_POST['zone'];
}

$conditions = '';

$conditions .= "and continent like '%$zone%'";

if(!empty($_POST['text'])) {
	$text = $_POST['text'];
	$conditions .= "and (email like '%$text%' or company like '%$text%' or address like '%$text%' or phone like '%$text%')";
}

if(!empty($_POST['country'])) {
	$country = $_POST['country'];
	$conditions .= "and country = '$country'";
}

$offices = mysql_query("select * from oficinas where latitude != 0 $conditions") or die(mysql_error());
$offices2 = mysql_query("select * from oficinas where latitude = 0 $conditions") or die(mysql_error());

/*
$paises = mysql_query('select nombre from paises order by rand() limit 1');
$pais = mysql_fetch_object($paises);
*/

$key_local = 'ABQIAAAAGEV6Nd-qLB9zCIGC1aOYhhSQ2svP4hN5eHaSELwOJI6S4R9UdBQ7ESeIKDDHxmcv4t0sqBALW5AHsA';
$key = 'ABQIAAAAGEV6Nd-qLB9zCIGC1aOYhhSQ2svP4hN5eHaSELwOJI6S4R9UdBQ7ESeIKDDHxmcv4t0sqBALW5AHsA';

$europe = '47,7';
$north_america = '47,-120';
$south_america = '0,-70';
$america = '-20,-70';
$africa = '0,0';
$asia = '55,90';
$oceania = '-20,135';

$zoom = 2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo __('Contacto'); ?></title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $key; ?>"	type="text/javascript"></script>
	<!-- <script type="text/javascript" src="gmaps.php"></script> -->
	<script type="text/javascript"><?php include('gmaps.php'); ?></script>
</head>

<body onload="initialize()" onunload="GUnload()">
<!-- <body> -->
	<div class="right"><a href="?lang=en">En</a> | <a href="?lang=es">Es</a></div>
	<h1><a href="map.php"><?php echo __('Contacto'); ?></a></h1>
	<?php include('form.php'); ?>
	<div id="map_canvas" style="width: 500px; height: 400px; margin-top: 10px;"></div>
	<!-- <iframe width="500" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;msa=0&amp;msid=207693414034452542156.0004ae2817e895a4eddde&amp;ll=<?php echo ${$zone}; ?>&amp;spn=19.570247,16.204491&amp;t=m&amp;vpsrc=6&amp;output=embed&amp;z=<?php echo $zoom; ?>"></iframe> -->
	<?php
	if(mysql_num_rows($offices2)) {
		?>
		<h2><?php echo __('Otras zonas'); ?></h2>
		<ul class="list">
			<?php
			while($office = mysql_fetch_object($offices2)) {
				echo '<li>';
					echo $office->email . ' (' . $office->country . ')';
				echo '</li>';
			}
			?>
		</ul>
		<?php
	}
	?>
</body>
</html>
