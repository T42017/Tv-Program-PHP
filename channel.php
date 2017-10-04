<?php
if(isset($url)){

}
else{

}
$str = file_get_contents('http://json.xmltv.se/action.film.viasat.se_2017-10-07.js.gz');
$channel = json_decode($str, true);


foreach ($channel['jsontv']['programme'] as $program){
$title = reset($program['title']);
$date = gmdate("Y-m-d", $program['start']);
$time = gmdate("h:i", $program['start']).'-'.gmdate("h:i", $program['stop']);
echo "<tr>";

    echo"<td>{$title}</td>";
    echo"<td>{$date}</td>";
    echo"<td>{$time}</td>";

    echo "</tr>";
}

?>