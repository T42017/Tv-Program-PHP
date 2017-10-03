<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	</head>

	<body>

<?php

	$page = "http://json.xmltv.se/svt1.svt.se_2017-10-08.js.gz";
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
 		$startDate = date("H:i", $value['start']);
 		$endDate = date("H:i", $value['stop']);
 		echo "<tr><td>".$startDate."</td><td>".$endDate."</td><td>".$value['title'][$keys[0]].'</td></tr>';
	}
?>
</table>



	</body>
</html>