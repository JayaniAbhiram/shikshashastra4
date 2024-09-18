
<!DOCTYPE html>
<?php
include ('connect.php');
?>
<?php
include('connect.php');
include('function1.php');

$pid = '';
$AppID = '';
$appdate = '';
$apptime = '';
$fname = '';
$lname = '';
$community = $_SESSION['dname'];

if (isset($_GET['pid']) && isset($_GET['AppID']) && isset($_GET['appdate']) && isset($_GET['apptime']) && isset($_GET['fname']) && isset($_GET['lname'])) {
    $pid = $_GET['pid'];
    $AppID = $_GET['AppID'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $appdate = $_GET['appdate'];
    $apptime = $_GET['apptime'];
}

if (isset($_POST['prescribe']) && isset($_POST['pid']) && isset($_POST['AppID']) && isset($_POST['appdate']) && isset($_POST['apptime']) && isset($_POST['lname']) && isset($_POST['fname'])) {
    $appdate = $_POST['appdate'];
    $apptime = $_POST['apptime'];
    $feedpoints = $_POST['feedpoints'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pid = $_POST['pid'];
    $AppID = $_POST['AppID'];
    $feedback = $_POST['feedback'];
    $community = $_SESSION['dname'];
    
    // Insert new feedback
    $query = mysqli_query($con, "INSERT INTO feedback (community, pid, AppID, fname, lname, appdate, apptime, feedpoints, feedback) 
                                 VALUES ('$community', '$pid', '$AppID', '$fname', '$lname', '$appdate', '$apptime', '$feedpoints', '$feedback')");
    
    if ($query) {
        // Calculate the total feedback points for this volunteer (fname + lname)
        $updateTotalFeedbackQuery = "
            UPDATE feedback f
            JOIN (
                SELECT fname, lname, SUM(feedpoints) AS total_points
                FROM feedback
                WHERE fname = '$fname' AND lname = '$lname'
                GROUP BY fname, lname
            ) summed_feedback
            ON f.fname = summed_feedback.fname AND f.lname = summed_feedback.lname
            SET f.total_feedbackpoints = summed_feedback.total_points
            WHERE f.fname = '$fname' AND f.lname = '$lname'";
        
        $updateTotalFeedbackResult = mysqli_query($con, $updateTotalFeedbackQuery);

        // Update the total points in the volunteer table
        $updateTotalPointsQuery = "
            UPDATE volunteer v
            JOIN (
                SELECT fname, lname, SUM(feedpoints) AS total_points
                FROM feedback
                WHERE fname = '$fname' AND lname = '$lname'
                GROUP BY fname, lname
            ) summed_feedback
            ON v.fname = summed_feedback.fname AND v.lname = summed_feedback.lname
            SET v.total_points = summed_feedback.total_points
            WHERE v.fname = '$fname' AND v.lname = '$lname'";
        
        $updateTotalPointsResult = mysqli_query($con, $updateTotalPointsQuery);

        if ($updateTotalFeedbackResult && $updateTotalPointsResult) {
          echo "
          <div id='popup' class='popup'>
              <div class='popup-content'>
                  <div class='popup-header'>
                      <span class='close'>&times;</span>
                      <h2>Success</h2>
                  </div>
                  <div class='popup-body'>
                      <p>Feedback submitted successfully and total points updated!</p>
                  </div>
                  <div class='popup-footer'>
                      <button id='popup-ok' class='popup-button'>OK</button>
                  </div>
              </div>
          </div>
          <script>
              // Show the popup with bounce animation
              var popup = document.getElementById('popup');
              var popupContent = document.querySelector('.popup-content');
              var popupOk = document.getElementById('popup-ok');
          
              popup.style.display = 'block';
              setTimeout(function() {
                  popupContent.classList.add('bounce-in');
              }, 10); // Small delay to ensure the popup is visible before animation starts
          
              // Close the popup when the 'x' is clicked
              document.querySelector('.close').onclick = function() {
                  closePopup();
              };
          
              // Close the popup when the OK button is clicked
              popupOk.onclick = function() {
                  closePopup();
              };
          
              // Function to close the popup and redirect
              function closePopup() {
                  popupContent.classList.remove('bounce-in');
                  popupContent.classList.add('fade-out');
                  setTimeout(function() {
                      popup.style.display = 'none';
                      window.location.href = 'community-panel.php'; // Redirect to the desired page
                  }, 800); // Match the duration of the fade-out animation
              }
          
              // Close the popup automatically after 3 seconds and redirect
              setTimeout(closePopup, 3000);
          </script>
          <style>
              /* Popup container */
              .popup {
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
              .popup-content {
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
      
              /* Bounce-in animation */
              .bounce-in {
                  transform: scale(1);
                  opacity: 1;
                  animation: bounceIn 1s ease-out;
              }
      
              /* Fade-out animation */
              .fade-out {
                  animation: fadeOut 0.8s ease-out;
                  transform: scale(0.5);
                  opacity: 0;
              }
      
              /* Popup header */
              .popup-header {
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
              }
      
              .popup-header h2 {
                  margin: 0;
                  color: #444;
              }
      
              /* Popup body */
              .popup-body {
                  margin: 20px 0;
              }
      
              /* Popup footer */
              .popup-footer {
                  margin-top: 20px;
              }
      
              /* Popup button */
              .popup-button {
                  padding: 10px 20px;
                  border: none;
                  border-radius: 5px;
                  background-color: #4CAF50;
                  color: white;
                  cursor: pointer;
                  transition: background-color 0.3s ease;
              }
      
              .popup-button:hover {
                  background-color: #45a049;
              }
      
              /* Close button */
              .close {
                  font-size: 24px;
                  font-weight: bold;
                  color: #888;
                  cursor: pointer;
              }
      
              .close:hover {
                  color: #444;
              }
      
              /* Animations */
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
            echo "<script>alert('Unable to update total feedback points or total points in volunteer table.');</script>";
        }
    } else {
        echo "<script>alert('Unable to submit feedback. Try again!');</script>";
    }
}
?>



<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">    
  <style type="text/css">
    body {
      padding-top: 50px;
      font-family: 'IBM Plex Sans', sans-serif;
      /* background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%); */
      background-image: url("img/bg_image.jpg");
    }
    
    .home-cont {
      margin-top: 50px;
    }
    
    .navbar-brand {
      font-size: 20px;
      font-weight: bold;
      text-decoration: none;
    }
    
    .navbar-nav .nav-item {
      margin-right: 10px;
    }
    
    .nav-link {
      font-size: 16px;
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      color: #fff;
    }
    
    .nav-link:hover {
      background-color: #007bff;
      color:black;
    }
    
    .nav-link.logout {
      background-color: #dc3545;
    }
    
    .nav-link.logout:hover {
      background-color: #c82333;
      color:black;
    }
    
    h3 {
      margin-left: 40%;
      padding-bottom: 20px;
    }
    
    .form-box {
      max-width: 500px;
      margin: 0 auto;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      /* background-color: #f8f9fa; */
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      font-weight: bold;
    }
    
    textarea {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: vertical;
    }
    
    .prescribe-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: black;
    background-color: white;
    border: 2px solid black;
    border-radius: 5px;
    cursor: pointer;
    /* tra
    nsition: background-color 0.5s ease; */
    text-align: center;
  }

  .prescribe-button:hover {
    background-color: orange;
  }
  </style>
  <script>
    function confirmPrescription() {
      var disease = document.getElementById("disease").value.trim();
      var feedpoints = document.getElementById("feedpoints").value.trim();
      var feedback = document.getElementById("feedback").value.trim();
      
      if (disease === "" || feedpoints === "" || feedback === "") {
        alert("Please fill in all fields before giving Feedback.");
      } else {
        var confirmed = confirm("Are you sure you want to give Feedback?");
        if (confirmed) {
          window.location.href = "community-panel.php";
        }
      }
    }
  </script>
</head>

<body>
  <div class="home-cont">
    <h3 style="font-size:30px;">Welcome <?php echo $community ?></h3>

    <div class="form-box">
      <form class="form-group" name="prescribeform" method="post" action="feedback.php">
        <div class="row">
          <!-- <div class="cont">
            <label>Points</label>
          </div> -->
          <!-- <div class="cont">
            <textarea id="disease" cols="86" rows="3" name="disease" required></textarea>
          </div> -->
        </div>
        <br>
        <div class="row">
          <div class="cont">
            <label>Credit Points</label>
          </div>
          <div class="cont">
            <textarea id="feedpoints" cols="86" rows="3" name="feedpoints" required></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="cont">
            <label>Remark</label>
          </div>
          <div class="cont">
            <textarea id="feedback" cols="86" rows="6" name="feedback" required></textarea>
          </div>
        </div>
        <br>
        <input type="hidden" name="fname" value="<?php echo $fname ?>" />
        <input type="hidden" name="lname" value="<?php echo $lname ?>" />
        <input type="hidden" name="appdate" value="<?php echo $appdate ?>" />
        <input type="hidden" name="apptime" value="<?php echo $apptime ?>" />
        <input type="hidden" name="pid" value="<?php echo $pid ?>" />
        <input type="hidden" name="AppID" value="<?php echo $AppID ?>" />
        <br>
        <div class="submit-btn">
        <input type="submit" name="prescribe" value="Submit" class="btn btn-primary" style="background-color:orange;width:90px;margin-left:180px;">
        </div>
      </form>
      <div class="submit-btn">
        <a href="community-panel.php" style="text-decoration: none;margin-left:180px;">
        <button class="btn btn-primary" style="width:90px;background-color:orange;">Back</button></a>
        </div>
    </div>
  </div>
</body>

</html>
