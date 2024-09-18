<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style5_1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Register as a Volunteer</title>
    <style>
        .form-group label{
            font-size:30px;
            margin-right:50px;
            
        }
        </style>
    <script>
        var check = function () {
            if (document.getElementById('password').value ==
                document.getElementById('cpassword').value) {
                document.getElementById('message').style.color = '#5dd05d';
                document.getElementById('message').innerHTML = 'Matched';
            } else {
                document.getElementById('message').style.color = '#f55252';
                document.getElementById('message').innerHTML = 'Not Matching';
            }
        }

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 32);
        };
        function redirectToVolunteerLogin() {
            window.location.replace("index.php");     
            return false;       
        }
        function redirectToCommunityLogin() {
            window.location.replace("community-login.php");
            return false;
        }
        function redirectToAdminLogin() {
            window.location.replace("admin-login.php");
            return false;
        }
        window.onload = function () {
            var formSubmitted = localStorage.getItem('formSubmitted');
            if (formSubmitted === 'true') {
                var formId = localStorage.getItem('lastSubmittedForm');
                if (formId) {
                    showForm(formId);
                }
            } else {
                showForm('loginVolunteer'); // Show the volunteer registration form by default
            }
        };

        function submitForm(formId) {
            localStorage.setItem('formSubmitted', 'true');
            localStorage.setItem('lastSubmittedForm', formId);
            return true;
        }
    </script>

</head>

<body>
    <div class="wrapper">
        <nav class="nav" style="position:absolute;">
            <div class="nav-logo" >
            <a href="index.php"><img src="img\logo-no-background.png" alt="" style="width:100px;">
                    <span style="width:300px;font-size:30px;">Shiksha Shastra</span>
            </div>
            <div class="nav-menu" id="navMenu">
           <ul>
                <li><a href="index.php" class="mobile-only">Volunteer</a></li>
                <li><a href="community-login.php" class="mobile-only">Community</a></li>
                <li><a href="admin-login.php" class="mobile-only">Admin</a></li>
            </ul>
            </div>

            
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>

        <div class="form-box">

            <div class="register-container" id="loginVolunteer">
                <div class="top">
                    <header>Register as a Volunteer</header>
                </div>
                <form action="function2.php" method="POST" onsubmit="return validateForm()">
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="form-control" style="width:400px;" placeholder="First Name *" name="fname"
                                onkeydown="return alphaOnly(event);" />
                            <i class="bx bx-user"></i><br><br>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" style="width:400px;" placeholder="Lastname *" name="lname"
                                onkeydown="return alphaOnly(event);" />
                            <i class="bx bx-user"></i><br><br>
                        </div>
                    </div>
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="email" class="form-control" style="width:400px;" placeholder="Your Email *" name="email" />
                            <i class="bx bx-envelope"></i><br><br>
                        </div>
                        <div class="input-box">
                            <input type="tel" minlength="10" style="width:400px;" maxlength="10" name="contact" class="form-control"
                                placeholder="Your Phone *" />
                            <i class='bx bx-dots-horizontal-rounded'></i><br><br>
                        </div>
                    </div>
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="password" class="form-control" style="width:400px;" placeholder="Password *" id="password"
                                name="password" onkeyup='check();' />
                            <i class="bx bx-lock-alt"></i><br><br>
                        </div>
                        <div class="input-box">
                            <input type="password" class="form-control" style="width:400px;" id="cpassword" placeholder="Confirm Password *"
                                name="cpassword" onkeyup='check();' /><span id='message'></span>
                            <i class="bx bx-lock-alt"></i><br><br>
                        </div>
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <label class="radio inline">
                                <input type="radio" name="gender" value="Male" checked>
                                <span> Male </span>
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="gender" value="Female">
                                <span>Female </span>
                            </label>
                            
                        </div>
                        
                    </div>
                    
                    <br>
                    <div class="input-box">
                        <input type="submit" class="btnRegister" name="patsub1"
                            onclick="return checklen() && validateForm();" value="Register" />
                    </div><br>

                </form>
                
                <div class="input-box">
                    <button class="btnlogin" onclick="window.location.href='vlogin.php';">Login as
                        Volunteer</button>
                </div>
            </div>
            <a href="joinus.php" style="display: inline-block; background-color: #4CAF50; color: white; padding: 15px 25px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 10px;margin-top:100px;margin-left:330px;">Back To Home</a>

            <!-- Community -->
            <div class="register-container" id="loginCommunity">
                <div class="top">
                    <header>Login as Community</header>
                </div>
                <form action="function1.php" method="POST" onsubmit="return validateCommunityForm();">
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="User Name *" name="username3" />
                            <i class="bx bx-user"></i><br><br>
                        </div>
                        <div class="input-box">
                            <input type="password" class="form-control" placeholder="Password *" name="password3" />
                            <i class="bx bx-lock-alt"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="btnRegister" name="docsub1" value="Login" />
                    </div>
                </form>
            </div>

            <!-- Admin -->
            <div class="register-container" id="loginAdmin">
                <div class="top">
                    <header>Login as Admin</header>
                </div>
                <form action="function3.php" method="POST" onsubmit="return validateAdminForm();">
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="User Name *" name="username1" />
                            <i class="bx bx-user"></i><br><br>
                        </div>
                        <div class="input-box">
                            <input type="password" class="form-control" placeholder="Password *" name="password2" />
                            <i class="bx bx-lock-alt"></i><br><br>
                        </div>
                    </div>
                    <div>
                        <input type="submit" class="btnRegister" name="adsub" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");

            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }

        function showForm(formId) {
            var forms = document.getElementsByClassName("register-container");
            for (var i = 0; i < forms.length; i++) {
                forms[i].style.display = "none";
            }

            var form = document.getElementById(formId);
            form.style.display = "block";
        }

        function validateForm() {
            // Get the values from the form
            var firstName = document.getElementsByName("fname")[0].value;
            var lastName = document.getElementsByName("lname")[0].value;
            var email = document.getElementsByName("email")[0].value;
            var contact = document.getElementsByName("contact")[0].value;

            // Check if all fields are filled
            if (firstName === "" || lastName === "" || email === "" || contact === "") {
                alert("Please fill in all fields.");
                return false;
            }

            // Check if the email field is not empty and has a valid email format
            if (email !== "") {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert("Please enter a valid email address.");
                    return false;
                }
            }

            // Check if the contact field is not empty and has a length of 10 digits
            if (contact !== "") {
                var contactRegex = /^\d{10}$/;
                if (!contactRegex.test(contact)) {
                    alert("Please enter a 10-digit contact number.");
                    return false;
                }
            }

            function checklen() {
                var pass1 = document.getElementById("password");
                if (pass1.value.length < 6) {
                    alert("Password must be at least 6 characters long. Try again!");
                    return false;
                }
            }

            return true; // Form is valid and can be submitted
        }

        function validateCommunityForm() {
            var username = document.getElementsByName("username3")[0].value;
            var password = document.getElementsByName("password3")[0].value;

            if (username === "" || password === "") {
                alert("Please fill in all fields.");
                return false;
            }

            return true;
        }

        function validateAdminForm() {
            var username = document.getElementsByName("username1")[0].value;
            var password = document.getElementsByName("password2")[0].value;

            if (username === "" || password === "") {
                alert("Please fill in all fields.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>