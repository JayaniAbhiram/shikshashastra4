<!DOCTYPE html>
<?php
include ('connect.php');
?>

<script>
        // JavaScript to check if the page was reloaded
        if (performance.navigation.type === 1) {
            // Page was reloaded, perform a complete reload
            window.location.href = window.location.href;
        }
    </script>


<?php
include ('connect.php');
include('function.php');
include('newfunction.php');

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$pid = $_SESSION['pid'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$gender = $_SESSION['gender'];
$lname = $_SESSION['lname'];
$contact = $_SESSION['contact'];

// Fetch unique states from the community table
$stateQuery = "SELECT DISTINCT state FROM community WHERE state IS NOT NULL AND state != '' ORDER BY state";
$stateResult = mysqli_query($con, $stateQuery);

// Fetch all state-city-spec-community combinations from the community table
$dataQuery = "SELECT DISTINCT state, city, spec, cname AS community FROM community WHERE state IS NOT NULL AND state != '' AND city IS NOT NULL AND city != '' ORDER BY state, city, spec, cname";
$dataResult = mysqli_query($con, $dataQuery);

$stateData = array();
while ($row = mysqli_fetch_assoc($dataResult)) {
    if (!isset($stateData[$row['state']])) {
        $stateData[$row['state']] = array();
    }
    if (!isset($stateData[$row['state']][$row['city']])) {
        $stateData[$row['state']][$row['city']] = array();
    }
    if (!isset($stateData[$row['state']][$row['city']][$row['spec']])) {
        $stateData[$row['state']][$row['city']][$row['spec']] = array();
    }
    $stateData[$row['state']][$row['city']][$row['spec']][] = $row['community'];
}
$email = $_SESSION['email'];

// Check if the volunteer's documents are accepted
$checkAcceptedQuery = "SELECT status FROM volunteer_documents WHERE gmail = ? AND status = 'yes'";
$stmt = $con->prepare($checkAcceptedQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$acceptedResult = $stmt->get_result();
$accepted = $acceptedResult->num_rows > 0;

if (isset($_POST['app-submit'])) {
    if (!$accepted) {
      echo "
      <div id='document-error-popup' class='error-popup'>
          <div class='error-popup-content'>
              <div class='error-popup-header'>
                  <h2>Error</h2>
              </div>
              <div class='error-popup-body'>
                  <p>Your documents are not accepted yet. Please ensure your documents are accepted before making a booking.</p>
              </div>
              <div class='error-popup-footer'>
                  <button id='document-error-popup-ok' class='error-popup-button'>OK</button>
              </div>
          </div>
      </div>
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
              background-color: rgba(0, 0, 0, 0.6);
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
      <script>
          // Show the error popup
          var popup = document.getElementById('document-error-popup');
          var popupContent = document.querySelector('.error-popup-content');
          var popupOk = document.getElementById('document-error-popup-ok');
  
          popup.style.display = 'block';
          popupContent.classList.add('error-show-popup');
  
          // Close the popup when the OK button is clicked
          popupOk.onclick = function() {
              popupContent.classList.remove('error-show-popup');
              popupContent.classList.add('error-hide-popup');
              setTimeout(function() {
                  popup.style.display = 'none';
              }, 800);
          };
  
          // Automatically close the popup after 5 seconds
          setTimeout(function() {
              popupContent.classList.remove('error-show-popup');
              popupContent.classList.add('error-hide-popup');
              setTimeout(function() {
                  popup.style.display = 'none';
              }, 800);
          }, 5000);
      </script>
      ";
    } else {
        // Existing booking logic here...
        if (empty($_POST['state']) || empty($_POST['city']) || empty($_POST['spec']) || empty($_POST['community']) || empty($_POST['appdate']) || empty($_POST['apptime'])) {
            echo "<script>alert('Please fill in all required fields.');</script>";
        } else {
            $state = $_POST['state'];
            $city = $_POST['city'];
            $spec = $_POST['spec'];
            $community = $_POST['community'];
            $appdate = $_POST['appdate'];
            $apptime = $_POST['apptime'];
            $cur_date = date("Y-m-d");
            date_default_timezone_set('Asia/Kathmandu');
            $cur_time = date("H:i:s");
            $apptime1 = strtotime($apptime);
            $appdate1 = strtotime($appdate);

            $oneMonthFromNow = date("Y-m-d", strtotime("+1 month"));

            if ($appdate1 < strtotime($oneMonthFromNow)) {
                if (date("Y-m-d", $appdate1) >= $cur_date) {
                    if ((date("Y-m-d", $appdate1) == $cur_date && date("H:i:s", $apptime1) > $cur_time) || date("Y-m-d", $appdate1) > $cur_date) {
                        $check_query = mysqli_query($con, "SELECT apptime FROM book WHERE community='$community' AND appdate='$appdate' AND apptime='$apptime' AND (userStatus='1' AND communityStatus='1')");

                        if (mysqli_num_rows($check_query) == 0) {
                            $query = mysqli_query($con, "INSERT INTO book(pid, fname, lname, gender, email, contact, state, city, spec, community, appdate, apptime, userStatus, communityStatus) VALUES($pid, '$fname', '$lname', '$gender', '$email', '$contact', '$state', '$city', '$spec', '$community', '$appdate', '$apptime', '1', '1')");

                            if ($query) {
                              echo "
                              <div id='popup' class='popup'>
                                  <div class='popup-content'>
                                      <div class='popup-header'>
                                          <span class='close'>&times;</span>
                                          <h2>Success</h2>
                                      </div>
                                      <div class='popup-body'>
                                          <p>Your booking was successful.</p>
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
                              
                                  // Function to close the popup
                                  function closePopup() {
                                      popupContent.classList.remove('bounce-in');
                                      popupContent.classList.add('fade-out');
                                      setTimeout(function() {
                                          popup.style.display = 'none';
                                      }, 800); // Match the duration of the fade-out animation
                                  }
                              
                                  // Close the popup automatically after 3 seconds
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
                                echo "<script>alert('Unable to process your request. Please try again!');</script>";
                            }
                        } else {
                          echo "
                          <div id='popup' class='popup'>
                              <div class='popup-content'>
                                  <div class='popup-header'>
                                      <span class='close'>&times;</span>
                                      <h2>Notification</h2>
                                  </div>
                                  <div class='popup-body'>
                                      <p>We are sorry to inform that the community is not available at this time or date. Please choose a different time or date!</p>
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
                          
                              // Function to close the popup
                              function closePopup() {
                                  popupContent.classList.remove('bounce-in');
                                  popupContent.classList.add('fade-out');
                                  setTimeout(function() {
                                      popup.style.display = 'none';
                                  }, 800); // Match the duration of the fade-out animation
                              }
                          
                              // Close the popup automatically after 3 seconds
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
                      
                        }
                    } else {
                        echo "<script>alert('Select a time or date in the future!');</script>";
                    }
                } else {
                    echo "<script>alert('Select a time or date in the future!');</script>";
                }
            } else {
                echo "<script>alert('Select a date within one month from now!');</script>";
            }
        }
    }
}



if (isset($_GET['cancel'])) {
  $query = mysqli_query($con, "update book set userStatus='0' where AppID = '" . $_GET['AppID'] . "'");
  if ($query) {
    // echo "<script>alert('Your book successfully cancelled');</script>";
    echo "<script>alert('Your book was successfully cancelled.');
              window.location.href = 'volunteer-panel.php';</script>";
  }
}
function get_specs()
{
  // $con = mysqli_connect("localhost", "root", "", "checkss");
  $query = mysqli_query($con, "select username, spec from community");
  $docarray = array();
  while ($row = mysqli_fetch_assoc($query)) {
    $docarray[] = $row;
  }

  $options = '';
  foreach ($docarray as $doc) {
    $options .= '<option value="' . $doc['username'] . '">' . $doc['spec'] . '</option>';
  }

  return $options;
}
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $pwd = $_POST['password'];

  $query = "UPDATE volunteer SET password='$pwd' WHERE email='$email'";
  $data = mysqli_query($con, $query);
  if ($data) {
    echo " <script> alert('password changed')</script>";
  } else {
    echo "Failed to change password";
  }
}

// Function to check if the book is reviewed
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
?>
<script>
  function validateBookingForm() {
    var spec = document.getElementById('spec').value;
    var community = document.getElementById('community').value;
    var comPoints = document.getElementById('comPoints').value;
    var appdate = document.querySelector('[name=appdate]').value;
    var apptime = document.getElementById('apptime').value;

    if (spec === "" || community === "" || appdate === "" || apptime === "") {
      alert("Please select all required fields.");
      return false;
    }

    return true;
  }
</script>
<html lang="en">

<head>
  <script src="https://kit.fontawesome.com/2323653b3c.js" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Volunteer Dashboard</title>
  <link rel="stylesheet" href="style_3.css">
  <link rel="stylesheet" href="style4_1.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .status-reviewed {
      color: green;
      font-weight: bold;
    }

    .status-canceled {
      color: red;
      font-weight: bold;
    }
  </style>


<body>
  <!-- dashboard -->
  <div class="sidebar">
    <div class="logo-details">
      <!-- <i class='bx bx-book'></i> -->
      <img src="img/logo-no-background.png" alt="Description of the image" style="height:80px;">
      <span class="logo_name"><a href="volunteer-panel.php"> Shiksha Shastra</a></span>
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
          <span class="links_name">Book Community</span>
        </a>
      </li>
      <li>
        <a href="#list-app" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Past Activities</span>
        </a>
      </li>
      <li>
        <a href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-detail'></i>
          <span class="links_name">Feedback</span>
        </a>
      </li>
      <li>
        <a href="#list-change-password" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-detail'></i>

          <span class="links_name">Change Password</span>
        </a>
      </li>
      <li>
        <a href="#uploaddocuments" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-detail'></i>

          <span class="links_name">Upload Documents</span>
        </a>
      </li>
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
        <span class="admin">
          <?php
          $query = "SELECT total_points FROM volunteer WHERE fname='$fname' AND lname='$lname';";
          $result = mysqli_query($con, $query);
          
          if (!$result) {
              echo mysqli_error($con);
          }
          
          $totalPoints = 0;
          if ($row = mysqli_fetch_array($result)) {
              $totalPoints = $row['total_points'];
          }

          $greeting = " Welcome , " . $username;
          echo $greeting;
          
          ?>
        </span>
        
      </div>
      <span class="total-points" style="
    float: right;
    margin-left: auto;
    font-weight: bold;
    font-size: 18px;
    color: #fff;
    background: linear-gradient(90deg, #ff6f61, #d76d77, #3a1c71);
    border-radius: 5px;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: pulse 2s infinite;
    display: flex;
    align-items: center;
">
    <strong>Total Points Earned: </strong>
    <span style="
        margin-left: 5px;
        color: #fff;
        font-size: 20px;
    "><?php echo $totalPoints; ?></span>
</span>

<style>
@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}
</style>

    </nav>
    <!-- Default contents and dashboard contents -->
    <div class="home-content" id="list-dash">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Book My Slot</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-doc-list')">
                Book Slot
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
            <h4>My Slots</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                Past Activities
              </a>
            </p>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Feedbacks</h4>

            <p>
              <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                View Feedbacks List
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Book Booking section -->
    <div class="home-content" id="list-doc">
      <div class="hcontent">
        <h4>Book a Slot</h4>
        <form class="form-group" method="post" action="volunteer-panel.php" onsubmit="return validateBookingForm();">
          <div>
            <label for="state">State:</label>
          </div>
          <div class="selspec">
            <select name="state" class="form-control" id="state">
              <option value="" disabled selected>Select State</option>
              <?php
              while ($stateRow = mysqli_fetch_assoc($stateResult)) {
                  echo "<option value='" . $stateRow['state'] . "'>" . $stateRow['state'] . "</option>";
              }
              ?>
            </select>
          </div>
          
          <div>
            <label for="city">City:</label>
          </div>
          <div class="selspec">
            <select name="city" class="form-control" id="city">
              <option value="" disabled selected>Select City</option>
            </select>
          </div>

          <div>
            <label for="spec">Specialization:</label>
          </div>
          <div class="selspec">
            <select name="spec" class="form-control" id="spec">
              <option value="" disabled selected>Select Specialization</option>
            </select>
          </div>

          <div>
            <label for="community">Communities</label>
          </div>
          <div class="sdoc">
            <select name="community" class="form-control" id="community">
              <option value="" disabled selected>Select Communities</option>
            </select>
          </div>

          <div>
            <label>Date</label>
          </div>
          <div class="apdate">
            <input type="date" class="form-control datepicker" name="appdate">
          </div>
          <div>
            <label>Time</label>
          </div>
          <div class="Stime">
            <select name="apptime" class="form-control" id="apptime">
              <option value="" disabled selected>Select Time</option>
              <option value="08:00:00">8:00 AM</option>
              <option value="10:00:00">10:00 AM</option>
              <option value="12:00:00">12:00 PM</option>
              <option value="14:00:00">2:00 PM</option>
              <option value="16:00:00">4:00 PM</option>
            </select>
          </div><br>
          <center>
            <div class="btn">
              <input type="submit" name="app-submit" value="Create new entry" class="btn btn-primary" id="inputbtn">
            </div>
          </center>
        </form>
      </div>
    </div>

<script>
const stateData = <?php echo json_encode($stateData); ?>;

document.getElementById('state').onchange = function() {
  const cities = Object.keys(stateData[this.value] || {});
  const citySelect = document.getElementById('city');
  citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';
  cities.forEach(city => {
    const option = document.createElement('option');
    option.value = city;
    option.textContent = city;
    citySelect.appendChild(option);
  });
  
  // Reset subsequent dropdowns
  document.getElementById('spec').innerHTML = '<option value="" disabled selected>Select Specialization</option>';
  document.getElementById('community').innerHTML = '<option value="" disabled selected>Select Communities</option>';
}

document.getElementById('city').onchange = function() {
  const state = document.getElementById('state').value;
  const specs = Object.keys(stateData[state][this.value] || {});
  const specSelect = document.getElementById('spec');
  specSelect.innerHTML = '<option value="" disabled selected>Select Specialization</option>';
  specs.forEach(spec => {
    const option = document.createElement('option');
    option.value = spec;
    option.textContent = spec;
    specSelect.appendChild(option);
  });
  
  // Reset community dropdown
  document.getElementById('community').innerHTML = '<option value="" disabled selected>Select Communities</option>';
}

document.getElementById('spec').onchange = function () {
  const state = document.getElementById('state').value;
  const city = document.getElementById('city').value;
  const communities = stateData[state][city][this.value] || [];
  const communitySelect = document.getElementById('community');
  communitySelect.innerHTML = '<option value="" disabled selected>Select Communities</option>';
  communities.forEach(community => {
    const option = document.createElement('option');
    option.value = community;
    option.textContent = community;
    communitySelect.appendChild(option);
  });
}

function validateBookingForm() {
  // Add any client-side validation here
  return true;
}
</script>
  

    <!-- Booking history section -->
    <div class="home-content" id="list-app">
      <div class="table-container">
        <table class="app-table"  >
          <thead>
            <tr>
              <th scope="col">Community Name</th>
              <!-- <th scope="col">Feedback</th> -->
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Current Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody  >
            <?php
            // $con = mysqli_connect("localhost", "root", "", "checkss");
            global $con;

            $query = "SELECT AppID, community, comPoints, appdate, apptime, userStatus, communityStatus FROM book WHERE fname ='$fname' AND lname='$lname' ORDER BY AppID desc";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
              $community = $row['community'];
              $comPoints = $row['comPoints'];
              $appdate = $row['appdate'];
              $apptime = $row['apptime'];
              $userStatus = $row['userStatus'];
              $communityStatus = $row['communityStatus'];
              $AppID = $row['AppID'];

              // Check if book is reviewed or cancelled
              $accepted = isAccepted($AppID);
              $cancelled = isCancelled($AppID);
              ?>
              <tr>
                <th scope="row">
                  <?php echo $community; ?>
                </th>
                <!-- <td> -->
                  <?php 
                  // echo $comPoints; 
                  ?> 
                <!-- </td> -->
                <td>
                  <?php echo $appdate; ?>
                </td>
                <td>
                  <?php echo $apptime; ?>
                </td>
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
                <td>
                  <?php if (!$cancelled && !$accepted) { ?>
                    <a href="volunteer-panel.php?AppID=<?php echo $row['AppID'] ?>&cancel=update"
                      onClick="return confirm('Are you sure you want to cancel this book?')"
                      title="Cancel Booking">
                      <button class="btn btn-primary">Cancel</button>
                    </a>
                  <?php } ?>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>


    <!-- Prescription section -->
    <div class="home-content" id="list-pres">
    <div>
        <table class="pres-table">
            <thead>
                <tr>
                    <th scope="col">Community Name</th>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Booking Time</th>
                    <th scope="col">Points</th>
                    <th scope="col">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $con;

                $query = "SELECT community, AppID, appdate, apptime, feedpoints, feedback FROM feedback WHERE pid='$pid' order by AppID desc;";
                $result = mysqli_query($con, $query);
                
                if (!$result) {
                    echo mysqli_error($con);
                }

                $totalPoints = 0; // Initialize the total points variable

                while ($row = mysqli_fetch_array($result)) {
                    $totalPoints += $row['feedpoints']; // Accumulate points
                ?>
                    <tr>
                        <td><?php echo $row['community']; ?></td>
                        <td><?php echo $row['AppID']; ?></td>
                        <td><?php echo $row['appdate']; ?></td>
                        <td><?php echo $row['apptime']; ?></td>
                        <td><?php echo $row['feedpoints']; ?></td>
                        <td><?php echo $row['feedback']; ?></td>
                    </tr>
                <?php 
                } 
                ?>
            </tbody>
        </table>
        <br>
        <div style="
    background: linear-gradient(135deg, #ff7e5f, #feb47b); /* Gradient background */
    border-radius: 12px; /* Rounded corners */
    padding: 15px 20px; /* Padding */
    margin: 20px auto; /* Centering and margin */
    display: inline-flex; /* Inline display with flex */
    align-items: center; /* Center items vertically */
    justify-content: center; /* Center items horizontally */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Shadow for depth */
    font-family: 'Arial', sans-serif; /* Font family */
    text-align: center; /* Center text */
    transition: transform 0.3s ease-in-out, background 0.3s ease-in-out; /* Transition effects */
    position: relative; /* For possible future positioning needs */
    overflow: hidden; /* Hide overflow */
    cursor: pointer; /* Pointer cursor on hover */
" onmouseover="this.style.background = 'linear-gradient(135deg, #feb47b, #ff7e5f)'; this.style.transform = 'scale(1.05)';" onmouseout="this.style.background = 'linear-gradient(135deg, #ff7e5f, #feb47b)'; this.style.transform = 'scale(1)';">
    <strong style="
        color: #fff; /* Text color */
        font-size: 1.2em; /* Font size */
        margin-right: 10px; /* Space between strong text and value */
    ">Total Points Earned:</strong>
    <span style="
        color: #fff; /* Text color */
        font-size: 2em; /* Font size */
        font-weight: bold; /* Font weight */
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Text shadow for better readability */
    "><?php echo $totalPoints; ?></span>
</div>

        
    </div>
</div>

    <!-- Change Password section -->
    <div class="home-content" id="list-change-password">
      <div class="change-password-form">

        <center>
          <h4 style="font-size:30px;">Change Password</h4>
        </center>
        <form class="form-group" method="post" action="volunteer-panel.php">
          <div>
            <label for="email">Email:</label>
          </div>
          <div>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div>
            <label for="new-password">New Password:</label>
          </div>
          <div>
            <input type="password" name="password" class="form-control" required>
          </div><br>
          <div class="btn">
            <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>

    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>

<!-- uploading the documetnts -->
<div class="home-content" id="uploaddocuments" >
    <div style="display: flex; justify-content: center; align-items: center; background-color: transparent;">
        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 90%; max-width: 600px;overflow-y:auto;">
            <!-- <h1 style="text-align: center; color: #333;">Upload Volunteer Documents</h1> -->
            <form action="volunteer-panel.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
                <label for="name" style="font-weight: bold; color: #555;">Name:</label>
                <input type="text" name="name" id="name" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

                <label for="gmail" style="font-weight: bold; color: #555;">Gmail:</label>
                <input type="email" name="gmail" id="gmail" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

                <label for="file1" style="font-weight: bold; color: #555;">Choose File 1 (Aadhar Card):</label>
<input type="file" name="file1" id="file1" accept=".pdf" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

<label for="file2" style="font-weight: bold; color: #555;">Choose File 2 (12th Mark Sheet):</label>
<input type="file" name="file2" id="file2" accept=".pdf" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

<label for="file3" style="font-weight: bold; color: #555;">Choose File 3 (Graduation Certificate):</label>
<input type="file" name="file3" id="file3" accept=".pdf" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">


                <button type="submit" name="upload" style="background-color: #28a745; color: #fff; border: none; border-radius: 4px; padding: 10px 20px; cursor: pointer; font-size: 16px; transition: background-color 0.3s;">
                    Upload Files
                </button>
            </form>
            <?php
include("connect.php");

if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $gmail = $_POST['gmail'];

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if name or gmail already exists
    $checkQuery = "SELECT id FROM volunteer_documents WHERE name = ? OR gmail = ?";
    $stmtCheck = $con->prepare($checkQuery);
    $stmtCheck->bind_param("ss", $name, $gmail);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        echo "<script>alert('Documents already uploaded with this name or Gmail.');</script>";
    } else {
        // Directory for uploads
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // File paths
        $file1Path = $file2Path = $file3Path = '';

        // Function to check if file is PDF
        function isPdf($file) {
            return isset($file['type']) && $file['type'] === 'application/pdf';
        }

        // File 1 upload
        if ($_FILES['file1']['error'] == 0 && isPdf($_FILES['file1'])) {
            $file1Path = $uploadDir . basename($_FILES['file1']['name']);
            move_uploaded_file($_FILES['file1']['tmp_name'], $file1Path);
        } else {
            echo "<script>alert('File 1 must be a PDF document.');</script>";
        }

        // File 2 upload
        if ($_FILES['file2']['error'] == 0 && isPdf($_FILES['file2'])) {
            $file2Path = $uploadDir . basename($_FILES['file2']['name']);
            move_uploaded_file($_FILES['file2']['tmp_name'], $file2Path);
        } else {
            echo "<script>alert('File 2 must be a PDF document.');</script>";
        }

        // File 3 upload
        if ($_FILES['file3']['error'] == 0 && isPdf($_FILES['file3'])) {
            $file3Path = $uploadDir . basename($_FILES['file3']['name']);
            move_uploaded_file($_FILES['file3']['tmp_name'], $file3Path);
        } else {
            echo "<script>alert('File 3 must be a PDF document.');</script>";
        }

        // Insert into database
        if ($file1Path && $file2Path && $file3Path) {
            $insertQuery = "INSERT INTO volunteer_documents (name, gmail, file1_path, file2_path, file3_path) VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $con->prepare($insertQuery);
            $stmtInsert->bind_param("sssss", $name, $gmail, $file1Path, $file2Path, $file3Path);

            // Execute and check success
            if ($stmtInsert->execute()) {
                echo "<script>alert('Documents successfully submitted and inserted into the database.');</script>";
            } else {
                echo "<p style='color: #dc3545; text-align: center;'>Error: " . $stmtInsert->error . "</p>";
            }

            $stmtInsert->close();
        }
    }

    // Close connections
    $stmtCheck->close();
    $con->close();
}
?>

        </div>
    </div>
</div>

        </div>
    </div>
      
    </div>








  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
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
      document.querySelectorAll(".home-content").forEach(function (section) {
        if (section.id !== "list-dash") {
          section.style.display = "none";
        }
      });

      // Toggle sidebar
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      };

      // Handle click events for navigation links
      links.forEach(function (link) {
        link.addEventListener("click", function (event) {
          event.preventDefault();
          const targetSection = document.querySelector(this.getAttribute("href"));
          sections.querySelectorAll(".home-content").forEach(function (section) {
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