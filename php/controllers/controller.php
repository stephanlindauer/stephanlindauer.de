<?php
class Controller {

	protected $_name;
	protected $_view;
	protected $_model;

	function __construct( $name ) {
		$this -> _name = $name;
	}

	protected function _setModel( $modelName ) {
		$modelName .= 'Model';
		$this -> _model = new $modelName();
	}

	protected function _setTitle( $title ) {
		MetaData::$title = $title;
	}

	protected function _setDescription( $description ) {
		MetaData::$description = $description;
	}

	protected function _setH2( $h2 ) {
		MetaData::$h2 = $h2;
	}

}
