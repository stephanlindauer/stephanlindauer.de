<?php

require 'bootstrap.php';
$bootstrap = new Bootstrap();

try {
	$bootstrap -> execute();
} catch (Exception $exception) {
	$bootstrap -> setError( $exception );
	$bootstrap -> execute();
}
