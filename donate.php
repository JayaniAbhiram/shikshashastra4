

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          @import url("https://fonts.googleapis.com/css?family=Assistant:400,700|Playfair+Display:900");
   
   :root {
       --backgroundColor: #E6E7E7;
       --logo-color: #181818;
       --font-all: "Assistant", sans-serif;
       --icon-color: #ff1414;
       --card-back1: tomato;
       --card-font: #fff;
   }
   
   *, *::before, *::after {
   box-sizing: border-box;
   margin:0%;
   padding: 0%;
   -webkit-text-size-adjust:none;
   -webkit-font-smoothing: antialiased;
   -moz-osx-font-smoothing: grayscale;
   }

   html, body {
       line-height: 1.6;
       font-family: var(--font-all);
       font-size: 1.2em;
       /* background: var(--backgroundColor); */
       background-image:url('img/bg_image.jpg');
   }

   header, main, section, footer {
       display: flex;
       flex-direction: column;
       align-items: center;
       align-content: certer;
       align-self: center;
       text-align: center;
       margin: 0 auto;
   }

   header, .form, main {
       margin-bottom: 12vh;
       width: 90%;
       max-width: 500px;
   }

   header h1 {
       font-size: 5em;
       margin-bottom: 3vh;
       height: 100%;
       line-height: 120px;
       margin-top:50px;
   }

   header h2 {
       line-height: 80px;
   }

   header p {
       line-height: 25px;
       width:1000px;

       
   }

   header button {
       margin-top: 40px;
       width: 120px;
       margin-bottom: 4px;
       padding: 15px 16px;
       border-radius: 5px;
       border: 1px var(--card-font) solid;
       /* background: var(--icon-color); */
       background-color:orange;
       letter-spacing: 3px;
       color: var(--card-font);
   }

   .logo {
       color: var(--logo-color);
       width:1000px;
   }

   i.fas {
       color: var(--icon-color);
       font-size: 100px;
   }    

   main {
       line-height: 30px;    
   }

   main h2 {
       color: var(--logo-color);
       margin-bottom: 8vh;
       font-size: 3em;
   }
   
   main h2 span{
       /* color: var(--icon-color); */
       color:orange;
   }

   main h3 {
       color: var(--icon-color);
       line-height: 25px;   
   }

   .blood {
       display: flex;
       align-items: center;
       position: relative;
       justify-content: center;
   }

   .donors {
       display: grid;
       grid-template-columns:  1fr 1fr 1fr 1fr;
   }

   .donor h3 {
       color: var(--icon-color);
       line-height: 25px;  
       z-index: 11;
   }

   .donor p {
       margin-top: 24px;
       font-size: 16px;
   }

   .blood::before {
       content: "";
       background: tomato;
       width: 40px;
       height: 40px;
       position: absolute;
       border-radius: 50%;
       border-top-right-radius: 0;
       transform: rotate(-45deg);
       opacity: 0.2;
       z-index: 1;
   }

   section.form {
       display: grid;
       grid-template-columns:  1fr 1fr;
       grid-gap: 45px;
       align-items: center;
       /* background: var(--card-back1); */
       background-image:url('img\bg_image.jpg');
       min-width: 380px;
       max-width: 600px;
       padding: 16px 64px;
       border-radius: 5px;
       /* border: 1px var(--card-back1) solid; */
       transition: all 300ms;
   }

   section > form input, form button {
       width: 100%;
       margin-bottom: 4px;
       padding: 15px 16px;
       border-radius: 4px;
       /* border: 1px var(--icon-color) solid; */
       background: var(--card-back1);
       /* background-image:url('img\bg_image.jpg'); */
       background-image:url('img/bg_image.jpg');
       opacity: 0.8;
       color: var(--card-font);
       letter-spacing: 3px;
   }

   form input[text], input::placeholder {
       /* color: var(--card-font); */
       color:white;
       background-image:url('img/bg_image.jpg');
   }

   section > form button {
       /* background: var(--card-font); */
       color: var(--logo-color);
       
   }

   .form h2 {
       color: var(--card-font);
   }

   section.form.hide {
       opacity: 0;
       visibility: hidden;
       height: 0;
       margin-bottom: 15vh;
       margin-top: -70px;
   }

   @media screen and (max-width: 480px) {
       section.form {
           display: flex;
           flex-direction: column;
           line-height: 5vh;
       }
       .donors {
           display: grid;
           grid-template-columns:  1fr;
           margin-bottom: 2vh;
       }
       .donors p {
            margin-bottom: 5vh;
       }
       main h2 {
           line-height: 8vh;
       }
   }

@media (prefers-color-scheme: dark) {
 :root {
       --backgroundColor: #000;
       --logo-color: #fff;
       --card-font: #fff;
   }
 header p {
           color: #fff;
       }
       section p {
           color: #fff;
       }
       footer {
           color: #fff
       }
    section > form button {
           color: #000;
       }
}

 @-ms-viewport {
   width: device-width;
 }
      </style>
</head>
<body>
<header>

<h1 class="logo">Shiksha Shastra</h1>

<h2>Your donation matters!</h2>

<p>
Make a Difference Today!<br>
Join us in our mission to make education accessible to all. Your donation, no matter the size, has the power to transform lives and build brighter futures. Together, we can create a world where every child has the opportunity to learn, grow, and succeed.

Donate Now or Become a Volunteer to start making a difference today!
</p>

<button>Donate</button>

</header>

<section class="form hide">

<h2>Lets build the new era of Teaching</h2>

<form action="/">

    <input type="text" name="name" placeholder="Full name" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="text" name="blood" placeholder="Enter Amount" required>

    <!-- <button>Help</button> -->
    <button onclick="window.location.href = 'payment.php'">Pay</button>

</form>

</section>





<a href="index.php" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; border-radius: 5px;margin-left:200px;">Back</a>







<script>
         document.querySelector('header button').addEventListener("click", function () {
                document.querySelector('.form').classList.toggle('hide')
            })
  </script>


    
</body>
</html>