<!DOCTYPE html>
<html>

    <head>
        
    </head>
    <body>
    <hl>Tv-program</hl>
        
        <table>
            
            <tr><th>Program</th><th>start-tid</th><th>slut-tid</th><th>beskrivning</th></tr>
            <?php
            $datum = date("m-d",time());
            $adress = "http://json.xmltv.se/svt1.svt.se_2017-".$datum.".js.gz";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$adress);
            $result=curl_exec($ch);
            curl_close($ch);
            
            $table=json_decode($result,true);
            foreach($table['jsontv']['programme']as $key => $value){
                $start = $table['jsontv']['programme'][$key]['start'];
                $stop = $table['jsontv']['programme'][$key]['stop'];
                echo '<tr>';
                
                if (time()>$start&&time()<$stop){
                    echo '<td>''<b>'.$table['jsontv']['programme']['title']['sv'].'<b>''</td>'
                }
                else{
                    echo '<td>'.$table['jsontv']['programme']['title']['sv'].'</td>'
                }
            }
            ?>
        </table>
    </body>