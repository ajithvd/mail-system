<?php
//include_once('connection.php');
$con=mysqli_connect("localhost","root","","10am");
$id=$_SESSION['sid'];
//echo $id;
echo "</br>";
echo "</br>";
echo "</br>";
@$tt=$_POST['title'];
if(@$_REQUEST['upd'])
{
	if($_POST['title']=="")
	{
	echo "fill the related data first";
	}
	
	else
	{
		$dd="INSERT INTO latestupd(title,date1)  values('$tt',now())";
		//echo $dd;
		mysqli_query($con,$dd);
      $ss1="DELETE FROM latestupd WHERE date < (CURDATE() - INTERVAL 3 DAY);";
    mysqli_query($con,$ss1);

		
	}
	
}	
	
?>
<head>
	<style>
	input[type=text]
	{
	width:200px;
	height:35px;
	}
	</style>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table width="506" border="1">
  <tr>
    <th width="213" height="35" scope="row">Title</th>
    <td width="277">
	<input type="text" name="title"  required/>	</td>
  </tr>
  <tr>
    <th height="35" colspan="2" scope="row">
	<input type="reset" value="RESET"/>
	<input type="submit" name="upd" value="UPDATE"/></th>
  </tr>
</table>

</body>
</form>
</html>
