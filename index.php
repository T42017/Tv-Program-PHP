<?php

	require __DIR__ . '/vendor/autoload.php';
	$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
	$twig = new Twig_Environment($loader, array('cache' => __DIR__ . '/cache', 'debug' => true));


    $channels = array("bbcentertainment.com_","comedycentral.tv_","h2.historytv.se_","hd.discoverychannel.se_","hd.disneychannel.se_");
    $today = date('Y-m-d');



    if(isset($_GET['channelnumber'])){
            $currentchannel = $_GET['channelnumber'];
    }
    if(!isset($currentchannel)){
        $currentchannel = 0;
    }
    
if(isset($_GET['channel'])){
        if($_GET['channel'] == "Next"){
               if($currentchannel == count($channels) - 1){
            $currentchannel = 0;
        }
        else
        {
            $currentchannel += 1;
        }
    }
    if($_GET['channel'] == "Previous"){

        if($currentchannel == 0){
            $currentchannel = count($channels) - 1;
        }
        else
        {
            $currentchannel -= 1;
        }
    }
}



    if(isset($_GET['date']))
    {
        $date = $_GET['date'];
        $json=file_get_contents("http://json.xmltv.se/".$channels[$currentchannel].$date.".js.gz");
    }
    else
    {
        $json = file_get_contents("http://json.xmltv.se/bbcentertainment.com_".$today.".js.gz");
    }

    $data = json_decode($json, true);
    $programme = $data["jsontv"]["programme"];
    
    $timenow = time();
    $programs = array();

    for($i=0; $i < count($programme); $i++){
        
        $timestart = $programme[$i]["start"];
        $timestop = $programme[$i]["stop"];
        
        $programs[] = array(
            'title'=> $programme[$i]["title"]["sv"],
            'timestart'=> date("H:i:s", $programme[$i]["start"]),
            'timeend'=> date("H:i:s", $programme[$i]["stop"]),
            'isplaying'=> ($timestart < $timenow && $timenow < $timestop) ? 'true' : 'false'
        );
    }

    
if(isset($_GET['date'])){
        $datetimetomorrow = new DateTime($_GET['date']);
    $datetimetomorrow->modify('+1 day');

    $datetimeyesterday = new DateTime($_GET['date']);
    $datetimeyesterday->modify('-1 day');

    $showdate = new DateTime($_GET['date']);
}
else{
    $datetimetomorrow = new Datetime();
    $datetimetomorrow->modify('+1 day');
    
    $datetimeyesterday = new DateTime();
    $datetimeyesterday->modify('-1 day');
    
    $showdate = new DateTime();
}

    $watching = $channels[$currentchannel];
    
	echo $twig->render('city.twig', array(
        'programs' => $programs, 
        'date'=> date("Y-m-d"), 
        'datetomorrow'=> $datetimetomorrow->format('Y-m-d'),  
        'dateyesterday'=> $datetimeyesterday->format('Y-m-d'), 
        'showdate'=> $showdate->format('Y-m-d'),
        'currentchannel'=> $currentchannel,
        'watching' => $watching
    ));

?>