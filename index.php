<?php


$str = file_get_contents('http://json.xmltv.se/kanal10.se_2017-09-30.js.gz');
$json = json_decode($str, true);

#print_r($json);
#print_r($json["jsontv"]["programme"][0]["title"]);
for ($i = 0; $i < count($json["jsontv"]["programme"]); $i++){
	
echo $json["jsontv"]["programme"][$i]["title"]["sv"];
echo  "<br>";
}
?>
<!doctype>
<html>
<header>
<h1>Rubrik</h1>
</header>
<body>

</body>

</html>