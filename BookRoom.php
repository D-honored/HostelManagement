<?php

session_start();

if($_SESSION['Type']!='Student')
	header('location:StudentLogin.php');

$ID = $_SESSION['ID'];
$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';
$tablename=$_SESSION['Table'];

$db=mysqli_connect($host,$user,$pass,$database);

$Type='';
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
		a{
			border: none;
		}
		input,select{
			border-radius: .3vw;
			border: 0px;
			background-color: #B0EEC8;
			border-bottom: .3vw solid #05386B;
		}
		#submitbutton{
			margin: 1% 1% 2% 1%;
			padding: 0;
			font-size: 1.5vw;
			border: 0.3vw solid #05386B;
		}
	</style>
</head>
<body>
	<div style="background-color: #05386B;">
		<div id="header">
			Hi,<?php 
					$NameQuery="SELECT * from Usertable where ID = '$ID'";
					$Nameresult=mysqli_query($db,$NameQuery);
					$Namerow = mysqli_fetch_assoc($Nameresult);
					echo $Namerow['Username'];
				?>
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
					$query1="SELECT * from Usertable where ID='$ID'";
					$check=mysqli_query($db,$query1);
					$row = @mysqli_fetch_assoc($check);
					if($row['RoomNo']!=NULL){
						echo "You Already Have A Room";
					}
					else{
						?>
						<form method="post">
							<select name="Roomtype">
								<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option value="1">I Seater</option>
								<option value="2">II Seater</option>
								<option value="3">III Seater</option>
							</select>&nbsp;&nbsp;
							<input id="submitbutton" type="submit" name="Submit" value="Submit">
						</form>
					<?php		
						@($Type = $_POST["Roomtype"]);				
						$query2="SELECT * from $tablename where Type = '$Type' && Status = 'empty'";
						$parse=mysqli_query($db,$query2);
						$num=@mysqli_num_rows($parse);
						if($num==0&&$Type!='')
							echo "Sorry, No Room Available";
						else{
							//mysqli_fetch_assoc($parse);
							while($key = mysqli_fetch_assoc($parse)) {
								?>
								<?php echo "RoomNo: ".$key['RoomNo'];?>&nbsp;&nbsp;&nbsp;
									<?php
									if($key['ID1']==NULL&&$key['ID2']==NULL&&$key['ID3']==NULL){
										echo "Occupant: None";	
										$Occupant=0;						
									}
									else{
										echo "Occupant:";
										for($i=$Type;$i>0;$i--){
											$Identity="ID".$i;
											$SID=$key[$Identity];
											$query="SELECT * from usertable where ID='$SID'";
											$stu=mysqli_query($db,$query);
											$name = mysqli_fetch_assoc($stu);
											echo $name['Name']."   ";
										}
									}
									?>
									<br>
								<a href="SendRequest.php?id=<?php echo $row['ID'];?>&room=<?php echo $key['RoomNo']?>&iroom=<?php echo $row['RoomNo']?>">
									<button style="margin: 1% 1% 2% 1%;padding: 0;font-size: 1.5vw;;border: 0.3vw solid #05386B;">Book Room</button>
								</a>
								<br>
								<?php
							}
						}
					}	
				?>
			</div>
		</div>
	</div>
</body>
</html>