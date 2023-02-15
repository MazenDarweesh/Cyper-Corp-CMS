<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<div id="main">
    <div id="navigation">
      <br/>
      <a href = "admin.php"> &laquo; Main Menu</a><br/>
     <?php 
       echo navigation($current_subject,$current_page) ;
     ?>
     <br/>
     <a href="new_subject.php">+Add a New Subject</a>
    </div>
    <div id="page">
        <?php echo message();?>
        <?php if($current_subject) { ?>
        <h2>Manage Subject</h2>
        Menu Name: <?php echo htmlentities($current_subject["menu_name"]);?>
        <br/>
        Position: <?php echo $current_subject["position"]; ?>
        <br/>
        Visible: <?php echo $current_subject["visible"]==1?'yes':'no'; ?>
        <br/>    
        <a href = "edit_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>"> Edit Subject </a>
        <br/>

        <h2>Page in this subject:</h2>
        <?php echo display_pages_for_current_subject($current_subject["id"])?>
        <br/>
        <a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>">+ Add a New Page to This Subject</a>

        <?php } elseif ($current_page) { ?>
        <h2>Manage Page</h2>
        Menu Name:<?php echo htmlentities($current_page["menu_name"]);?><br/>
        Position:<?php echo $current_page["position"];  ?><br/>
        Visible:<?php echo $current_page["visible"];?><br/>
        Content:<br/>
        <div class="view-content">
        <?php echo htmlentities($current_page["content"]);?> 
        </div> <br/><br/>
        
        <a href = "edit_page.php?page=<?php echo urlencode($current_page["id"]);?>"> Edit Page </a>

        <?php } else { ?>
        <h2>Manage Content</h2>
        Please Select a Subject Or a Page.
        <?php }   ?>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
