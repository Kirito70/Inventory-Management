<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28/12/2017
 * Time: 11:46 AM
 */

/*
	Deining the core paths
	Define them as absolute paths to make sure that require_once works as expected

	DIRECTORY_SEPRATOR is a PHP pre-defined constant
	(/ for user and \ for windows)
	*/
    defined('DS')? null :define('DS', DIRECTORY_SEPARATOR);

    /*PHP native constant that is used to define root directory w.r.t website's index page*/
    defined('SITE_ROOT') ? null : define('SITE_ROOT','C:'.DS.'xampp'.DS.'htdocs'.DS.'Inventory-Management');

    /*PHP native constant that is being used to define a path w.r.t native path which is going to be used most of the time*/
    defined('LIB_PATH')? null : define('LIB_PATH',SITE_ROOT.DS.'includes');
    ?>