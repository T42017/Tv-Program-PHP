<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$date = date("Y-m-d");
	$uri .= $_SERVER['HTTP_HOST'];
	echo "<h1><b>Index</b></h1>"; 
    echo "<a href=" . 'svt1.php?date=' . $date . "> SVT1 </a>";
    echo "<br> <br> <a href=" . 'svt2.php?date=' . $date . "> SVT2 </a>";
    echo "<br> <br> <a href=" . 'tv4.php?date=' . $date . "> TV4 </a>";
	exit;

?>