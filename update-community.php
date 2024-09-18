<!DOCTYPE html>
<?php
include('connect.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(0);
$cn = $_GET['cn']; // Community No

$un = $_GET['un'];
$sp = $_GET['sp'];
$em = $_GET['em'];
$df = $_GET['df'];
$pw = $_GET['pw'];
$st = $_GET['st']; // Get state
$ct = $_GET['ct']; // Get city
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Community</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function populateCities() {
            const stateCities = {
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

            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");
            const selectedState = stateSelect.value;

            citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';

            if (stateCities[selectedState]) {
                stateCities[selectedState].forEach(function (city) {
                    const option = document.createElement("option");
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
            }
        }

        window.onload = function() {
            populateCities();
            document.getElementById("state").value = "<?php echo $st; ?>";
            populateCities();
            document.getElementById("city").value = "<?php echo $ct; ?>";
        };
    </script>
</head>

<body>
    <div class="home-content" id="list-settings">
        <div class="form-container">
            <form class="form-group" method="GET" action="update-community.php">
                <input type="hidden" name="cn" value="<?php echo htmlspecialchars($cn); ?>">
                <div class="form-row">
                    <div class="form-group1">
                        <label for="community">Community Name:</label>
                        <input type="text" value="<?php echo htmlspecialchars($un); ?>" class="form-control" name="community">
                    </div>
                    <div class="form-group1">
                        <label for="cname">Community username</label>
                        <input type="text" value="<?php echo htmlspecialchars($un); ?>" class="form-control" name="cname">
                    </div>
                    <div>
                        <label for="special">Specialization:</label>
                        <select name="special" class="form-control" id="special">
                        <option value="" disabled>Select Specialization</option>
                            <option value="Primary" <?php if ($sp === "Primary") echo "selected"; ?>>Primary</option>
                            <option value="Secondary" <?php if ($sp === "Secondary") echo "selected"; ?>>Secondary</option>
                            <option value="Senior_Secondary" <?php if ($sp === "Senior_Secondary") echo "selected"; ?>>Senior Secondary</option>
                            <option value="Undergraduation - Science" <?php if ($sp === "Undergraduation - Science") echo "selected"; ?>>Undergraduation - Science</option>
                            <option value="Undergraduation - Commerce" <?php if ($sp === "Undergraduation - Commerce") echo "selected"; ?>>Undergraduation - Commerce</option>
                            <option value="Undergraduation - Arts" <?php if ($sp === "Undergraduation - Arts") echo "selected"; ?>>Undergraduation - Arts</option>
                        </select>
                        
                    </div>
                </div>
                <div class="form-group1">
                    <label for="demail">Email ID:</label>
                    <input type="email" value="<?php echo htmlspecialchars($em); ?>" class="form-control" name="demail" id="demail">
                </div>
                <div class="form-row">
                    <div class="form-group1">
                        <label for="dpassword">Password:</label>
                        <input type="text" value="<?php echo htmlspecialchars($pw); ?>" class="form-control" name="dpassword" id="dpassword">
                    </div>
                </div>
                <div class="form-group1">
                    <label for="comPoints">Consultancy Fees:</label>
                    <input type="text" value="<?php echo htmlspecialchars($df); ?>" class="form-control" name="comPoints" id="comPoints">
                </div>
                <div class="form-row">
                    <div class="form-group1">
                        <label for="state">State:</label>
                        <select class="form-control" name="state" id="state" onchange="populateCities()">
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
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <button type="button" onclick="deleteRecord('<?php echo htmlspecialchars($un); ?>')" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function deleteRecord(username) {
        if (confirm("Are you sure you want to delete this community?")) {
            window.location.href = 'delete-community.php?username=' + encodeURIComponent(username);
        }
    }
    </script>
</body>

</html>

<?php
if (isset($_GET['submit'])) {
    $community = $_GET['community'];
    $cname = $_GET['cname'];
    $password = $_GET['dpassword'];
    $demail = $_GET['demail'];
    $special = $_GET['special'];
    $comPoints = $_GET['comPoints'];
    $state = $_GET['state'];
    $city = $_GET['city'];
    $cn = $_GET['cn']; // Community No

    $query = "UPDATE community SET username='$community', cname='$cname',password='$password', email='$demail', spec='$special', comPoints='$comPoints', state='$state', city='$city' WHERE community_no='$cn'";
    $data = mysqli_query($con, $query);

    if ($data) {
        echo "
        <div id='popup' class='popup'>
            <div class='popup-content'>
                <div class='popup-header'>
                    <span class='close'>&times;</span>
                    <h2>Success</h2>
                </div>
                <div class='popup-body'>
                    <p>Details updated successfully</p>
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
            popupContent.classList.add('bounce-in');
    
            // Close the popup when the 'x' is clicked
            document.querySelector('.close').onclick = function() {
                popupContent.classList.remove('bounce-in');
                popupContent.classList.add('fade-out');
                setTimeout(function() {
                    popup.style.display = 'none';
                    window.location.href = 'admin-panel.php#list-settings1';
                }, 800);
            };
    
            // Close the popup when the OK button is clicked
            popupOk.onclick = function() {
                popupContent.classList.remove('bounce-in');
                popupContent.classList.add('fade-out');
                setTimeout(function() {
                    popup.style.display = 'none';
                    window.location.href = 'admin-panel.php#list-settings1';
                }, 800);
            };
    
            // Close the popup automatically after 3 seconds
            setTimeout(function() {
                popupContent.classList.remove('bounce-in');
                popupContent.classList.add('fade-out');
                setTimeout(function() {
                    popup.style.display = 'none';
                    window.location.href = 'admin-panel.php#list-settings1';
                }, 800);
            }, 3000);
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
        echo "Failed to update details: " . mysqli_error($con);
    }
}
?>
<?php
include('connect.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['community_search_submit'])) {
    $contact = $_POST['community_contact'];
    $query = "SELECT * FROM community WHERE email='$contact'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        // Display the results
    } else {
        echo "No records found for the provided email.";
    }
}
?>
<?php
// include('connect.php');

// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// if (isset($_GET['username'])) {
//     $username = mysqli_real_escape_string($con, $_GET['username']);
//     $query = "DELETE FROM community WHERE username = ?";
    
//     $stmt = mysqli_prepare($con, $query);
//     mysqli_stmt_bind_param($stmt, "s", $username);
//     mysqli_stmt_execute($stmt);
    
//     if (mysqli_affected_rows($con) > 0) {
//         echo "<script>alert('Community deleted successfully');window.location.href = 'admin-panel.php#list-settings1';</script>";
//     } else {
//         echo "Failed to delete community or community not found.";
//     }
    
//     mysqli_stmt_close($stmt);
// } else {
//     echo "No username provided for deletion.";
// }

// mysqli_close($con);

// include('connect.php');

// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// if (isset($_GET['username'])) {
//     $username = mysqli_real_escape_string($con, $_GET['username']);

//     // First, delete related records in the book table
//     $delete_book_query = "DELETE FROM book WHERE community = ?";
//     $stmt_book = mysqli_prepare($con, $delete_book_query);
//     mysqli_stmt_bind_param($stmt_book, "s", $username);
//     mysqli_stmt_execute($stmt_book);
//     mysqli_stmt_close($stmt_book);

//     // Then, delete related records in the feedback table
//     $delete_feedback_query = "DELETE FROM feedback WHERE community = ?";
//     $stmt_feedback = mysqli_prepare($con, $delete_feedback_query);
//     mysqli_stmt_bind_param($stmt_feedback, "s", $username);
//     mysqli_stmt_execute($stmt_feedback);
//     mysqli_stmt_close($stmt_feedback);

//     // Finally, delete the community from the community table
//     $delete_community_query = "DELETE FROM community WHERE username = ?";
//     $stmt_community = mysqli_prepare($con, $delete_community_query);
//     mysqli_stmt_bind_param($stmt_community, "s", $username);
//     mysqli_stmt_execute($stmt_community);

//     if (mysqli_affected_rows($con) > 0) {
//         echo "<script>alert('Community deleted successfully');window.location.href = 'admin-panel.php#list-settings1';</script>";
//     } else {
//         echo "Failed to delete community or community not found.";
//     }

//     mysqli_stmt_close($stmt_community);
// } else {
//     echo "No username provided for deletion.";
// }

// mysqli_close($con);
// ?>
