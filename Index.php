<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	</head>
	<body>
			<h1>TV-kanaler </h1>
<?php
	if(isset($_GET['date']))
		$date = $_GET['date'];
	else
		$date = date("Y-m-d");
	
	if(isset($_GET['channel']))
		$channel = $_GET['channel'];
	else
	 	$channel = "svt1.svt.se";
	
	$page = "http://json.xmltv.se/".$channel."_".$date.".js.gz";
 	$data = json_decode(file_get_contents($page), true);
?>

<h2>Välj kanal</h2>	

<?php
	$twoDaysBefeYda = date('Y-m-d', strtotime(' -3 day'));
	$oneDayBefYda = date('Y-m-d', strtotime(' -2 day'));
 	$yesterday = date('Y-m-d', strtotime(' -1 day'));
 	$currentDate = date('Y-m-d', strtotime('today'));
 	$tomorrow = date('Y-m-d', strtotime(' +1 day'));
 	$oneDayAftTmrw = date('Y-m-d', strtotime(' +2 day'));
	$twoDaysAftTmrw = date('Y-m-d', strtotime(' +3 day'));

 	$channels = array("svt1.svt.se", "svt2.svt.se", "tv3.se", "tv4.se", "kanal5.se", "tv6.se",);
?>

<ul>
	<?php echo "<li><a href='?channel={$channel}&date={$twoDaysBefeYda}'>{$twoDaysBefeYda}</a></li>"; ?>
	<?php echo "<li><a href='?channel={$channel}&date={$oneDayBefYda}'>{$oneDayBefYda}</a></li>"; ?>
	<?php echo "<li><a href='?channel={$channel}&date={$yesterday}'>{$yesterday}</a></li>"; ?>
	<?php echo "<li><a href='?channel={$channel}&date={$currentDate}'>{$currentDate}</a></li>"; ?>
	<?php echo "<li><a href='?channel={$channel}&date={$tomorrow}'>{$tomorrow}</a></li>"; ?>
	<?php echo "<li><a href='?channel={$channel}&date={$oneDayAftTmrw}'>{$oneDayAftTmrw}</a></li>"; ?>
	<?php echo "<li><a href='?channel={$channel}&date={$twoDaysAftTmrw}'>{$twoDaysAftTmrw}</a></li>"; ?>
</ul>

<form method="get">
    <select name="channel" onchange="this.form.submit();">

<?php
   	foreach ($channels as $v) {
    		$selected = ($channel === $v) ? " selected='selected' " : "";
    		echo "<option{$selected}>{$v}</option>";
    	}
?>
    </select>
</form>	

<table style="margin-top: 25px;">
	<tr>
		<th style="padding-right: 15px;">	 
			Starttid
		</th>

		<th style="padding-right: 15px;">
			Sluttid
		</th>

		<th style="text-align: left;">
			Programtitel
		</th>		
	</tr>

<?php
 	foreach ($data['jsontv']['programme'] as $value) {
 		$keys = array_keys($value['title']);
 		$startTime = date("H:i", $value['start']);
 		$endTime = date("H:i", $value['stop']);
 		$timeRN = time();

		if ($timeRN >= $value['start'] && $timeRN <= $value['stop'])
 			echo "<tr><td><b>".$startTime."</b></td><td><b>".$endTime."</b></td><td><b>".$value['title'][$keys[0]].'</b></td></tr>';
 		else 
 			echo "<tr><td>".$startTime."</td><td>".$endTime."</td><td>".$value['title'][$keys[0]].'</td></tr>';
	}
?>

</table>
	</body>
</html>