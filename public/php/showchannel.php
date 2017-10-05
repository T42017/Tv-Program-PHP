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
// $date = isset($_GET["date"]) ? htmlspecialchars($_GET["date"]) : date('Y-m-d');
$date_match;
$date = preg_match($date_pattern, $channelURL, $date_match); // Get date from channelURL
$channelURL = preg_replace($date_pattern, $date_match[0], $channelURL);
$url = $baseURL . "/" . $channelURL;

$obj = json_decode(file_get_contents($url), true);
$programmes = $obj["jsontv"]["programme"];
$tv_shows = array();

$previous_day = date('Y-m-d', strtotime($date_match[0] . ' - 1 days'));
$next_day     = date('Y-m-d', strtotime($date_match[0] . ' + 1 days'));

$previous_day_URL = preg_replace($date_pattern, $previous_day, $channelURL);
$next_day_URL     = preg_replace($date_pattern, $next_day    , $channelURL);
?>

<div>
	<div id="date-control">
		<a href="./showchannel.php?channel=<?php echo $previous_day_URL; ?>">
			&larr;
		</a>
		
		<?php echo $date_match[0]; ?>

		<a href="./showchannel.php?channel=<?php echo $next_day_URL; ?>">
			&rarr;
		</a>
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
			$category = $programmes[$i]["category"]["en"];           if (!isset($category))    $category    = "No categories";
			$description = $programmes[$i]["desc"];                  if (!isset($description)) $description = "No description";
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