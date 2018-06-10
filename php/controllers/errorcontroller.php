<?php

class ErrorController  extends Controller {

	function __construct( $model ) {
		parent::__construct( $model );
	}

	function showErrorMessage( $exception = false ) {
		$this -> _view = new View( $this -> _name, __FUNCTION__ );

		if ( !$exception instanceof Exception ) {
			$exception = new Exception("the requested file could not be found on the server" );
			if ( !headers_sent() ) {
				header( 'HTTP/1.1 404 Not Found' );
			}
		}

		$this -> _view -> set( "reason", 		$exception -> getMessage() );
		$this -> _view -> set( "stacktrace",	$exception -> getTraceAsString() );

		$this -> _view -> output();

		$this -> _setTitle		($this -> _name . " - " . WEBSITE_NAME);
		$this -> _setH2			($this -> _name);
		$this -> _setDescription($this -> _name);
	}

}
