<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('phpFlickr-3.1/phpFlickr.php'); //Incluyendo el API de Flickr
include('functions.php');

$f = new phpFlickr('d51a852e16430fb26b78b3435cb48df0'); //Clase de Api, conseguir en: http://www.flickr.com/services/api/keys/
$nsid = '57174169@N06'; // indal

$photos = $f->photos_search(array('tags' => '', 'user_id' => $nsid, 'sort' => 'date-posted-desc', 'privacy_filter' => 1, 'per_page' => 20, 'page' => $page));
$url = 'http://www.flickr.com/photos/'.$nsid.'/'; //Url de la Imgen Original
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Fotos</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		$('.img').mousemove(function(e){
			if($('#div img').attr('src') != $(this).attr('var')) {
				$('#div').show();
				$('#div img').attr('src', $(this).attr('var'));
				$('#div img').attr('width', '400');
			}
			$('#div').attr('style', 'top: ' + (e.pageY + 5) + 'px; left: ' + (e.pageX + 5) + 'px;');
		}); 
		$(document).mouseout(function() {
			$('#div').hide();
			$('#div img').attr('width', '16');
			$('#div img').attr('src', '/webs/indal/small.gif');
		});
	})
	</script>
</head>
<body>
	<div style="display: none;" id="div"><img src="" border="0" id="image" /></div>
	<div class="header">
		<h1>Zona multimedia</h1>
		<ul class="menu">
			<li>Fotos</li>
			<li><a href="index.php">Vídeos</a></li>
		</ul>
		<h2>Fotos</h2>
	</div>

	<div class="clearfix">
		<ul class="square">
		<?php
		if (is_array($photos['photo'])) {
			foreach ($photos['photo'] as $photo) {
				echo '<li class="image">';
					echo '<a target="_blank" href="'.$url.$photo['id'].'"><img var="'.$f->buildPhotoURL($photo, 'large').'" class="img" alt="'.$photo['title'].'" title="'.$photo['title'].'" src="'.$f->buildPhotoURL($photo, 'square').'" /></a>';
					echo '<a target="_blank" href="'.$url.$photo['id'].'" class="title">' . short_text($photo['title'], 25) . '</a>';
				echo '</li>';
				//<object style="height: 390px; width: 640px"><param name="movie" value="http://www.youtube.com/v/' . $id . '?version=3"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="http://www.youtube.com/v/' . $id . '?version=3" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="640" height="360"></object>
			}
		}
		?>
		</ul>
	</div>
	<div class="clearfix paginator">
		<?php if($page != 1) { ?>
			<a href="?page=<?php echo $page - 1; ?>" class="prev">&lt; Anterior</a>
		<?php } ?>
		<a href="?page=<?php echo $page + 1; ?>" class="next">Siguiente &gt;</a>
	</div>
</body>
</html>
