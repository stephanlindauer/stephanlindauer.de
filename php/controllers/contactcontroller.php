<?php

class ContactController extends Controller {

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

	function sendMessage($arg = false) {
		$headers = "From: " . $_POST['email'] . "\r\n";
		$headers .= "Reply-To: " . $_POST['email'] . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		if (mail("stephanlindauer@posteo.de", "request from " . $_POST["name"], $_POST["enquiry"], $headers)) {
			echo "success";
		} else {
			die("error");
		}

	}

}
