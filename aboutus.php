<?php
include("navbar.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About us</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://md-aqil.github.io/images/swiper.min.css">
  <style>
    

.text-blk {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  line-height: 25px;
}

.responsive-container-block {
  min-height: 75px;
  height: fit-content;
  width: 100%;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
  display: flex;
  flex-wrap: wrap;
  margin-top: 0px;
  margin-right: auto;
  margin-bottom: 0px;
  margin-left: auto;
  justify-content: flex-start;
}

.responsive-container-block.bigContainer {
  padding-top: 10px;
  padding-right: 30px;
  padding-bottom: 10px;
  padding-left: 30px;
  /* background-image: url("https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/bb29.png"); */
  /* background-image:url("img/bg_image.jpg"); */
  background-position-x: initial;
  background-position-y: initial;
  background-size: cover;
  background-attachment: initial;
  background-origin: initial;
  background-clip: initial;
  background-color: initial;
  background-repeat-x: no-repeat;
  background-repeat-y: no-repeat;
}

.responsive-container-block.Container {
  max-width: 800px;
  flex-direction: column;
  align-items: center;
  padding-top: 20px;
  padding-right: 20px;
  padding-bottom: 20px;
  padding-left: 20px;
  margin-top: 150px;
  margin-right: auto;
  margin-bottom: 50px;
  margin-left: auto;
  background-color: white;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
}

.text-blk.heading {
  font-size: 36px;
  line-height: 45px;
  font-weight: 800;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 30px;
  margin-left: 0px;
}

.text-blk.subHeading {
  text-align: center;
  font-size: 18px;
  line-height: 26px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 60px;
  margin-left: 0px;
  font-family: 'Times New Roman', Times, serif;
}

.socialIcon {
  width: 33px;
  height: 33px;
}

.social-icons-container {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}

.social-icon {
  margin: 0 50px 0 50px;
}

.social-icon:hover {
  cursor: pointer;
}

@media (max-width: 768px) {
  .text-blk.heading {
    font-size: 55px;
    line-height: 65px;
  }

  .text-blk.subHeading {
    font-size: 18px;
    line-height: 24px;
    font-family: 'Times New Roman', Times, serif;
  }

  .socialIcon {
    width: 20px;
    height: 20px;
  }

  .text-blk.subHeading {
    line-height: 27px;
  }

  .text-blk.heading {
    font-size: 32px;
    line-height: 40px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 20px;
    margin-left: 0px;
  }

  .social-icon {
    margin: 0 25px 0 25px;
  }
}

@media (max-width: 500px) {
  .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
  }

  .text-blk.heading {
    font-size: 45px;
    line-height: 55px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 20px;
    margin-left: 0px;
  }

  .text-blk.subHeading {
    font-size: 14px;
    line-height: 22px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 30px;
    margin-left: 0px;
  }

  .social-icons-container {
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
  }

  .text-blk.subHeading {
    font-size: 16px;
    line-height: 23px;
  }

  .text-blk.heading {
    font-size: 26px;
    line-height: 30px;
  }

  .social-icon {
    margin: 0 20px 0 20px;
  }
}


  /* ============================================cofounders */

  .spacer {
			margin: 0;
			padding: 0;
			font-family: 'Lato', sans-serif;
      margin-bottom:100px;
      margin-top:50px;

		}
		:root {
			--dark-green: #9cc675;
      --dark-yellow: #e89a3d;
      --extra-light-brown:#fdf0d7;
      --light-brown: #ecd5ab;
      --dark-brown:#915b40;
      --light-yellow:#f8e3a8;
      --light-red:#f3ac99;
      --light-teal:#a6c8cc;
      --light-gray:#ddd5d6;
			--theme-color2: ;
		}


 .site-logo {
	 width: 218.33px !important;
	 margin-right: 50px;
}
 .btn {
	 border-radius: 5px;
	 font-weight: normal;
	 font-size: 15px;
	 letter-spacing: 0.02em;
	 line-height: 12px;
	 text-align: center;
	 font-weight: 600;
	 font-size: 14px;
	 padding: 14px 30px;
	 cursor: pointer;
}
 .btn-theme {
	 background: var(--theme-color1);
	 color: #212121;
   /* color:red; */

}

.c-container {
    margin: auto;
    width: 93%;
    position: relative;
    z-index: 1;
}

.btn-outline-white {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
    /* background-color:white; */
    background-image: none;
    border-width: 2px;
    border-color: #fff;
    font-weight: 500;
    -webkit-transition: all .2s;
    transition: all .2s;
}
.btn {
    border-radius: 5px;
    font-weight: normal;
    font-size: 15px;
    letter-spacing: 0.02em;
    line-height: 12px;
    text-align: center;
    font-weight: 600;
    font-size: 14px;
    padding: 14px 30px;
    cursor: pointer;
}
.btn-outline-white:hover {
    background-color: #fff;
    color: var(--text-dark);
}
/* common css up */

.testimonial p {
	 font-size: 28px;
	 letter-spacing: 0.02em;
	 line-height: 35px;
}
 .testimonial .name {
	 font-weight: bold;
	 font-size: 18px;
	 letter-spacing: 0.04em;
	 line-height: 35px;
	 text-align: left;
}
 .testimonial .designation {
	 font-size: 14px;
	 letter-spacing: 0.04em;
	 text-align: left;
	 color: #fff;
	 opacity: 0.65;
}
 .unt {
	 margin-bottom: 20px;
	 margin-top: 60px;
}
 .hero-text {
	 font-size: 30px;
	 letter-spacing: 0.02em;
	 color: #fff;
  

}
 .gallery-thumbs {
	 height: 100%;
}
 .gallery-thumbs .swiper-wrapper {
	 align-items: center;
}
 .gallery-thumbs .swiper-slide {
	 background-position: center;
	 background-size: cover;
	 width: 250px !important;
	 height: 330px;
	 position: relative;
}
 .gallery-thumbs .swiper-slide img {
	 filter: contrast(0.5) blur(1px);
	 width: 100%;
	 height: 100%;
	 object-fit: cover;
	 border-radius: 10px;
}
 .gallery-thumbs .swiper-slide-active img {
	 filter: contrast(1) blur(0px) !important;
}
 .flex-row {
	 display: -webkit-box;
	 display: -ms-flexbox;
	 display: flex;
	 -ms-flex-wrap: wrap;
	 flex-wrap: wrap;
	 margin-right: -15px;
	 margin-left: -15px;
}
 .flex-row .flex-col {
	 -ms-flex-preferred-size: 0;
	 flex-basis: 0;
	 -webkit-box-flex: 1;
	 -ms-flex-positive: 1;
	 flex-grow: 1;
	 max-width: 100%;
	 position: relative;
	 width: 100%;
	 min-height: 1px;
	 padding-right: 15px;
	 padding-left: 15px;
}

.gallery-thumbs .swiper-wrapper {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}


.testimonial-section .quote {
    width: 75%;
    height: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding-left: 100px;
    padding-right: 100px;
}
.swiper-container.testimonial {
    height: 350px;
}
.testimonial-section .user-saying {
    background: var(--theme-color2);
    width: 60%;
    color: #fff;
    height: 100%;
}
.testi-user-img {
    width: 40%;
}
.testimonial-section {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    width: 100%;
    height: 100%;
}
.testimonial-section .quote p {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.8;
    font-style: italic;
    margin: 0;
}
.quote-icon {
    width: 38px;
    display: block;
    margin-bottom: 30px;
}
 

    </style>
</head>
<body style="background-image: url(img/bg_image.jpg);">
<div class="responsive-container-block bigContainer">
  <div class="responsive-container-block Container">
    <p class="text-blk heading">
      About Us
    </p>
    <p class="text-blk subHeading" >
    At Shiksha Shastra, we believe in the transformative power of education and its ability to break the cycle of poverty. Established in 2024, our journey began with a simple yet powerful idea: connecting passionate volunteers with underprivileged communities to create a sustainable impact through knowledge-sharing.
    Inspired by a shared commitment to make education accessible to all, Poorna Bhati and Jayani Abhiram envisioned a platform that would serve as a bridge between those eager to teach and those eager to learn. Fueled by the belief that education is the cornerstone of empowerment, they embarked on a mission to create positive change in communities that often lack resources.
</p>
    <div class="social-icons-container">
      <a class="social-icon">
        <img class="socialIcon image-block" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/bb33.png">
      </a>
      <a class="social-icon">
        <img class="socialIcon image-block" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/bb34.png">
      </a>
      <a class="social-icon">
        <img class="socialIcon image-block" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/bb35.png">
      </a>
      <a class="social-icon">
        <img class="socialIcon image-block" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/bb36.png">
      </a>
    </div>
  </div>
</div>





		
<section class="spacer">
			
				<div class="testimonial-section">
					<div class="testi-user-img">
					<div class="swiper-container gallery-thumbs">
						  <div class="swiper-wrapper">
								  <div class="swiper-slide">
										<img class="u3" src="img\founders\IMG20230628173510.jpg" alt="">
									</div>
						  <div class="swiper-slide">
							  <img class="u1" src="img/founders/My pic full.jpg" alt="">
						  </div>
						  <div class="swiper-slide">
						  <img class="u2" src="img/founders/Gounrang.jpg" alt="">
						  </div>
					  
						  
						  
						  </div>
					  </div>
					</div>
					<div class="user-saying">
						  <div class="swiper-container testimonial">
								  <!-- Additional required wrapper -->
								  <div class="swiper-wrapper ">
									  <!-- Slides -->
									  <div class="swiper-slide">
										  <div class="quote">
												  <img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">
											  <p>
                        I founded this platform with a simple yet powerful vision — to make education barrier-free for all. Inspired by the belief that knowledge should know no limits, we've created a space that empowers learners, connects enthusiasts, and fosters positive change.

											  </p>
											  <div class="name">-Poorna Bhati-</div>
											  <div class="designation"> Cofounder</div>
											  
										  </div>
									  </div>
									  <div class="swiper-slide">
										  <div class="quote">
												<img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">
											
											  <p>
                        I established this platform with a clear mission: to democratize education for all. Our space empowers learners, connects enthusiasts, and drives positive change. Join us in reshaping education for a world where learning knows no boundaries.
											  </p>
											  <div class="name">-Jayani Abhiram-</div>
											  <div class="designation">Cofounder</div>
											  
										  </div>
									  </div>
									  <div class="swiper-slide">
										  <div class="quote">
												<img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">
												  
											  <p>
													  “This is best and biggest unified platform
											  for instant online admission. We can easily
											  take admission for any course in any institute..“
											  </p>
											  <div class="name">-Gaurang gupta-</div>
											  <div class="designation"> Cofounder</div>
											  
										  </div>
									  </div>
									  
									  
								  </div>
								  <!-- If we need pagination -->
								  <div class="swiper-pagination swiper-pagination-white"></div>
							  
							  </div>
					</div>
				</div>
			</section>
	<script src="https://md-aqil.github.io/images/swiper.min.js"></script>




<h1 style="text-align:center;">To Know More About Us<h1>

<a href="timeline.php" style="background-color: #4CAF50; /* Green */
                       border: none;
                       color: white;
                       padding: 15px 32px;
                       text-align: center;
                       text-decoration: none;
                       display: inline-block;
                       font-size: 16px;
                       margin: 4px 2px;
                       cursor: pointer;
                       border-radius: 8px;
                       margin-left:45%;">Click here</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  var nbOptions = 5; // number of menus
  var angleStart = -360; // start angle

  // jquery rotate animation
  function rotate(li,d) {
    $({d:angleStart}).animate({d:d}, {
      step: function(now) {
        $(li)
          .css({ transform: 'rotate('+now+'deg)' })
          .find('label')
          .css({ transform: 'rotate('+(-now)+'deg)' });
      }, duration: 0
    });
  }

  // show / hide the options
  function toggleOptions(s) {
    $(s).toggleClass('open');
    var li = $(s).find('li');
    var deg = $(s).hasClass('half') ? 180/(li.length-1) : 360/li.length;
    for(var i=0; i<li.length; i++) {
      var d = $(s).hasClass('half') ? (i*deg)-90 : i*deg;
      $(s).hasClass('open') ? rotate(li[i],d) : rotate(li[i],angleStart);
    }
  }

  $('.selector button').click(function(e) {
    toggleOptions($(this).parent());
  });

  setTimeout(function() { toggleOptions('.selector'); }, 100);


  // =================================================================================================codounders

  var galleryThumbs = new Swiper('.gallery-thumbs', {
	effect: 'coverflow',
	grabCursor: true,
	centeredSlides: true,
	slidesPerView: '2',
	// coverflowEffect: {
	//   rotate: 50,
	//   stretch: 0,
	//   depth: 100,
	//   modifier: 1,
	//   slideShadows : true,
	// },
	
	coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 50,
        modifier: 6,
        slideShadows : false,
	  },
	  
  });
  
  
var galleryTop = new Swiper('.swiper-container.testimonial', {
	speed: 400,
	spaceBetween: 50,
	autoplay: {
	  delay: 3000,
	  disableOnInteraction: false,
	},
	direction: 'vertical',
	pagination: {
	  clickable: true,
	  el: '.swiper-pagination',
	  type: 'bullets',
	},
	thumbs: {
		swiper: galleryThumbs
	  }
  });
  
  
  </script>
  
</body>
</html>