<?php
session_start();
if($_SESSION['sid']=="")
{
header('Location:index.php');
}
$id=$_SESSION['sid'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"> 
  <!-- <link rel="stylesheet" href="bstrap/css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
    <script src="bstrap/js/bootstrap.min.js"></script> -->
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      background: #ffffff47;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f14f;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }

    #myNavbar .navbar-nav ul li a{
      font-family: 'Poppins', sans-serif;
      font-size: 24px;
    }

    .navbar-inverse .navbar-nav>li>a{
      font-size: 24px;
    }

    .user_wel{
      font-size: 18px;
      font-family: 'Poppins', sans-serif;
      color:white;
    }

  </style>
</head>
<body>
<div style="background-image:url('theme/<?php
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



<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
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
?>
    </div>
       
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
        <ul class="nav navbar-nav">
        <li class="active"><a href="HomePage.php?chk=vprofile">Profile</a></li>
        <!--<li><a href="#">Change <br>Password</br></a></li>-->
        <!--<li><a href="#">theme</a></li>-->
        <li><a href="#">Contact</a></li>
      </ul>
        <li><a href="HomePage.php?chk=logout"">Logout</a></li>
      </ul>
    </div>
    <span class="user_wel">
          <?php  echo @$_SESSION['sid'];?>
    </span>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="HomePage.php?chk=compose">Compose</a></p>
      <p><a href="HomePage.php?chk=inbox">Inbox</a></p>
      <p><a href="HomePage.php?chk=sent">Sent</a></p>
      <p><a href="HomePage.php?chk=draft">Draft</a></p>
      <p><a href="HomePage.php?chk=trash">Trash</a></p>
      <p><a href="HomePage.php?chk=chngthm">Theme</a></p>

    </div>
    <div class="col-sm-8 text-left"> 
      <!--<h1>Welcome</h1>-->
     
          

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




    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>
</div>
</body>
</html>
