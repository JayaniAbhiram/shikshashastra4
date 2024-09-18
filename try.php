<?php
include("connect.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle update request
if (isset($_POST['update_submit'])) {
    $community = trim($_POST['community']);
    $spec = trim($_POST['spec']);
    $dpassword = trim($_POST['dpassword']);
    $demail = trim($_POST['demail']);
    $state = trim($_POST['state']);
    $city = trim($_POST['city']);

    if (empty($community) || empty($dpassword) || empty($demail) || empty($spec) || empty($state) || empty($city)) {
        echo "<script>alert('All fields are required.');
              window.location.href = 'admin-panel.php';</script>";
        exit();
    }

    $query = "UPDATE community 
              SET password = ?, email = ?, state = ?, city = ? 
              WHERE username = ? AND spec = ?";
    $stmt = mysqli_prepare($con, $query);
    $hashedPassword = password_hash($dpassword, PASSWORD_BCRYPT);
    mysqli_stmt_bind_param($stmt, 'ssssss', $hashedPassword, $demail, $state, $city, $community, $spec);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Community updated successfully.');
              window.location.href = 'admin-panel.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $email = trim($_GET['email']);
    $spec = trim($_GET['spec']);

    $query = "DELETE FROM community WHERE email = ? AND spec = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $spec);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Community deleted successfully.');
              window.location.href = 'admin-panel.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!-- HTML for displaying and managing community records -->
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
          <th scope="col">Community Name</th>
          <th scope="col">Specialization</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">State</th>
          <th scope="col">City</th>
          <th scope="col">Manage Communities</th>
        </tr>
      </thead>
      <tbody>
        <!-- Table rows with dynamic data -->
        <?php
        $query = "SELECT * FROM community";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          echo "
          <tr>
            <td>".$row['username']."</td>
            <td>".$row['spec']."</td>
            <td>".$row['email']."</td>
            <td>".$row['password']."</td>
            <td>".$row['state']."</td>
            <td>".$row['city']."</td>
            <td>
              <a href='#' onclick=\"document.getElementById('updateForm').style.display='block';
                                    document.getElementById('community').value='".$row['username']."';
                                    document.getElementById('spec').value='".$row['spec']."';
                                    document.getElementById('dpassword').value='".$row['password']."';
                                    document.getElementById('demail').value='".$row['email']."';
                                    document.getElementById('state').value='".$row['state']."';
                                    document.getElementById('city').value='".$row['city']."';\">
                <input type='button' value='Update' class='btn btn-primary'>
              </a>
              <a href='?delete=true&email=".$row['email']."&spec=".$row['spec']."'>
                <input type='button' value='Delete' class='btn btn-primary'>
              </a>
            </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Update Form -->
  <div id="updateForm" style="display:none;">
    <form action="" method="post">
      <input type="hidden" id="community" name="community">
      <input type="hidden" id="spec" name="spec">
      
      <label for="dpassword">Password:</label>
      <input type="password" id="dpassword" name="dpassword" required>
      
      <label for="demail">Email:</label>
      <input type="email" id="demail" name="demail" required>
      
      <label for="state">State:</label>
      <input type="text" id="state" name="state" required>
      
      <label for="city">City:</label>
      <input type="text" id="city" name="city" required>
      
      <input type="submit" name="update_submit" value="Update" class="btn btn-primary">
      <input type="button" value="Cancel" class="btn btn-secondary" onclick="document.getElementById('updateForm').style.display='none';">
    </form>
  </div>
</div>