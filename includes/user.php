<?php
	require_once('database.php');

	class User
	{
		public $id;
		public $username;
		public $first_name;
		public $last_name;
		public $password;

		public static function find_all()
		{
			//global $database;
			//$result_set = $database->Perform_Return_Query("Select * from Users");
			//return $result_set;

			return User::find_by_sql("Select * from users");
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

		public static function find_by_id($id=0)
		{
			global $database;
			$result_array = self::find_by_sql("Select * from users where id ={$id} Limit 1");
			return !empty($result_array) ? array_shift($result_array) : false;
		}

		public static function find_by_sql($sql="")
		{
			global $database;
			$result_set = $database->Perform_Return_Query($sql);
			$found_object_array=array();
			while ($row = $database->fetch_array($result_set)) {

				$found_object_array[] = self::instantiate($row);
			}
			return $found_object_array;
		}


		private static function instantiate($record)
		{
			$object = new self;
			// $object->id = $record['id'];
			// $object->username = $record['username'];
			// $object->password = $record['password'];
			// $object->first_name = $record['first_name'];
			// $object->last_name = $record['last_name'];

			foreach($record as $attribute=>$value)
			{
				if($object->has_attribute($attribute))
				{
					$object->$attribute = $value;
				}
			}

			return $object;
		}

		private function has_attribute($attribute)
		{
			//get_object_vars returns an associative array with all attributes
			//(include private ones) as the keys and their current values as the value

			$object_vars = get_object_vars($this);

			//we dont care about the value we just want to know if the key exists
			//this will return true or false

			return array_key_exists($attribute, $object_vars);
		}

	}
?>