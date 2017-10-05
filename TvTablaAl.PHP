<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>

<body>

<h1>Index</h1><h1>Al Jazerra</h1>

<table>
<tr><th><a href=TvTabla.PHP>bbc knowledge Denmark</th><th><a href=TvTablaBib.PHP>Boomerangtv Germany</th></tr>
<tr><th>programme</th><th>StartTime</th><th>EndTime</th></th><th>Description</th></tr>
<?php

if(isset($_GET['number']))
{
	$time=$_GET['number'];  
$adress="http://json.xmltv.se/arab.aljazeera.net_2017-";
$adress=$adress.$time.".js.gz";
$url=$adress;
    
}
else{

    $time=date("m-d",time());
$adress="http://json.xmltv.se/arab.aljazeera.net_2017-";    
$adress=$adress.$time.".js.gz";
$url=$adress;
	

	
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
    echo '<td><b>' . $json['jsontv']['programme'][$key]['title']['en'] .'</b></td>';
}
else{
echo '<td>' . $json['jsontv']['programme'][$key]['title']['en'] .'</td>';
}
echo '<td>' . date("H:i",$StartTimestamp) .'</td>';
echo '<td>' . date("H:i",$EndTimestamp) .'</td>';
echo '<td>' . $json['jsontv']['programme'][$key]['desc']['en'] .'</td>';
echo '</tr>';

}	
 for($i=0;$i<9;$i++){
    
if($i >= (date("d",time())+4)){
$b=(30-($i-(date("d",time())+4)));
$b=(date("m", time())-1)."-".$b;    
    } else {  
$b=date("d",time())+4-$i;
if($b<10){
$b="0".$b;    
}
$b=date("m",time())."-".$b;    
}
echo'<tr>';
echo "<td><a href='?number={$b}'>{$b}</a></td>";     
echo '</tr>';    
}  

//$title = $json['jsontv']['programme'][0]['title']['en'];
//echo $title;

//var_dump(json_decode($result, true));
?>

</table>


</body>
</html>