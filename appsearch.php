<!DOCTYPE html>
 <?php #include("function.php");?>
<html>
<head>
	<title>Volunteer Details</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("newfunction.php");
if(isset($_POST['app_search_submit']))
{
	$contact=$_POST['app_contact'];
	$query = "select * from book where contact= '$contact';";
  $result = mysqli_query($con,$query);
  $row=mysqli_fetch_array($result);
  if($row['fname']=="" & $row['lname']=="" & $row['email']=="" & $row['contact']=="" & $row['community']=="" & $row['comPoints']=="" & $row['appdate']=="" & $row['apptime']==""){
    echo "<script> alert('No Bookings found'); 
          window.location.href = 'admin-panel.php#list-doc';</script>";
  }
  else {
    echo "<div>
    <div class='home-content' id='list-app'>
    <div>
  <table class='app-table'>
    <thead>
      <tr>
        <th scope='col'>First Name</th>
        <th scope='col'>Last Name</th>
        <th scope='col'>Email</th>
        <th scope='col'>Contact</th>
        <th scope='col'>Community Name</th>
        <th scope='col'>Consultancy Fees</th>
        <th scope='col'>Booking Date</th>
        <th scope='col'>Booking Time</th>
        <th scope='col'>Booking Status</th>
      </tr>
    </thead>
    <tbody>";
  
    
          $fname = $row['fname'];
          $lname = $row['lname'];
          $email = $row['email'];
          $contact = $row['contact'];
          $community = $row['community'];
          $comPoints= $row['comPoints'];
          $appdate= $row['appdate'];
          $apptime = $row['apptime'];
          if(($row['userStatus']==1) && ($row['communityStatus']==1))  
                    {
                      $appstatus = "Active";
                    }
                    if(($row['userStatus']==0) && ($row['communityStatus']==1))  
                    {
                      $appstatus = "Cancelled by You";
                    }

                    if(($row['userStatus']==1) && ($row['communityStatus']==0))  
                    {
                      $appstatus = "Cancelled by Community";
                    }
          echo "<tr>
            <td>$fname</td>
            <td>$lname</td>
            <td>$email</td>
            <td>$contact</td>
            <td>$community</td>
            <td>$comPoints</td>
            <td>$appdate</td>
            <td>$apptime</td>
            <td>$appstatus</td>
          </tr>";
    echo "</tbody></table><center><div class='submitbtn'><a href='admin-panel.php' class='btn btn-light'></div>Back to your Dashboard</a></div></center></div></div></div>";
  }
  }
	
?>
</body>
</html>
