<?php
include("navbar.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<!-- <div class="title">
  <p>Shiksha Shastra</p>
  
</div>
<div class="title2">
  <p>Teach For Change</p>
  
</div> -->
<div class="bgimage">
<section class="showcase">
  <img src="img\gallery\im1.jpg" alt="Picture">
  <div class="overlay">
    <p><strong>TOGETHER, WE'RE CREATING A WORLD WHERE EDUCATION KNOWS NO BOUNDARIES.</strong></p>
    
  </div>
</section>
</div>



<!-- <div class="imgs">
		<img src="img\classroom-girl-character-rendering_23-2151023105-removebg-preview.png">
	</div>
    <div class="main_logo">
        <img src="img/logo-no-background.png">

    </div> -->
	

	
    <!-- <div class="vision_container">
        <p><strong>TOGETHER, WE'RE CREATING A WORLD WHERE EDUCATION KNOWS NO BOUNDARIES.</strong></p>

    </div> -->


      <!-- ==================================================================================================stats -->
      <div>
    <!-- start count stats -->
    

    <?php
// Database connection
include('connect.php');// your database name

// Create connection
// $con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to get the highest community_no value
$sql_community = "SELECT MAX(community_no) as max_community_no FROM community";
$result_community = $con->query($sql_community);

if ($result_community->num_rows > 0) {
    // Output data of each row
    $row_community = $result_community->fetch_assoc();
    $highest_community_no = $row_community['max_community_no'];
} else {
    $highest_community_no = 0;
}

// Query to get the highest pid value
$sql_volunteer = "SELECT MAX(pid) as max_pid FROM volunteer";
$result_volunteer = $con->query($sql_volunteer);

if ($result_volunteer->num_rows > 0) {
    // Output data of each row
    $row_volunteer = $result_volunteer->fetch_assoc();
    $highest_pid = $row_volunteer['max_pid'];
} else {
    $highest_pid = 0;
}

// Query to get the total number of rows in the community table
$sql_total_communities = "SELECT COUNT(*) as total_communities FROM community";
$result_total_communities = $con->query($sql_total_communities);

if ($result_total_communities->num_rows > 0) {
    // Output data of each row
    $row_total_communities = $result_total_communities->fetch_assoc();
    $total_communities = $row_total_communities['total_communities'];
} else {
    $total_communities = 0;
}

$con->close();
?>



<div class="stats_count">
    <h1><strong>Impact and Outreach</strong></h1>
    <section id="counter-stats" class="wow fadeInRight" data-wow-duration="1.4s">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 stats">
                    <i class="fa fa" aria-hidden="true"></i>
                    <img style="height:70px;" src="img/community_icon.png">
                    <div class="counting" data-count="<?php echo $highest_community_no; ?>"></div>
                    <h5 style="font-size:30px;"><strong>Communities connected</strong></h5>
                </div>

                <div class="col-lg-4 stats">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div class="counting" data-count="<?php echo $highest_pid; ?>">0</div>
                    <h5 style="font-size:30px;"><strong>Volunteers connected</strong></h5>
                </div>

                <div class="col-lg-4 stats">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <div class="counting" data-count="<?php echo $total_communities; ?>">0</div>
                    <h5 style="font-size:30px;"><strong>Communities Impacted</strong></h5>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- end cont stats -->
</div>


    <!-- ===================================================================================================stats -->





    <!-- ===========================================================================================================vedio -->
    <div class="video-frame">
  <video autoplay controls>
    <source src="img/Shiksha_vedio.mp4" type="video/mp4">
  </video>
</div>
    
    <!-- ================================================================================================================vedio -->

  


    <!-- ================================================================================================================idea -->
    <div class="idea">
  <h1 style="font-size:50px;color:black;font-family: 'Times New Roman', Times, serif;"><strong>Why Us..?</strong></h1>
  
<div id="rotate-words">
  
  
<div>Empowerment<br />  <span>We believe in the transformative power of education to empower individuals and uplift communities.
</span></div>
<div>Inclusivity<br />  <span>Every person deserves access to quality education, and we are committed to breaking down barriers that hinder this access.
</span></div>
<div>Collaboration<br />  <span>We foster a collaborative spirit, uniting volunteers and communities in a shared commitment to learning and growth.
</span></div>
<div>Sustainability<br />  <span>Our programs are designed to create sustainable, long-term impacts, ensuring that the benefits of education extend far beyond the classroom.
</span></div>
<!-- <div>Cinematic, Animated Text Effect<br />  <span>Everyone</span></div>
<div>Perfect for Any Movie<br />  <span>Someone</span></div>
<div>Loops for Eternity<br />  <span>No one</span></div>
<div>Simple CSS Tricks<br />  <span>Someone</span></div> -->
<div>Empowerment<br />  <span>We believe in the transformative power of education to empower individuals and uplift communities.
</span></div>
<div>Inclusivity<br />  <span>Every person deserves access to quality education, and we are committed to breaking down barriers that hinder this access.
</span></div>
<div>Collaboration<br />  <span>We foster a collaborative spirit, uniting volunteers and communities in a shared commitment to learning and growth.
</span></div>
<div>Sustainability<br />  <span>Our programs are designed to create sustainable, long-term impacts, ensuring that the benefits of education extend far beyond the classroom.
</span></div>
</div>
</div>



<!-- ========================================================================================================================idea -->



	<!-- ==============================================================================================================cubebox -->
  <h1 style="font-size:50px;text-align:center;margin-top:200px;font-family: 'Times New Roman', Times, serif;"><strong>Motive</strong></h1>

<div class="cubecontainer">
<div class="dice">
  <div class="side one"><a>Impact</a></div>
  <div class="side two"><a>Innovate</a></div>
  <div class="side three"><a>Empower</a></div>
  <div class="side four"><a>Ignite</a></div>
  <div class="side five"><a>Unify</a></div>
  <div class="side six"><a>Transform</a></div>
  <!-- <div class="side four">Location</div>
  <div class="side five">Contact</div>
  <div class="side six">About</div> -->
</div>
</div>


<!-- ================================================================================================== -->


    <!-- =============================================================================================================gallery -->

<h1 style="text-align:center;font-size:50px;margin-top:100px;font-family: 'Times New Roman', Times, serif;margin-bottom:50px;"><strong>Gallery</strong></h1>
    <div class="gallery">
<div class="container">
  <div class="card">
    <img src="img\gallery\im1.jpg">
    <div class="card__head">Unify</div>
  </div>
  <div class="card">
    <img src="img\gallery\im2.jpg">
    <div class="card__head">Empower</div>
  </div>
  <div class="card">
    <img src="img\gallery\im3.jpg">
    <div class="card__head">Impact</div>
  </div>
  <div class="card">
    <img src="img\gallery\im6.jpg">
    <div class="card__head">Innovate</div>
  </div>
  <div class="card">
    <img src="img\gallery\im4.jpg">
    <div class="card__head">Ignite</div>
  </div>
  <div class="card">
    <img src="img\gallery\im7.jpg">
    <div class="card__head">Transform</div>
  </div>
</div>
  </div>
    <!-- =======================================================================================================================gallery -->






 


<!-- -------------------------------------------------------------------------------------------------------cube -->


<!-- ========================================================================================================features -->
<h1 style="margin-top:100px;margin-bottom:50px;font-size:50px;font-family: 'Times New Roman', Times, serif;text-align:center;"><strong>Our Features</strong></h1>
<div class="features">
        <div class='selector'>
            <ul>
              <li>
                <input id='c1' type='checkbox'>
                <label for='c1'><br><br>Adaptable Engagement</label>
              </li>
              <li>
                <input id='c2' type='checkbox'>
                <label for='c2'><br><br>Community Networking</label>
              </li>
              <li>
                <input id='c3' type='checkbox'>
                <label for='c3'><br><br>Tailored Communities</label>
              </li>
              <li>
                <input id='c4' type='checkbox'>
                <label for='c4'><br><br>Real-Time Coonectivity</label>
              </li>
              <li>
                <input id='c5' type='checkbox'>
                <label for='c5'><br><br>Social  <br>   Impact</label>
              </li>
            </ul>
            <button>Shiksha Shastra</button>
          </div>
    </div>
    

<!-- ==========================================================================================================features -->












<!-- =========================================================================================whatsapp -->



<a href="whatsapp://send?phone=918520997742&text=Hello" class="wfloat" target="_blank">
<i class="fab fa-whatsapp wmy-float"></i>
</a>
<!-- =============================================================================================================================whatsapp -->



<!-- =======================================================================================================testinomials -->
<h1 style="text-align:center;font-size:50px;margin-top:100px;font-family: 'Times New Roman', Times, serif;"><strong>Tales of Transformation</strong></h1>
<div class="testcontainer">
    <section id="testim" class="testim">
             <div class="testim-cover">
                <div class="wrap">
    
                    <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                    <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                    <ul id="testim-dots" class="dots">
                        <li class="dot active"></li><!--
                        --><li class="dot"></li><!--
                        --><li class="dot"></li><!--
                        --><li class="dot"></li><!--
                        --><li class="dot"></li>
                    </ul>
                    <div id="testim-content" class="cont">
                        
                        <div class="active">
                            <div class="img"><img src="img\founders\IMG20230628173510.jpg" alt=""></div>
                            <h2>Poorna</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                        </div>
    
                        <div>
                            <div class="img"><img src="img\founders\My pic full.jpg" alt=""></div>
                            <h2>Abhiram</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                        </div>
    
                        <div>
                            <div class="img"><img src="img\founders\Gounrang.jpg" alt=""></div>
                            <h2>Gaurang</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                        </div>
    
                        <div>
                            <div class="img"><img src="img\founders\IMG20230628173510.jpg" alt=""></div>
                            <h2>Everyone</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                        </div>
    
                        <div>
                            <div class="img"><img src="img\founders\My pic full.jpg" alt=""></div>
                            <h2>No One</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                        </div>
    
                    </div>
    
                </div>
             </div>
        </section>
    </div>
<!-- =========================================================================----------------------testinomials -->




































<?php
include("footer.php");
?>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script>
  // =============================================================================================features
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
  // ====================================================================================features
</script>

<script src="https://use.fontawesome.com/1744f3f671.js"></script>
    <script>
        // vars
'use strict'
var	testim = document.getElementById("testim"),
		testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
    testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
    testimLeftArrow = document.getElementById("left-arrow"),
    testimRightArrow = document.getElementById("right-arrow"),
    testimSpeed = 4500,
    currentSlide = 0,
    currentActive = 0,
    testimTimer,
		touchStartPos,
		touchEndPos,
		touchPosDiff,
		ignoreTouch = 30;
;

window.onload = function() {

    // Testim Script
    function playSlide(slide) {
        for (var k = 0; k < testimDots.length; k++) {
            testimContent[k].classList.remove("active");
            testimContent[k].classList.remove("inactive");
            testimDots[k].classList.remove("active");
        }

        if (slide < 0) {
            slide = currentSlide = testimContent.length-1;
        }

        if (slide > testimContent.length - 1) {
            slide = currentSlide = 0;
        }

        if (currentActive != currentSlide) {
            testimContent[currentActive].classList.add("inactive");            
        }
        testimContent[slide].classList.add("active");
        testimDots[slide].classList.add("active");

        currentActive = currentSlide;
    
        clearTimeout(testimTimer);
        testimTimer = setTimeout(function() {
            playSlide(currentSlide += 1);
        }, testimSpeed)
    }

    testimLeftArrow.addEventListener("click", function() {
        playSlide(currentSlide -= 1);
    })

    testimRightArrow.addEventListener("click", function() {
        playSlide(currentSlide += 1);
    })    

    for (var l = 0; l < testimDots.length; l++) {
        testimDots[l].addEventListener("click", function() {
            playSlide(currentSlide = testimDots.indexOf(this));
        })
    }

    playSlide(currentSlide);

    // keyboard shortcuts
    document.addEventListener("keyup", function(e) {
        switch (e.keyCode) {
            case 37:
                testimLeftArrow.click();
                break;
                
            case 39:
                testimRightArrow.click();
                break;

            case 39:
                testimRightArrow.click();
                break;

            default:
                break;
        }
    })
		
		testim.addEventListener("touchstart", function(e) {
				touchStartPos = e.changedTouches[0].clientX;
		})
	
		testim.addEventListener("touchend", function(e) {
				touchEndPos = e.changedTouches[0].clientX;
			
				touchPosDiff = touchStartPos - touchEndPos;
			
				console.log(touchPosDiff);
				console.log(touchStartPos);	
				console.log(touchEndPos);	

			
				if (touchPosDiff > 0 + ignoreTouch) {
						testimLeftArrow.click();
				} else if (touchPosDiff < 0 - ignoreTouch) {
						testimRightArrow.click();
				} else {
					return;
				}
			
		})
}
    </script>
</body>
</html>

