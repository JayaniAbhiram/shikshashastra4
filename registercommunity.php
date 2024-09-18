<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Community</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 800px;
            animation: fadeIn 1s ease-in;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        .form-row > div {
            flex: 1;
            min-width: calc(50% - 20px);
            margin-right: 20px;
        }
        .form-row > div:last-child {
            margin-right: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }
        input[type="text"], input[type="tel"], input[type="email"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="tel"]:focus, input[type="email"]:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
        }
        .checkbox-group label {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    <script>
        // Function to dynamically load cities based on the selected state
        function loadCities() {
            var state = document.getElementById("state").value;
            var citySelect = document.getElementById("city");
            var cities = {
                "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Tirupati", "Guntur", "Kakinada"],
                "Arunachal Pradesh": ["Itanagar", "Tawang", "Ziro", "Bomdila", "Pasighat"],
                "Assam": ["Guwahati", "Silchar", "Dibrugarh", "Jorhat", "Tezpur"],
                "Bihar": ["Patna", "Gaya", "Bhagalpur", "Muzzafarpur", "Begusarai"],
                "Goa": ["Panaji", "Margao", "Vasco da Gama", "Ponda", "Mapusa"]
                // Add more states and cities as needed
            };

            citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';

            if (state in cities) {
                for (var i = 0; i < cities[state].length; i++) {
                    var option = document.createElement("option");
                    option.value = cities[state][i];
                    option.text = cities[state][i];
                    citySelect.add(option);
                }
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <?php
        include("connect.php"); // Ensure you have this file for database connection

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and sanitize form data
            $communityName = mysqli_real_escape_string($con, $_POST['communityName']);
            $incharge = mysqli_real_escape_string($con, $_POST['incharge']);
            $mobileNumber = mysqli_real_escape_string($con, $_POST['mobileNumber']);
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $state = mysqli_real_escape_string($con, $_POST['state']);
            $city = mysqli_real_escape_string($con, $_POST['city']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $specializations = $_POST['specializations']; // Array of selected specializations

            // Convert the array to a comma-separated string
            $specializations_str = implode(',', $specializations);

            // Check if the mobile number or email already exists
            $checkQuery = "SELECT * FROM registercommunity WHERE mobile_number='$mobileNumber' OR email='$email'";
            $checkResult = mysqli_query($con, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "<script>alert('A community with this mobile number or email already exists.');</script>";
            } else {
                // Insert data into the database
                $query = "INSERT INTO registercommunity (community_name, incharge, mobile_number, address, state, city, email, specializations) 
                          VALUES ('$communityName', '$incharge', '$mobileNumber', '$address', '$state', '$city', '$email', '$specializations_str')";

                if (mysqli_query($con, $query)) {
                    echo "<script>alert('Community added successfully!'); window.location.href = 'community-login.php';</script>";
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($con);
                }
            }

            // Close the database connection
            mysqli_close($con);
        }
        ?>

        <h1>Register as a Community</h1>
        <form action="" method="post">
            <div class="form-row">
                <div>
                    <label for="communityName">Community Name:</label>
                    <input type="text" id="communityName" name="communityName" required>
                </div>
                <div>
                    <label for="incharge">Community Head:</label>
                    <input type="text" id="incharge" name="incharge" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="mobileNumber">Community Mobile Number:</label>
                    <input type="tel" id="mobileNumber" name="mobileNumber" pattern="\d{10}" title="Mobile number must be 10 digits" required>
                </div>
                <div>
                    <label for="address">Community Address:</label>
                    <input type="text" id="address" name="address" pattern="[A-Za-z0-9\s,.-]+" title="Address must contain letters, numbers, and common address symbols" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="state">State:</label>
                    <select id="state" name="state" onchange="loadCities()" required>
                        <option value="" disabled selected>Select State</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Goa">Goa</option>
                        <!-- Add more states as needed -->
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="city">City:</label>
                    <select id="city" name="city" required>
                        <option value="" disabled selected>Select City</option>
                    </select>
                </div>
                <div>
                    <label>Specializations:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="specializations[]" value="Primary"> Primary</label>
                        <label><input type="checkbox" name="specializations[]" value="Secondary"> Secondary</label>
                        <label><input type="checkbox" name="specializations[]" value="Senior_Secondary"> Senior Secondary</label>
                        <label><input type="checkbox" name="specializations[]" value="Undergraduation - Science"> Undergraduation - Science</label>
                        <label><input type="checkbox" name="specializations[]" value="Undergraduation - Commerce"> Undergraduation - Commerce</label>
                        <label><input type="checkbox" name="specializations[]" value="Undergraduation - Arts">Undergraduation - Arts</label>
                    </div>
                </div>
            </div>
            <div style="text-align:center">
                <input type="submit" value="Register">
            </div>
        </form>
        <div style="text-align: center; margin-top: 20px;">
    <a href="community-login.php" style="display: inline-block; padding: 10px 20px; margin: 0 10px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-size: 16px;">Back</a>
    
    <a href="community-login.php" style="display: inline-block; padding: 10px 20px; margin: 0 10px; background-color: #28a745; color: #ffffff; text-decoration: none; border-radius: 5px; font-size: 16px;">Login</a>
</div>

    </div>
</body>
</html>
