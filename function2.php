<?php
include ('connect.php');
?>
<?php
session_start();
// $con = mysqli_connect("localhost", "root", "", "checkss");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['patsub1'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $errors = array();

    if (empty($fname) || empty($lname) || empty($gender) || empty($email) || empty($contact) || empty($password) || empty($cpassword)) {
        $errors[] = "All fields are required";
    }

    if ($password !== $cpassword) {
        $errors[] = "Passwords do not match";
    }

    // Check if the volunteer with the same email or contact already exists
    $checkQuery = "SELECT * FROM volunteer WHERE email='$email' OR contact='$contact'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $errors[] = "A Volunteer with the same email or contact already exists";
    }

    if (count($errors) === 0) {
        $query = "INSERT INTO volunteer (fname, lname, gender, email, contact, password, cpassword) VALUES ('$fname', '$lname', '$gender', '$email', '$contact', '$password', '$cpassword');";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['username'] = $fname . " " . $lname;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['gender'] = $gender;
            $_SESSION['contact'] = $contact;
            $_SESSION['email'] = $email;

            $query1 = "SELECT pid FROM volunteer WHERE fname='$fname' AND lname='$lname';";
            $result1 = mysqli_query($con, $query1);

            if ($result1 && mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $_SESSION['pid'] = $row['pid'];
            }

            // header("Location: volunteer-login");
            echo" <script>alert('Volunteer registred successfully');window.location.href = 'volunteer-login.php';</script>";
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
    } else {
        $_SESSION['validation_errors'] = $errors;
        header("Location: error1.php");
        exit();
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Succesfully</title>
</head>
<body>
    
</body>
</html>