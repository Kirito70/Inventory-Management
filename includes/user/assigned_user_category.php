<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/01/2018
 * Time: 2:16 AM
 */

    require_once(LIB_PATH.DS."database".DS."database.php");
    require_once(LIB_PATH.DS."database".DS."DatabaseObject.php");
    require_once (LIB_PATH.DS.'Functions'.DS.'functions.php');

    class assigned_user_category extends DatabaseObject
    {
        protected static $table_name = "assigned_user_category";
        protected static $db_fields = array('id','user_category_id','user_id','user_responsible');

        public $id = 0;
        public $user_category_id;
        public $user_id;
        public $user_responsible = 0;


    }

?>