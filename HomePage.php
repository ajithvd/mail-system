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

    #myNavbar, #myNavbar .navbar-nav ul li a{
      font-family: 'Poppins', sans-serif;
      font-size: 24px;
      color: #000;
      text-decoration: none;
    }

    .navbar-inverse .navbar-nav > li > a, .navbar-inverse .navbar-nav > li > a:hover{
      text-decoration: none;
      color:#000;
    }

    .navbar-inverse .navbar-nav>li>a{
      font-size: 24px;
      color: #000;
    }
.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:focus, .navbar-inverse .navbar-nav > .active > a:hover{
  background: none;
}
.navbar.navbar-inverse{
  border: none;

}

.sidenav p {
  margin:25px;

}

    .user_wel{
      font-size: 18px;
      font-family: 'Poppins', sans-serif;
      color:#000;
      margin-left: 2vw;
    }

table tr{
  border: 3px solid black;
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
  //error_reporting(1);
  
  @$chk=$_GET['chk'];
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
        <li><a href="HomePage.php?chk=contus">Contact</a></li>
      </ul>
        <li><a href="HomePage.php?chk=logout">Logout</a></li>
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
      <!--<h1>Welcome</h1>-->
      
      <p><a href="HomePage.php?chk=compose"><h4>Compose</h4></a></p>
      <p><a href="HomePage.php?chk=inbox"><h4>Inbox</h4></a></p>
      <p><a href="HomePage.php?chk=sent"><h4>Sent</h4></a></p>
      <p><a href="HomePage.php?chk=draft"><h4>Draft</h4></a></p>
      <p><a href="HomePage.php?chk=trash"><h4>Trash</h4></a></p>
      <p><a href="HomePage.php?chk=chngthm"><h4>Theme</h4></a></p>

    </div>
    <div class="col-sm-8 text-left"> 
      <!--<h1>Welcome</h1>-->
     
          

          <?php
          
    @$id=$_SESSION['sid'];
    @$chk=$_REQUEST['chk'];
    //echo $chk;
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
      if($chk=="contus")
      {
      include_once('contus.php');
      }
      
      
    ?>



    <?php
    //global $read;
    //$read=0;
    $id=$_SESSION['sid'];
    //echo $id;
    @$coninb=$_GET['coninb'];
    
    //echo $coninb;
      //echo $coninb;
      if($coninb)
      {
        
        //echo $coninb;
      $sql="SELECT * FROM usermail where rec_id='$id' and mail_id='$coninb' ";
      //echo $coninb;
      $dd=mysqli_query($con,$sql);
      //echo $dd;
      $row=mysqli_fetch_object($dd);
      //echo $row;
      //$fidd=$row->sub;
      //$fpasss=$row->password;
      //echo $fidd;
      //echo $fpasss;
       //$row=mysqli_fetch_object($r);
      //<h1 align="center">Inbox</h1>
      

       
      $_SESSION['sub'] = $row->sub;
      $_SESSION['msg'] = $row->msg;
       $_SESSION['file'] = $row->attachement;
       $_SESSION['ss'] = $row->sen_id;
       //$_SESSION['mid']=$coninb;
      echo "<h3>Subject  :</h3>".$row->sub."<br/>";
      echo "<h3>Message  :</h3>".$row->msg."<br/>";
      //echo "attachement".$row->attachement;
      @$file=$row->attachement;
      //echo $file;
      echo "</br>";
      //echo "<img  src='imgsent/$file' height='200' width='200'/>";
      echo "<a href='imgsent/$file' >$file</a>";
       //global $read;
       //$read=1;
      //echo $read;
      $sqll = "UPDATE usermail SET mstat=0 where rec_id='$id' and mail_id='$coninb'";
      mysqli_query($con,$sqll);
     //echo'<button type="submit" name="submit" value="'.$row1['username'].'">delete</button></td>';
          $mm="SELECT MAX(mail_id) FROM usermail";
      //$mm = "SELECT * FROM usermail ORDER BY mail_id DESC LIMIT 1";
          $val=mysqli_query($con,$mm);
          //echo $val;
          $a=mysqli_fetch_array($val);
          $b=$a[0];
          $b=$b+1;
          $_SESSION['mid']=$b;

     //echo '<br/><br/><a href="http://localhost/texto/HomePage.php?chk=compose" class="btn btn-primary">Reply</a>';
              echo "</br>";
              echo "</br>";
              echo "</br>";
      echo  '<a href="http://localhost/texto/HomePage.php?chk=compose" class="btn btn-primary">Forward</a>';      
      

      }
    //$id=$_SESSION['sid'];
    //echo $id;
    @$conq=$_GET['conq'];
    //echo $coninb;
      //echo $coninb;
      if($conq)
      {
        //$read=1;
        //echo $coninb;
      $sql="SELECT * FROM draft where user_id='$id' and draft_id='$conq'";
      //echo $coninb;
      $dd=mysqli_query($con,$sql);
      //echo $dd;
      $row=mysqli_fetch_object($dd);
       $_SESSION['sub'] = $row->sub;
      $_SESSION['msg'] = $row->msg;
       $_SESSION['file'] = $row->attach;
      // $_SESSION['ss'] = $row->sen_id;
      //echo $row;
      //$fidd=$row->sub;
      //$fpasss=$row->password;
      //echo $fidd;
      //echo $fpasss;
       //$row=mysqli_fetch_object($r);
      echo "<h3>Subject  :</h3>".$row->sub."<br/>";
      echo "<h3>Message  :</h3>".$row->msg."<br/>";
      //echo "attachement".$row->attachement;
      @$file=$row->attach;
       echo "</br>";
      //echo "<img  src='imgsent/$file' height='200' width='200'/>";
      echo "<a href='imgsent/$file' >$file</a>";

          $mm="SELECT MAX(mail_id) FROM usermail";
      //$mm = "SELECT * FROM usermail ORDER BY mail_id DESC LIMIT 1";
          $val=mysqli_query($con,$mm);
          //echo $val;
          $a=mysqli_fetch_array($val);
          $b=$a[0];
          $b=$b+1;
          $_SESSION['mid']=$b;

              echo "</br>";
              echo "</br>";
              echo "</br>";
      echo  '<a href="http://localhost/texto/HomePage.php?chk=compose" class="btn btn-primary">Forward</a>';

      }
 
      
      @$contr=$_GET['contr'];
    //echo $coninb;
      //echo $coninb;
      if($contr)
      {
        //$read=1;
        //echo $coninb;
      $sql1="SELECT * FROM trash where rec_id='$id' and trash_id='$contr'";
      //echo $coninb;
      $dd1=mysqli_query($con,$sql1);
      //echo $dd;
      $row=mysqli_fetch_object($dd1);
      //echo $row;
      //$fidd=$row->sub;
      //$fpasss=$row->password;
      //echo $fidd;
      //echo $fpasss;
       //$row=mysqli_fetch_object($r);
      echo "<h3>Subject  :</h3>".$row->sub."<br/>";
      echo "<h3>Message  :</h3>".$row->msg."<br/>";
       echo "</br>";
      //echo "attachement".$row->attachement;
      //@$file=$row->attach;
      //echo "<img  src='imgsent/$file' height='200' width='200'/>";
      //echo "<a href='imgsent/$file' >$file</a>";

      }
 






  @$cheklist=$_REQUEST['ch'];
  if(isset($_GET['delete']))
  {
    foreach($cheklist as $v)
    { 
    $sql=mysqli_query($con,"SELECT * FROM usermail where rec_id='$id' and mail_id='$v'");
while($dd=mysqli_fetch_array($sql))
      {
  $rec=$dd['rec_id'];
  $sen=$dd['sen_id'];
  $sub=$dd['sub'];
  $msg=$dd['msg'];
  $att=$dd['attachement'];
  mysqli_query($con,"insert into trash (rec_id,sen_id,sub,msg,date) values('$rec','$sen','$sub','$msg',now())");
    }
    $d="DELETE from usermail where mail_id='$v'";
    mysqli_query($con,$d);
    
    //echo "msg deleted";
  }
   echo "<script>alert('deleted');window.location='HomePage.php?chk=sent'</script>";

}

        @$cheklist=$_REQUEST['ch1'];
  if(isset($_GET['delete1']))
  {
    foreach($cheklist as $v)
    { 
    
    $d="DELETE from draft where draft_id='$v'";
    mysqli_query($con,$d);
    
    //echo "msg deleted";
  }
   echo "<script>alert('deleted');window.location='HomePage.php?chk=draft'</script>";

}

 //@$cheklist=$_REQUEST['ch2'];
  //if(isset($_GET['delete2']))
 // {
   // foreach($cheklist as $v)
    //{ 
    
    //$d="DELETE from trash where trash_id='$v'";
   // mysqli_query($con,$d);
    
    //echo "msg deleted";
  //}
   //echo "<script>alert('deleted');window.location='HomePage.php?chk=draft'</script>";

//}



      // $id=$_SESSION['sid'];
    @$consent=$_GET['consent'];
      
      if($consent)
      {
      $sql="SELECT * FROM usermail where sen_id='$id' and mail_id='$consent'";
$dd=mysqli_query($con,$sql);
      $row=mysqli_fetch_object($dd);
      echo "<h3>Subject  :</h3>".$row->sub."<br/>";
      echo "<h3>Message  :</h3>".$row->msg;
      @$file=$row->attachement;
      $mstat1=$row->mstat;
       echo "</br>";
       echo "</br>";
       echo "</br>";
      //echo $mstat1;
       echo "<a href='imgsent/$file' download>$file</a>";
       if($mstat1==0)
       {
        echo "</br>";
         echo "</br>";
          echo'<span style="color:#FF0000;text-align:center;"> <b>READ </b></span>';
        //echo "<font color="red"> read</font>;
       }
       else
       {
         echo "</br>";
          echo "</br>";
        echo '<span style="color:#FF0000;text-align:center;"><b>NOT READ</b></span>';
       }

       
       }
    ?>
    
    
    
  <!--sent box-->




    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>
          <marquee direction='up' behavior='SCROLL' SCROLLDELAY=150  onmouseover='stop()'' onmouseout='start()''>
              <?php
         
           $con=mysqli_connect("localhost","root","","10am");
          $mm="SELECT MAX(id) FROM latestupd";
          $val=mysqli_query($con,$mm);
           $a=mysqli_fetch_array($val);
           $b=$a[0];
            //echo $b;
          //
            $as= "SELECT title,date1 FROM latestupd ORDER BY id Desc";
          $ss= mysqli_query($con,$as);
           for($i=0;$i<$b; $i++)
           {
              //echo $i;
          $row=mysqli_fetch_object($ss);
          @$a=$row->title;
          @$b=$row->date1;
          //echo "</br>";
          echo "</br>";
          echo $a." ";
          echo $b;
          echo "</br>";
          //echo "</br>";  
                  }
           ?>

         </marquee>

        </p>
      </div>
    </div>
  </div>
</div>
<footer class="container-fluid text-center">
  <h3>THE TEXTO</h3>
</footer>
</div>
</body>
</html>
