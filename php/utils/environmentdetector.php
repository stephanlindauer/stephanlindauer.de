<?php
class EnvironmentDetector {

	const LIVE = "live";
	const STAGING = "staging";
	const DEVELOPMENT = "development";
	const LOCAL = "local";

	public function getEnvironment() {
		if (strpos($_SERVER['HTTP_HOST'], 'dev.') !== FALSE)
			return self::DEVELOPMENT;
		else if (strpos($_SERVER['HTTP_HOST'], 'staging.') !== FALSE)
			return self::STAGING;
		else if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== FALSE)
			return self::LOCAL;
		else
			return self::LIVE;
	}

}
