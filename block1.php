<html>
<body>
</br>
</br>

</br>
</br>
	<form method="post" enctype="multipart/form-data">
			<label for="name">User Name:</label>
            <input type="text"  name="un" placeholder="example@texto.com"  required>
            <input  type="submit" name="reg1" value="block"/>
            <input  type="submit" name="reg2" value="unblock"/>
</form>
</body>
</html>
<?php

 if(isset($_POST['reg1']))
{ 
	//echo "dfgbnjyu,";
	$blk=$_POST['un'];
	//echo $blk;
	$con=mysqli_connect("localhost","root","","10am");
	 $sqlll= "UPDATE userinfo SET blkstatus=1 where user_name='$blk'";
	//$check="update userinfo set blkstatus=1 where user_name='$blk'";
	 mysqli_query($con,$sqlll);
	 echo "<script>alert('BLOCKED');</script>";

	}

	if(isset($_POST['reg2']))
{ 
	//echo "dfgbnjyu,";
	$blk=$_POST['un'];
	//echo $blk;
	$con=mysqli_connect("localhost","root","","10am");
	 $sqlll= "UPDATE userinfo SET blkstatus=0 where user_name='$blk'";
	//$check="update userinfo set blkstatus=1 where user_name='$blk'";
	 mysqli_query($con,$sqlll);
	 echo "<script>alert('UNBLOCKED');</script>";
	}