<!DOCTYPE html>
<html>
<head>

    <meta charset = "utf-8">



</head>

<body>

<h1> Homepage </h1>


<p>
    <?php

    $str = file_get_contents('http://json.xmltv.se/action.film.viasat.se_2017-10-06.js.gz');
    $val = json_decode($str, true);
    
    echo $val['jsontv']['programme'][0]['credits']['actor'][0]['role'];

    ?>
</p>




</body>
</html>

