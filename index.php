 <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TV-Table</title>
</head>

<body>
    <h1 style="text-align:center;">TV-Tables</h1>
    <?php
    $json = file_get_contents('http://json.xmltv.se/kunskapskanalen.svt.se_2017-10-05.js.gz');
    $ar = json_decode($json, true);
    
    $max = sizeof($ar['jsontv']['programme']);
    
    for($i = 0; $i < $max; $i++){
        echo $ar['jsontv']['programme'][$i]['start']."<br>";
    }
    ?>
</body>
</html> 