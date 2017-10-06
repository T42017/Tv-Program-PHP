<?php
class TvShow {
	private $current_date, $start_date;
	public $tile, $start, $stop, $episodeNum, $category, $description;

	function __construct($title, $start, $stop, $episodeNum, $category, $description) {
		$this->current_date = date("Y-M-d");
		$this->start_date   = date("Y-M-d", $start);
		$this->title = $title;
		$this->start = date("H:i", $start);
		$this->stop  = date("H:i", $stop);
		$this->episodeNum  = $episodeNum;
		$this->category    = $category;
		$this->description = $description;
	}

	function is_currently_airing() {
		$now = date("H:i");
		return $this->current_date === $this->start_date && ($this->start < $now && $this->stop >= $now);
	}

	function full_info() {
		return array(
			"title"       => $this->title,
			"start"       => $this->start,
			"stop"        => $this->stop,
			"episodeNum"  => $this->episodeNum,
			"cateogry"    => $this->category,
			"description" => $this->description
		);
	}

	function full_info_string() {
		// return is_array($this->description) ? $this->description["sv"] : $this->description;
		return $this->description;
	}
}
?>