<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 31/12/2017
 * Time: 10:30 AM
 */
require_once ("../../includes/database/database.php");
require_once ("../../includes/database/DatabaseObject.php");

class UserCategory extends DatabaseObject
{
    protected static $table_name = "user_category";
    protected static $db_fields = array('id','category_name','category_description','status');

    public $id = 0;
    public $category_name;
    public $category_description;
    public $status = true;

    public static function make($category_id,$category_name="",$category_description = "",$status = "true")
    {
        if(!empty($category_id) && !empty($category_name) && !empty($category_description))
        {
            $category = new UserCategory();

            $category->id = $category_id;
            $category->category_name = $category_name;
            $category->category_description = $category_description;
            $category->status = $status;
            return $category;
        }
        else
        {
            return false;
        }


    }

    public function category_exists()
    {
        if(!self::find_by_unique_field("category_name", $this->category_name))
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