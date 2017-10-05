<!DOCTYPE html>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(function() { $(".txtrev").on('click', function() { $(this).parent().find('.details').slideToggle(300); }); });
</script>

<html>
<link rel = "stylesheet"
      type = "text/css"
      href = "tvTableStyle.css" />
<head>
    <meta charset = "utf-8">
</head>

<body>

<h1> Channels </h1>

<?php

$selectedDate = date("Y-m-d");



if(isset($_GET['date']))
{
    $selectedDate = $_GET['date'];
    if(isset($_GET['action'])){
        if($_GET['action'] === ">"){
            $selectedDate = strtotime("+1 day", strtotime($selectedDate));
        }
        else if($_GET['action'] === "<"){
            $selectedDate = strtotime("-1 day", strtotime($selectedDate));
        }
        $selectedDate = date("Y-m-d", $selectedDate);
    }


}
$svt1Url = 'http://json.xmltv.se/svt1.svt.se_'.$selectedDate.'.js.gz';
$svt2Url = 'http://json.xmltv.se/svt2.svt.se_'.$selectedDate.'.js.gz';
$tv3Url = 'http://json.xmltv.se/tv3.se_'.$selectedDate.'.js.gz';
$tv4Url = 'http://json.xmltv.se/tv4.se_'.$selectedDate.'.js.gz';
@file_get_contents($svt1Url)
?>
<nav>
    Change date
    <form method="get">

        <input type="hidden" name="date" value="<?php echo $selectedDate?>" />
        <button type="submit" name="action" value="<">
            <?php $tmpDate = strtotime("-1 day", strtotime($selectedDate)); echo date("m-d", $tmpDate)?>
        </button>
        <button type="submit" name="action" value=">">
            <?php $tmpDate = strtotime("+1 day", strtotime($selectedDate)); echo date("m-d", $tmpDate)?>
        </button>

    </form>
</nav>

        <div class = "right">

            <table>
               <h2>SVT2</h2>
               <tr>  <th> Programme <hr> </th> <th> Date <hr></th><th> Time <hr></th> </tr>



               <?php

               $svt2 = @file_get_contents($svt2Url);

               if($svt2 === false){
                   echo "No info found";
               }
                else {
                    $channel = json_decode($svt2, true);


                    foreach ($channel['jsontv']['programme'] as $program) {


                        $title = reset($program['title']);
                        $date = gmdate("Y-m-d", $program['start']);
                        $time = gmdate("H:i", $program['start']) . '-' . gmdate("H:i", $program['stop']);

                        echo "<tr>";
                        if (isset($program['desc'])) {
                            $desc = reset($program['desc']);
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>$desc</div></td>";
                        } else {
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>No more info.</div></td>";

                        }
                        echo "<td>{$date}</td>";
                        echo "<td>{$time}</td>";
                        if (gmdate("Hi", $program['start']) < date("Hi") && date("Hi") < gmdate("Hi", $program['stop'])) {

                            echo "<td>Playing</td>";
                        }

                        echo "</tr>";

                    }
                }
               ?>

            </table>


            <table>


                <h2>TV4</h2>
                <tr> <th> Programme <hr> </th> <th> Date <hr></th><th> Time <hr></th> </tr>



                <?php

                $tv4 = @file_get_contents($tv4Url);

                if($tv4 === false){
                    echo "No info found";
                }


                else {
                    $channel = json_decode($tv4, true);

                    foreach ($channel['jsontv']['programme'] as $program) {


                        $title = reset($program['title']);
                        $date = gmdate("Y-m-d", $program['start']);
                        $time = gmdate("H:i", $program['start']) . '-' . gmdate("H:i", $program['stop']);

                        echo "<tr>";
                        if (isset($program['desc'])) {
                            $desc = reset($program['desc']);
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>$desc</div></td>";
                        } else {
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>No more info.</div></td>";

                        }
                        echo "<td>{$date}</td>";
                        echo "<td>{$time}</td>";
                        if (gmdate("Hi", $program['start']) < date("Hi") && date("Hi") < gmdate("Hi", $program['stop'])) {

                            echo "<td>Playing</td>";
                        }

                        echo "</tr>";
                    }
                }
                ?>
            </table>


        </div>

        <div class = "left">

            <table>
                <h2>SVT1</h2>
                <tr> <th> Programme <hr> </th> <th> Date <hr></th><th> Time <hr></th> </tr>



                <?php
                $svt1 = @file_get_contents($svt1Url);
                if($svt1 === false){
                    echo "No info found";
                }

                else {

                    $channel = json_decode($svt1, true);

                    foreach ($channel['jsontv']['programme'] as $program) {


                        $title = reset($program['title']);
                        $date = gmdate("Y-m-d", $program['start']);
                        $time = gmdate("H:i", $program['start']) . '-' . gmdate("H:i", $program['stop']);

                        echo "<tr>";
                        if (isset($program['desc'])) {
                            $desc = reset($program['desc']);
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>$desc</div></td>";
                        } else {
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>No more info.</div></td>";

                        }
                        echo "<td>{$date}</td>";
                        echo "<td>{$time}</td>";
                        if (gmdate("Hi", $program['start']) < date("Hi") && date("Hi") < gmdate("Hi", $program['stop'])) {

                            echo "<td>Playing</td>";
                        }
                        echo "</tr>";
                    }
                }
                ?>

            </table>


            <table>

                <h2>TV3</h2>
                <tr> <th> Programme <hr> </th> <th> Date <hr></th><th> Time <hr></th> </tr>



                <?php

                $tv3 = @file_get_contents($tv3Url);
                if($tv3 === false){
                    echo "No info found";

                }

                else {
                    $channel = json_decode($tv3, true);


                    foreach ($channel['jsontv']['programme'] as $program) {


                        $title = reset($program['title']);
                        $date = gmdate("Y-m-d", $program['start']);
                        $time = gmdate("H:i", $program['start']) . '-' . gmdate("H:i", $program['stop']);

                        echo "<tr>";
                        if (isset($program['desc'])) {
                            $desc = reset($program['desc']);
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>$desc</div></td>";
                        } else {
                            echo "<td class = 'title'><span class='txtrev'>{$title}</span><div class='details'>No more info.</div></td>";

                        }
                        echo "<td>{$date}</td>";
                        echo "<td>{$time}</td>";
                        if (gmdate("Hi", $program['start']) < date("Hi") && date("Hi") < gmdate("Hi", $program['stop'])) {

                            echo "<td>Playing</td>";
                        }

                        echo "</tr>";
                    }
                }
                ?>

            </table>

        </div>





    </body>

</html>