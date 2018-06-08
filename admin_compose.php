<html>

<head>
	
</head>
<h1 align="center">Compose</h1>


<?php
//echo  $_SESSION['mid'];
//echo $_SESSION['file'];


$con=mysqli_connect("localhost","root","","10am");
//include_once('connection.php');
//@$to=$_POST['to'];
@$sub=$_POST['sub'];
@$msg=$_POST['msg'];
@$to=$_POST['cc'];
$p1 = explode(",", $to);
$max= max(array_keys($p1));

if(empty($_SESSION['file']))
{
	@$file=$_FILES['file']['name'];
}
else{

@$file=$_SESSION['file'];
}
$id=$_SESSION['sid'];

if(@$_REQUEST['send'])
{

	if($to=="" || $sub=="" || $msg=="")
	{
	
			echo "<script>alert('Please Fill all Fields');window.location='HomePage.php?chk=compose'</script>";
	//$err= "<font color='red'>fill the related data first";
	}
	
	else
	{
//				echo "</br>";
//echo $p1[0];
//echo "</br>";
//echo $p1[1];
//echo "</br>";
//echo $p1[2];
//echo "</br>";

//echo $max;
		for ($j = 0; $j <= $max ; $j++) {
			$p=$p1[$j];
	 $d=mysqli_query($con,"SELECT * FROM userinfo where user_name='$p';");
	// $d=mysqli_query($con,"SELECT * FROM userinfo where user_name='$p'");
	 $row=mysqli_fetch_array($d,MYSQLI_NUM);
	//echo $r;
	 if($row[0]>=1)
		{

			$mm="insert into usermail (rec_id,sen_id,sub,msg,attachement,recDT) values('$p','$id','$sub','$msg','$file',sysdate())";
			mysqli_query($con,$mm);
			//echo "im in ifff";
		//mysqli_query($con,"insert into usermail (rec_id,sen_id,sub,msg,attachement,recDT) values('$p','$id','$sub','$msg','$file',sysdate())");
		//$err= "message sent...";
		//if (!is_dir("imgsent/$id")) 
				//{
					// mkdir("imgsent/$id");
				//}
			move_uploaded_file($_FILES["file"]["tmp_name"], "imgsent/" . $_FILES["file"]["name"]);
			if($j==$max)
			{
		       echo "<script>alert('Message Sent');</script>";
	       }

	     if(isset($_SESSION['file'])){
		
		//$con=mysqli_connect("localhost","root","","10am");

		//echo $_SESSION['file'];
		//echo  $_SESSION['mid'];
		//$sqlll = "UPDATE usermail SET attachement= '$_SESSION[file]' where rec_id='$id' and mail_id='$_SESSION[mid]'";
      //mysqli_query($con,$sqlll);     

				} 






		}
	else
		{
		//$sub=$sub."--"."msg failed";
		//mysqli_query($con,"INSERT INTO usermail values('','$id','$id','$sub','$msg','',sysdate())");
		//$err= "message failed...";
				echo "<script>alert('Chek your id');window.location='HomePage.php?chk=compose'</script>";
		}	
	}
}
		$_SESSION['msg'] = '';
        $_SESSION['sub'] = '';
        $_SESSION['file']='';
}	


if(@$_REQUEST['save'])
{
	if($sub=="" || $msg=="")
	{
	echo "<script>alert('fill all fields');window.location='HomePage.php?chk=compose'</script>";
	//$err= "<font color='red'>fill subject and msg first</font>";
	}
	
	else
	{
	$query="insert into draft (user_id,sub,attach,msg,date) values('$id','$sub','$file','$msg',sysdate())";
	mysqli_query($con,$query);
	//$err= "message saved...";
      move_uploaded_file($_FILES["file"]["tmp_name"], "imgsent/" . $_FILES["file"]["name"]);
		//echo "<script>alert('Message Sent');window.location='HomePage.php?chk=compose'</script>";


	echo "<script>alert('Saved');window.location='HomePage.php?chk=compose'</script>";
	}
	$_SESSION['msg'] = '';
    $_SESSION['sub'] = '';
    $_SESSION['file']='';

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
<table width="906" border="3" style='background:#fff'>
 

<tr>
    
  </tr>

  <tr>
    <th height="40" scope="row">To</th>
    <td><input type="text" name="cc"/></td>
  </tr>
  <tr>
    <th height="40" scope="row">Subject</th>
    <td><input type="text" name="sub" value="<?php if(isset($_SESSION['sub'])){echo $_SESSION['sub'];}?>"/></td>
  </tr>
  <tr>
    <th height="40" scope="row">upload your file</th>
    <td><input type="file" name="file"  /></td>
  </tr>
  <tr>
    <th height="52" scope="row">Message</th>
    <td><textarea rows="8" cols="40" name="msg" required><?php if(isset($_SESSION['msg'])){echo $_SESSION['msg'];}?></textarea></td>
  </tr>
  <tr>
    <th height="35" colspan="2" scope="row">
	<input type="submit" name="send" value="Send"/>
	<input type="submit" name="save" value="Save"/>
	<input type="reset"   value="Cancel" <?php $_SESSION['msg'] = '';
    $_SESSION['sub'] = '';
   $_SESSION['ss']='';
    //$_SESSION['file']=''; ?> </th>
  </tr>
</table>

</body>
</form>
</html>
