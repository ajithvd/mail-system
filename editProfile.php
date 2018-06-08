<?php
///error_reporting(1);
$con=mysqli_connect("localhost","root","","10am");
$sid=$_SESSION['sid'];
//include_once('connection.php');

$r=mysqli_query($con,"select * from userinfo where user_name='$sid'");
echo "<table width='940' border='1' align='center' style='background:#fff'>";
$row=mysqli_fetch_object($r);
//$p=$row->password;
$m=$row->mobile;
$e=$row->email;

echo "<tr height='50'>";
echo "<td>username    :</td>";
echo "<td>".$row->user_name."</td>";
echo "</tr>";

//echo "<tr height='40'>";
//echo "<td>Password :</td>";
//echo "<td><input type='password'  name='' value='$p'/></td>";
//echo "</tr>";

echo "<tr height='50'>";
echo "<td>Mobile    :</td>";
echo "<td><input type='text'  name='' value='$m'/></td>";
echo "</tr>";

echo "<tr height='40'>";
echo "<td>Email </td>";
echo "<td><input type='text'  name='' value='$e'/></td>";
echo "</tr>";

echo "<tr height='50'>";
echo "<td>Gender  :</td>";
echo "<td>".$row->gender."</td>";
echo "</tr>";

echo "<tr height='50'>";
echo "<td>Hobbies :</td>";
echo "<td>".$row->hobbies."</td>";
echo "</tr>";

echo "<tr height='50'>";
echo "<td>DOB  :</td>";
echo "<td>".$row->dob."</td>";
echo "</tr>";

echo "<tr height='150'>";
echo "<td>Profile pic  :</td>";
echo "<td><img style='border-radius: 100px;'alt='image not upload' src='userImages/$id/$file' height='150' width='150'/></td>";
echo "</tr>";

echo "</table>";
//echo"<input type='submit' value='change password' name='change_password'/>"
?>





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
				echo "<script>alert('Password updated');</script>";
			}
			
			else
			{
			echo "<script>alert('New password not matching');</script>";
			}
		}
		else
		{
	      echo "<script>alert('Wrong old password');</script>";
		}
	}
		
}



?>
<body>
<form method="post">
<table width="940" align='center' border="1" style='background:#fff'>
  <tr>
  <?php echo $err; ?>
    <th width="173"  height="40" scope="row">Old Password </th>
    <td width="176">
		<input type="password" name="op"/>
	</td>
  </tr>
  <tr>
    <th height="40" scope="row">New Password </th>
    <td>
			<input type="password" name="np"/>
	</td>
  </tr>
  <tr>
      <th height="40" scope="row">Confirm Password </th>
    <td><input type="password" name="cp"/></td>
  </tr>
<tr>
    <td colspan="2" align="center">
	<input type="submit" name="chngP" value="Change Password"/></td>
  </tr>
  
</table>
</form>
</body>
