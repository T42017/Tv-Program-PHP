<?php 
include 'header.php'; 
include './classes/tvshow.php';

if (!isset($_GET["channel"])) {
	echo "Channel not found.";
	exit;
}

$date_pattern = "/\d{4}-\d{2}-\d{2}/";
$baseURL = "http://json.xmltv.se";
$channelURL = $_GET["channel"];
$date_matches;
$date_from_url = preg_match($date_pattern, $channelURL, $date_matches); // Get date from channelURL
$date = $date_matches[0];
$channelURL = preg_replace($date_pattern, $date_matches[0], $channelURL);
$url = $baseURL . "/" . $channelURL;

$previous_day = date('Y-m-d', strtotime($date . ' - 1 days'));
$next_day     = date('Y-m-d', strtotime($date . ' + 1 days'));

$previous_day_URL = preg_replace($date_pattern, $previous_day, $channelURL);
$next_day_URL     = preg_replace($date_pattern, $next_day    , $channelURL);

$should_print_left_arrow = true;
$should_print_right_arrow = true;


if (!@file_get_contents($baseURL . "/" . $previous_day_URL)) {
	$should_print_left_arrow = false;
}

if (!@file_get_contents($baseURL . "/" . $next_day_URL)) {
	$should_print_right_arrow = false;
}

$obj = json_decode(file_get_contents($url), true);

$programmes = $obj["jsontv"]["programme"];
$tv_shows = array();
?>

<div>
	<div id="date-control">
		<?php if ($should_print_left_arrow): ?>
		<a href="./showchannel.php?channel=<?php echo $previous_day_URL; ?>">
			&larr;
		</a>
		<?php else: ?>
		<a class="arrownotshow" href="./showchannel.php?channel=<?php echo $previous_day_URL; ?>">
			&larr;
		</a>
		<?php endif; ?>
		
		<?php echo $date; ?>

		<?php if ($should_print_right_arrow): ?>
		<a href="./showchannel.php?channel=<?php echo $next_day_URL; ?>">
			&rarr;
		</a>
		<?php else: ?>
		<a class="arrownotshow" href="./showchannel.php?channel=<?php echo $next_day_URL; ?>">
			&rarr;
		</a>
		<?php endif; ?>
	</div>

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

			if (isset($programmes[$i]["episodeNum"]) && isset($programmes[$i]["episodeNum"]["onscreen"]))
				$episodeNum = $programmes[$i]["episodeNum"]["onscreen"];
			else
				$episodeNum = "No episode number";
			
			if (isset($programmes[$i]["category"]) && isset($programmes[$i]["category"]["en"]))
				$category = $programmes[$i]["category"]["en"];
			else
				$category = "No categories";
			
			if (isset($programmes[$i]["desc"]) && isset($programmes[$i]["desc"]["sv"]))
				$description = $programmes[$i]["desc"]["sv"];
			else
				$description = "No description";
			
			$tv_shows[$i] = new TvShow($title, $start, $stop, $episodeNum, $category, $description); 
			$moreinfo = $tv_shows[$i]->full_info_string();
			
			// If the show is currently airing, give it a css-class
			echo $tv_shows[$i]->is_currently_airing() ? "<tr class='tr-currently-airing'>" : "<tr>";
			echo "<td>" . $tv_shows[$i]->start . "</td>";
			echo "<td>" . $tv_shows[$i]->stop . "</td>";
			echo "<td class='tooltip'>" . $tv_shows[$i]->title . "<span class='tooltiptext'>$moreinfo</span></td>";
			echo "</tr>";
		}
		?>
	</table>
</div>

<?php include 'footer.php'; ?>