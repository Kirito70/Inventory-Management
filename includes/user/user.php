<?php
	require_once(LIB_PATH.DS."database".DS."database.php");
    require_once(LIB_PATH.DS."database".DS."DatabaseObject.php");

	class User extends DatabaseObject
	{
	    protected static $table_name = "users";
	    protected static $fields = array('first_name','last_name','username','email','password');

		public $id;
		public $username;
		public $first_name;
		public $last_name;
		public $password;
		public $email;
		public $status = true;

		public static function make($id,$first_name="",$last_name="",$username="",$email="")
        {

        }

		public function add_user()
        {

        }

        /*To find user detail by provided username*/
        public function get_user_by_username($temp_username = "")
        {
            $result = self::find_by_field("username",$temp_username);

            //if user does not exist then system returns false
            if(!$result)
            {
                //As user does not exist
                return false;
            }
            else
            {
                //return user as user exists in the system
                return $result;
            }
        }




		public static function authenticate($username="",$password="" )
		{
			global $database;
			$username = $database->escape_value($username);
			$password = $database->escape_value($password);

			$sql = "select * from users ";
			$sql .= "where username = '{$username}' ";
			$sql .= "and password = '{$password}' ";
			$sql .= "limit 1";
			$result_array = self::find_by_sql($sql);
			return !empty($result_array) ? array_shift($result_array): false;
		}

		public function get_full_name()
		{
			return $this->first_name." ".$this->last_name;
		}

	}
?>