<?php

session_start();

if($_SESSION['Type']!='Admin')
	header('location:AdminLogin.php');

?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=BioRhyme&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>
		AdminPage
	</title>
	<style type="text/css">
		body{
			background-color: #5CDB95;
			font-family:'BioRhyme',serif;
		}
		#header{
			background-color: #05386B;
			color: #E5FBC3;
			font-size: 2vw;
			padding: 1%;
			padding-left: 5%;
		}
		img{
			height: 15vw;
			width: 15vw;
			padding: 3%;
			border-radius: 50%;
		}
		.row{
			text-align: center;
			margin: 13% 10%;
		}
	</style>
</head>
<body>
	<div id="header">
		Hi, Admin
		<a href="Logout.php">
			<button style="float: right; background-color: #E55917; font-size: 2vw;border: none;">Logout</button>
		</a>
	</div>
	<div class="row">
		<div class="col-md-6">
			<a href="AddRoom.php">
				<img src="construct.png"  style="background-color: red;">
			</a>
		</div>
		<div class="col-md-6">
			<a href="DeleteRoom.php">
				<img src="destroy.png" style="background-color: orange;">
			</a>
			
		</div>
	</div>
</body>
</html>