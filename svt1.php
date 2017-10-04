<?php


$date = $_GET['date'];
$today = date("Y-m-d");
$nextday = date('Y-m-d', strtotime(' +1 day'));
$url = 'http://json.xmltv.se/svt1.svt.se_' . $date . '.js.gz';
echo "<h2>" . $date . "</h2>";	


$jsondata = json_decode(file_get_contents($url), TRUE);
$programme = $jsondata["jsontv"]["programme"];



for ($i=0; $i < sizeof($programme); $i++) { 

	$start = $programme[$i]["start"];
	$stop = $programme[$i]["stop"];
	$title = $programme[$i]["title"]["sv"];
	
	echo '<br>' . date('H:i', $start);
	echo "&nbsp" . "-" . "&nbsp" .date("H:i", $stop);
	echo "&nbsp" . "<b>" . $title . "</b>";	
}





echo 
"<html>
<form action='svt1.php?date=" . $today ."method = 'GET'>
	<input id = 'submit' type='submit' value='svt'>
</form>
</html>";

?>

<html>
</form>
<form action="index.php" method = "GET">
	<input id = "submit" type="submit" value="index">
</form>
</html>