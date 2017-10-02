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

	<table>
		<th>
			Starttid
		</th>

		<th>
			Sluttid
		</th>

		<th>
			Titel
		</th>

	<?php
	for ($i = 0; $i < sizeof($programmes); $i++) {
		$title = $programmes[$i]["title"]["sv"];
		$start = $programmes[$i]["start"];
		$stop  = $programmes[$i]["stop"];
		$tv_shows[$i] = new TvShow($title, $start, $stop);
		
		echo $tv_shows[$i]->is_currently_airing() ? "<tr class='tr-currently-airing'>" : "<tr>";
		echo "<td>" . $tv_shows[$i]->start . "</td>";
		echo "<td>" . $tv_shows[$i]->stop . "</td>";
		echo "<td>" . $tv_shows[$i]->title . "</td>";
		echo "</tr>";		
	}
	echo "</table>";
	?>
</div>

<?php include 'footer.php'; ?>