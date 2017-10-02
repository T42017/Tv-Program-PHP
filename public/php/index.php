<?php 
include 'header.php'; 
include './classes/tvshow.php';
?>

<div>
	<?php
	if (!isset($_GET["date"])) {
		$date = "2017-10-02"; // TODO
	}
	else {
		$date = htmlspecialchars($_GET["date"]);
	}
	$url = "http://json.xmltv.se/svt1.svt.se_{$date}.js.gz";
	$obj = json_decode(file_get_contents($url), true);
	$programmes = $obj["jsontv"]["programme"];
	$tv_shows = array();

	echo "<table>";
	echo "<th>Starttid</th><th>Sluttid</th><th>Titel</th>";
	for ($i = 0; $i < sizeof($programmes); $i++) {
		$title = $programmes[$i]["title"]["sv"];
		$start = $programmes[$i]["start"];
		$stop  = $programmes[$i]["stop"];
		$tv_shows[$i] = new TvShow($title, $start, $stop);
		echo "<tr>";
		echo "<td>" . $tv_shows[$i]->start . "</td>";
		echo "<td>" . $tv_shows[$i]->stop . "</td>";
		echo "<td>" . $tv_shows[$i]->title . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	foreach ($tv_shows as $show) {
		#echo $show->to_string() . "<br />";
	}
	?>
</div>

<?php include 'footer.php'; ?>