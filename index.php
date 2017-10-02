<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	echo "<h1><b>Index</b></h1>"; 
    echo "<a href='svt1.php'> SVT1 </a>";
	exit;

?>