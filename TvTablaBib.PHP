<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>

<body>

<h1>Index</h1><h1>Boomerangtv Germany</h1>

<table>
<tr><th><a href=TvTabla.PHP>bbc knowledge Denmark</th><th><a href=TvTablaAl.PHP>Al Jazerra</th><th><a href=TvTabla.PHP?number=-1>yesterday</th><th>tomorrow</th></tr>
<tr><th>programme</th><th>StartTime</th><th>EndTime</th></th><th>Description</th></tr>
<?php

if(isset($_GET['number']))
{
	
}
else{

$url="http://json.xmltv.se/boomerangtv.de_2017-10-03.js.gz";
	
}	

echo $url;


$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);
curl_close($ch);
$nowtime = time();
$json= json_decode($result, true);
$date = new DateTime();
//var_dump($json);
//exit;

foreach($json['jsontv']['programme'] as $key => $value){
$StartTimestamp = $json['jsontv']['programme'][$key]['start'] ;
$EndTimestamp = $json['jsontv']['programme'][$key]['stop'] ;
echo '<tr>';
if($nowtime > $StartTimestamp && $nowtime < $EndTimestamp){
    echo '<td><b>' . $json['jsontv']['programme'][$key]['title']['de'] .'</b></td>';
}
else{
echo '<td>' . $json['jsontv']['programme'][$key]['title']['de'] .'</td>';
}
echo '<td>' . date("H:i",$StartTimestamp) .'</td>';
echo '<td>' . date("H:i",$EndTimestamp) .'</td>';
echo '<td>' . $json['jsontv']['programme'][$key]['desc']['de'] .'</td>';
echo '</tr>';

}	
//$title = $json['jsontv']['programme'][0]['title']['en'];
//echo $title;

//var_dump(json_decode($result, true));
?>

</table>


</body>
</html>