<?php
session_start();
include('config.php');
if($_POST['submit'])
{
$seater=$_POST['seater'];
$roomno=$_POST['rmno'];
$sql="SELECT room_no FROM rooms where room_no=?";
$stmt1 = $mysqli->prepare($sql);
$stmt1->bind_param('i',$roomno);
$stmt1->execute();
$stmt1->store_result(); 
$row_cnt=$stmt1->num_rows;;
if($row_cnt>0)
{
echo"<script>alert('Room already exist');</script>";
}
else
{
$query="insert into  rooms (seater,room_no) values(?,?)";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('ii',$seater,$roomno);
$stmt->execute();
echo"<script>alert('Room has been added successfully');</script>";
}
}
?> 

<!DOCTYPE html>
<html>
<head>
	<title> Add room </title>
</head>
<body>
Welcome <?php echo $_POST["name"]; ?>!
<form  action="" method="post">
Seater : <input type = "text" name = "seater" />
Room no : <input type = "text" name = "rmno" />
<input type="submit" value="submit" name="submit" />
</form>

</body>
</html>