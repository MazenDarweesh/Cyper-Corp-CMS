<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php 
find_selected_page();
if(isset($_POST['submit']))
{
    //process the form
    $id =urlencode($current_subject["id"]);
    $menu_name = mysql_prep($_POST["menu_name"]);
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"];
    $content = mysql_prep($_POST["content"]);
    //validations 
    $required_fields = array("menu_name" ,"position" , "visible","content" );
    validate_presences($required_fields);

    $fields_with_max_length = array ("menu_name" => 30);
    validate_max_lengths($fields_with_max_length);

    if(!empty($errors))
    {
        $_SESSION["errors"]= $errors;
        redirect_to("new_page.php");
    }

    $query  = "INSERT INTO pages ( ";
    $query .= "subject_id ,menu_name ,position , visible ,content  ";
    $query .= ") VALUES ( ";
    $query .= " {$id} ,'{$menu_name}',{$position},{$visible},'{$content}' ";
    $query .= ")";
    $result = mysqli_query($connection,$query);

    if ($result)
    {
      //success
      $_SESSION["message"] ="Page Created";
      redirect_to("manage_content.php?subject=". urlencode($current_subject["id"])); 
    } 
    else
    {
        //faluire وهيبقى خطا فادح يعني ضرب الداتا تايب
        $_SESSION["message"]="Page Creation Failed";
        //redirect_to("new_page.php");
    }

}
else
{
    //if the val didn't submit
    // so it's prply a Get req يعني حد كتب بايده ف شريط الموقع
    redirect_to("new_page.php");
}
?>
<?php
if(isset($connection)) {mysqli_close($connection);}
?>

