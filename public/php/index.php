<?php 
include 'header.php'; 
include './classes/tvshow.php';
include 'addchannels.php';
?>
<body class="index">
	<header>
		TV-Tableau.PontusHemsida.net
	</header>
<div class= "index">

	<form action="showchannel.php" method="get">
		<label for="channel">
			Kanal
		</label>
		<br />

		<select name="channel">
			<?php
			foreach ($channelLinks as $channelLink) {
				echo "<option value='$channelLink'>$channelLink</option>";
			}
			?>
		</select>
		<br />
		
		<input type="submit" value="Visa"/>
	</form>
</div>

<?php include 'footer.php'; ?>