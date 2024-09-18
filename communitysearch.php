<!DOCTYPE html>
 <?php #include("func.php");?>
<html>
<head>
	<title>Community Details</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("newfunction.php");
if(isset($_POST['community_search_submit']))
{
	$contact=$_POST['community_contact'];
  $query = "select * from community where email= '$contact'";
  $result = mysqli_query($con,$query);
  $row=mysqli_fetch_array($result);
  if($row['username']=="" & $row['password']=="" & $row['email']=="" & $row['comPoints']==""){
    echo "<script> alert('Community Not Found!'); 
          window.location.href = 'admin-panel1.php#list-doc';</script>";
  }
  else {
    echo "<div>
	<div class ='home-content' id='list-doc'>
  <div>
<table class='community-table'>
  <thead>
    <tr>
      <th scope='col'>Username</th>
      <th scope='col'>Password</th>
      <th scope='col'>Email</th>
      <th scope='col'>Consultancy Fees</th>
    </tr>
  </thead>
  <tbody>";

	// while ($row=mysqli_fetch_array($result)){
		    $username = $row['username'];
        $password = $row['password'];
        $email = $row['email'];
        $comPoints = $row['comPoints'];
        echo "<tr>
          <td>$username</td>
          <td>$password</td>
          <td>$email</td>
          <td>$comPoints</td>
        </tr>";
	// }
	echo "</tbody></table><center><a href='admin-panel.php' class='btn btn-light'>Back to dashboard</a></div></center></div></div></div>";
}
  }
	

?>
</body>
</html>