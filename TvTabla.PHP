<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>

<body>

<h1>Index</h1>

<table>

<tr><th>programme</th><th>StartTime</th><th>EndTime</th></th><th>desc</th></tr>
<?php
$i=0;
$url="http://json.xmltv.se/bbcknowledge.dk_2017-09-29.js.gz";
date_default_timezone_set('Europe/Stockholm');

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);
curl_close($ch);

$json= json_decode($result, true);

//var_dump($json);
//exit;

foreach($json['jsontv']['programme'] as $key => $value){
$StartTimestamp = $json['jsontv']['programme'][$key]['start'] ;
$EndTimestamp = $json['jsontv']['programme'][$key]['stop'] ;
echo '<tr>';
echo '<td>' . $json['jsontv']['programme'][$key]['title']['en'] .'</td>';
echo '<td>' . gmdate("H:i:s",$StartTimestamp) .'</td>';
echo '<td>' . gmdate("H:i:s",$EndTimestamp) .'</td>';
echo '<td>' . $json['jsontv']['programme'][$key]['desc']['en'] .'</td>';
echo '</tr>';

}	
//$title = $json['jsontv']['programme'][0]['title']['en'];
//echo $title;

//var_dump(json_decode($result, true));
?>

</table>


</body>
</html>