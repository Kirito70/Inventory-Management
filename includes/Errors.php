<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 31/12/2017
 * Time: 4:32 PM
 */

class Errors
{
    public $Error_message;

    public function __construct()
    {
        $this->Error_message = array();
    }

    public function add_message($msg = "")
    {
        array_push($this->Error_message,$msg);
    }
    public function error_message()
    {
        return $this->Error_message;
    }
}
?>