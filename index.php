 <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styling.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <title>TV-Table</title>
</head>

<body>
    <header>
        <h1>TV-Tables</h1>
    </header>
    <nav>
        <?php
        $date = date("Y-m-d");
        $channel;
    
        if (isset($_GET['date'])){
            $date = $_GET['date'];
        
            if (isset($_GET['action'])){
                if($_GET['action'] === "Next->"){
                    $date = strtotime("+1 day", strtotime($date));
                    $date = date("Y-m-d", $date);
                }
                else if($_GET['action'] === "<-Previous"){
                    $date = strtotime("-1 day", strtotime($date));
                    $date = date("Y-m-d", $date);
                }
            }
        }
        if (isset($_GET['channel'])){
            $channel = $_GET['channel'];
        }
        else{
            echo "<h2>Choose a channel</h2>";
        }
        ?>
        
        
        <form method="get">
            <ul>
            <li><button class="" type="submit" name="channel" value="svt1.svt.se">Svt1</button></li>
            <li><button class="" type="submit" name="channel" value="svt2.svt.se">Svt2</button></li>
            <li><button class="" type="submit" name="channel" value="kunskapskanalen.svt.se">Kunskapskanalen</button></li>
            </ul>
        </form>
        
        
        <form method="get">
            <input type="hidden" name="channel" value="<?php echo $channel?>">
            <input type="hidden" name="date" value="<?php echo $date?>">
            <input class="NavButton" type="submit" name="action" value="<-Next">
            <input class="NavButton" type="submit" name="action" value="Previous->">
        </form>
        
        
    </nav>
    <div class="TextContainer">
        <main class="Programmes">
            <ol>
                <?php 
                    if (isset($_GET['channel'])){
                    $json = file_get_contents('http://json.xmltv.se/'.$channel.'_'.$date.'.js.gz');
                    $table = json_decode($json, true);
                
                    $max = sizeof($table['jsontv']['programme']);
                    for($i = 0; $i < $max; $i++){
                    $timeStart = $table['jsontv']['programme'][$i]['start'];
                    $timeEnd = $table['jsontv']['programme'][$i]['stop'];
                    $currentTime = strtotime("now") + 2*60*60;
                    
                    echo "<div>";
                    if ($timeStart < $currentTime And $timeEnd > $currentTime){
                        echo "<button class='txtRev'><b>".$table['jsontv']['programme'][$i]['title']['sv']." --- ".gmdate("H:i", $timeStart)." - ".gmdate('H:i', $timeEnd)."</b></button>";
                    }
                    else{
                        echo "<button class='txtRev'>".$table['jsontv']['programme'][$i]['title']['sv']." --- ".gmdate("H:i", $timeStart)." - ".gmdate('H:i', $timeEnd)."</button>";
                    }
                    
                    if (isset($table['jsontv']['programme'][$i]['desc']['sv'])){
                        echo "<div class='details'>".$table['jsontv']['programme'][$i]['desc']['sv']."</div>";
                    }
                    else{
                        echo "<div class='details'><p class='txtFix'>Ingen ytterligare information tillgänglig</p></div>";
                    }
                    echo "</div>";
                    }
                    }
                    else{
                        
                    }
                ?>
            </ol>
        </main>
    </div>
</body>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">
$(function() { $(".txtRev").on('click', function() { $(this).parent().find('.details').slideToggle(300); }); });
</script>
</html> 