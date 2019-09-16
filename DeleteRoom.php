<?php

session_start();

if($_SESSION['Type']!='Admin')
	header('location:AdminLogin.php');

$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';
$tablename='';

$db=mysqli_connect($host,$user,$pass,$database);



if(isset($_POST['submit'])){
	if($_POST['Year']==1&&$_POST['Gender']=='Boys')
	$tablename='FirstBoys';
elseif($_POST['Year']==1&&$_POST['Gender']=='Girls')
	$tablename='FirstGirls';
elseif($_POST['Gender']=='Boys'&&$_POST['Year']!=1)
	$tablename='OtherBoys';
elseif($_POST['Gender']=='Girls'&&$_POST['Year']!=1)
	$tablename='OtherGirls';
}


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
		form{
			margin: 5%;
			font-size: 2vw;			
			color: #E5FBC3;
		}
		input,select{
			border-radius: .3vw;
			border: 0px;
			border-bottom: .3vw solid #05386B;
			background-color: #B0EEC8;
			margin: .5vw;	
		}
		button{
			padding: .2vw 1vw;
			font-size: 1.5vw;
			border: 0.3vw solid #05386B;
		}
	</style>
</head>
<body>
	<div id="header">
		<a href="AdminPage.php" style="text-decoration: none;color: #E5FBC3;">
			Hi, Admin
		</a>
		<a href="Logout.php">
			<button style="float: right; background-color: #E55917; font-size: 2vw;border: none;">Logout</button>
		</a>
	</div>
	<div style="text-align: center;">
		<form method="post">Year:<br>
			<select name="Year">
				<option value="" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<option value="1">I Year</option>
				<option value="2">II Year</option>
				<option value="3">III Year</option>
				<option value="4">IV Year</option>
			</select><br>Boys/Girls<br>
			<select name="Gender">
				<option value="" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<option value="Boys">Boys</option>
				<option value="Girls">Girls</option>
			</select><br><br>
			<input type="submit" name="submit" value="Submit" style="border: none;background-color: #05386B;color:#E5FBC3;">
			<div class="container">
				<br><br>
				<?php					
					$query="SELECT * from $tablename where Status='empty'";
					$parse=mysqli_query($db,$query);
					$num=@mysqli_num_rows($parse);
					if($num==0&&$tablename!='')
						echo "Sorry, All Rooms Are Occupied";
					else{
						while($key = @mysqli_fetch_assoc($parse)) {
							if($key['ID1']==NULL&&$key['ID2']==NULL&&$key['ID3']==NULL){
							?>
							<?php echo "RoomNo: ".$key['RoomNo']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."Type: ".$key['Type']." Seater";?>
							<br>
									<a style="text-decoration: none;" href="DeleteCom.php?Hostel=<?php echo $tablename;?>&RoomNo=<?php echo $key['RoomNo'];?>">
										<p style="border: 0.3vw solid black;color: #05386B;margin:0% 44%;">Delete</p>
									</a>
									<br>
							<?php
						}
					}
				}
				?>
			</div>
		</form>
	</div>
</body>
</html>