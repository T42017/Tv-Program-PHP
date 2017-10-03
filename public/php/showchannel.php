<?php 
include 'header.php'; 
include './classes/tvshow.php';
?>

<div>
	<?php
	if (!isset($_GET["channel"])) {
		echo "Channel not found.";
		exit;
	}

	$date_pattern = "/\d{4}-\d{2}-\d{2}/";
	$baseURL = "http://json.xmltv.se";
	$channelURL = $_GET["channel"];
	$date = isset($_GET["date"]) ? htmlspecialchars($_GET["date"]) : date('Y-m-d');
	$channelURL = preg_replace($date_pattern, $date, $channelURL);
	$url = $baseURL . "/" . $channelURL;

	$obj = json_decode(file_get_contents($url), true);
	$programmes = $obj["jsontv"]["programme"];
	$tv_shows = array();

	$previous_day_URL = preg_replace($date_pattern, /* TODO */, $channelURL);
	$next_day_URL = preg_replace($date_pattern, /* TODO */, $channelURL);
	?>

	<a href=>
		<
	</a>

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
		for ($i = 0; $i < count($programmes); $i++) { 
			$title = $programmes[$i]["title"]["sv"];
			$start = $programmes[$i]["start"];
			$stop  = $programmes[$i]["stop"];
			$episodeNum = $programmes[$i]["episodeNum"]["onscreen"];
			$category = $programmes[$i]["category"]["en"];
			$description = $programmes[$i]["desc"];
			$tv_shows[$i] = new TvShow($title, $start, $stop, $episodeNum, $category, $description); 
			
			// If the show is currently airing, give it a css-class
			echo $tv_shows[$i]->is_currently_airing() ? "<tr class='tr-currently-airing'>" : "<tr>";
			echo "<td>" . $tv_shows[$i]->start . "</td>";
			echo "<td>" . $tv_shows[$i]->stop . "</td>";
			echo "<td><a class='tooltip' target='_blank' href='moreinfo.php?channel=$channelURL'>" . $tv_shows[$i]->title . "<span class='tooltiptext'>Click for more info</span></a></td>";
			echo "</tr>";
		}
		?>
	</table>

	<a href="moreinfo.php">
		>
	</a>
</div>

<?php include 'footer.php'; ?>