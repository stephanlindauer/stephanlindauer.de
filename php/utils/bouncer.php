<?php
class Bouncer {

	private $useragent;
	private $oldBrowsers;

	public function __construct() {
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$oldBrowsers = array("Opera/3", "Opera/2", "Opera/1", "Safari/4", "Safari/3", "Safari/2", "Safari/1", "Navigator/", "MSIE 8", "MSIE 7", "MSIE 6", "MSIE 5", "MSIE 4", "MSIE 3", "MSIE 2", "MSIE 1", );
	}

	public function redirect() {

		foreach ($oldBrowsers as $value) {
			if (strpos($useragent, "MSIE 6.0")) {
				header("Location: http://google.com/");
			}
		}
	}

}
