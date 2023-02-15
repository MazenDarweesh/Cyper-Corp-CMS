<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
 $current_subject = find_subject_by_id($_GET["subject"]);
if(!$current_subject)
{
    //subject id was missing or invalid or
    // subject couldn't be found in DB
    redirect_to("manage_content.php");
}

$page_set= find_pages_for_subject($current_subject["id"] , false);
if(mysqli_num_rows($page_set) > 0)
{
$_SESSION["message"] ="Can't delete subject with pages.";
 redirect_to("manage_content.php?{$current_subject["id"]}");
}

$id = $current_subject["id"];
$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1" ;
$result = mysqli_query($connection,$query);

if ($result&& mysqli_affected_rows($connection)==1)
{
 //success
 $_SESSION["message"] ="Subject Deleted";
 redirect_to("manage_content.php");
}
else
{
    $_SESSION["message"]="Subject Deletion Failed";
    redirect_to("manage_content.php?subject={$id}");
}

?>