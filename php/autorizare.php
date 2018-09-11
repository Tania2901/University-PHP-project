<?php
include"connect.php";
session_start();
if ($_SESSION["key_admin"]!=session_id())
{echo "Nu esti autentificat! <br />";
echo "<a href=\"autentificare.php\"> Autentifica-te! </a>";
exit;}
$sql="SELECT * FROM admin WHERE username='".$_SESSION["user"]."'AND pass='".$_SESSION["pass"]."'";
$do_sql=mysqli_query($link,$sql);
echo mysqli_error($link);
if (mysqli_num_rows($do_sql)!=1)
{echo "User sau pass au fost modificate! <br />";
echo "<a href=\"autentificare.php\"> Autentifica-te! </a>";
exit;}

?>