<?php
class Configurator {

	function __construct( $root ) {

		$environmentDetector = new EnvironmentDetector();

		define('APPLICATION_ENVIRONMENT', $environmentDetector -> getEnvironment());
		
		if ( APPLICATION_ENVIRONMENT == EnvironmentDetector::LIVE ) 
			error_reporting( 0 );

		switch ( APPLICATION_ENVIRONMENT) {
			case EnvironmentDetector::LIVE :
				define(
					'DB_SETTINGS', 
					serialize(
						array(
							"host" => "db468253547.db.1and1.com", 
							"user" => "dbo468253547", 
							"pass" => "blablabla", 
							"db" => "db468253547"
				)));
				break;
			case EnvironmentDetector::STAGING :
				define(
					'DB_SETTINGS', 
					serialize(
						array(
							"host" => "db468253547.db.1and1.com", 
							"user" => "dbo468253547", 
							"pass" => "blablabla", 
							"db" => "db468253547"
				)));
				break;
			case EnvironmentDetector::DEVELOPMENT :
				define(
					'DB_SETTINGS', 
					serialize(
						array(
							"host" => "db468253547.db.1and1.com", 
							"user" => "dbo468253547", 
							"pass" => "blablabla", 
							"db" => "db468253547"
				)));
				break;
			case EnvironmentDetector::LOCAL :
				define(
					'DB_SETTINGS', 
					serialize(
						array(
						"host" => "localhost", 
						"user" => "root", 
						"pass" => "", 
						"db" => "stephanlindauer"
				)));
				break;
		}

		define('DS', 				DIRECTORY_SEPARATOR);
		define('DOCUMENT_ROOT', 	$root);
		define('WEB_ROOT', 			$root . DS . ".."  );
		define('WEBMASTER_EMAIL', 	'stephanlindauer@posteo.de');
		define('WEBSITE_NAME', 		'stephan lindauer');

		MetaData::$title 		= "stephan lindauer";
		MetaData::$description 	= "stephan lindauers homepage: code, design, berlin based web development";
		MetaData::$h2 			= "stephan lindauer";

		header('Content-type: text/html; charset=utf-8');
	}

}
