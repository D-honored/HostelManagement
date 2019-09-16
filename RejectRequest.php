<?php

session_start();

if($_SESSION['Type']!='Student')
	header('location:StudentLogin.php');

$FromID=$_GET['FromID'];
$ToID=$_GET['ToID'];


$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';

$db=mysqli_connect($host,$user,$pass,$database);
$query="DELETE from Mails where ToID='$ToID' AND FromID='$FromID'";
$parse=mysqli_query($db,$query);

header('location:Messages.php');

?>