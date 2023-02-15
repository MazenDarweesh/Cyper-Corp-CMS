<?php
define("DB_SERVER" ,"localhost");
define("DB_USER" ,"root");
define("DB_PASS" ,"313619313619");
define("DB_NAME" ,"cyper_corp");

$connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//test if conn succ
if (mysqli_connect_errno())
{
    die("DB conn failed: " . 
        //the actual error
        mysqli_connect_error() .
        "(" . mysqli_connect_errno() . ")"
        );
}
?>
