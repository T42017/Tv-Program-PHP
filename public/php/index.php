<?php 
include 'header.php'; 
include './classes/tvshow.php';
include 'addchannels.php';
?>

<div>
	<form action="showchannel.php" method="get">
		<select name="channel">
			<?php
			foreach ($channelLinks as $channelLink) {
				echo "<option value='$channelLink'>$channelLink</option>";
			}
			?>
		</select>

		<input type="submit" value="Submit"/>
	</form>
</div>

<?php include 'footer.php'; ?>