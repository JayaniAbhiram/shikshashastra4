<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Volunteer Login</title>
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="style5_1.css">
  <link rel="stylesheet" type="text/css" href="style5_1.css">
  <script>
    function myMenuFunction() {
      var i = document.getElementById("navMenu");

      if (i.className === "nav-menu") {
        i.className += " responsive";
      } else {
        i.className = "nav-menu";
      }
    }
    function redirectToVolunteerLogin() {
      window.location.replace("index.php");
    }
    function redirectToCommunityLogin() {
      window.location.replace("community-login.php");
    }
    function redirectToAdminLogin() {
      window.location.replace("admin-login.php");
    }

    function showForm(formId) {
      var forms = document.getElementsByClassName("register-container");
      for (var i = 0; i < forms.length; i++) { forms[i].style.display = "none"; } var form = document.getElementById(formId);
      form.style.display = "block";
    } </script>
</head>

<body>

  <div class="wrapper">
    <nav class="nav">
      <div class="nav-logo">
        <a href="index.php"><img src="#" alt="">
          <span>Shiksha Shastra</span>
      </div>
      <div class="nav-menu" id="navMenu">
        <ul>
          <li><a href="volunteer-login.php" class="mobile-only">Volunteer</a></li>
          <li><a href="community-login.php" class="mobile-only">Community</a></li>
          <li><a href="admin-login.php" class="mobile-only">Admin</a></li>
        </ul>
      </div>
      <!-- <div class="nav-button">
        <button class="btn white-btn" id="registerBtn" onclick="redirectToVolunteerLogin()">Volunteer</button>
        <button class="btn white-btn" id="registerBtn" onclick="redirectToCommunityLogin()">Community</button>
        <button class="btn white-btn" id="registerBtn" onclick="redirectToAdminLogin()">Admin</button>
      </div> -->
      <div class="nav-menu-btn">
        <i class="bx bx-menu" onclick="myMenuFunction()"></i>
      </div>
    </nav>
    <div class="form-box">
      <div class="register-container" id="loginVolunteer">
        <div class="top">
          <header>Volunteer Login</header>
        </div>
        <form method="POST" action="function.php">
          <div class="two-forms">
            <div class="input-box">
              <input type="text" name="email" class="form-control" placeholder="Enter email ID" />
            </div><br>
            <div class="input-box">
              <input type="password" class="form-control" name="password2" placeholder="Enter password" />
            </div>
          </div><br><br>
          <div class="input-box">
            <input type="submit" id="inputbtn" name="patsub" value="Login" class="btnRegister">
          </div><br>
            <!-- <button type="button"><a href="index.php">Back</a></button> -->
            <button type="button" style="background-color: #f0f0f0; color: #333; border-radius:30px;margin-left:200px;margin-top:20px;border: 2px solid #333; padding: 10px 20px; font-family: Arial, sans-serif; font-size: 16px; cursor: pointer; text-decoration: none;">
    <a href="volunteer-login.php" style="text-decoration: none; color: inherit;">Back</a>
</button>

          </div>
        </form>

      </div>
    </div>


  </div>

</body>

</html>