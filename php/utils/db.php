<?php

class Db
{
	private static $db;
	
	public static function init()
	{
		if ( !self::$db )
		{
			try {
				$dbSettings = unserialize( DB_SETTINGS );
				
				$dsn = 'mysql:host='.$dbSettings["host"].';dbname='.$dbSettings["db"];
			
				self::$db = new PDO( $dsn, $dbSettings["user"], $dbSettings["pass"] );
				
				self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				self::$db->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
				
			} catch ( PDOException $e ) {
				echo $e;
				throw new Exception("database connection can't be established");
			}
		}
		return self::$db;
	}
}
