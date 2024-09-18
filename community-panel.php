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
include('function1.php');
// $con = mysqli_connect("localhost", "root", "", "checkss");
// $community = $_SESSION['dname'];
$community = isset($_SESSION['dname']) ? $_SESSION['dname'] : '';

// Function to check if the book is reviewed
function isReviewed($id)
{
    global $con;
    $query = "SELECT * FROM feedback WHERE AppID = '$id'";
    $result = mysqli_query($con, $query);
    return mysqli_num_rows($result) > 0;
}
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
if (isset($_GET['accept'])) {
    $AppID = $_GET['AppID'];
    $sql = mysqli_query($con, "UPDATE book SET communityStatus= 0 WHERE AppID = '$AppID'");
    if ($sql) {
        echo "
    <div id='popup' class='popup'>
        <div class='popup-content'>
            <div class='popup-header'>
                <span class='close'>&times;</span>
                <h2>Success</h2>
            </div>
            <div class='popup-body'>
                <p>Your slot was successfully accepted.</p>
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
}

if (isset($_GET['cancel'])) {
    $AppID = $_GET['AppID'];
    $query = mysqli_query($con, "UPDATE book SET userStatus = 0 WHERE AppID = '$AppID'");
    if ($query) {
        // echo "<script>alert('Your book was successfully cancelled.');</script>";
        echo "
    <div id='popup' class='popup'>
        <div class='popup-content'>
            <div class='popup-header'>
                <span class='close'>&times;</span>
                <h2>Notification</h2>
            </div>
            <div class='popup-body'>
                <p>Your book was successfully cancelled.</p>
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

        exit;
    }
}
// if (isset($_GET['accept'])) {
//     $AppID = $_GET['AppID'];
//     $query = mysqli_query($con, "UPDATE book SET userStatus= 1 WHERE AppID = '$AppID'");
//     if ($query) {
//         echo "<script>alert('Your book was successfully Accepted.');</script>";
//     }
// }

if (isset($_GET['prescribe'])) {
    $AppID = $_GET['AppID'];
    $appdate = $_GET['appdate'];
    $apptime = $_GET['apptime'];
    // $disease = $_GET['disease'];
    $feedpoints = $_GET['feedpoints'];
    $feedback = $_GET['feedback'];
    $query = mysqli_query($con, "INSERT INTO feedback(community, AppID, appdate, apptime, feedpoints, feedback) VALUES ('$community', '$AppID', '$appdate', '$apptime', '$feedpoints', '$feedback');");
    if ($query) {
        echo "<script>alert('Reviewed successfully!');</script>";
    } else {
        echo "<script>alert('Unable to process your request. Try again!');</script>";
    }
}

?>

<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/2323653b3c.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style_3.css">
    <link rel="stylesheet" href="style4_1.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script>
        function validateForm() {
            var contactInput = document.forms["searchForm"]["contact"].value;
            var numbersOnly = /^\d+$/;
            if (contactInput === "" || !contactInput.match(numbersOnly) || contactInput.length !== 10) {
                alert("Please enter a valid 10-digit contact number.");
                return false;
            }
        }
    </script>
</head>

<body>
    <!-- dashboard -->
    <div class="sidebar">
        <div class="logo-details">
            <!-- <i class='bx bx-book'></i> -->
            <img src="img/logo-no-background.png" alt="Description of the image" style="height:80px;">
            <span class="logo_name">
                <a href="community-panel.php">
                    Shiksha Shastra</a>
            </span>
        </div>
        <ul class="nav-links">
            <li>
                <a class="active" href="#list-dash">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#list-app" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Bookings</span>
                </a>
            </li>
            <li>
                <a href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
                    <i class='bx bx-detail'></i>
                    <span class="links_name">Feedback</span>
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
        <!-- Navbar content -->
        <nav class="doc-nav">
    <div class="welcome">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="admin">
            <?php 
            if (isset($_SESSION['dname'])) {
                $community = $_SESSION['dname'];
                
                echo "Welcome, " ,htmlspecialchars($community, ENT_QUOTES, 'UTF-8'); // Display the community username
            } else {
                // Handle the case when 'dname' is not set
                echo "Guest"; // Optionally display a default message or redirect
            }
            ?>
        </span>
    </div>
    <div>
        <form class="form-group" name="searchForm" onsubmit="return validateForm()" method="post" action="search.php">
            <div class="psearch">
                <div class="email-field">
                    <input class="form-control" type="text" placeholder="Search here" aria-label="Search" name="contact">
                </div>
                <div class="submit-btn">
                    <input type="submit" class="btn btn-primary" id="inputbtn" name="search_submit" value="Search">
                </div>
            </div>
        </form>
    </div>
</nav>


        <!-- Default contents and dashboard contents -->
        <div class="home-content" id="list-dash">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                            <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4>Bookings</h4>
                        <p class="cl-effect-1">
                            <a href="#app-list" onclick="clickDiv('#list-pat-list')">
                                View bookings
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
                        <h4>Feedback</h4>

                        <p>
                            <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                                View Feedback List
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div>
        <img src="img\pannels\p1.png" alt="Community Icon">
    </div> -->

        <!-- Bookings view section -->
        <?php
// Connect to the database
// $con = mysqli_connect("localhost", "root", "", "checkss");
global $con;

// Get the community name from the session
$dname = isset($_SESSION['dname']) ? $_SESSION['dname'] : '';

// Fetch data including total points from the volunteer table
$query = "SELECT b.pid, b.AppID, b.fname, b.lname, b.gender, b.email, b.contact, b.appdate, b.apptime, b.userStatus, b.communityStatus, v.total_points
          FROM book b
          JOIN volunteer v ON b.fname = v.fname AND b.lname = v.lname
          WHERE b.community = '$dname'
          order by b.AppID desc";
$result = mysqli_query($con, $query);
?>
<div class="home-content" id="list-app">
    <div class="table-container">
        <table class="app-table">
            <thead>
                <tr>
                    <th scope="col">Volunteer ID</th>
                    <th scope="col">Booking ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Booking Time</th>
                    <th scope="col">Current Status</th>
                    <th scope="col">Action</th>
                    <th scope="col">Total Points</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['AppID'];
                    $accepted = isAccepted($id);
                    $cancelled = isCancelled($id);
                    $reviewed = isReviewed($id);
                    
                    // Adjustments for button display logic
                    $showCancelAcceptButtons = !$cancelled && !$accepted && !$reviewed;
                    $showPrescribeButton = $accepted && !$reviewed && !$cancelled; 
                ?>
                    <tr>
                        <td><?php echo $row['pid']; ?></td>
                        <td><?php echo $row['AppID']; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['lname']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
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
                        <td>
                            <?php
                            if ($showCancelAcceptButtons) {
                                echo '<a href="community-panel.php?AppID=' . $row['AppID'] . '&cancel=update" onClick="return confirm(\'Are you sure you want to cancel this slot?\')" title="Cancel slot"><button class="btn btn-primary">Cancel</button></a>';
                                echo '<a href="community-panel.php?AppID=' . $row['AppID'] . '&accept=update" onClick="return confirm(\'Are you sure you want to accept this slot?\')" title="Accept slot"><button class="btn btn-primary">Accept</button></a>';
                            } elseif ($showPrescribeButton) {
                                echo '<a href="feedback.php?pid=' . $row['pid'] . '&AppID=' . $row['AppID'] . '&fname=' . $row['fname'] . '&lname=' . $row['lname'] . '&appdate=' . $row['appdate'] . '&apptime=' . $row['apptime'] . 'feedpoints=&feedback=" title="feedback"><button class="btn btn-primary">Feedback</button></a>';
                            }
                            ?>
                        </td>
                        <td><?php echo $row['total_points']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <br>
</div>


        <!-- Prescription section -->
        <div class="home-content" id="list-pres">
            <table class="pres-table">
                <thead>
                    <tr>
                        <th scope="col">Volunteer ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Booking Time</th>
                        <!-- <th scope="col">Points</th> -->
                        <th scope="col">Points</th>
                        <th scope="col">Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $con = mysqli_connect("localhost", "root", "", "checkss");
                    global $con;

                    $query = "SELECT pid, fname, lname, AppID, appdate, apptime, feedpoints, feedback FROM feedback WHERE community = '$community' order by pid desc";

                    $result = mysqli_query($con, $query);
                    if (!$result) {
                        echo mysqli_error($con);
                    }

                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['pid']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['AppID']; ?></td>
                            <td><?php echo $row['appdate']; ?></td>
                            <td><?php echo $row['apptime']; ?></td>
                            
                            <td><?php echo $row['feedpoints']; ?></td>
                            <td><?php echo $row['feedback']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarBtn = document.querySelector(".sidebarBtn");
            const sidebar = document.querySelector(".sidebar");
            const sections = document.querySelector("#sections");
            const links = document.querySelectorAll(".nav-links li a");

            // Show the dashboard section by default
            document.getElementById("list-dash").style.display = "block";
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