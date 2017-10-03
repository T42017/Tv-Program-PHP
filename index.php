<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Tv-schedual</title>
</head>

<body>
    <?php
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'http://json.xmltv.se/bibeltv.de_2017-10-03.js.gz');
    $result = curl_exec($ch);
    curl_close($ch);
    
    $array = json_decode($result, TRUE);
    
    echo '<table>';
    echo '<tr>';
    echo '<th><h2>Title</h2></th>';
    echo '<th><h2>Start time</h2></th>';
    echo '<th><h2>Duration</h2></th>';
    if (strpos($result, 'category'))
        echo '<th><h2>Category</h2></th>';
    if (strpos($result, 'desc'))
        echo '<th><h2>Description</h2></th>';
    echo '</tr>';
    
    foreach($array['jsontv']['programme'] as $key => $value) {
        
        if (isset($value['category']))
            $categories = array_values($value['category'])[0];
        $categoriesAsString = '';
        foreach ($categories as $category => $categoryValue) {
            $categoriesAsString = (($categoriesAsString == '') ? '' : $categoriesAsString . ', ') . $categoryValue;
        }
        
        $startTime = new DateTime(date("Y-m-d\TH:i:s\Z", $value['start']));
        $stopTime = new DateTime(date("Y-m-d\TH:i:s\Z", $value['stop']));
        $now = new DateTime(date("Y-m-d\TH:i:s\Z", time()));
        
        if ($now > $startTime && $now < $stopTime)
            echo '<tr id="selected">';
        else
            echo '<tr>';
        echo '<th>' . array_values($value['title'])[0] . '</th>';
        echo '<th>' . $startTime->format('H:i') . '</th>';
        echo '<th>' . ($startTime->diff($stopTime))->format('%hh %imin') . '</th>';
        if (isset($value['category']))
            echo '<th>' . $categoriesAsString . '</th>';
        if (isset($value['desc']))
            echo '<th>' . array_values($value['desc'])[0] . '</th>';
        echo '</tr>';
    }
    
    echo '</table';
    
    ?>
</body>

</html>