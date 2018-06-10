<?php
class BlogController extends Controller {

	function __construct( $name ) {
		parent::__construct( $name );
		$this -> _setModel( $name );
	}

	function index($arg = false) {
		$posts = $this -> _model -> getPosts();

		$this -> _view = new View( $this -> _name, __FUNCTION__ );
		$this -> _view -> set( 'posts', $posts );
		$this -> _view -> output();

		$this -> _setTitle		( $this -> _name . " - " . WEBSITE_NAME );
		$this -> _setH2			( $this -> _name );
		$this -> _setDescription( $this -> _name );
	}

	function post( $arg = false ) {
		$post = $this -> _model -> getPost( $arg );

		$this -> _view = new View( $this -> _name, __FUNCTION__ );
		$this -> _view -> set( 'post', $post );
		$this -> _view -> output();

		$this -> _setTitle		( $post["title"] . " - " . $this -> _name . " - " . WEBSITE_NAME );
		$this -> _setH2			( $this -> _name); 
		$this -> _setDescription( $post['subtitle'] );
	}

}
