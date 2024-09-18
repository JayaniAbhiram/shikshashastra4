<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History of Shiksha Shastra</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500&display=swap");

@property --clip-vertical {
  syntax: "<percentage>";
  initial-value: 95%;
  inherits: false;
}

@property --clip-horizontal {
  syntax: "<percentage>";
  initial-value: 100%;
  inherits: false;
}

@property --intro-radial {
  syntax: "<percentage>";
  initial-value: 0%;
  inherits: false;
}

main {
  --timeline-width: 100%;

  position: relative;
  /* padding-block: 300px; */
  max-width: 1000px;
  margin-inline: auto;
  &::before {
    position: absolute;
    top: 0;
    left: 50%;
    width: 0;
    height: 100%;
    margin-left: -3px;
    border-right: 6px dashed oklch(20% 0.5 313);
    content: "";
  }
}

.stop {
  --clip-horizontal: 100%;
  --clip-vertical: 93%;

  position: relative;
  min-height: 40vh;
  padding-top: 15vh;
  width: calc(var(--timeline-width) / 2);
  padding-inline: 50px;
  &::before {
    position: absolute;
    top: 0;
    right: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: oklch(80% 0.23 68);
    
    border: 6px solid oklch(20% 0.5 313);
    content: "";
    translate: 50% 0;
    transform-origin: center;
    animation: popIn linear both;
    animation-timeline: view(block);
    animation-range: cover 5% contain 22%;
  }
  &::after {
    position: absolute;
    top: 20px;
    right: 40px;
    width: 80%;
    height: calc(15vh - 20px);
    border-width: 3px 0 0 3px;
    border-style: dashed;
    border-color: oklch(20% 0.5 313);
    clip-path: inset(0 0 var(--clip-vertical) var(--clip-horizontal));
    transform-origin: center;
    animation: showLine linear both;
    animation-timeline: view(block);
    animation-range: cover 10% contain 40%;
    content: "";
    
  }

  &:nth-child(even) {
    justify-content: flex-end;
    text-align: end;
    margin-left: calc(var(--timeline-width) / 2);
    &::before {
      right: auto;
      left: 0;
      translate: -50% 0;
    }
    &::after {
      right: auto;
      left: 40px;
      border-width: 3px 3px 0 0;
      clip-path: inset(0 var(--clip-horizontal) var(--clip-vertical) 0);
    }
  }
}

.text {
  animation: slideIn linear both;
  animation-timeline: view(block);
  animation-range: cover 0% contain 12%;
}

/* keyframes */
@keyframes popIn {
  0% {
    scale: 0;
  }
  60% {
    scale: 1.2;
  }
}

@keyframes moveGradient {
  to {
    --intro-radial: 100%;
  }
}

@keyframes showLine {
  0% {
    --clip-horizontal: 100%;
    --clip-vertical: 95%;
  }
  60% {
    --clip-horizontal: 0%;
    --clip-vertical: 95%;
  }
  100% {
    --clip-horizontal: 0%;
    --clip-vertical: 0%;
  }
}

@keyframes slideIn {
  0% {
    opacity: 0;
    translate: 0 50%;
  }
  100% {
    opacity: 1;
    translate: 0 3%;
  }
}

/* Default styles */

*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  font-family: "Open Sans", sans-serif;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  font-size: 1rem;
  line-height: 1.6;
  /* background-image: radial-gradient(
      150vw circle at var(--intro-radial) var(--intro-radial) in oklab,
      oklch(80% 0.23 68) 0%,
      oklch(35% 0.5 313) 100%
    ),
    url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="28" height="49" viewBox="0 0 28 49"%3E%3Cg fill-rule="evenodd"%3E%3Cg id="hexagons" fill="%23444" fill-opacity="0.4" fill-rule="nonzero"%3E%3Cpath d="M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); */
    background-image: url("img/bg_image.jpg");
    
  background-size: 100%, 500px;
  background-attachment: fixed;
  background-color: #000;
  background-blend-mode: difference;

  animation: moveGradient linear both;
  animation-timeline: view(block);
  animation-range: contain 0% cover 100%;
}

h2 {
  font-family: "Ubuntu", sans-serif;
  font-weight: 500;
  margin: 0;
}

header {
  font-family: "Ubuntu", sans-serif;
  font-weight: 500;
}

p {
  margin-block: 1.2rem 0;
}

.text {
  /* background: rgba(0, 0, 0, 0.6); */
  /* background-color:orange; */
  background: linear-gradient(45deg, #FFA500,#007FFF);

  backdrop-filter: blur(8px);
  color: #fff;
  padding: 1.1rem;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px,
    rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
  border: 1px solid oklch(38% 0.5 313);
  border-radius: 0.6rem;
}

.intro {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  padding-inline: 30px;
  /* height: 50vh; */
  color: white;
}

img {
  width: 100px;
  margin-block-start: 1.05rem;
  border: 1px solid #eee;
  background: white;
  margin-left:40%;
  margin-right:40%;
}

/* Some mobile improvements I did after the demo was finished :) I know this could be done a bit more optimised if i'd done it right away */
@media screen and (width <= 600px) {
  main::before {
    left: 30px;
    margin-left: 0;
  }
  .stop,
  .stop:nth-child(even) {
    justify-content: flex-end;
    text-align: end;
    margin-bottom: 30px;
    margin-left: 33px;
    width: calc(var(--timeline-width) - 33px);
    padding-inline: 30px 8px;
    &::before {
      right: auto;
      left: 0;
      translate: -50% 0;
    }
    &::after {
      right: auto;
      left: 40px;
      border-width: 3px 3px 0 0;
      clip-path: inset(0 var(--clip-horizontal) var(--clip-vertical) 0);
    }
    .text {
      text-align: left;
    }
  }
}

        </style>
</head>
<body>
<div class="intro">
  <h1>How it works...?</h1>
  
</div>
<p style="text-align:center;font-size:20px;margin-bottom:20px;">Scroll down</p>
<main>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-1</h2>
        <!-- <time>1932</time> - Gustav Taushek -->
      </header>
      <p>Click Get Started</p>
      <!-- <img src="https://assets.codepen.io/159218/drum-memory.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-2</h2>
        <!-- <time>1951</time> - Fritz Pfleumer -->
      </header>
      <p>Get Registerd With Us</p>
      <!-- <img src="https://assets.codepen.io/159218/magnetic-tape.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-3</h2>
        <!-- <time>1956</time> - IBM -->
      </header>
      <p>Verify Yourself</p>
      <!-- <img src="https://assets.codepen.io/159218/hard-disk-drive.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-4</h2>
        <!-- <time>1967</time> - Alan Shugart -->
      </header>
      <p>Submit Required Documents</p>
      <!-- <img src="https://assets.codepen.io/159218/floppy-disk.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-5</h2>
        <!-- <time>1971</time> - Philips -->
      </header>
      <p>Select Your Present Location</p>
      <!-- <img src="https://assets.codepen.io/159218/compact-cassette.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-6</h2>
        <!-- <time>1980</time> - Iomega -->
      </header>
      <p>Choose from the Community hubs near you</p>
      <!-- <img src="https://assets.codepen.io/159218/zip-drive.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>step-7</h2>
        <!-- <time>1984</time> - James Russell -->
      </header>
      <p>Book your slot</p>
      <!-- <img src="https://assets.codepen.io/159218/cd-rom.png" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-8</h2>
        <!-- <time>1994</time> - Kenji Kashiwaya -->
      </header>
      <p>For Confirmation - You will receive a notification soon.</p>
      <!-- <img src="https://assets.codepen.io/159218/dvd-rom.png" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-9</h2>
        <!-- <time>1995</time> - Sony and Philips -->
      </header>
      <p>Once notified , you can connect with the choosen hub.</p>
      <!-- <img src="https://assets.codepen.io/159218/blu-ray.png" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-10</h2>
        <!-- <time>2000</time> - SanDisk -->
      </header>
      <p>Empower your Impact - Make a difference.</p>
      <!-- <img src="https://assets.codepen.io/159218/ssd.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-11</h2>
        <!-- <time>2003</time> - IBM -->
      </header>
      <p>Collect Reward Points</p>
      <!-- <img src="https://assets.codepen.io/159218/usb-flash-drive.jpg" alt="" /> -->
    </div>
  </article>
  <article class="stop">
    <div class="text">
      <header>
        <h2>Step-12</h2>
        <!-- <time>2007</time> - Amazon Web Services -->
      </header>
      <p>Ready for felicitation and recognition :- Maximize your reward Points</p>
      <!-- <img src="https://images.unsplash.com/photo-1517685352821-92cf88aee5a5?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2ODk2MDA3NDJ8&ixlib=rb-4.0.3&q=85" alt="" /> -->
    </div>
  </article>
</main>


<a href="aboutus.php" style="background-color: #4CAF50; /* Green */
                       border: none;
                       color: white;
                       padding: 15px 32px;
                       text-align: center;
                       text-decoration: none;
                       display: inline-block;
                       font-size: 16px;
                       margin: 4px 2px;
                       cursor: pointer;
                       border-radius: 8px;">Back</a>
    
</body>
</html>