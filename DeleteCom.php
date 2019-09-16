<?php

session_start();

if($_SESSION['Type']!='Admin')
	header('location:AdminLogin.php');

$RoomNo=$_GET['RoomNo'];
$Hostel=$_GET['Hostel'];


$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';

$db=mysqli_connect($host,$user,$pass,$database);
$q1="DELETE FROM $Hostel where RoomNo = '$RoomNo'";
$result=mysqli_query($db,$q1);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=BioRhyme&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>SendRequestPage</title>
	<style type="text/css">
		body{
			background-color: #5CDB95;
		}
		.head{
			color: #E5FBC3;
			font-size: 4vw;
			text-align: center;
			font-family:'BioRhyme',serif;
			padding-top: 12%;
		}
		i{	
			color: #05386B;
			margin: 4%;
			padding: 1%;
			margin-bottom: 0%;

		}
		i:hover{
			background-color: #EDF5E1	;
			border-radius: 50%;
		}
	</style>
</head>
<body>
	<div>
		<a href="DeleteRoom.php"><i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i></a>
	</div>
	<div class="head">ROOM DELETED</div>
</body>
</html>