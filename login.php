
<?php


session_start();
 	//echo @$_SESSION['sname'];


//error_reporting(1);
//include_once('connection.php');
$con=mysqli_connect("localhost","root","","10am");

function encryptIt($q){
	$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	return( $qEncoded );
}

  

    
if(isset($_POST['signIn']))
{
	
	$captcha = $_POST['g-recaptcha-response'];
  $secret = "6LckOU4UAAAAADOYuw_8IvdgQgV8ov62YNy10phJ";
  $ip = $_SERVER['REMOTE_ADDR'];
  $action = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
  $result = json_decode($action,TRUE);


	

	if($result['success']) 
	{
		$query = "SELECT * FROM userinfo where user_name='{$_POST['id']}'";
	//echo $query;
		$d=mysqli_query($con,$query);
		if(mysqli_num_rows($d)!="0")
			{
				$row=mysqli_fetch_object($d);
				$fid=$row->user_name;
				$fpass=$row->password;
				$encrypt=$_POST['pwd'];
				$fpass1 = encryptIt($encrypt);
				$blkk=$row->blkstatus;
		//echo $fpass1;
		//echo $fpass;
				$s=$row->status;
				if($fid==$_POST['id'] && $fpass==$fpass1)
					{
						
			// echo $a;
		//header('location:HomePage.php');
						if($s==1)
							{
								$_SESSION['sid']=$_POST['id'];
								echo "<script>window.location='admin.php?chk=inbox1'</script>";
							}
						if($s==0 && $blkk==0)
							{
								$_SESSION['sid']=$_POST['id'];
								echo "<script>window.location='HomePage.php?chk=inbox'</script>";
							}	
							else
							{
							echo "<script>alert('blocked');window.location='login.php'</script>";	
							}		        
					}
				else
				{
					echo "<script>alert('Invalid Details');window.location='login.php'</script>";
				}	
					
			}
		
		
	
	}
	else{
		echo "<script>if(confirm('Unauthorized Access !!')){window.location='login.php'};</script>";
	}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>

	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"> 
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<form method="post"  enctype="multipart/form-data">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-10 p-b-20">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-40">
				Welcome
					</span>
					<span class="login100-form-avatar">
						<img src="images/avatar-01.png" alt="AVATAR">
					</span>

					<div class="wrap-input100 validate-input m-t-85 m-b-35">
						<input class="input100" type="text" name="id">
						<span class="focus-input100" data-placeholder="Username@texto.com"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" >
						<input class="input100" type="password" name="pwd">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>


						<div style="margin-left: 44px" class="g-recaptcha" data-sitekey="6LckOU4UAAAAAG0q3vU9xBU-8NRcYEh9LBwrDLw6"></div>

							<br></br>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="signIn">
							Sign In
						</button>
					</div>




					<ul class="login-more p-t-50">
						<li class="m-b-8">
							<span class="txt1">
								Don’t have an account?
							</span>

							<a href="http://localhost/texto/regis.php" class="txt2">
								Sign up
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	
 
	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</form>
</body>
</html>


