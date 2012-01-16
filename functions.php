<?php
if(!empty($_GET['page'])) {
	$page = (int)$_GET['page'];
	if($page < 1) {
		$page = 1;
	}
} else {
	$page = 1;
}

function debug($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}
function short_text($string, $limit, $link = '...<!-- Texto cortado -->'){
	$string = strip_tags($string);
	$end_link = substr($link, strlen($link)-15);
	$wrap = wordwrap($string, $limit, $link);
	$pos = strpos($wrap, $end_link)+15;
	if($pos == 15){
		$new_text = $string;
	}
	else{
		$new_text = substr($wrap, 0, $pos);
	}
	return $new_text;
}

if(!empty($_GET['lang'])) {
	$lang = $_SESSION['lang'] = $_GET['lang'];
} elseif(!empty($_SESSION['lang'])) {
	$lang = $_SESSION['lang'];
} else {
	$lang = $_SESSION['lang'] = 'es';
}

function __($string) {
	if($_SESSION['lang'] == 'es') {
		return $string;
	} else {
		switch($string) {
			case 'Todos los paises':
				return 'All countries';
				break;
			case 'Buscar':
				return 'Search';
				break;
			case 'Contacto':
				return 'Contact';
				break;
			case 'Europa':
				return 'Europe';
				break;
			case 'Sudamérica':
				return 'South America';
				break;
			case 'Norte América':
				return 'North America';
				break;
			case 'América':
				return 'America';
				break;
			case 'África':
				return 'Africa';
				break;
			case 'Oceanía':
				return 'Oceania';
				break;
			case 'Otras zonas':
				return 'Other sites';
				break;
			default:
				return $string;
				break;
		}
	}
}
