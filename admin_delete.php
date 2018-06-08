<?php
session_start();
$id=$_SESSION['sid'];
//include_once('connection.php');
$con=mysqli_connect("localhost","root","","10am");
if(isset($_POST['deletewq'])) 
{
foreach($_POST['ch'] as $v)
{
//echo $v;
$sql=mysqli_query($con,"SELECT * FROM usermail where rec_id='$id' and mail_id='$v'");
while($dd=mysqli_fetch_array($sql))
	{
	$rec=$dd['rec_id'];
	$sen=$dd['sen_id'];
	$sub=$dd['sub'];
	$msg=$dd['msg'];
	$att=$dd['attachement'];
	//store into trash table
	mysqli_query($con,"insert into trash (rec_id,sen_id,sub,msg,date) values('$rec','$sen','$sub','$msg',now())");
	
	//delete form inbox
	
	mysqli_query($con,"delete FROM usermail where rec_id='$id' and mail_id='$v'");

	}
	
}
echo "<script>alert('msg deleted');window.location='HomePage.php?chk=inbox'</script>";
}
?>