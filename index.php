<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Tv Schedual</title>
</head>

<body>
    <?php
    
    $urlStart = 'http://json.xmltv.se/';
    $channel = 'kunskapskanalen.svt.se';
    $date = date("Y-m-d", time());
    $urlEnd = '.js.gz';
    
    if (isset($_GET['channel']))
        $channel = $_GET['channel'];
    
    if (isset($_GET['date'])) 
        $date = $_GET['date'];
    else
        $date = date('Y-m-d', time());
    
    $url = $urlStart . $channel . '_' . $date . $urlEnd;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    
    $array = json_decode($result, TRUE);
    
    echo "<h1>Channel: $channel </h1>";
    
    ?>
    
    <form>
        <select name="date">
            <?php
                for ($x = -7; $x <= 7; $x++) {
                    $tempDate = date('Y-m-d', strtotime(' ' . ($x >= 0 ? '+' :  '') . $x . ' day'));
                    echo '<option value="' . $tempDate . '" ' . ($tempDate == $date ? 'selected="selected"' : '') . '>' . $tempDate . '</option>';
                }
            ?>
        </select>
        <button name="channel" type="submit" value="<?php echo $channel; ?>"
        >Update</button>
        <button type="submit" name="channel" value="kunskapskanalen.svt.se">Kunskapskanelen</button>
        <button type="submit" name="channel" value="lifestyletv.se">Lifestyle tv</button>
        <button type="submit" name="channel" value="animalplanet.discovery.eu">Animalplanet</button>
    </form>
    
    <table>
    <tr>
    <th><h2>Title</h2></th>
    <th><h2>Start time</h2></th>
    <th><h2>Duration</h2></th>
    <th><h2>Category</h2></th>
    <th><h2>Description</h2></th>
    </tr>
    
    <?php
    
    foreach($array['jsontv']['programme'] as $key => $value) {
        
        $categories = isset($value['category']) ? array_values($value['category'])[0] : array();
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
        echo '<th>' . $categoriesAsString . '</th>';
        echo '<th>' . (array_key_exists('desc', $value) ? array_values($value['desc'])[0] : '') . '</th>';
        echo '</tr>';
    }
    
    echo '</table';
    
    ?>
</body>

</html>
