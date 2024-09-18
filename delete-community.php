<?php
include ('connect.php');

// Check if the community number (cn) is set in the URL
if (isset($_GET['cn'])) {
    // Sanitize the input to prevent SQL injection
    $community_no = intval($_GET['cn']);

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM community WHERE community_no = $community_no";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If successful, display a popup and then redirect
        echo "
    <div id='popup' class='popup'>
        <div class='popup-content'>
            <div class='popup-header'>
                <span class='close'>&times;</span>
                <h2>Success</h2>
            </div>
            <div class='popup-body'>
                <p>Community deleted successfully</p>
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

        // Close the popup when the 'x' or OK button is clicked
        function closePopup() {
            popupContent.classList.remove('bounce-in');
            popupContent.classList.add('fade-out');
            setTimeout(function() {
                popup.style.display = 'none';
                window.location.href = 'admin-panel.php#list-settings1';
            }, 800);
        }

        document.querySelector('.close').onclick = closePopup;
        popupOk.onclick = closePopup;

        // Auto-close the popup after 3 seconds
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
        // If there's an error, display it
        echo "Error deleting record: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    echo "Invalid request.";
}
?>
