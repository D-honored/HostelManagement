<?php
session_start();
include('config.php');
if($_POST['submit'])
{
// $seater=$_POST['seater'];
$roomno=$_POST['rmno'];
$sql="SELECT room_no FROM rooms where room_no=?";
$stmt1 = $mysqli->prepare($sql);
$stmt1->bind_param("i",$roomno);
$stmt1->execute();
$stmt1->store_result(); 
$row_cnt=$stmt1->num_rows;
// if($row_cnt>0)
// {
// echo"<script>alert('Room has been found');</script>";
// }
// else
{ 
$query="delete from rooms where room_no=$roomno";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i",$_SESSION['rmno']);
$stmt->execute();
$stmt->close();
echo"<script>alert('Room has been deleted successfully');</script>";
}
}
?> 

<!DOCTYPE html>
<html>
<head>
	<title> Delete room</title>
</head>
<body>
<form  action="" method="post">
Room no : <input type = "text" name = "rmno" />
<input type="submit" value="submit" name="submit" />
</form>

</body>
</html>