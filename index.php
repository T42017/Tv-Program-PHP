<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tv-schedual</title>
</head>

<body>
    <?php
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'http://json.xmltv.se/action.sky.de_2017-10-12.js.gz');
    $result = curl_exec($ch);
    curl_close($ch);
    
    $array = json_decode($result, TRUE);
    
    echo '<table>';
    echo '<tr>';
    echo '<th><h2>Title</h2></th>';
    echo '<th><h2>Start time</h2></th>';
    echo '<th><h2>Duration</h2></th>';
    echo '<th><h2>Category</h2></th>';
    echo '</tr>';
    
    foreach($array['jsontv']['programme'] as $key => $value) {
        
        $categories = array_values($value['category'])[0];
        $categoriesAsString = '';
        foreach ($categories as $category => $categoryValue) {
            $categoriesAsString = (($categoriesAsString == '') ? '' : $categoriesAsString . ', ') . $categoryValue;
        }
        
        $startTime = new DateTime(date("Y-m-d\TH:i:s\Z", $value['start']));
        $stopTime = new DateTime(date("Y-m-d\TH:i:s\Z", $value['stop']));
        
        echo '<tr>';
        echo '<th>' . array_values($value['title'])[0] . '</th>';
        echo '<th>' . $startTime->format('H:i') . '</th>';
        echo '<th>' . ($startTime->diff($stopTime))->format('%hh %imin') . '</th>';
        echo '<th>' . $categoriesAsString . '</th>';
        echo '</tr>';
    }
    
    echo '</table';
    
    ?>
</body>

</html>