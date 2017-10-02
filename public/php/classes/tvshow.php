<?php
class TvShow {
	public $title;
	public $start;
	public $stop;

	function __construct($title, $start, $stop) {
		$this->title      = $title;
		$this->start      = date("H:i", $start);
		$this->stop       = date("H:i", $stop);
	}

	function to_string() {
		return "{$this->start} - {$this->stop}: {$this->title}";
	}
}
?>