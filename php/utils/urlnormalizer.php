<?php
class UrlNormalizer {

	public function __construct() {
	}

	public function normalize() {

		if (!preg_match('/www\..*?/', $_SERVER['HTTP_HOST'])) {
			header("HTTP/1.1 301 Moved Permanently"); 
			if (!EMPTY($_SERVER['REDIRECT_URL']))
				header("location: http://www." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			else
				header("location: http://www." . $_SERVER['HTTP_HOST'] );
		}
		
	}

}
