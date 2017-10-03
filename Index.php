<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	</head>

	<body>

<?php
	if(isset($_GET['date']))
		$date = $_GET['date'];
	else
		$date = date("Y-m-d");

	$page = "http://json.xmltv.se/hd.tv3.se_".$date.".js.gz";
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