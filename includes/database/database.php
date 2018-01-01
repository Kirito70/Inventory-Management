<?php 
	require_once("db_config.php");

	/**
	* Defining Database class to define database functions
	*/
	class MySQLDatabase 
	{
		private $connection;
		public $last_query;
		private $magic_quotes_active;
		private $real_escape_string_exists;

		/*
			Initializes database by connecting to database
		*/
		public function __construct()
		{
			$this->connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			$this->magic_quotes_active = get_magic_quotes_gpc();
			$this->real_escape_string_exists = function_exists("mysql_real_escape_string");

			if(!$this->connection){
				die("Database connection failed: ".mysqli_error(0));
			}
		}

		/*
			Connects to the database
		*/
		public function open_connection()
		{
			$this->connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

			if(!$this->connection){
				die("Database connection failed: ".mysql_error());
			}
		}

		/*
			Setter for connection variable
		*/
		public function get_connection()
		{
			return $this->connection;
		}

		/*
			Closes the connection of the database
		*/
		public function Close_Connection()
		{
			if(isset($this->connection))
			{
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}


		/*
			Performs a query to return data or others CRUD operations
		*/
		public function query($statement)
		{
			$this->last_query = $statement;
			$result  = mysqli_query($this->connection,$statement);
			$this->Confirm_Query($result);

			return $result;
		}

		/*
			Gets array of rows from the result set returned from database query
		*/
		public function fetch_array($result_set)
		{
			return mysqli_fetch_array($result_set);
		}

		/*
			Confirms that query has been performed without errors
		*/
		private function Confirm_Query($result_set)
		{
			if(!$result_set)
			{
				$output = "Databse Query Failed: ".mysqli_error($this->connection);
				$output .= " Last SQL Query: ".$this->last_query;
				die($output);
			}
			//if(!$result_set)
			//{
			//	die("Databse Query Failed: ".mysqli_error($this->connection));
			//}
		}

		/*
			Returns Number of rows selected from database
		*/
		public function num_rows($result_set)
		{
			return mysql_num_rows($result_set);
		}

		/*
			Rturns Last Id of item inserted into the database
		*/
		public function insert_id()
		{
			//gets the last insert id
			return mysqli_insert_id($this->connection);
		}

		/*
			Returns the number of rows effected in result of performed query
		*/
		public function affected_rows()
		{
			return mysqli_affected_rows($this->connection);
		}

		/*
			Prepares string to use SQL Query manners and avoid reserved words problem
		*/
		public function escape_value($value)
		{
			if($this->real_escape_string_exists)
			{

				if ($new_enough_php)
				{
					//undo any magic qoute effects so mysql_real_escape_string can do the work

					if($magic_quotes_active)
					{
						$value = stripslashes($value);
					}
					$value = mysql_real_escape_string($value);
				}
				else //before PHP v4.3.0
				{
					// if magic quotes aren't already on then add slashes manually
					if(!$magic_quotes_active)
					{
						$value = addslashes($value);
					}
					// if magic quots are active then the slashes already exist
				}
			}

			return $value;
		}
	}

	$database = new MySQLDatabase();
	$db = &$database;
?>