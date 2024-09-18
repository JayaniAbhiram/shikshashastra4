<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
      .footer-section {
  background: #151414;
  position: relative;
}
.footer-cta {
  border-bottom: 1px solid #373636;
  padding-bottom: 8px !important;
}
.single-cta i {
  color: #ff5e14;
  font-size: 30px;
  float: left;
  margin-top: 8px;
}
.cta-text {
  padding-left: 15px;
  display: inline-block;
}
.cta-text h4 {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 2px;
}
.cta-text span {
  color: #757575;
  font-size: 15px;
}
.footer-content {
  position: relative;
  z-index: 2;
}
.footer-pattern img {
  position: absolute;
  top: 0;
  left: 0;
  height: 330px;
  background-size: cover;
  background-position: 100% 100%;
}
.footer-logo img {
  max-width: 150px;
  max-height:30px;
  margin-left:130px;
  margin-bottom:20px;
}
.footer-text p {
  margin-bottom: 14px;
  font-size: 14px;
  color: #7e7e7e;
  line-height: 21px;
}
.footer-social-icon span {
  color: #fff;
  display: block;
  font-size: 20px;
  font-weight: 700;
  font-family: "Poppins", sans-serif;
  margin-bottom: 20px;
}
.footer-social-icon a {
  color: #fff;
  font-size: 16px;
  margin-right: 15px;
}
.footer-social-icon i {
  height: 40px;
  width: 40px;
  text-align: center;
  line-height: 38px;
  border-radius: 50%;
}
.facebook-bg {
  background: #3b5998;
}
.twitter-bg {
  background: #55acee;
}
.google-bg {
  background: #dd4b39;
}
.footer-widget-heading h3 {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 40px;
  position: relative;
}
.footer-widget-heading h3::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -15px;
  height: 2px;
  width: 50px;
  background: #ff5e14;
}
.footer-widget ul li {
  display: inline-block;
  float: left;
  width: 50%;
  margin-bottom: 12px;
}
.footer-widget ul li a:hover {
  color: #ff5e14;
}
.footer-widget ul li a {
  color: #878787;
  text-transform: capitalize;
}
.subscribe-form {
  position: relative;
  overflow: hidden;
}
.subscribe-form input {
  width: 100%;
  padding: 14px 28px;
  background: #2e2e2e;
  border: 1px solid #2e2e2e;
  color: #fff;
}
.subscribe-form button {
  position: absolute;
  right: 0;
  background: #ff5e14;
  padding: 13px 20px;
  border: 1px solid #ff5e14;
  top: 0;
}
.subscribe-form button i {
  color: #fff;
  font-size: 22px;
  transform: rotate(-6deg);
}
.copyright-area {
  background: #202020;
  padding: 25px 0;
}
.copyright-text p {
  margin: 0;
  font-size: 14px;
  color: #878787;
}
.copyright-text p a {
  color: #ff5e14;
}
.footer-menu li {
  display: inline-block;
  margin-left: 20px;
}
.footer-menu li:hover a {
  color: #ff5e14;
}
.footer-menu li a {
  font-size: 14px;
  color: #878787;
}
.footer-cta .row .col-xl-4:nth-child(1) .single-cta i {
  position: absolute;
  color: #ff5e14;
}
.footer-cta .row .col-xl-4:nth-child(1) .single-cta .cta-text {
  padding-left: 32px;
}
.footer-cta .row .col-xl-4:nth-child(2) .single-cta i {
  color: #14ffa7;
}
.footer-cta .row .col-xl-4:nth-child(3) .single-cta i {
  color: #ffd700;
}
.footer-social-icon .social_icon {
  text-align: left;
}
.footer-social-icon .social_icon li {
  float: inherit !important;
  display: inline-block !important;
  width: inherit;
}
.footer-social-icon .social_icon li a i {
  font-size: 15px;
  line-height: 39px;
}
.footer-social-icon .social_icon li a {
  width: 40px;
  height: 40px;
}

.social_icon {
  text-align: right;
  margin: 0;
  margin-top: 3px;
}
.social_icon li {
  display: inline-block;
  margin: 0 5px;
}
.social_icon li a {
  display: inline-block;
  width: 25px;
  height: 25px;
  background: #fff;
  color: #000;
  text-align: center;
  border-radius: 100%;
  transition: 0.2s ease-in-out;
}
.social_icon li a i {
  font-size: 15px;
  line-height: 20px;
}
.social_icon li:nth-child(1) a {
  background: #4267b2;
  color: #fff;
}
.social_icon li:nth-child(2) a {
  background: #1da1f2;
  color: #fff;
}
.social_icon li:nth-child(3) a {
  background: #f09433;
  background: -moz-linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  background: -webkit-linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  background: linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
  color: #fff;
}
.social_icon li:nth-child(4) a {
  background: #ff0000;
  color: #fff;
}
.social_icon li:nth-child(1):hover a {
  background: #fff;
  color: #4267b2;
}
.social_icon li:nth-child(2):hover a {
  background: #fff;
  color: #1da1f2;
}
.social_icon li:nth-child(3):hover a {
  background: #fff;
  color: #bc1888;
}
.social_icon li:nth-child(4):hover a {
  background: #fff;
  color: #ff0000;
}

        



        </style>
</head>
<body>
<footer class="footer-section">
          <div class="container">
              <div class="footer-cta pt-5 ">
                  <div class="row">
                      <div class="col-xl-4 col-md-4 mb-30">
                          <div class="single-cta">
                              <i class="fas fa-map-marker-alt"></i>
                              <div class="cta-text">
                                  <h4>Find us</h4>
                                  <span>Jk Lakshmipat University, Mahapura, Jaipur, Rajasthan </span>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-4 col-md-4 mb-30">
                          <div class="single-cta">
                              <i class="fas fa-phone"></i>
                              <div class="cta-text">
                                  <h4>Call us</h4>
                                  <span>+91 8520997742</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-4 col-md-4 mb-30">
                          <div class="single-cta">
                              <i class="far fa-envelope-open"></i>
                              <div class="cta-text">
                                  <h4>Mail us</h4>
                                  <span>abhiram@gmail.com</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="footer-content pt-5 pb-1">
                  <div class="row">
                      <div class="col-xl-4 col-lg-4 mb-50">
                          <div class="footer-widget">
                              <div class="footer-logo">
                                  <a href="index.html"><img src="img\logo-no-background.png" class="img-fluid" alt="logo"></a>
                              </div>
                              <div class="footer-text">
                                  <p>At the heart of Shiksha Shastra, is a mission to empower individuals and communities through education. We strive to create a world where the right to learn is universal, transcending socio-economic boundaries. </p>
                              </div>
                              <div class="footer-social-icon">
                                  <span>Follow us</span>
                                  <ul class="social_icon">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-github"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                          <div class="footer-widget">
                              <div class="footer-widget-heading">
                                  <h3>Useful Links</h3>
                              </div>
                              <ul>
                                  <li><a href="#">Home</a></li>
                                  <li><a href="#">About Us</a></li>
                                  <li><a href="#">Our Gallery</a></li>
                                  <li><a href="#">Contact Us</a></li>
                                  <li><a href="#">Join Us</a></li>
                                  <li><a href="#">Time line</a></li>
                                  <!-- <li><a href="#">Our Policies</a></li>
                                  <li><a href="#">Our Team</a></li>
                                  <li><a href="#">Contact us</a></li> -->
                              </ul>
                          </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                          <div class="footer-widget">
                              <div class="footer-widget-heading">
                                  <h3>Subscribe</h3>
                              </div>
                              <div class="footer-text mb-25">
                                  <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                              </div>
                              <div class="subscribe-form">
                                  <form action="#">
                                      <input type="text" placeholder="Email Address">
                                      <button><i class="fab fa-telegram-plane"></i></button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="copyright-area">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                          <div class="copyright-text">
                              <p>Copyright &copy; 2023, All Right Reserved <a href="#">Jayani Abhiram & Poorna Bhati</a></p>
                          </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                          <div class="footer-menu">
                              <ul>
                                  <li><a href="#">Home</a></li>
                                  <li><a href="#">Terms</a></li>
                                  <li><a href="#">Privacy</a></li>
                                  <li><a href="#">Policy</a></li>
                                  <li><a href="#">Contact</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </footer>
    
</body>
</html>