<?php
class ProjectsModel {

	function __construct() {

	}

	function getPosts() {
		$folder = WEB_ROOT . DS . "content" . DS . "projects";
		
		$folderGlob = $folder . DS . "*";

		$dirs = array_filter( glob( $folderGlob ), 'is_dir' );

		$posts = array();

		foreach ( $dirs as $dir ) {

			$post = array();
			$xml = simplexml_load_file($dir . DS . "post.xml");

			$post["permalink"] 	= basename( $dir );
			$post["title"] 		= (string)$xml -> title;
			$post["active"] 	= (string)$xml -> active;
			$post["thumbnail"] 	= "/content/projects/" . basename( $dir ) . "/thumb.png";
			$post["link"] 		= "/projects/item/" . basename( $dir );

			$post["order"] = (int) $xml -> order;

			if ( strpos( $post["active"], "true" ) !== FALSE ) {
				array_push( $posts, $post );
			}
		}

		function compare($a, $b) {
			return $a["order"] < $b["order"];
		}

		usort($posts, "compare");

		return $posts;
	}

	function getItem( $permalink ){
		$folder = WEB_ROOT . DS . "content" . DS . "projects" . DS . $permalink;

		$post 	= array();
		$xml 	= simplexml_load_file($folder . DS . "post.xml");

		$post["title"] 		    = (string)$xml -> title;

        $assetsFolder           = DS ."content". DS ."projects/" . $permalink . "/assets";
        $viewContent            = file_get_contents( $folder . DS . "content.xml", true );

        $post["content"]        = str_replace( "{assets-folder}", $assetsFolder , $viewContent );

		return $post;
	}
}
