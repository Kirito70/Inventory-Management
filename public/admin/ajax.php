<?php
require_once ('../../includes/initialize/admin_initialize.php');
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05/01/2018
 * Time: 11:23 AM
 */
if(isset($_POST['category_name']) && !empty($_POST['category_name']) )
{
    $temp_category = new UserCategory();
    $temp_category->category_name = $_POST['category_name'];

    if($temp_category->category_exists())
    {
        echo true;
    }
    else
    {
        echo false;
    }
}

if(isset($_POST['username']) && !empty($_POST['username']) )
{
    $temp_user = new User();
    $temp_user->username = $_POST['username'];

    if($temp_category->category_exists())
    {
        echo true;
    }
    else
    {
        echo false;
    }
}
?>