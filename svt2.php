<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
		</head>
		<body>

			<h1>SVT1</h1>
			<form action="index.php" method = "GET">
				<input id = "submit" type="submit" value="Index">
			</form>
			<table>
				<tr><th>Start</th><th>Stop</th></th><th>Program</th></tr>
<?php

$date = isset($_GET["date"]) ? htmlspecialchars($_GET["date"]) : date('Y-m-d');
$url = "http://json.xmltv.se/svt2.svt.se_{$date}.js.gz";
echo "<h3>" . $date . "</h3>";	

$jsondata = json_decode(file_get_contents($url), TRUE);
$programme = $jsondata["jsontv"]["programme"];



for ($i=0; $i < sizeof($programme); $i++) { 

	$start = $programme[$i]["start"];
	$stop = $programme[$i]["stop"];
	$title = $programme[$i]["title"]["sv"];
	#$desc = $programme[$i]["desc"]["sv"];
	

	echo '<tr>';
	echo '<td>' . date('H:i', $start) . ' - ' .'</td>';
	echo '<td>' . date("H:i", $stop) . '</td>';
	echo '<td>' . '&emsp;'. "<script>
  function a() {
    alert('description')
    }
</script>
<a onClick='a();' style='cursor: pointer; cursor: hand;'> {$title}</a>" . '</td>';


	echo '</tr>';
}

echo "
"

?>


</html>