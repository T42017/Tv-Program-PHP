 <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TV-Table</title>
</head>

<body>
    <h1 style="text-align:center;">TV-Tables</h1>
    <table>
    <tr><th>Show name</th><th>Run time</th></tr>
    
    <?php
    $json = file_get_contents('http://json.xmltv.se/kunskapskanalen.svt.se_2017-10-05.js.gz');
    $table = json_decode($json, true);
    
    $max = sizeof($table['jsontv']['programme']);
    
    for($i = 0; $i < $max; $i++){
        echo "<tr>";
        
        echo "<td>".$table['jsontv']['programme'][$i]['title']['sv']." "."</td>";
        
        $timeStart = $table['jsontv']['programme'][$i]['start'];
        echo "<td>".gmdate("H:i ", $timeStart)." - "."</td>";
        
        $timeEnd = $table['jsontv']['programme'][$i]['stop'];
        echo "<td>".gmdate('H:i', $timeEnd)."<br>"."</td>";
        
        
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html> 