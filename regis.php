<?php $a=0; 

 session_start();
  echo @$_SESSION['sname'];
?>
  <html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="stylen.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>

      <form method="post"  enctype="multipart/form-data">
      
        <h1>Sign Up</h1>
        
        <fieldset>
          <legend>Your basic info</legend>
          <label for="name">User Name:</label>
          <input type="text"  name="un" placeholder="example@texto.com"  required>

          <label for="password">Password:</label>
          <input type="password" name="pwd1" pattern= ".{8,12}" title="8 to 12 characters only"  placeholder="password" required  >

          <label for="password">Confirm Password:</label>
          <input type="password"  name="pwd" pattern= ".{8,12}" title="8 to 12 characters only"  placeholder="Confirm password" required  >

            <?php
              if($_POST)  
                {
                  if($_POST['pwd']!=$_POST['pwd1'])
                      {echo "<script>alert('Password mismatch');window.location='regis.php'</script>";$a=1;}   
                } 
              ?>

          
           
          <label for="name">Mobile:</label>
          <input type="text"  name="mob" pattern="[7-9]{1}[0-9]{9}" title= "Must contain at least 10 numbers" placeholder="10 digit number" required >
            
          <label for="mail">Alternate Email:</label>
          <input type="email"  name="eid" pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" placeholder="Alternative Email" required > 
          
          
          
          <label>Gender:</label>
          <input type="radio"  value="male" name="gen" checked><label for="under_13" class="light">male</label><br>
          <input type="radio"  value="female" name="gen"><label for="over_13" class="light">female</label>
        </fieldset>
          

          <label>Interests:</label>
          <input type="checkbox"  value="cricket" name="ch[]" checked><label class="light" for="development">Cricket</label><br>
            <input type="checkbox" value="Football" name="ch[]"><label class="light" for="design">Football</label><br>
          <input type="checkbox"  value="reading" name="ch[]"><label class="light" for="business">Reading</label>
          <br></br>
          <label>Date of Birth</label>
            <select name="y" required >
      <option value="">Year</option>
      <?php
      for($i=1980;$i<=2006;$i++)
      {
      echo "<option value='$i'>$i</option>";
      }
      ?>
    </select>
    <select name="m" required >
      <option value="">Month</option>
      <?php
      for($i=1;$i<=12;$i++)
      {
      echo "<option value='$i'>$i</option>";
      }
      ?>
    </select>
    <select name="d" required >
      <option value="">Date</option>
      <?php
      for($i=1;$i<=31;$i++)
      {
      echo "<option value='$i'>$i</option>";
      }
      ?>
    </select>
<br></br>
      <label>Profile picture</label>
  
      <input type="file" name="file" id="file" accept="image/*"  required> 
          <?php

            if($_POST)
                {
                  $file_tmp =$_FILES['file']['tmp_name'];
                  $target_file = $file_tmp.basename($_FILES["file"]["name"]);
                  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
              if ($_FILES["file"]["size"] > 5000000)
                  {
                    
                  echo "<script>alert('Image size too large');window.location='regis.php'</script>";
                      $a=1;
                  }
              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                  && $imageFileType != "gif" ) 
                {
                  echo "<script>alert('jpeg,png are only allowed');window.location='regis.php'</script>";
                      $a=1;
                }
              }
  
            ?>

      <br></br>
      <label>I accept term & condition</label>
      
      <input type="checkbox"  name="checklist" checked required>
        <!-- <button type="submit" name="reg" class=".login100-form-btn">Sign up</button> -->
        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="reg">
             Sign Up
            </button>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="reset">
             Reset
            </button>
          </div>
        <!-- <button type="submit" name="login">Log In</button> -->
        <ul class="login-more p-t-50">
            <li class="m-b-8">
              <span class="txt1">
                Already have an account?
              </span>

              <a href="http://localhost/texto/login.php" class="txt2">
                Sign In
              </a>
            </li>
          </ul>
        <!-- <button type="reset">Reset</button> -->
        
      </form>
      
<?php
//include_once('connection.php');
//error_reporting(1);


$con=mysqli_connect("localhost","root","","10am");


 if(isset($_POST['reg']))
{ 
if($a==0)
{
function encryptIt($q){
  $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
  $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
  return( $qEncoded );
}
            
            
$y=$_POST['y'];
$m=$_POST['m'];
$d=$_POST['d'];
$dob=$y."-".$m."-".$d;
$ch=$_POST['ch'];
$hobbies=implode(",",$ch);
$imgpath=$_FILES['file']['name'];
$un=$_POST['un']."@texto.com";
$psd=$_POST['pwd1'];

$encrypted = encryptIt($psd);

       $check="SELECT * FROM userinfo where user_name='$un'";
  $r=mysqli_query($con,$check);
  $t=mysqli_fetch_array($r,MYSQLI_NUM);
    if($t[0]>=1)
     {
     echo "<script>alert('user already exists please Log In');window.location='regis.php'</script>";
    }  
         else
     {
    $q="insert into userinfo(user_name,password,mobile,email,gender,hobbies,dob,image) values('$un','$encrypted','{$_POST['mob']}','{$_POST['eid']}','{$_POST['gen']}','$hobbies','$dob','$imgpath')";
    mysqli_query($con,$q);
    echo "<script>alert('ACCOUNT CREATED,');window.location='login.php'</script>";
    
    if (!is_dir("userImages/$un")) 
      {
        mkdir("userImages/$un");  
        move_uploaded_file($_FILES["file"]["tmp_name"], "userImages/$un/" . $_FILES["file"]["name"]);
      }
      else
      {
       echo "<script>alert('user already exists please Log In');window.location='regis.php'</script>";
      }
      
    //mkdir("userImages/$un");
    //move_uploaded_file($_FILES["file"]["tmp_name"], "userImages/$un/" . $_FILES["file"]["name"]);
    //echo "<script>window.location='login.php'</script>";
    }
  
}
}
?>
 </body>
</html>
