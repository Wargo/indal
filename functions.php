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
