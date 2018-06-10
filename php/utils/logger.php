<?php
class Logger {

	private $logFile;

	public function __construct() {
		$this->logFile = DOCUMENT_ROOT . DS . "logs" . DS . date("Y_m_d") . ".log";
	}

	public function log($string = "empty") {

		if ( APPLICATION_ENVIRONMENT == EnvironmentDetector::LIVE )
			return;

		$file = "unknown";
		$line = 0;
		$backtrace = debug_backtrace();

		if ( isset( $backtrace[0]["file"] ) )
			$file = basename( $backtrace[0]["file"] );

		if ( isset( $backtrace[0]["line"] ) )
			$line = $backtrace[0]["line"];

		$debugString = 	"[" . date("Y-m-d H:i:s") . "]";
		$debugString .= "[" . $file . ":" . $line . "]";
		$debugString .= " " . $string . "\n";

		$fh = fopen($this->logFile, "a+");
		fwrite($fh, $debugString);
		fclose($fh);
	}

}
