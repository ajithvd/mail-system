<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

#myInput {
 // background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 18px;
  padding: 4pxp 15x 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 15px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 3px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>


</head>
<body>
<h1 align="center">Draft</h1>
<?php
//include_once('connection.php');
$con=mysqli_connect("localhost","root","","10am");
$id=$_SESSION['sid'];


$sql="SELECT * FROM draft where user_id='$id' ORDER BY draft_id DESC";
$dd=mysqli_query($con,$sql);

echo "<div style='margin-left:10px;width:940px;height:auto;'>";

	echo "<table border='1' id='myTable' width='940' style='background:#fff'>";
	echo "<tr><th>check</th><th>Subject </th><th>Attachement </th><th>Message</th><th>Date</th></tr>";
	echo' <input type="text" id="myInput" onkeyup="myFunction()"  class="" placeholder="Search.."  title="Type in a subject">';
while(list($draftId,$u_id,$sub,$file,$msg,$date)=mysqli_fetch_array($dd))
{
	echo "<tr>";
	echo "<form>";
	echo "<td><input type='checkbox' name='ch1[]' value='$draftId'/></td>";
	echo "<td><a href='admin.php?conq=$draftId'>".$sub."</td>";
	
	echo "<td><a href='admin.php?conq=$draftId'>".$file."</td>";
	echo "<td><a href='admin.php?conq=$draftId'>".$msg."</td>";
	echo "<td><a href='admin.php?conq=$draftId'>".$date."</td>";
	echo "</tr>";	
	}
	echo "</table>";
	
	echo"<input type='submit' value='Delete' name='delete1'/>";

echo "</div>";
	
echo "</form>";

?>
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    // td = tr[i].getElementsByTagName("td");
    if (tr[i]) {
      if (tr[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>
