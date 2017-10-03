<?php 
include 'header.php'; 
include './classes/tvshow.php';
?>

<div>

	<?php
	$date = isset($_GET["date"]) ? htmlspecialchars($_GET["date"]) : date('Y-m-d');
	$url = "http://json.xmltv.se/svt1.svt.se_{$date}.js.gz";
	$obj = json_decode(file_get_contents($url), true);
	$programmes = $obj["jsontv"]["programme"];
	$tv_shows = array();
	?>

	<header class="SVT1">
		<img src="SVT1.png" class="SVT1">
	</header>
	<table>	

	<?php
	for ($i = 0; $i < sizeof($programmes); $i++) {
		$title = $programmes[$i]["title"]["sv"];
		$start = $programmes[$i]["start"];
		$stop  = $programmes[$i]["stop"];
		if (isset($programmes[$i]["desc"]))
			$desc = $programmes[$i]["desc"]["sv"];
		else
			$desc = "No descreption";
		$tv_shows[$i] = new TvShow($title, $start, $stop, $desc);
		
		echo $tv_shows[$i]->is_currently_airing() ? "<tr class='tr-currently-airing'>" : "<tr>";
		echo "<td>" . $tv_shows[$i]->start . "-" . $tv_shows[$i]->stop . " ";
		echo "<a href='javascript:void(0)'>" . $tv_shows[$i]->title . "</a></td>";
		echo "</tr>";		
		echo "<tr class='desc'>";
		echo "<td class='desc'>" . $tv_shows[$i]->desc . "</td>";
		echo "</tr>";
	}
	
	?>
	</table>
</div>

<?php include 'footer.php'; ?>