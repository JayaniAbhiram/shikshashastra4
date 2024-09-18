
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Volunteer Documents</title>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #e0e0e0;">
        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 90%; max-width: 600px;">
            <h1 style="text-align: center; color: #333;">Upload Volunteer Documents</h1>
            <form action="volunteerdocuments.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
                <label for="name" style="font-weight: bold; color: #555;">Name:</label>
                <input type="text" name="name" id="name" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

                <label for="gmail" style="font-weight: bold; color: #555;">Gmail:</label>
                <input type="email" name="gmail" id="gmail" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

                <label for="file1" style="font-weight: bold; color: #555;">Choose File 1 (Aadhar Card):</label>
                <input type="file" name="file1" id="file1" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

                <label for="file2" style="font-weight: bold; color: #555;">Choose File 2 (12th Mark Sheet):</label>
                <input type="file" name="file2" id="file2" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

                <label for="file3" style="font-weight: bold; color: #555;">Choose File 3 (Graduation Certificate):</label>
                <input type="file" name="file3" id="file3" required style="border: 1px solid #ddd; border-radius: 4px; padding: 8px;">

                <button type="submit" name="upload" style="background-color: #28a745; color: #fff; border: none; border-radius: 4px; padding: 10px 20px; cursor: pointer; font-size: 16px; transition: background-color 0.3s;">
                    Upload Files
                </button>
            </form>
            <?php
            if (isset($_POST['upload'])) {
                $name = $_POST['name'];
                $gmail = $_POST['gmail'];

                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "checkss";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if name or gmail already exists
                $checkQuery = "SELECT id FROM volunteer_documents WHERE name = ? OR gmail = ?";
                $stmtCheck = $conn->prepare($checkQuery);
                $stmtCheck->bind_param("ss", $name, $gmail);
                $stmtCheck->execute();
                $stmtCheck->store_result();

                if ($stmtCheck->num_rows > 0) {
                    echo "<script>showAlert('Documents already uploaded with this name or Gmail.');</script>";
                } else {
                    // Directory for uploads
                    $uploadDir = 'uploads/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // File paths
                    $file1Path = $file2Path = $file3Path = '';

                    // File 1 upload
                    if (isset($_FILES['file1'])) {
                        $file1Path = $uploadDir . basename($_FILES['file1']['name']);
                        move_uploaded_file($_FILES['file1']['tmp_name'], $file1Path);
                    }

                    // File 2 upload
                    if (isset($_FILES['file2'])) {
                        $file2Path = $uploadDir . basename($_FILES['file2']['name']);
                        move_uploaded_file($_FILES['file2']['tmp_name'], $file2Path);
                    }

                    // File 3 upload
                    if (isset($_FILES['file3'])) {
                        $file3Path = $uploadDir . basename($_FILES['file3']['name']);
                        move_uploaded_file($_FILES['file3']['tmp_name'], $file3Path);
                    }

                    // Insert into database
                    $insertQuery = "INSERT INTO volunteer_documents (name, gmail, file1_path, file2_path, file3_path) VALUES (?, ?, ?, ?, ?)";
                    $stmtInsert = $conn->prepare($insertQuery);
                    $stmtInsert->bind_param("sssss", $name, $gmail, $file1Path, $file2Path, $file3Path);

                    // Execute and check success
                    if ($stmtInsert->execute()) {
                        echo "<script>showAlert('Documents successfully submitted and inserted into the database.');</script>";
                    } else {
                        echo "<p style='color: #dc3545; text-align: center;'>Error: " . $stmtInsert->error . "</p>";
                    }

                    $stmtInsert->close();
                }

                // Close connections
                $stmtCheck->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
