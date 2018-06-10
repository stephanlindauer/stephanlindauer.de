<?php
class AutoLoader {

	public function __construct($root) {
		$this->root = $root;
		spl_autoload_register(array($this, 'autoload'));
	}

	public function autoload($className) {

		$dirs = glob($this->root . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
		array_push($dirs, $this->root);

		foreach ($dirs as $dir) {
			$potentialClassFile = $dir . DIRECTORY_SEPARATOR . strtolower($className) . '.php';
			if (file_exists($potentialClassFile)) {
				require_once $potentialClassFile;
				return;
			}
		}
		
		//should only be reached if class can't be found:
		throw new Exception('class ' . $className . ' does not exist.');
	}

}
