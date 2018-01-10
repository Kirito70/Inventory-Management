<?php
	require_once(LIB_PATH.DS."database".DS."database.php");
    require_once(LIB_PATH.DS."database".DS."DatabaseObject.php");

	class User extends DatabaseObject
	{
	    protected static $table_name = "users";
	    protected static $db_fields = array('id','first_name','last_name','username','email','password');

		public $id = 0;
		public $username;
		public $first_name;
		public $last_name;
		public $password;
		public $email;
		public $status = true;
		public $image;

		public static function make($id,$first_name="",$last_name="",$username="",$email="")
        {
            $new_user = new User();

            $new_user->id = $id;
            $new_user->first_name = $first_name;
            $new_user->last_name = $last_name;
            $new_user->username = $username;
            $new_user->email = $email;

            return $new_user;
        }

        public function full_name()
        {
            return $this->first_name." ".$this->last_name;
        }

		public function add_user($file = "")
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

        public function user_exists()
        {
            if(!self::find_by_unique_field("username", $this->username))
            {
                return false;
            }
            else
            {
                return true;
            }
        }

	}
?>