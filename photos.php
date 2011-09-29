<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('phpFlickr-3.1/phpFlickr.php'); //Incluyendo el API de Flickr
$f = new phpFlickr('d51a852e16430fb26b78b3435cb48df0'); //Clase de Api, conseguir en: http://www.flickr.com/services/api/keys/
$nsid = '57174169@N06'; // indal
//Incluir tag, ordenamieno, privacidad, y numero de imagenes a mostrar
$photos = $f->photos_search(array('tags' => '', 'user_id' => $nsid, 'sort' => 'date-posted-desc', 'privacy_filter' => 1, 'per_page' => 10, 'page' => 1));
$url = 'http://www.flickr.com/photos/'.$nsid.'/'; //Url de la Imgen Original
if (is_array($photos['photo']))
{
	foreach ($photos['photo'] as $photo)
	{
		$salida = '<div class="caja">';
		$salida .= '<a href="'.$url.$photo['id'].'"><img alt="'.$photo['title'].'" title="'.$photo['title'].'" src="'.$f->buildPhotoURL($photo, 'square').'" /></a>';
		echo $salida.'</div>';
	}
}
?>
