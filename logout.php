<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Logout</title>
    <style>
      body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url("img/bg_image.jpg");

      }

      h3 {
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
        font-size:50px;
      }

      .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: orange;
        color: black;
        text-decoration: none;
        border-radius: 4px;
        border: 2px solid #ccc;
        transition: color 0.5s;
      }

      .btn:hover {
        background-color: white;
      }
    </style>
  </head>
  <body>
    <h3>You have logged out.</h3><br><br>
    <a href="index.php" class="btn btn-outline-light">Back to Home Page</a>
  </body>
</html>