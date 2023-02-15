<?php
define("DB_SERVER" ,"localhost");
define("DB_USER" ,"");
define("DB_PASS" ,"");
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
