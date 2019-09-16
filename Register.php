<?php

$NameErr=""; 
$UsernameErr= "";
$GenderErr= "";
$PasswordErr= "";
$IDErr="";
$YearErr="";
$RePasswordErr="";
$Rs="";



$Name="";
$ID="";
$Username="";
$Password="";
$RePassword="";
$Year="";
$Gender="";

 $db= mysqli_connect('localhost','root','');

if(!@mysqli_connect('localhost','root','','HostelManagement')){
$sql="CREATE Database HostelManagement";
if (mysqli_query($db,$sql)) {
    $db= mysqli_connect('localhost','root','','HostelManagement');
    $Tq="CREATE Table Usertable(
    Name VARCHAR(250) NOT NULL,
	ID VARCHAR(7) NOT NULL PRIMARY KEY,
	Username VARCHAR(250) NOT NULL,
	Password VARCHAR(250) NOT NULL,
	Year VARCHAR(1) NOT NULL,
	Gender VARCHAR(6) NOT NULL,
	RoomNo VARCHAR(3) NULL
	)";
	mysqli_query($db,$Tq);

	$Tq="CREATE Table Mails(
	FromID VARCHAR(7) NOT NULL,
    Name VARCHAR(250) NOT NULL,
    ToID VARCHAR(7) NOT NULL,
	Message VARCHAR(500) NOT NULL,
	Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";
	mysqli_query($db,$Tq);

	$Tq="CREATE Table FirstBoys(
	RoomNo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Type VARCHAR(1) NOT NULL,
    ID1 VARCHAR(10) NULL,
    ID2 VARCHAR(10) NULL,
    ID3 VARCHAR(10) NULL,
	Status VARCHAR(5) DEFAULT 'empty'
	)";
	mysqli_query($db,$Tq);

	$Tq="CREATE Table FirstGirls(
	RoomNo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Type VARCHAR(1) NOT NULL,
    ID1 VARCHAR(10) NULL,
    ID2 VARCHAR(10) NULL,
    ID3 VARCHAR(10) NULL,
	Status VARCHAR(5) DEFAULT 'empty'
	)";
	mysqli_query($db,$Tq);

	$Tq="CREATE Table OtherBoys(
	RoomNo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Type VARCHAR(1) NOT NULL,
    ID1 VARCHAR(10) NULL,
    ID2 VARCHAR(10) NULL,
    ID3 VARCHAR(10) NULL,
	Status VARCHAR(5) DEFAULT 'empty'
	)";
	mysqli_query($db,$Tq);

	$Tq="CREATE Table OtherGirls(
	RoomNo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Type VARCHAR(1) NOT NULL,
    ID1 VARCHAR(10) NULL,
    ID2 VARCHAR(10) NULL,
    ID3 VARCHAR(10) NULL,
	Status VARCHAR(5) DEFAULT 'empty'
	)";
	mysqli_query($db,$Tq);

	for($i=1;$i<4;$i++){
		for($j=0;$j<5;$j++){
			$reg="INSERT into FirstBoys(Type) values($i)";
			mysqli_query($db,$reg);
			$reg="INSERT into FirstGirls(Type) values($i)";
			mysqli_query($db,$reg);
			$reg="INSERT into OtherBoys(Type) values($i)";
			mysqli_query($db,$reg);
			$reg="INSERT into OtherGirls(Type) values($i)";
			mysqli_query($db,$reg);
		}
	}
}
else {
    die("Error creating database: " . mysqli_error($db));
}
}


if (empty($_POST["Username"])) {
    $UsernameErr= "Username is required";
  } 
  elseif(!preg_match("/^[a-zA-Z0-9 _]*$/",$_POST['Username'])) {
  	$UsernameErr= "Only Letters, Spaces, Underscore And Alphabets";
  }
	else{
    $Username = test_input($_POST["Username"]);
  }


if (empty($_POST["Password"])) {
    $PasswordErr= "Password is required";
  }
	else{
    $Password = md5(test_input($_POST["Password"]));
 }


if (empty($_POST["Name"])) {
    $NameErr = "Name is required";
  } 
  elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['Name'])) {
  	$NameErr= "Only Spaces And Alphabets";
  }
	else{
    $Name = test_input($_POST["Name"]);
  }


 if (empty($_POST["RePassword"])) {
    $RePasswordErr= "Re-Password is required";
  } elseif ($_POST["RePassword"]!=$_POST["Password"]) {
  	$RePasswordErr= "Password Mismatch"; 	
  }
else{
    $RePassword = md5(test_input($_POST["RePassword"]));
 }



 if (empty($_POST["ID"])) {
    $IDErr= "StudentID is required";
  } elseif(!preg_match("/^[0-9]*$/",$_POST['ID'])) {
  	$IDErr= "Only Numbers";
  }
	else{
    $ID = test_input($_POST["ID"]);
  }

if (empty($_POST["Year"])) {
    $YearErr= "Year is required";
  } 
  elseif(!preg_match("/^[0-9]*$/",$_POST['Year'])) {
  	$YearErr= "Only Numbers";
  }
	else{
    $Year = test_input($_POST["Year"]);
  }


 if (empty($_POST["Gender"])) {
    $GenderErr= "Gender is required";
  }
	else{
    $Gender = test_input($_POST["Gender"]);
  }
   

 $db= mysqli_connect('localhost','root','','HostelManagement');

$q="SELECT * from Usertable where ID = '$ID' || Username = '$Username'";

$result=mysqli_query($db,$q);
	
$num=mysqli_num_rows($result);

if($num>0){
	$Rs="Registration Unsuccessful";
	$UsernameErr="Already Taken";
	}
elseif($Name!=''&&$Username!=''&&$ID!=''&&$Gender!=''&&$Password!=''&&$Year!=''&&$Password==$RePassword){
	$reg="INSERT into Usertable(Name,ID,Username,Password,Year,Gender) values('$Name','$ID','$Username','$Password','$Year','$Gender')";
	mysqli_query($db,$reg);
	$Rs="Registration successful";
	}
else{
	$Rs="Registration Unsuccessful";
}
mysqli_close($db);

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
			margin-bottom: 4%;
		}
		.small{
			color: #05386B;
			font-size: 1.5vw;
		}
		input,select{
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
	<div class="head">Registration Page</div>
	<div class="body">
		<div class="error">Required Fields are Marked *</div><br><br>
		<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
			<div class="small">Your Name</div>
			<input type="text" name="Name" placeholder="Your Full Name"><br>
			<span class="error">*<?php echo $NameErr;?></span><br><br>
			<div class="small">Gender</div>
			<select name="Gender">
				<option value="" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select><br>
			<span class="error">*<?php echo $GenderErr;?></span><br><br>
			<div class="small">Year</div>
			<select name="Year">
				<option vlaue="" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<option value="1">I Year</option>
				<option value="2">II Year</option>
				<option value="3">III Year</option>
				<option value="4">IV Year</option>
			</select><br>
			<span class="error">*<?php echo $YearErr;?></span><br><br>
			<div class="small">ID</div>
			<input type="text" name="ID" placeholder="ID"><br>
			<span class="error">*<?php echo $IDErr;?></span><br><br>
			<div class="small">UserName</div>
			<input type="text" name="Username" placeholder="Username"><br>
			<span class="error">*<?php echo $UsernameErr;?></span><br><br>
			<div class="small">Password</div>
			<input type="password" name="Password" placeholder="Password"><br>
			<span class="error">*<?php echo $PasswordErr;?></span><br><br>
			<div class="small">Re-Confirm Password</div>
			<input type="password" name="RePassword" placeholder="Confirm Password"><br>
			<span class="error">*<?php echo $RePasswordErr;?></span><br><br><br>
			<div class="error"><?php echo $Rs;?></div><br><br>
			<input type="submit" name="submit" value="Register" style="border: none;background-color: #05386B;color:#E5FBC3;
			font-size: 2.3vw;">
		</form>
	</div>
</body>
</html>