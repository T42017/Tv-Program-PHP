<!DOCTPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
    
<body>

<h1>TV3</h1>

<?php
	if(isset($_GET['date']))
		$date = $_GET['date'];
	else
		$date = date("Y-m-d");

	//hd.tv3.se
	//tv4.se

	$url = "hd.tv3.se";
	$page = "http://json.xmltv.se/".$url."_".$date.".js.gz";
 	$data = json_decode(file_get_contents($page), true);
?>

<table>
	<tr>
		<th>	 
			Starttid
		</th>

		<th>
			Sluttid
		</th>

		<th>
			Programtitel
		</th>
	</tr>

<?php
 	foreach ($data['jsontv']['programme'] as $value) {
 		$keys = array_keys($value['title']);
 		$startTime = date("H:i", $value['start']);
 		$endTime = date("H:i", $value['stop']);
 		$timeRN = time();

		if ($timeRN >= $value['start'] && $timeRN <= $value['stop'])
 			echo "<tr><td><b>".$startTime."</b></td><td><b>".$endTime."</b></td><td><b>".$value['title'][$keys[0]].'</b></td></tr>';
 		else 
 			echo "<tr><td>".$startTime."</td><td>".$endTime."</td><td>".$value['title'][$keys[0]].'</td></tr>';
	}
?>