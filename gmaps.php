<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(empty($_REQUEST['zone'])) {
	$zone = 'europe';
} else {
	$zone = $_REQUEST['zone'];
}
?>
var europe = new GLatLng(47, 7);
var north_america = new GLatLng(47, -120);
var south_america = new GLatLng(-20, -70);
var america = new GLatLng(0, -70);
var africa = new GLatLng(0, 0);
var asia = new GLatLng(55, 90);
var oceania = new GLatLng(-20, 135);
function initialize() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map_canvas"));
		map.setCenter(<?php echo str_replace(' ', '_', $zone); ?>, 2);

		// Add 10 markers to the map at random locations
		var bounds = map.getBounds();
		var southWest = bounds.getSouthWest();
		var northEast = bounds.getNorthEast();
		var lngSpan = northEast.lng() - southWest.lng();
		var latSpan = northEast.lat() - southWest.lat();
		<?php
		//foreach($offices as $office) {
		while($office = mysql_fetch_object($offices)) {
			$company = $office->company;
			if(strpos($office->company, 'Indal') === 0) {
				$company = 'Indal';
			}
			$text = str_replace("\r\n", '<br />', '<strong>' . $company . '</strong><br />' . $office->address . ', ' . $office->city . ', ' . $office->zip. '<br />' . $office->phone . ($office->phone && $office->mobile?' - ':'') . $office->mobile . '<br />' . $office->hours);
			echo '
			var point = new GLatLng(' . $office->latitude . ', ' . $office->longitude . ');
			map.addOverlay(createMarker(point, \'' . $text . '\'));
			';
		}
		?>
		// Zoom
		map.addControl(new GSmallMapControl());

		// satelite, mapa, etc...
		var mapTypeControl = new GMapTypeControl();
		var topRight = new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(10,10));
		var bottomRight = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(10,10));
		map.addControl(mapTypeControl, topRight);

	}
}
// Create a base icon for all of our markers that specifies the
// shadow, icon dimensions, etc.
var baseIcon = new GIcon(G_DEFAULT_ICON);
baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
baseIcon.iconSize = new GSize(20, 34);
baseIcon.shadowSize = new GSize(37, 34);
baseIcon.iconAnchor = new GPoint(9, 34);
baseIcon.infoWindowAnchor = new GPoint(9, 2);

// Función add marker
// Creates a marker whose info window displays the letter corresponding
// to the given index.
function createMarker(point, text) {
	var letter = text;
	var letteredIcon = new GIcon(baseIcon);
	letteredIcon.image = "http://www.google.com/mapfiles/marker.png";

	// Set up our GMarkerOptions object
	markerOptions = { icon:letteredIcon };
	var marker = new GMarker(point, markerOptions);

	GEvent.addListener(marker, "click", function() {
		marker.openInfoWindowHtml(letter);
	});
	return marker;
}
