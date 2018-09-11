<?php
if ($_POST["user"]=="" || $_POST["pass"]=="")
{echo "Nu ai completat user sau parola! <br />";
echo "<a href=\"autentificare.php\"> Autentifica-te! </a>";
exit;}
include "connect.php";
$passcrypt=md5($_POST["pass"]);

$sql="SELECT * FROM admin WHERE username='".$_POST["user"]."'AND pass='".$passcrypt."'";
$do_sql=mysqli_query($link,$sql);
echo mysqli_error($link);
if (mysqli_num_rows($do_sql)!=1)
{echo "Ai gresit user sau pass! <br />";
echo "<a href=\"autentificare.php\"> Autentifica-te! </a>";
exit;}
session_start();
//a pornit un fisier pe hard disk
$_SESSION["key_admin"]=session_id();
$_SESSION['user'] = $_POST['user'];
$_SESSION["pass"]=$passcrypt;
//lasam userul in fisierul de control cu header
header("location:admin.php");



?>