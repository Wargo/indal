<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('youtube.php');
include('functions.php');

$youtube = new ChannelFeed('IndalLighting', $page);
$vids = $youtube->showFullFeed();
if(!count($vids)) {
	header('Location:index.php?page=' . ($page - 1));
}
//$vidIDs = array_map($youtube->getYTid(),$vids);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Vídeos</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>
<body>
	<div class="header">
		<h1>Zona multimedia</h1>
		<ul class="menu">
			<li><a href="photos.php">Fotos</a></li>
			<li>Vídeos</li>
		</ul>
		<h2>Vídeos</h2>
	</div>

	<div class="clearfix">
		<ul class="list">
		<?php
		if(!is_dir('cache')) {
			mkdir('cache');
		}
		foreach($vids as $vid) {
			$id = $youtube->getYTid((string)$vid);
			if(!empty($id)) {
				if(file_exists('cache/' . $id . '.txt')) {
					$file = fopen('cache/' . $id . '.txt', 'r');
					$data = (array)json_decode(fread($file, filesize('cache/' . $id . '.txt')));
				} else {
					$data = (array)simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . $id);
					$file = fopen('cache/' . $id . '.txt', 'w');
					fwrite($file, json_encode($data));
					fclose($file);
				}
				echo '<li class="clearfix">';
					echo '<a target="_blank" href="http://www.youtube.com/?v=' . $id . '"><img class="img" border="0" src="http://i1.ytimg.com/vi/' . $id . '/default.jpg" align="left" /></a>';
					echo '<a target="_blank" href="http://www.youtube.com/?v=' . $id . '" class="title">' . (string)$data['title'] . '</a>';
					if(!is_object($data['content'])) {
						echo '<p>' . short_text((string)$data['content'], 400) . '</p>';
					}
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
