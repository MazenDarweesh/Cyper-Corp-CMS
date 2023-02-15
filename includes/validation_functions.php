<?php 
$errors = array();

function fieldname_as_text($fieldname)
{
    $fieldname = str_replace("_" ," ",$fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
}

// couple of notes : * presence
// use trim() so empty spaces don't count
// use === to avoid false positives 
// empty() would consider "0" to be empty
function has_presence($value)
{
    return isset($value) && $value !== "";
}

function validate_presences($required_fields)
{
    global $errors;

    foreach($required_fields as $field)
    {
        $value = trim($_POST[$field]);
        if(!has_presence($value))
        {
            $errors[$field]= fieldname_as_text($field) . " can't be blank";
        }
    }
}

// * string length 
// max length 
function has_max_length($value ,$max)
{
    return strlen($value) <= $max;
}

function validate_max_lengths($field_with_max_lengths)
{
    global $errors ;
    //expects an assoc. array
    foreach($field_with_max_lengths as $field => $max)
    {
        $value = trim($_POST[$field]);
        if(!has_max_length($value,$max))
        {
            $errors[$field] = fieldname_as_text($field) . " is too long";
        }
    }
}


?>