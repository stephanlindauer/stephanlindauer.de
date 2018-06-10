<?php

class View {

	protected $_data = array();

	protected $_file;
	protected $_path;

	function __construct( $name, $action ) {
		$this -> _file = __DIR__ . DS . $name . DS . $action . ".php";
		$this -> _path = __DIR__ . DS . $name . DS;
	}

	public function output() {

		if (!file_exists( $this -> _file )) {
			throw new Exception("view " . $this -> _file . " doesn't exist.");
		}

		extract( $this -> _data );
		ob_start();
		include ( $this -> _file );
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}

	public function set( $key, $value ) {
		$this -> _data[$key] = $value;
	}

	public function get( $key ) {
		return $this -> _data[ $key ];
	} 

}
