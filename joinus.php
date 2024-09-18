<?php
include("navbar.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started</title>
    <style>
          @import url("https://fonts.googleapis.com/css?family=Lato:300,400,700");

          h1{
            font-size:50px;
            text-align:center;
            margin-top: 50px;

          }

.box-wrapper{
/*   margin-left:300px; */
  max-width:1500px;
  margin-top:50px;
}


    
   

    .shape-box {
        display: inline-block;
        position: relative;
        z-index: 1;
/*         max-width: 500px; */
        height: 430px;
/*         margin: 30px 10px 30px; */
        box-shadow: 0 6px 30px 0 rgba(0, 0, 0, .12);
        overflow: hidden;
        width: 23.333%;
      margin-left:250px;
    }

    .shape-box_half {
        overflow: hidden;
        text-align: left;
    }

    .shape-box_half:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transform: skewY(53.5deg);
        transform-origin: top left;
        transition: \transform .4s;
        background: #fff;
        z-index: 1;
    }

    .shape-box>img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .bg-black {
        background-color: #000;
    }

    .shape-box_half figcaption {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 0 30px 30px;
        transition: \transform .4s;
        transform: translateY(100%);
        z-index: 3;
    }

    .shape-box_half figcaption .show-cont {
        position: absolute;
        bottom: calc(100% + 30px);
        left: 30px;
        right: 30px;
        transition: bottom .4s;
    }

    .card-no {
        font-size: 36px;
        color: #ffc107;
        padding: 0;
        margin: 10px 0;
    }

    .card-main-title {
        margin-top: 8px;
        font-weight: 700;
        font-size: 24px;
        text-transform: uppercase;
        color: #292b2c;
    }

    .card-content {
        color: #9f9f9f;
        margin-top: 20px;
        line-height: 22px;
        font-size: 15px;
    }

    .read-more-btn {
        border: 2px solid #db3236;
        font-size: 14px;
        cursor: pointer;
        padding: 10px 20px;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: .08em;
        font-weight: 600;
        position: relative;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        background: #db3236;
        color: #fff;
        border-radius: 2px;
        margin-top: 25px;
        text-decoration: none;
    }

    .read-more-btn:hover {
        background: transparent;
        color: #db3236;

    }

    .shape-box_half>.after {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #fdd744;
        opacity: 0;
        transition: opacity .4s;
    }

    /*On hover*/
    .shape-box_half:hover:before {
        transform: skewY(20deg);
    }

    .shape-box_half:hover figcaption {
        transform: translateY(0);
    }

    .shape-box_half:hover figcaption .show-cont {
        bottom: 100%;
    }

    .shape-box_half:hover>.after {
        opacity: 1;
    }
   
body{
#background-video {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: -1000;
  overflow: hidden;
}
}

        </style>
</head>
<!-- <body style="background-image: url(img/bg_image.jpg);"> -->
<body>
    <video autoplay muted loop id="background-video">
        <source src="https://cdn.pixabay.com/vimeo/221185519/blue-9809.mp4?width=640&hash=2866297f06f4adbfc645094c72661f23bdbd97a2" type="video/mp4">
      </video>

   
    


<!-- <h1>Join As..</h1> -->
<h1>Join As..<a href="admin-login.php">.</a></h1>

<div class="box-wrapper">
        <figure class="shape-box shape-box_half">
            <!-- <img src="https://images.unsplash.com/photo-1534670007418-fbb7f6cf32c3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt=""> -->
            <img src="img\v1.jpg" alt="">
            <div class="brk-abs-overlay z-index-0 bg-black opacity-60"></div>
            <figcaption>
                <div class="show-cont">
                    <h3 class="card-no">01</h3>
                    <h4 class="card-main-title">Volunteer</h4>
                </div>
                <p class="card-content">Transform compassion into action-Join us, lend a helping hand and ignite positive change in the communities.</p>
                <a href="volunteer-login.php" class="read-more-btn">Login</a>
            </figcaption>
            <span class="after"></span>
        </figure>
        <figure class="shape-box shape-box_half">
            <!-- <img src="https://images.unsplash.com/photo-1512295767273-ac109ac3acfa?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80"> -->
            <img src="img\c1.jpg">

            <div class="brk-abs-overlay z-index-0 bg-black opacity-60"></div>
            <figcaption>
                <div class="show-cont">
                    <h3 class="card-no">02</h3>
                    <h4 class="card-main-title">Community</h4>
                </div>
                <p class="card-content">Fuel community spirit, amplify voices- Join Shiksha Shastra, where collaboration thrives, creating a tapestry of collective impact and shared success.</p>
                <a href="community-login.php" class="read-more-btn">Login</a>
            </figcaption>
            <span class="after"></span>
        </figure>
        
        
    </div>
    
</body>
</html>