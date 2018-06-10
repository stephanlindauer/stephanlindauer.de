<?php

class Bootstrap {

	private $controller;
	private $action;
	private $arg;

	private $configurator;
	private $autoloader;

	public function __construct() {
		try {
			session_start();

			require 'utils/autoloader.php';
			$this -> autoloader = new AutoLoader(__DIR__);

			$this -> configurator = new Configurator(__DIR__);

			if( APPLICATION_ENVIRONMENT == EnvironmentDetector::STAGING		||
				APPLICATION_ENVIRONMENT == EnvironmentDetector::DEVELOPMENT	){

				if ( $_SESSION[ 'unlocked' ] != TRUE )
					die ( "access denied" );
			}

			if( APPLICATION_ENVIRONMENT == EnvironmentDetector::LIVE	){
				$urlnormalizer = new UrlNormalizer();
				$urlnormalizer->normalize();
			}

			$sanitizer = new Sanitizer();
			$sanitizer->sanitzeHeaderData();

			$bouncer = new Bouncer();

			$controllerName = isset($_GET["controller"]) ? $_GET["controller"] : "about";
			$action = isset( $_GET["action"] ) && $_GET["action"] != "" ? $_GET["action"] : "index";
			$arg = isset($_GET["arg"]) ? $_GET["arg"] : "";

			$this -> setController($controllerName);

			if (method_exists($this -> controller, $action)) {
				$this -> action = $action;
			} else {
				throw new Exception('action does not exists');
			}

			$this -> arg = $arg;

		} catch (Exception $exception) {
			$this -> setError($exception);
		}
	}

	public function execute() {
		$this -> controller -> { $this->action }($this -> arg);
	}

	private function setController($controllerName) {
		$controllerClassName = ucfirst($controllerName) . "Controller";
		$this -> controller = new $controllerClassName($controllerName);
		$this -> controllerName = $controllerName;
		$this -> title = $controllerName;
	}

	public function setError($exception) {
		$controllerName = "error";
		$this -> setController($controllerName);
		$this -> action = "showErrorMessage";
		$this -> arg = $exception;
	}

}
