<?php

session_start();

$_SESSION['ID'] = "";
$_SESSION['Type']="";

$DBErr="";
$Username="";
$Password="";

$conn= mysqli_connect('localhost','root','','HostelManagement');//or die("Database Couldn't Be Found"); 

$Username = @test_input($_POST["Username"]);
$Password = @md5(test_input($_POST["Password"]));

$q="SELECT * from Usertable where Username = '$Username' && Password='$Password'";
$result=mysqli_query($conn,$q);
$row = mysqli_fetch_assoc($result);
$num=mysqli_num_rows($result);
if($num==1){
	$_SESSION['ID']=$row["ID"];
	$_SESSION['Type']='Student';
	header('location:UserPage.php');
}
else
	$DBErr = "Wrong Credentials/Database Not Connected";
mysqli_close($conn);

function test_input($input) {
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
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
			text-align: center;
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
		input{
			border-radius: .3vw;
			border: 0px;
			background-color: #B0EEC8;
			border-bottom: .3vw solid #05386B;
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
		.error{
			font-size: 1vw;
			color: #05386B;
		}
	</style>
</head>
<body>
	<div>
		<a href="FrontPage.html"><i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i></a>
	</div>
	<div class="head">Login</div>
	<div class="body">
		<form action="<?=$_SERVER['PHP_SELF'];?>" method="post"> 
			<div class="small">UserName</div>
			<input type="text" name="Username" placeholder="Username"><br><br>
			<div class="small">Password</div>
			<input type="password" name="Password" placeholder="Password"><br><br><br>
			<input type="submit" name="submit" value="Login" style="border: none;background-color: #05386B;color: #E5FBC3;
			font-size: 2.3vw;">
			<div class="error"><?php echo $DBErr;?></div><br><br>
		</form>
	</div>
</body>
</html>