<?php



#$d = new DateTime('+1day');
#$tomorrow = $d->format('Y-m-d');

$date = date("Y-m-d");
$url = 'http://json.xmltv.se/svt1.svt.se_' . $date . '.js.gz';
$jsondata = json_decode(file_get_contents($url), TRUE);
$programme = $jsondata["jsontv"]["programme"];
echo "<h2>" . $date . "</h2>";




for ($i=0; $i < sizeof($programme); $i++) { 

	$start = $programme[$i]["start"];
	$stop = $programme[$i]["stop"];
	$title = $programme[$i]["title"]["sv"];
	
	echo '<br>' . date('H:i', $start);
	echo "&nbsp" . "-" . "&nbsp" .date("H:i", $stop);
	echo "&nbsp" . "<b>" . $title . "</b>";
	
}
?>

<html>
<form action="svt1.php" method = "post">
	<input id = "submit" type="submit" value="next">
</form>
</html>