<?php

class ProjectsController extends Controller {

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

    function item( $arg = false ) {
        $post = $this -> _model -> getItem( $arg );

        $this -> _view = new View( $this -> _name, __FUNCTION__ );
        $this -> _view -> set( 'post', $post );
        $this -> _view -> output();

        $this -> _setTitle		( $post["title"] . " - " . $this -> _name . " - " . WEBSITE_NAME );
        $this -> _setH2			( $this -> _name );
    }

}
