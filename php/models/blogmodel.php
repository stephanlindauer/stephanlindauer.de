<?php
class BlogModel {

	function __construct() {

	}

	function getPosts() {
		$folder = WEB_ROOT . DS . "content" . DS . "blog";
		
		$folderGlob = $folder . DS . "*";

		$dirs = array_filter( glob( $folderGlob ), 'is_dir' );

		$posts = array();

		foreach ( $dirs as $dir ) {

			$post = array();
			$xml = simplexml_load_file($dir . DS . "post.xml");

			$post["permalink"] 	= basename( $dir );
			$post["title"] 		= (string)$xml -> title;
			$post["subtitle"] 	= (string)$xml -> subtitle;
			$post["active"] 	= (string)$xml -> active;
			$post["thumbnail"] 	= "/content/blog/" . basename( $dir ) . "/thumb.png";
			$post["link"] 		= "/blog/post/" . basename( $dir );
						
			$timeString 		= 	(string)$xml -> date -> day 	. '-' .
									(string)$xml -> date -> month 	. '-' .
									(string)$xml -> date -> year;
			
			$timeString 		= preg_replace( '/\s+/', '', $timeString );

			$post["date"] 		= new DateTime( $timeString );

			if ( strpos( $post["active"], "true" ) !== FALSE ) {
				array_push( $posts, $post );
			}
		}

		function compare($a, $b) {
			return $a["date"] < $b["date"];
		}
		
		usort($posts, "compare");

		return $posts;
	}

	function getPost( $permalink ){
		$folder = WEB_ROOT . DS . "content" . DS . "blog" . DS . $permalink;

		$post 	= array();
		$xml 	= simplexml_load_file($folder . DS . "post.xml");

		$post["title"] 		= (string)$xml -> title;
		$post["subtitle"] 	= (string)$xml -> subtitle;
		$post["thumbnail"] 	= "/content/blog/" . $permalink . "/thumb.png";
						
		$timeString =	(string)$xml -> date -> day . '-' .
						(string)$xml -> date -> month. '-' .
						(string)$xml -> date -> year;
			
		$timeString = preg_replace( '/\s+/', '', $timeString );
        $post["date"] = new DateTime( $timeString );

        $assetsFolder = DS ."content". DS ."blog/" . $permalink . "/assets";
        $viewContent = file_get_contents( $folder . DS . "content.xml", true );
        $post["content"]        = str_replace( "{assets-folder}", $assetsFolder , $viewContent );



        return $post;
	}
}
