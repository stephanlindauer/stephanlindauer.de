<?php

class HiremeController extends Controller {

	function __construct( $name ) {
		parent::__construct( $name );
	}

	function index( $arg = false ) {
		$this -> _view = new View( $this -> _name, __FUNCTION__ );
		$this -> _view -> output();

		$this -> _setTitle		($this -> _name . " - " . WEBSITE_NAME);
		$this -> _setH2			($this -> _name);
		$this -> _setDescription($this -> _name);
	}
}
