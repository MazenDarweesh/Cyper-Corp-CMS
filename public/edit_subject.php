<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_page(); ?>

<?php 
if(!$current_subject)
{
    //subject id was missing or invalid or
    // subject couldn't be found in DB
    redirect_to("manage_content.php");
}
?>

<?php 
if(isset($_POST['submit']))
{
    //validations 
    $required_fields = array("menu_name" ,"position" , "visible");
    validate_presences($required_fields);

    $fields_with_max_length = array ("menu_name" => 30);
    validate_max_lengths($fields_with_max_length);

    if(empty($errors))
    { 
        //perform update
        $id =$current_subject["id"];
        $menu_name = mysql_prep($_POST["menu_name"]);
        $position = (int) $_POST["position"];
        $visible = (int) $_POST["visible"];

        $query  = "UPDATE subjects SET  ";
        $query .= "menu_name = '{$menu_name}', ";
        $query .= "position = {$position}, ";
        $query .= "visible = {$visible} ";
        $query .=  "WHERE id = {$id} ";
        $query .=  "LIMIT 1";
        $result = mysqli_query($connection,$query);

        if ($result&& mysqli_affected_rows($connection)>=0)
        {
        //success
        $_SESSION["message"] ="Subject Updated";
        redirect_to("manage_content.php");
        }
    }
    else
    {
        //faluire وهيبقى خطا فادح يعني ضرب الداتا تايب
       $message ="Subject Update Failed";
    }

}
else
{
    //if the val didn't submit
    // so it's prply a Get req يعني حد كتب بايده ف شريط الموقع
}
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
     <?php 
       echo navigation($current_subject,$current_page) ;
     ?>
      </div>
    <div id="page">
        <?php //$message is just var dnot use session
        if(!empty($message))
        {
            echo "<div class=\"message\">" . htmlentities($message) . "</div>";
        }  

        ?>
        <?php echo form_errors($errors); ?>
        <h2>Edit Subject: <?php echo htmlentities($current_subject["menu_name"]);?></h2>
        <form action="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>" method ="post">
         <p> Menu Name
             <input type="text" name ="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]);?>"/>
         </p>
         <p>Position
            <select name="position">
                <?php
                    $subject_set=find_all_subjects(false); 
                    $subject_count=mysqli_num_rows($subject_set);
                ?>
                <?php 
                    for($count =1 ; $count<=($subject_count);$count++)
                    {
                        echo"<option value =\"{$count}\"";
                        if($current_subject["position"]==$count){
                        echo " selected";
                        }
                        echo ">{$count}</option>";
                    }
                ?>
            </select>
        </p> 
            <p>Visible
             <input type ="radio" name= "visible" value="0" <?php if($current_subject["visible"]==0) {echo "checked";} ?> />NO
             <input type ="radio" name= "visible" value="1" <?php if($current_subject["visible"]==1) {echo "checked";} ?>/> YES
         </p>
         <input type ="submit" name ="submit" value="Edit Subject"/>
        </form>
        <br/>
        <a href="manage_content.php">Cancel</a>
        <?php//non breaking space?>
        &nbsp;
        &nbsp;
        <a href = "delete_subject.php?subject=
        <?php echo urlencode($current_subject["id"]); ?>" onclick="return confirm ('Are you sure??')">
        Delete Subject</a>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
