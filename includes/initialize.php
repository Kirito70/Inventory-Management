<?php
	/*
	Deining the core paths
	Define them as absolute paths to make sure that require_once works as expected

	DIRECTORY_SEPRATOR is a PHP pre-defined constant
	(/ for user and \ for windows)
	*/	
	defined('DS')? null :define('DS', DIRECTORY_SEPARATOR);

/*PHP native constant that is used to define root directory w.r.t website's index page*/
	defined('SITE_ROOT') ? null : define('SITE_ROOT','C:'.DS.'xampp'.DS.'htdocs'.DS.'POS');

/*PHP native constant that is being used to define a path w.r.t native path which is going to be used most of the time*/
	defined('LIB_PATH')? null : define('LIB_PATH',SITE_ROOT.DS.'includes');

	/*config file must be loaded first because database paths should be there to load*/
	require_once(LIB_PATH.DS."db_config.php");

	/*load basic function so it can be used in other places*/
	require_once(LIB_PATH .DS."Functions". DS . "functions.php");

	/*now core objects are to be loaded like session or database*/
	require_once(LIB_PATH.DS."session.php");
	require_once(LIB_PATH.DS."database.php");

	/*now load database related classes*/
	require_once(LIB_PATH.DS."user.php");
?>