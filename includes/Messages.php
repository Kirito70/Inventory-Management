<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 31/12/2017
 * Time: 6:05 PM
 */

class Messages
{
    public $message_detail;

    public function __construct()
    {
        $this->message_detail = array();
    }

    public function add_message($msg = "")
    {
        array_push($this->message_detail,$msg);
    }
    public function message_info()
    {
        return $this->message_detail;
    }
}