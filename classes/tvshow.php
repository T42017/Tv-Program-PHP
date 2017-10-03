<?php
class TvShow {
	private $current_date;
	private $start_date;
	public $title;
	public $start;
	public $stop;
	public $desc;
	function __construct($title, $start, $stop, $desc) {
		$this->current_date = date("Y-M-d");
		$this->start_date = date("Y-M-d", $start);
		$this->title      = $title;
		$this->desc       = isset($desc)?$desc:"No description";
		$this->start      = date("H:i", $start);
		$this->stop       = date("H:i", $stop);
	}
	function is_currently_airing() {
		$now = date("H:i");
		return $this->current_date === $this->start_date && $this->start < $now && $this->stop >= $now;
	}
	function to_string() {
		return "{$this->start} - {$this->stop}: {$this->title} {$this->desc}";
	}
}
?>