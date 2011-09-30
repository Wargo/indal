<?php
if(empty($_REQUEST['zone'])) {
	$zone = 'europe';
} else {
	$zone = $_REQUEST['zone'];
}

$offices = array(
	array(
		'lat' => '41.615346071613295',
		'lng' => '-4.734764099121094',
		'name' => 'Indal S.L. <br />Ctra. Arcas Reales S/N, 47008 Valladolid',
	),
	array(
		'lat' => '39.673197',
		'lng' => '-0.681023',
		'name' => 'Oficina 1',
	),
	array(
		'lat' => '43.673197',
		'lng' => '9.681023',
		'name' => 'Oficina 2',
	),
	array(
		'lat' => '39.673197',
		'lng' => '21.681023',
		'name' => 'Oficina 3',
	),
	array(
		'lat' => '56.673197',
		'lng' => '9.681023',
		'name' => 'Oficina 4',
	),
);
?>
var europe = new GLatLng(47, 7);
var north_america = new GLatLng(47, -120);
var south_america = new GLatLng(-20, -70);
var africa = new GLatLng(0, 0);
var asia = new GLatLng(55, 90);
var oceania = new GLatLng(-20, 135);
function initialize() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map_canvas"));
		map.setCenter(<?php echo $zone; ?>, 2);

		// Add 10 markers to the map at random locations
		var bounds = map.getBounds();
		var southWest = bounds.getSouthWest();
		var northEast = bounds.getNorthEast();
		var lngSpan = northEast.lng() - southWest.lng();
		var latSpan = northEast.lat() - southWest.lat();
		<?php
		foreach($offices as $office) {
			echo '
			var point = new GLatLng(' . $office['lat'] . ', ' . $office['lng'] . ');
			map.addOverlay(createMarker(point, \'' . $office['name'] . '\'));
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
		marker.openInfoWindowHtml("<b>" + letter + "</b>");
	});
	return marker;
}
