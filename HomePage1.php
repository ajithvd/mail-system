<?php
session_start();
if($_SESSION['sid']=="")
{
header('Location:index.php');
}
$id=$_SESSION['sid'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>home page</title>
<style>
	a{text-decoration:none}
	a:hover{ background-color:#00CC66}
	#atop{margin-left:50}
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<!-- <link rel="stylesheet" href="bstrap/css/bootstrap.min.css"> -->
<!-- <script src="bstrap/js/bootstrap.min.js"></script> -->
</head>



<body background="imgg.jpg">

<table width="1500" border="5" align="center" style="background-image:url('theme/<?php
		@$conTheme=$_REQUEST['conTheme'];											
		if($conTheme)
		{
			$fo=fopen("userImages/$id/theme","w");
			fwrite($fo,$conTheme);
		}
			@$f=fopen("userImages/$id/theme","r");
			@$fr=fread($f, filesize("userImages/$id/theme"));
			echo $fr;
			?>')">
  
  <tr>
    <td height="200" colspan="7" align="center">
	<div  style="float:right;">
	<?php
	$con=mysqli_connect("localhost","root","","10am");
	//include_once('connection.php');
	error_reporting(1);
	
	$chk=$_GET['chk'];
	if($chk=="logout")
		{
			unset($_SESSION['sid']);
			header('Location:index.php');
		}
	$r=mysqli_query($con,"select * from userinfo where user_name='{$_SESSION['sid']}'");
	//echo $r;

	
	$row=mysqli_fetch_object($r);
	@$file=$row->image;
	//echo $file;
	echo "<img style='border-radius: 100px;'' alt='image not upload' src='userImages/$id/$file' height='200' width='200'/>";
?></div>
	
	 <div style="float:left;margin-left:300px;padding-top:40px;font-size:25px;text-align:center;font-color:red"> Welcome <?php  echo @$_SESSION['sid'];?>
	 </div>
 	  </td>
  </tr>
  <tr>
    <td height="60" colspan="7">
    	<span class="btnTextTo" style="margin:5px 50px"> 
		<a href="HomePage.php?chk=chngthm" >THEME STORE</a>
	</span>
		<span class="btnTextTo" style="margin:5px 50px">
		<a href="HomePage.php?chk=chngPass">CHANGE PASSWORD</a>
		</span>
		<span class="btnTextTo" style="margin:5px 50px">
		<a href="HomePage.php?chk=vprofile" >EDIT YOUR PROFILE</a>
		</span>

		<span class="btnTextTo" style="margin:5px 50px">
			<a href="HomePage.php?chk=updnews">UPDATE LATEST NEWS</a>
		</span>
		<span class="btnTextTo" style="margin:5px 50px">
	<a href="HomePage.php?chk=logout">LOGOUT</a>
		</span>
	</td>
  </tr>
  <tr>
    <td width="158" height="572" valign="top">

	<div style="margin-top:50px; text-align: center;" > <div class="btnTextTo"> <a href="HomePage.php?chk=compose" style="margin-top:10px; margin-bottom:10px">COMPOSE</a> </div><br/><br/>
		<div class="btnTextTo">
	<a href="HomePage.php?chk=inbox">INBOX</a></div><br/><br/>
	<div class="btnTextTo"> 
	<a href="HomePage.php?chk=sent" >SENT</a></div><br/><br/>
	<div class="btnTextTo">
	<a href="HomePage.php?chk=trash" >TRASH</a></div><br/><br/>
	<div class="btnTextTo">
	<a href="HomePage.php?chk=draft" >DRAFT</a>
	</div>
	</div>
	</td>
    <td width="760" valign="top">
			
			
		<?php
		@$id=$_SESSION['sid'];
		@$chk=$_REQUEST['chk'];
			if($chk=="vprofile")
			{
			include_once("editProfile.php");
			}
			if($chk=="compose")
			{
			include_once('compose.php');
			}
			if($chk=="sent")
			{
			include_once('sent.php');
			}
			if($chk=="trash")
			{
			include_once('trash.php');
			}
			if($chk=="inbox")
			{
			include_once('inbox.php');
			}
			if($chk=="setting")
			{
			include_once('setting.php');
			}
			if($chk=="chngPass")
			{
			include_once('chngPass.php');
			}
			if($chk=="chngthm")
			{
			include_once('chngthm.php');
			}
			if($chk=="draft")
			{
			include_once('draft.php');
			}
			if($chk=="updnews")
			{
			include_once('latestupd.php');
			}
			
		?>
		
		<!--inbox -->
		<?php
		$id=$_SESSION['sid'];
		//echo $id;
		$coninb=$_GET['coninb'];
			//echo $coninb;
			if($coninb)
			{
				//echo $coninb;
			$sql="SELECT * FROM usermail where rec_id='$id' and mail_id='$coninb'";
			//echo $coninb;
			$dd=mysqli_query($con,$sql);
			//echo $dd;
			$row=mysqli_fetch_object($dd);
			//echo $row;
			//$fidd=$row->sub;
			//$fpasss=$row->password;
			//echo $fidd;
			//echo $fpasss;

			echo "Subject :".$row->sub."<br/>";
			echo "Message :".$row->msg;
			}
			
			
	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['delete']))
	{
		foreach($cheklist as $v)
		{
		
		$d="DELETE from usermail where mail_id='$v'";
		mysqli_query($con,$d);
		}
		echo "msg deleted";
	}
			
		?>
		
		
		
	<!--sent box-->
	<?php
		$id=$_SESSION['sid'];
		@$consent=$_GET['consent'];
			
			if($consent)
			{
			$sql="SELECT * FROM usermail where sen_id='$id' and mail_id='$consent'";
$dd=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($dd);
			echo "Subject :".$row->sub."<br/>";
			echo "Message :".$row->msg;
			}
			
			
	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['delete']))
	{
		foreach($cheklist as $v)
		{
		$d="DELETE from usermail where mail_id='$v'";
		mysqli_query($con,$d);
		}
		echo "msg deleted";
	}
			
		?>	
		
	</td>
    <td width="1">&nbsp;</td>
  </tr>
  <tr>
    <td height="47" colspan="3">
	<h2 align="center">THE TEXTO</h2>
	</td>
  </tr>
  
</table>

</body>
</html>

