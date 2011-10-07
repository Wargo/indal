<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Contact</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>

<?php
$zones = array(
	'america' => 'north_america',
	'sudamerica' => 'south_america',
	'africa' => 'africa',
	'europa' => 'europe',
	'asia' => 'asia',
	'oceania' => 'oceania',
);
$aux = array();
foreach($zones as $key => $value) {
	 $aux[] = $key . '=results.php?zone=' . $value;
}
?>
<body onload="initialize()" onunload="GUnload()">
	<h1>Contact</h1>
	<?php include('form.php'); ?>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="500" height="290">
	<param name="movie" value="map2.swf?<?php echo implode('&', $aux); ?>" />
	<param name="quality" value="high" />
	<embed src="map2.swf?<?php echo implode('&', $aux); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="500" height="290"></embed>
	</object>
</body>
</html>
