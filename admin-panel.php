<!DOCTYPE html>
<script>
        // JavaScript to check if the page was reloaded
        if (performance.navigation.type === 1) {
            // Page was reloaded, perform a complete reload
            window.location.href = window.location.href;
        }
    </script>
<?php
include("connect.php");
include('newfunction.php');

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['docsub'])) {
  $community = $_POST['community'];
  $cname = $_POST['cname'];
  $dpassword = $_POST['dpassword'];
  $demail = $_POST['demail'];
  $spec = $_POST['special'];
  $state = $_POST['state'];  // Add state
  $city = $_POST['city'];    // Add city

  if (empty($community) || empty($cname) || empty($dpassword) || empty($demail) || empty($spec) || empty($state) || empty($city)) {
    echo "
    <div id='error-popup' class='error-popup'>
        <div class='error-popup-content'>
            <div class='error-popup-header'>
                <h2>Error</h2>
            </div>
            <div class='error-popup-body'>
                <p>All fields are required.</p>
            </div>
            <div class='error-popup-footer'>
                <button id='error-popup-ok' class='error-popup-button'>OK</button>
            </div>
        </div>
    </div>
    <script>
        // Show the error popup
        var popup = document.getElementById('error-popup');
        var popupContent = document.querySelector('.error-popup-content');
        var popupOk = document.getElementById('error-popup-ok');

        popup.style.display = 'block';
        popupContent.classList.add('error-show-popup');

        // Close the popup when the OK button is clicked
        popupOk.onclick = function() {
            popupContent.classList.remove('error-show-popup');
            popupContent.classList.add('error-hide-popup');
            setTimeout(function() {
                popup.style.display = 'none';
                window.history.back();
            }, 800);
        };

        // Automatically close the popup after 3 seconds
        setTimeout(function() {
            popupContent.classList.remove('error-show-popup');
            popupContent.classList.add('error-hide-popup');
            setTimeout(function() {
                popup.style.display = 'none';
                window.history.back();
            }, 800);
        }, 3000);
    </script>
    <style>
        /* Popup container */
        .error-popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            animation: fadeIn 1s;
        }

        /* Popup content */
        .error-popup-content {
            position: relative;
            margin: 10% auto;
            padding: 20px;
            width: 50%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.4);
            transform: scale(0.5);
            opacity: 0;
            transition: all 0.8s ease;
        }

        .error-show-popup {
            transform: scale(1);
            opacity: 1;
            animation: bounceIn 1s ease-out;
        }

        .error-hide-popup {
            animation: fadeOut 0.8s ease-out;
            transform: scale(0.5);
            opacity: 0;
        }

        .error-popup-header {
            margin-bottom: 20px;
        }

        .error-popup-header h2 {
            margin: 0;
            color: #f44336;
        }

        .error-popup-body {
            margin-bottom: 20px;
        }

        .error-popup-footer {
            margin-top: 20px;
        }

        .error-popup-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #f44336;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .error-popup-button:hover {
            background-color: #e53935;
        }

        @keyframes bounceIn {
            0% { transform: scale(1.3); opacity: 0; }
            50% { transform: scale(0.9); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    ";
    exit();
}

  // Check if the combination of community name and specialization already exists
  $checkQuery = "SELECT * FROM community WHERE username='$community' AND spec='$spec'";
  $checkResult = mysqli_query($con, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    // Community with the same name and specialization exists, show error
    header("Location: error3.php");
    exit();
  }

  // Insert the new community with state and city
  $query = "INSERT INTO community(username, password, email, spec, state, city,cname) 
            VALUES('$community', '$dpassword', '$demail', '$spec', '$state', '$city','$cname')";
  
  $result = mysqli_query($con, $query);

  if ($result) {
    echo "
    <div id='success-popup' class='success-popup'>
        <div class='success-popup-content'>
            <div class='success-popup-header'>
                <h2>Success</h2>
            </div>
            <div class='success-popup-body'>
                <p>Community added successfully.</p>
            </div>
            <div class='success-popup-footer'>
                <button id='success-popup-ok' class='success-popup-button'>OK</button>
            </div>
        </div>
    </div>
    <script>
        // Show the success popup
        var popup = document.getElementById('success-popup');
        var popupContent = document.querySelector('.success-popup-content');
        var popupOk = document.getElementById('success-popup-ok');

        popup.style.display = 'block';
        popupContent.classList.add('success-show-popup');

        // Close the popup when the OK button is clicked
        popupOk.onclick = function() {
            popupContent.classList.remove('success-show-popup');
            popupContent.classList.add('success-hide-popup');
            setTimeout(function() {
                popup.style.display = 'none';
                window.location.href = 'admin-panel.php';
            }, 800);
        };

        // Automatically close the popup after 3 seconds
        setTimeout(function() {
            popupContent.classList.remove('success-show-popup');
            popupContent.classList.add('success-hide-popup');
            setTimeout(function() {
                popup.style.display = 'none';
                window.location.href = 'admin-panel.php';
            }, 800);
        }, 3000);
    </script>
    <style>
        /* Popup container */
        .success-popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            animation: fadeIn 1s;
        }

        /* Popup content */
        .success-popup-content {
            position: relative;
            margin: 10% auto;
            padding: 20px;
            width: 50%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.4);
            transform: scale(0.5);
            opacity: 0;
            transition: all 0.8s ease;
        }

        .success-show-popup {
            transform: scale(1);
            opacity: 1;
            animation: bounceIn 1s ease-out;
        }

        .success-hide-popup {
            animation: fadeOut 0.8s ease-out;
            transform: scale(0.5);
            opacity: 0;
        }

        .success-popup-header {
            margin-bottom: 20px;
        }

        .success-popup-header h2 {
            margin: 0;
            color: #4CAF50;
        }

        .success-popup-body {
            margin-bottom: 20px;
        }

        .success-popup-footer {
            margin-top: 20px;
        }

        .success-popup-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .success-popup-button:hover {
            background-color: #45a049;
        }

        @keyframes bounceIn {
            0% { transform: scale(1.3); opacity: 0; }
            50% { transform: scale(0.9); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    ";
} else {
    echo "Error: " . mysqli_error($con);
}
}

// Function to check if the book is accepted
function isAccepted($id)
{
    global $con;
    $query = "SELECT * FROM book WHERE AppID = '$id' AND communityStatus=0";
    $result = mysqli_query($con, $query);
    return mysqli_num_rows($result) > 0;
}

// Function to check if the book is cancelled
function isCancelled($id)
{
    global $con;
    $query = "SELECT * FROM book WHERE AppID = '$id' AND userStatus = 0";
    $result = mysqli_query($con, $query);
    return mysqli_num_rows($result) > 0;
}

mysqli_close($con);
?>

<script>
  function validateCommunityForm() {
    var community = document.getElementsByName("community")[0].value;
    var dpassword = document.getElementsByName("dpassword")[0].value;
    var cdpassword = document.getElementsByName("cdpassword")[0].value;
    var demail = document.getElementsByName("demail")[0].value;
    var spec = document.getElementsByName("special")[0].value;
    var comPoints = document.getElementsByName("comPoints")[0].value;

    if (community === "" || dpassword === "" || cdpassword === "" || demail === "" || spec === "" || comPoints === "") {
      alert("All details must be included.");
      return false; // Prevent form submission
    }

    // Check email format using a regular expression
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(demail)) {
      alert("Please enter a valid email address.");
      return false; // Prevent form submission
    }

    if (dpassword !== cdpassword) {
      alert("Passwords do not match.");
      return false; // Prevent form submission
    }
    if (isNaN(comPoints)) {
      alert("Consultancy Fees must be a numerical value.");
      return false; // Prevent form submission
    }

    // Check if Consultancy Fees contains only numbers
    if (!/^[0-9]+$/.test(comPoints)) {
      alert("Consultancy Fees must contain only numbers.");
      return false; // Prevent form submission
    }
    return true; // Form is valid and can be submitted
  }
  if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
function validateDeleteCommunityForm() {
  var email = document.getElementsByName('demail')[0].value;
  
  if (email.trim() === '') {
    alert('Please enter the community\'s email address.');
    return false; // Prevent form submission
  }
  
  // Rest of your validation logic
  // ...
}
</script>
<html lang="en" dir="ltr">

<head>
  <script src="https://kit.fontawesome.com/2323653b3c.js" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="stylesheet" href="style_3.css"> -->
  <link rel="stylesheet" href="admin_style.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">

</head>

<body style="background-color:red;">
  <!-- dashboard -->
  <div class="sidebar">
    <div class="logo-details">
      <!-- <i class='bx bx-plus-medical'></i> -->
      <i class='bx bx-book'></i>

      <span class="logo_name"><a href="admin-panel.php"> Shiksha Shastra</a></span>
    </div>
    <ul class="nav-links">
      <li>
        <a class="active" href="#list-dash">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#list-doc" id="list-doc-list">
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Communities list</span>
        </a>
      </li>
      <li>
        <a href="#list-pat" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Volunteers list</span>
        </a>
      </li>
      
      <li>
        <a href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-detail'></i>
          <span class="links_name">Booking Details</span>
        </a>
      </li>
      <li>
        <a href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-table'></i>
          <span class="links_name">Feedback details</span>
        </a>
      </li>
      <li>
        <a href="#list-registercommunities" id="list-adoc-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bxs-book-add'></i>
          <span class="links_name">New Communities</span>
        </a>
      </li>
      <li>
        <a href="#list-settings" id="list-adoc-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bxs-book-add'></i>
          <span class="links_name">Add Communitiy</span>
        </a>
      </li>
      <span>
    <a href="volunteerDetailsDocuments.php" style="text-decoration: none;">
        <button style="
            margin-left: 10px;
            margin-right:10px;
            background-color: transparent;
            border: 2px solid #007BFF;
            color: #007BFF;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            font-family: Arial, sans-serif;
            transition: background-color 0.3s, color 0.3s;
        ">
            View Volunteer Documents
        </button>
    </a>
</span>

      <!-- <li>
        <a href="#volunteerDocuments" id="list-adoc-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bxs-book-add'></i>
          <span class="links_name">view volunteer documents</span>
        </a>
      </li> -->
      

      
      
      <li class="log_out">
        <a href="logout.php" onclick="logout()">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- sections  -->
  <div class="section-container" id="sections">
    <!-- navbar -->
    <nav>
      <div class="welcome">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="admin">Welcome Admin</span>
      </div>
    </nav>
    <!-- Default contents and also dashboard contents -->
    <div class="home-content" id="list-dash" style="background-image: url(img/bg_image.jpg);">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4> Communitis List</h4>
            <script>
              function clickDiv(id) {
                document.querySelector(id).click();
              }
            </script>
            <p class="links cl-effect-1">
              <a href="#list-doc" onclick="clickDiv('#list-doc-list')">
                View Communities
              </a>
            </p>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Volunteers List</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                View Volunteers
              </a>
            </p>
            
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Booking Details</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-app-list')">
                View Bookings
              </a>
            </p>
          </div>
        </div>

      </div>
      
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Feedback List</h4>

            <p>
              <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                View Feedbacks
              </a>
            </p>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Manage Communities</h4>

            <p>
              <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Add Community</a>
              &nbsp|<a href="#list-doc" onclick="clickDiv('#list-doc-list')">Delete & Edit Community</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Community List contents-->
    <div class="home-content" id="list-doc">
  <div>
    <form class="form-group" action="communitysearch.php" method="post">
      <div class="dsearch">
        <div class="email-field">
          <input type="text" name="community_contact" placeholder="Enter Email ID" class="form-control">
        </div>
        <div class="submit-btn">
          <input type="submit" name="community_search_submit" class="btn btn-primary" value="Search">
        </div>
      </div>
    </form>
  </div>
  <div class="table-container">
    <table class="community-table">
      <thead>
        <tr>
        <th scope="col">Community No</th>
          <!-- <th scope="col">Community Username</th> -->
          <th scope="col">Community Name</th>
          <th scope="col">Specialization</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">State</th> <!-- New column for State -->
          <th scope="col">City</th> <!-- New column for City -->
          <th scope="col">Manage Communities</th>
        </tr>
      </thead>
      <tbody>
        <!-- Table rows with dynamic data -->
        <?php
include("connect.php");
global $con;
$query = "SELECT * FROM community order by community_no desc";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
    echo "
    <tr>
        <td>".$row['community_no']."</td>
        
        <td>".$row['username']."</td>
        <td>".$row['spec']."</td>
        <td>".$row['email']."</td>
        <td>".$row['password']."</td>
        <td>".$row['state']."</td> <!-- Displaying State -->
        <td>".$row['city']."</td> <!-- Displaying City -->
        <td>
            <a href='update-community.php?cn=".$row['community_no']."&un=".urlencode($row['username'])."&sp=".urlencode($row['spec'])."&em=".urlencode($row['email'])."&pw=".urlencode($row['password'])."&st=".urlencode($row['state'])."&ct=".urlencode($row['city'])."'>
                <input type='button' value='Update' class='btn btn-primary'>
            </a>
            <a href='delete-community.php?cn=".$row['community_no']."'>
                <input type='button' value='Delete' class='btn btn-primary'>
            </a>
        </td>
    </tr>";
}
?>

      </tbody>
    </table>
  </div>
</div>

    <!-- List volunteers section  -->
    <div class="home-content" id="list-pat">
      <div>
      
        <form class="form-group" action="volunteersearch.php" method="post">
          <div class="psearch">
            <div class="email-field">
              <input type="text" name="volunteer_contact" placeholder="Enter Contact" class="form-control">
            </div>
            
            <div class="submit-btn">
              <input type="submit" name="volunteer_search_submit" class="btn btn-primary" value="Search">
            </div>
            
          </div>
        </form>
      </div>
      <div class="table-container">
    
      <table class="volunteer">
        
        <thead>
          <tr>
            <th scope="col">Volunteer Id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
            <th scope="col">Total Points</th>
            <!-- <th scope="col">Password</th> -->
          </tr>
        </thead>
        
        <tbody>
          <!-- Table rows with dynamic data -->
          <?php
// $con = mysqli_connect("localhost", "root", "", "shikshashastra1");
global $con;

// Query to join volunteer table with feedback table and calculate total_feedbackpoints
$query = "
    SELECT v.pid, v.fname, v.lname, v.gender, v.email, v.contact, COALESCE(SUM(f.feedpoints), 0) AS total_points
    FROM volunteer v
    LEFT JOIN feedback f ON v.fname = f.fname AND v.lname = f.lname
    GROUP BY v.pid, v.fname, v.lname, v.gender, v.email, v.contact order by v.pid desc
";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
    $pid = $row['pid'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $gender = $row['gender'];
    $email = $row['email'];
    $contact = $row['contact'];
    $total_points = $row['total_points'];

    echo "<tr>
        <td>$pid</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$gender</td>
        <td>$email</td>
        <td>$contact</td>
        <td>$total_points</td>
    </tr>";
}
?>

        </tbody>
       
        
      </table>
      
        </div>
      <br>
    </div>
    <!-- List Bookings section -->
    <div class="home-content" id="list-app">
      <div>
        <form class="form-group" action="appsearch.php" method="post">
          <div class="appsearch">
            <div class="email-field">
              <input type="text" name="app_contact" placeholder="Enter Contact" class="form-control">
            </div>
            <div class="submit-btn"><input type="submit" name="app_search_submit" class="btn btn-primary" value="Search">
            </div>
          </div>
        </form>
      </div>
      <div class="table-container">
      <table class="app-table">
       
        <thead>
          <tr>
            <th scope="col">Booking ID</th>
            <th scope="col">Volunteer ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
            <th scope="col">Community Name</th>
            <!-- <th scope="col">Feedback</th> -->
            <th scope="col">Booking Date</th>
            <th scope="col">Booking Time</th>
            <th scope="col">Booking Status</th>
          </tr>
        </thead>
        <tbody>
          <?php

          // $con = mysqli_connect("localhost", "root", "", "shikshashastra1");
          global $con;

          $query = "select * from book order by AppID desc;";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_array($result)) {
            $id = $row['AppID'];
            $accepted = isAccepted($id);
            $cancelled = isCancelled($id);
        ?>
            <tr>
                <td><?php echo $row['AppID']; ?></td>
                <td><?php echo $row['pid']; ?></td>
                      <td><?php echo $row['fname']; ?></td>
                      <td><?php echo $row['lname']; ?></td>
                      <td><?php echo $row['gender']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['contact']; ?></td>
                      <td><?php echo $row['community']; ?></td>
                      
                      <td><?php echo $row['appdate']; ?></td>
                      <td><?php echo $row['apptime']; ?></td>
                <td>
                    <?php
                    if ($cancelled) {
                        echo "Cancelled";
                    } elseif ($accepted) {
                        echo "Accepted";
                    } else {
                        echo "Active";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
                  
      </table>
                  </div>
      <br>
    </div>
    <!-- feedback list contents-->
    <div class="home-content" id="list-pres">

      <div>
      <div class="table-container">

        <table class="pres-table">
          
          <thead>
            <tr>
              <th scope="col">Community</th>
              <th scope="col">Volunteer ID</th>
              <th scope="col">Booking ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Booking Date</th>
              <th scope="col">Booking Time</th>
              <th scope="col">Points</th>
              
              <th scope="col">Remarks</th>
              <th scope="col">Total points</th>
            </tr>
          </thead>
          <tbody>
          <?php
// $con = mysqli_connect("localhost", "root", "", "shikshashastra1");
global $con;

// Query to get feedback data along with the total feedback points for each volunteer
$query = "
    SELECT f.community, f.pid, f.AppID, f.fname, f.lname, f.appdate, f.apptime, f.feedpoints, f.feedback,
           COALESCE(summed_feedback.total_feedbackpoints, 0) AS total_points
    FROM feedback f
    LEFT JOIN (
        SELECT fname, lname, SUM(feedpoints) AS total_feedbackpoints
        FROM feedback
        GROUP BY fname, lname
    ) summed_feedback
    ON f.fname = summed_feedback.fname AND f.lname = summed_feedback.lname order by f.AppID desc
";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
    $community = $row['community'];
    $pid = $row['pid'];
    $AppID = $row['AppID'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $appdate = $row['appdate'];
    $apptime = $row['apptime'];
    $feedpoints = $row['feedpoints'];
    $pres = $row['feedback'];
    $total_points = $row['total_points'];

    echo "<tr>
        <td>$community</td>
        <td>$pid</td>
        <td>$AppID</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$appdate</td>
        <td>$apptime</td>
        <td>$feedpoints</td>
        <td>$pres</td>
        <td>$total_points</td>
    </tr>";
}
?>

          </tbody>
          
        </table>
          </div>
        <br>
      </div>
    </div>

    <!-- newly added communities -->
     
    <div class="home-content" id="list-registercommunities">
        <div class="table-container">
        <table class="pres-table" style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 16px; text-align: left; border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <thead>
        <tr style="background-color: #4CAF50; color: white; border-bottom: 3px solid #ddd;">
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">ID</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">Community Name</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">In-Charge</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">Mobile Number</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">Address</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">State</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">City</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">Created At</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">Email</th>
            <th scope="col" style="padding: 12px; border-right: 1px solid #ccc;">Specializations</th>
            <th scope="col" style="padding: 12px;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection
        // 
        include('connect.php');

        // Check connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to get details from the registercommunity table
        $query = "SELECT id, community_name, incharge, mobile_number, address, state, city, created_at, email, specializations FROM registercommunity order by id desc";
        $result = mysqli_query($con, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $community_name = $row['community_name'];
                $incharge = $row['incharge'];
                $mobile_number = $row['mobile_number'];
                $address = $row['address'];
                $state = $row['state'];
                $city = $row['city'];
                $created_at = $row['created_at'];
                $email = $row['email'];
                $specializations = $row['specializations'];

                echo "<tr style='border-bottom: 1px solid #ccc;'>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$id</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$community_name</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$incharge</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$mobile_number</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$address</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$state</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$city</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$created_at</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$email</td>
                    <td style='padding: 12px; border-right: 1px solid #eee;'>$specializations</td>
                    <td style='padding: 12px;'>
                        <form action='' method='post' onsubmit='return confirmDelete();' style='display:inline; margin-right: 10px;'>
                            <input type='hidden' name='delete_id' value='$id'>
                            <input type='submit' class='btn btn-delete' value='Delete' style='background-color: #ff4d4d; color: white; border: none; padding: 8px 12px; cursor: pointer;'>
                        </form>
                        <form action='' method='post' style='display:inline;'>
                            <input type='hidden' name='check_email' value='$email'>
                            <input type='submit' class='btn btn-check' value='Check' onclick='return checkEmail();' style='background-color: #4CAF50; color: white; border: none; padding: 8px 12px; cursor: pointer;'>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='11' style='padding: 12px; text-align: center;'>No records found</td></tr>";
        }

        mysqli_close($con);
        ?>
    </tbody>
</table>

        </div>

        <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this record?');
        }

        function checkEmail() {
            return true; // Form submission will be handled by PHP
        }
        </script>

<?php
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Database connection
    include('connect.php');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve email of the record to be deleted
    $email_query = "SELECT email FROM registercommunity WHERE id = ?";
    $stmt = mysqli_prepare($con, $email_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($email) {
        // Email is found, proceed to delete the record
        $delete_query = "DELETE FROM registercommunity WHERE id = ?";
        $stmt = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $delete_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Record deleted successfully'); window.location.href='admin-panel.php';</script>";
        } else {
            echo "<script>alert('Error deleting record');</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        // Email not found, show an alert and redirect
        echo "<script>alert('Community not found'); window.location.href='admin-panel.php';</script>";
    }

    mysqli_close($con);
}

if (isset($_POST['check_email'])) {
    $check_email = $_POST['check_email'];

    // Database connection
    $con = mysqli_connect("localhost", "root", "", "shikshashastra3");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the email exists in the `community` table
    $email_query = "SELECT email FROM community WHERE email = ?";
    $stmt = mysqli_prepare($con, $email_query);
    mysqli_stmt_bind_param($stmt, "s", $check_email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('This community is present in the community table.');</script>";
    } else {
        echo "<script>alert('This community is not present in the community table.');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>


    </div>




    <!-- <div class="home-content" id="list-registeredcommunities"> -->
    
    

      





    <!-- Add community section -->
    <div class="home-content" id="list-settings">
  <div class="form-container"style="height: 600px; overflow-y: auto;">
    <form class="form-group" method="post" action="admin-panel.php" onsubmit="return validateCommunityForm();">
      <div class="form-row">
      <div class="form-group1">
  <label for="community">Community Name:</label>
  <input type="text" class="form-control" name="community" id="community" oninput="checkMatchingFields();" onkeydown="return alphaOnly(event);">
</div>
<div class="form-group1">
  <label for="cname">Confirm COmmunity Name:</label>
  <input type="text" class="form-control" name="cname" id="cname" oninput="checkMatchingFields();" onkeydown="return alphaOnly(event);">
</div>
<div id="error-message" style="color: red; display: none;">
  Community Name and Community Username must be the same.
</div>
        <div class="form-group1">
          <label for="special">Specialization:</label>
          <select name="special" class="form-control" id="special">
            <option value="" disabled selected>Select Specialization</option>
            <option value="Primary">Primary</option>
            <option value="Secondary - Education">Secondary</option>
            <option value="Senior_Secondary">Senior Secondary</option>
            <option value="Undergraduation - Science">Undergraduation - Science</option>
            <option value="Under_graduation - Commerce">Undergraduation - Commerce</option>
            <option value="UnderGraduation - Arts">UnderGraduation - Arts</option>
          </select>
        </div>
      </div>

      <div class="form-group1">
        <label for="demail">Email ID:</label>
        <input type="email" class="form-control" name="demail" id="demail">
      </div>

      <div class="form-row">
        <div class="form-group1">
          <label for="dpassword">Password:</label>
          <input type="password" class="form-control" name="dpassword" id="dpassword">
        </div>
        <div class="form-group1">
          <label for="cdpassword">Confirm Password:</label>
          <input type="password" class="form-control" name="cdpassword" id="cdpassword">
        </div>
      </div>

      <!-- State and City Fields -->
      <div class="form-row">
        <div class="form-group1">
          <label for="state">State:</label>
          <select class="form-control" name="state" id="state">
            <option value="" disabled selected>Select State</option>
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
            <option value="Assam">Assam</option>
            <option value="Bihar">Bihar</option>
            <option value="Chhattisgarh">Chhattisgarh</option>
            <option value="Goa">Goa</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Haryana">Haryana</option>
            <option value="Himachal Pradesh">Himachal Pradesh</option>
            <option value="Jharkhand">Jharkhand</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Kerala">Kerala</option>
            <option value="Madhya Pradesh">Madhya Pradesh</option>
            <option value="Maharashtra">Maharashtra</option>
            <option value="Manipur">Manipur</option>
            <option value="Meghalaya">Meghalaya</option>
            <option value="Mizoram">Mizoram</option>
            <option value="Nagaland">Nagaland</option>
            <option value="Odisha">Odisha</option>
            <option value="Punjab">Punjab</option>
            <option value="Rajasthan">Rajasthan</option>
            <option value="Sikkim">Sikkim</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
            <option value="Telangana">Telangana</option>
            <option value="Tripura">Tripura</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="Uttarakhand">Uttarakhand</option>
            <option value="West Bengal">West Bengal</option>
          </select>
        </div>

        <div class="form-group1">
          <label for="city">City:</label>
          <select class="form-control" name="city" id="city">
            <option value="" disabled selected>Select City</option>
          </select>
        </div>
      </div>

      <div class="form-group1">
        <button type="submit" name="docsub" class="btn btn-primary">Add Community</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stateCityMap = {
        "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Tirupati"],
        "Arunachal Pradesh": ["Itanagar", "Naharlagun", "Pasighat", "Tawang", "Ziro"],
        "Assam": ["Guwahati", "Silchar", "Dibrugarh", "Jorhat", "Tezpur"],
        "Bihar": ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur", "Darbhanga"],
        "Chhattisgarh": ["Raipur", "Bilaspur", "Korba", "Durg", "Rajnandgaon"],
        "Goa": ["Panaji", "Margao", "Vasco da Gama", "Mapusa", "Ponda"],
        "Gujarat": ["Ahmedabad", "Vadodara", "Surat", "Rajkot", "Gandhinagar"],
        "Haryana": ["Chandigarh", "Gurugram", "Faridabad", "Karnal", "Ambala"],
        "Himachal Pradesh": ["Shimla", "Dharamshala", "Manali", "Kullu", "Solan"],
        "Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Deoghar"],
        "Karnataka": ["Bengaluru", "Mysore", "Hubli", "Mangalore", "Belgaum"],
        "Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode", "Kollam", "Kannur"],
        "Madhya Pradesh": ["Bhopal", "Indore", "Jabalpur", "Gwalior", "Ujjain"],
        "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Thane", "Nashik"],
        "Manipur": ["Imphal", "Churachandpur", "Thoubal", "Jiribam", "Ukhrul"],
        "Meghalaya": ["Shillong", "Tura", "Jowai", "Bajengdoba", "Williamnagar"],
        "Mizoram": ["Aizawl", "Lunglei", "Champhai", "Kolasib", "Serchhip"],
        "Nagaland": ["Kohima", "Dimapur", "Wokha", "Mokokchung", "Tuensang"],
        "Odisha": ["Bhubaneswar", "Cuttack", "Rourkela", "Sambalpur", "Berhampur"],
        "Punjab": ["Chandigarh", "Amritsar", "Ludhiana", "Jalandhar", "Patiala"],
        "Rajasthan": ["Jaipur", "Udaipur", "Jodhpur", "Kota", "Bikaner"],
        "Sikkim": ["Gangtok", "Namchi", "Pelling", "Mangan", "Rongli"],
        "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Salem", "Tiruchirappalli"],
        "Telangana": ["Hyderabad", "Warangal", "Nizamabad", "Karimnagar", "Khammam"],
        "Tripura": ["Agartala", "Udaipur", "Kailasahar", "Dharmanagar", "Belonia"],
        "Uttar Pradesh": ["Lucknow", "Kanpur", "Agra", "Varanasi", "Meerut"],
        "Uttarakhand": ["Dehradun", "Haridwar", "Rishikesh", "Nainital", "Roorkee"],
        "West Bengal": ["Kolkata", "Howrah", "Durgapur", "Siliguri", "Asansol"]
    };

    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    stateSelect.addEventListener('change', function () {
        const selectedState = this.value;
        citySelect.innerHTML = '<option value="" disabled selected>Select City</option>'; // Clear previous options

        if (selectedState && stateCityMap[selectedState]) {
            stateCityMap[selectedState].forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    });
});

function checkMatchingFields() {
    var communityName = document.getElementById('community').value;
    var communityUsername = document.getElementById('cname').value;
    var errorMessage = document.getElementById('error-message');

    if (communityName !== communityUsername) {
      errorMessage.style.display = 'block';
    } else {
      errorMessage.style.display = 'none';
    }
  }
</script>



  </div>



  



  <!-- <script>
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".sidebarBtn");
  sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if (sidebar.classList.contains("active")) {
      sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else
      sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  }
</script> -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebarBtn = document.querySelector(".sidebarBtn");
      const sidebar = document.querySelector(".sidebar");
      const sections = document.querySelector("#sections");
      const links = document.querySelectorAll(".nav-links li a");
      // Show the dashboard section by default
      document.getElementById("list-dash").style.display = "block";
      document.getElementById("list-doc").style.display = "none";
      document.querySelector(".nav-links li a.active").classList.remove("active");
      document.querySelector(".nav-links li a[href='#list-dash']").classList.add("active");

      // Hide other sections when the page loads
      document.querySelectorAll(".home-content").forEach(function(section) {
        if (section.id !== "list-dash") {
          section.style.display = "none";
        }
      });

      // Toggle sidebar
      sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      };

      // Handle click events for navigation links
      links.forEach(function(link) {
        link.addEventListener("click", function(event) {
          event.preventDefault();
          const targetSection = document.querySelector(this.getAttribute("href"));
          sections.querySelectorAll(".home-content").forEach(function(section) {
            section.style.display = "none";
          });
          targetSection.style.display = "block";
          document.querySelector(".nav-links li a.active").classList.remove("active");
          this.classList.add("active");
        });
      });
    });
    // logout button code
    function logout() {
      event.preventDefault();
      window.location.href = "logout.php"; // Redirect to logout.php
    }
    // default page contents js
    function clickDiv(id) {
      document.querySelector(id).click();
    }
  </script>

  



</body>

</html>