<?php
$url = "http://json.xmltv.se/";
$html = file_get_contents($url);
$dom = new DOMDocument();
$dom->loadHTML($html);
$links = $dom->getElementsByTagName('a');
$channelLinks = array();

$date = date("Y-m-d");
foreach ($links as $link) {
	if (strpos($link->nodeValue, '.se') !== false && strpos($link->nodeValue, $date) !== false) {
		array_push($channelLinks, $link->nodeValue);
	}
}
?>