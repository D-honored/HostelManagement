<?php

session_start();

if($_SESSION['Type']!='Student')
	header('location:StudentLogin.php');

$ID = $_SESSION['ID'];
$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';
$tablename='';

$db=mysqli_connect($host,$user,$pass,$database);
$q="SELECT * from Usertable where ID = '$ID'";
$result=mysqli_query($db,$q);
$row = mysqli_fetch_assoc($result);

if($row['Year']==1 && $row['Gender']=='Male')
	$tablename='FirstBoys';
elseif($row['Year']==1 && $row['Gender']=='Female')
	$tablename='FirstGirls';
elseif($row['Gender']=='Male')
	$tablename='OtherBoys';
elseif($row['Gender']=='Female')
	$tablename='OtherGirls';

$_SESSION['Table']=$tablename;
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=BioRhyme&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>
		RegisterPage
	</title>
	<style type="text/css">
		body{
			background-color: #5CDB95;
			font-family:'BioRhyme',serif;
		}
		.head{
			color: #E5FBC3;
			font-size: 4vw;
			text-align: left;
			padding-top: 2vw;
			padding-bottom: 3vw;
		}
		.body{
			margin-right: 25%;
			margin-left: 25%;
			background-color: #8EE4AF;
			font-size: 2vw;
			padding:3% 9%;
		}
		.small{
			color: #05386B;
			font-size: 1.5vw;
		}
		.but{
			padding: 3% 2%;
			font-size: 2vw;
			border-radius: .3vw;
			border: .1vw solid white;
			background-color: #05386B;
			color:#E5FBC3;
		}
		#header{
			background-color: #05386B;
			color: #E5FBC3;
			font-size: 2vw;
			padding: 1%;
			padding-left: 5%;
		}
		.col-md-3{
			background-color: #379683;
			height: 100%;
			text-align: center;
		}
		.col-md-9{
			padding-left: 10%;
		}
		.opt{
			margin: 15%;
			margin-top: 30%;
		}
	</style>
</head>
<body>
	<div id="header">
		Hi,<?php echo $row['Username'];?>
		<a href="Logout.php">
			<button style="float: right; background-color: #E55917; font-size: 2vw;border: none;">Logout</button>
		</a>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="opt"><a href="BookRoom.php"><button class="but">Book Room</button></a></div>
			<div class="opt"><a href="ChangeRoom.php"><button class="but">Change Room</button></a></div>
			<div class="opt"><a href="Messages.php"><button class="but">Messages</button></a></div>
		</div>
		<div class="col-md-9">
			<div class="head">Personal Details</div>
			<div style="font-size: 2vw;color: #05386B;">
				Name: <?php echo $row['Name'];?><br>
				ID: <?php echo $row['ID'];?><br>
				Year: <?php echo $row['Year']?><br>
				Gender: <?php echo $row['Gender']?><br>
				RoomNo: <?php if($row['RoomNo']==NULL)
								echo "No Room Assigned";
							  else
								echo $row['RoomNo'];?>
			</div>
		</div>
	</div>
</body>
</html>