<?php 

    session_start(); 

function message()
{
    if(isset($_SESSION["message"]))
    {
        $output  = "<div class=\"message\">";
        //احنا منعرفش الرسالة ده ممكن تبقى جت من الداتا بيز او اليوزر
        $output .= htmlentities($_SESSION["message"]);
        $output .= "</div>";

        //to disply message 1 time
        // fo crash css shit press ctrl+F5
        $_SESSION["message"] = null ;

        return $output;
    }
}

function errors()
{
    if(isset($_SESSION["errors"]))
    {
        $errors = ($_SESSION["errors"]);
        //to disply message 1 time
        // fo crash css shit press ctrl+F5
        $_SESSION["errors"] = null ;

        return $errors;
    }
}
?>
