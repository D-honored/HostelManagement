<?php

session_start();

if($_SESSION['Type']!='Student')
	header('location:StudentLogin.php');

$ID=$_GET['id'];
$Room=$_GET['room'];
$Hostel=$_SESSION['Table'];
$iroom=$_GET['iroom'];
$R='';


$host='localhost';
$user='root';
$pass='';
$database='HostelManagement';


$db=mysqli_connect($host,$user,$pass,$database);

$q1="SELECT * FROM Mails WHERE FromID='$ID'";
$result=mysqli_query($db,$q1);
$num=@mysqli_num_rows($result);
if($num>0)
	$Show='Already Confirmation Send';
else{
		$q1="SELECT * FROM $Hostel WHERE RoomNo='$Room'";
		$result=mysqli_query($db,$q1);
		$row = mysqli_fetch_assoc($result);
		if($row['ID1']==NULL&&$row['ID2']==NULL&&$row['ID3']==NULL){
			$findquery="SELECT * from $Hostel where RoomNo='$iroom'";
			$findcheck=mysqli_query($db,$findquery);
			$findrow = @mysqli_fetch_assoc($findcheck);
			if($findrow['ID1']==$ID)
				$R='ID1';	
			elseif($findrow['ID2']==$ID)
				$R='ID2';
			elseif($findrow['ID1']==$ID)
				$R='ID2';
			$iquery="UPDATE $Hostel SET $R= NULL where RoomNo='$iroom'";
			$iresult=mysqli_query($db,$iquery);
			$query="UPDATE $Hostel SET ID1='$ID' WHERE RoomNo='$Room'";
			$result=mysqli_query($db,$query);
			$q1="UPDATE Usertable SET RoomNo='$Room' where ID='$ID'";
			$result=mysqli_query($db,$q1);
		    $Show='Room Booked';
		}
		else{
			$q1="SELECT * from Usertable where ID='$ID'";
			$result=mysqli_query($db,$q1);
			$row = mysqli_fetch_assoc($result);
			$Name=$row['Name'];	
				$q1="SELECT * FROM $Hostel WHERE RoomNo='$Room'";
				$result=mysqli_query($db,$q1);
				$row = mysqli_fetch_assoc($result);
				$ID1=$row['ID1'];

				$Message="Hi! I would like to join your Room";

				$q1="INSERT into Mails (`FromID`, `Name`, `ToID`, `Message`, `Time`) VALUES ('$ID', '$Name', '$ID1', '$Message', current_timestamp())";
				mysqli_query($db,$q1);
				$Show='Confirmation Send';
			}
}
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
		<a href="UserPage.php"><i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i></a>
	</div>
	<div class="head"><?php echo $Show;?></div>
</body>
</html>