<!DOCTYPE html>
<html>
<head>

    <meta charset = "utf-8">



</head>

<body>

<h1> Homepage </h1>


<p>
    <?php

    $str = file_get_contents('http://json.xmltv.se/1.bluemovie.de_2017-09-23.js.gz');
    $val = json_decode($str, true);
    
    echo $val['jsontv']['programme']->video;
    ?>
</p>




</body>
</html>

