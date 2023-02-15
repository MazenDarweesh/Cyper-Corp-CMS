<div id = "footer">Copyright <?php echo date("Y"); ?>,Mazen Th. Darweesh</div>

 </body>
</html>
<?php
//5- closing db conn
if(isset($connection))
{
    mysqli_close($connection);
}
?>