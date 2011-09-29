<?php
class ChannelFeed {

	function __construct($username, $page = 1)
	{
		// $gallery = 'uploads', 'favorites', etc...
		$gallery = 'uploads';
		$this->username=$username;
		$limit = 10;
		$page = ($page - 1) * $limit + 1;
		$this->feedUrl=$url='http://gdata.youtube.com/feeds/api/users/'.$username.'/'.$gallery.'?start-index='.$page.'&max-results='.$limit;
		$this->feed=simplexml_load_file($url);
	}

	public function getYTid($ytURL = null) {

		if(empty($ytURL)) {
			$ytURL = $this->feed->entry->link['href'];
		}

		$ytvIDlen = 11; // This is the length of YouTube's video IDs

		// The ID string starts after "v=", which is usually right after 
		// "youtube.com/watch?" in the URL
		$idStarts = strpos($ytURL, "?v=");

		// In case the "v=" is NOT right after the "?" (not likely, but I like to keep my 
		// bases covered), it will be after an "&":
		if($idStarts === FALSE)
			$idStarts = strpos($ytURL, "&v=");
		// If still FALSE, URL doesn't have a vid ID
		if($idStarts === FALSE)
			die("YouTube video ID not found. Please double-check your URL.");

		// Offset the start location to match the beginning of the ID string
		$idStarts +=3;

		// Get the ID string and return it
		$ytvID = substr($ytURL, $idStarts, $ytvIDlen);    
		return $ytvID;   
	}
	public function showFullFeed()
	{ 
		$vidarray = array();
		foreach($this->feed->entry as $video){
			$vidarray[] = $video->link['href'];
		}
		return $vidarray;
	}
};
