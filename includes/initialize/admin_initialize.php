<?php

/*including this file so that DIRECTORY SEPARATOR can be included in the file to use.*/
require_once("path_initialize.php");
/*config file must be loaded first because database paths should be there to load*/
require_once(LIB_PATH . DS. "database".DS . "db_config.php");

/*load basic function so it can be used in other places*/
require_once(LIB_PATH .DS."Functions". DS . "functions.php");

/*now core objects are to be loaded like session or database*/
require_once(LIB_PATH . DS . "session.php");
require_once (LIB_PATH.DS."database".DS."DatabaseObject.php");
require_once(LIB_PATH . DS. "database" .DS. "database.php");

/*now load database related classes*/

/* Icluding User Related Files*/
require_once(LIB_PATH . DS . "user".DS."user.php");
require_once(LIB_PATH . DS . "user".DS."UserCategory.php");
require_once(LIB_PATH . DS . "user".DS."user_picture.php");
require_once(LIB_PATH . DS . "user".DS."assigned_user_category.php");
?>