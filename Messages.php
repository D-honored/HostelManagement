<?php

session_start();

if($_SESSION['Type']!='Student')
	header('location:StudentLogin.php');

$ID = $_SESSION['ID'];
$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';

$db=mysqli_connect($host,$user,$pass,$database);
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
		.but{
			padding: 3% 2%;
			font-size: 2vw;
			border-radius: .3vw;
			border: .1vw solid white;
			background-color: #05386B;
			color:#E5FBC3;
		}
		#header{
			color: #E5FBC3;
			font-size: 2vw;
			padding: 1%;
			padding-left: 5%;
		}
		.col-md-3{
			background-color: #379683;
			height:100%;
			background-size:cover;
			text-align: center;
		}
		.col-md-9{
			padding-left: 10%;
		}
		.opt{
			margin: 15%;
			margin-top: 30%;
		}
		.container{
			font-size: 2vw;
			color: #E5FBC3;
			text-align: center;
		}
		#row1{
			margin:2% 30%; 
		}
	</style>
</head>
<body>
	<div style="background-color: #05386B;">
		<div id="header">
		<a href = "UserPage.php" style = "text-decoration: none;">
			Hi,<?php 
					$NameQuery="SELECT * from Usertable where ID = '$ID'";
					$Nameresult=mysqli_query($db,$NameQuery);
					$Namerow = mysqli_fetch_assoc($Nameresult);
					echo $Namerow['Username'];
				?>
		</a>
			<a href="Logout.php">
				<button style="float: right; background-color: #E55917; font-size: 2vw;border: none;">Logout</button>
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="opt"><a href="BookRoom.php"><button class="but">Book Room</button></a></div>
			<div class="opt"><a href="ChangeRoom.php"><button class="but">Change Room</button></a></div>
			<div class="opt"><a href="Messages.php"><button class="but">Messages</button></a></div>
		</div>
		<div class="col-md-9">
			<div class="container">
				<?php					
					$query="SELECT * from Mails where ToID='$ID'";
					$parse=mysqli_query($db,$query);
					$num=@mysqli_num_rows($parse);
					if($num==0)
						echo "Sorry, No Messages";
					else{
						while($key = mysqli_fetch_assoc($parse)) {
							?>
							<?php echo $key['Name']." (".$key['FromID'].")<br>".$key['Message'];?>
							<br>
							<div class="row" id="row1">
								<div class="col-md-6">
									<a href="AcceptRequest.php?FromID=<?php echo $key['FromID'];?>&ToID=<?php echo $key['ToID']?>">
										<button style="margin: 1% 1% 2% 1%;padding: .2vw 1vw;font-size: 1.5vw;;border: 0.3vw solid #05386B;">Accept</button>
									</a>
								</div>
								<div class="col-md-6">
									<a href="RejectRequest.php?FromID=<?php echo $key['FromID'];?>&ToID=<?php echo $key['ToID']?>">
										<button style="margin: 1% 1% 2% 1%;padding: .2vw 1vw;font-size: 1.5vw;;border: 0.3vw solid #05386B;">Reject</button>
									</a>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>