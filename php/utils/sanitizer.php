<?php
class Sanitizer {

	public function __construct() {

	}

	public function sanitzeHeaderData() {
		$_GET 	= filter_input_array( INPUT_GET,  FILTER_SANITIZE_STRING );
		$_POST	= filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
	}

}
