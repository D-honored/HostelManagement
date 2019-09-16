<?php

session_start();

if($_SESSION['Type']!='Student')
	header('location:StudentLogin.php');

$FromID=$_GET['FromID'];
$ToID=$_GET['ToID'];
$Hostel=$_SESSION['Table'];

$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';

$db=mysqli_connect($host,$user,$pass,$database);

$Findquery = "SELECT * from Usertable where ID='$ToID'";
$Resultquery = mysqli_query($db,$Findquery);
$Rowquery = mysqli_fetch_assoc($Resultquery);
$RoomNo = $Rowquery['RoomNo'];


$Find = "SELECT * from $Hostel where RoomNo='$RoomNo'";
$Result = mysqli_query($db,$Find);
$Row = mysqli_fetch_assoc($Result);

if($Row['ID1']==NULL)
	$FreeID='ID1';
elseif($Row['ID2']==NULL)
	$FreeID='ID2';
elseif($Row['ID3']==NULL)
	$FreeID='ID3';


$Add="UPDATE $Hostel SET $FreeID = '$FromID' where RoomNo='$RoomNo'";
$parse=mysqli_query($db,$Add);
$Add="UPDATE Usertable SET RoomNo = '$RoomNo' where ID='$FromID'";
$parse=mysqli_query($db,$Add);

$query="DELETE from Mails where ToID='$ToID' AND FromID='$FromID'";
$parse=mysqli_query($db,$query);

header('location:Messages.php');

?>