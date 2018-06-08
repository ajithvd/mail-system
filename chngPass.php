<?php
//include_once('connection.php');
$con=mysqli_connect("localhost","root","","10am");
error_reporting(1);
$id=$_SESSION['sid'];
$op=$_POST['op'];
$np=$_POST['np'];
$cp=$_POST['cp'];
if(isset($_POST['chngP']))
{

      	 function encryptIt($q){
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q,MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
			return( $qEncoded );
							}
		$encrypted = encryptIt($op);


	if($op=="" || $np=="" || $cp=="")
	{
	    $err="Fill all the fields first";
	}
	else
	{
		$sql="select * from userinfo where user_name ='$id'";
		$d=mysqli_query($con,$sql);
		list($a,$b,$c)=mysqli_fetch_array($d);
		if($c==$encrypted)
		{
			if($np==$cp)
			{
				$newencrypted = encryptIt($np);
				$sql="update userinfo set password='$newencrypted' where user_name='$id'";
				$d=mysqli_query($con,$sql);
				echo "password  updated...";
			}
			
			else
			{
			echo "new pass doesn't match";
			}
		}
		else
		{
		echo "wrong old password";
		}
	}
		
}
?>
<body>
<form method="post">
<table width="365" border="1">
  <tr>
  <?php echo $err; ?>
    <th width="173" scope="row">Old Pass </th>
    <td width="176">
		<input type="password" name="op"/>
	</td>
  </tr>
  <tr>
    <th scope="row">New Password </th>
    <td>
			<input type="password" name="np"/>
	</td>
  </tr>
  <tr>
      <th scope="row">Confirm Pass </th>
    <td><input type="password" name="cp"/></td>
  </tr>
<tr>
    <td colspan="2" align="center">
	<input type="submit" name="chngP" value="Change Password"/></td>
  </tr>
  
</table>
</form>
</body>
