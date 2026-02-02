
<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musical Academy</title>
    <style>
        .i, .o, .n, .j, .l, .k, .p, .s, .x, .a, .r ,.m {
            position: absolute;
            text-align: center; /* Center text under images */
        }

        .i {
            top: 150px;
            left: 350px;
        }

        .o {
            top: 150px;
            left: 550px;
        }

        .n {
            top: 150px;
            left: 750px;
        }

        .j {
            top: 150px;
            left: 950px;
        }

        .l {
            top: 350px;
            left: 450px;
        }

        .k {
            top: 350px;
            left: 650px;
        }

        .p {
            top: 350px;
            left: 850px;
        }

          .s {
            top: 580px;
            left: 410px;
        }

        .x {
            top: 550px;
            left: 550px;
        }

        .a {
            top: 550px;
            left: 750px;
        }

        .r {
            top: 580px;
            left: 940px;
        }

        .m {
            top: 580px;
            left: 1400px;
        }

        img {
            border-radius: 15px; /* Rounded corners */
            display: block; /* Ensure images are block elements */
            margin: 0 auto; /* Center images */
            transition: transform 0.3s ease; /* Smooth transition */
        }

        img:hover {
            transform: scale(1.1); /* Scale up the image on hover */
        }

        .header-img:hover {
            transform: none; /* Disable hover effects */
            transition: none; /* Remove hover transitions */
        }

        a {
            color: white; /* Text color */
            text-decoration: none; /* Remove underline */
            font-size: 14px; /* Adjust font size */
            display: block; /* Ensure links are block elements */
        }

        h1 {
            color: white; /* H1 text color */
            font-size: 26px; /* H1 font size */
            text-align: center; /* Center the H1 text */
            position: relative;
        }

        .header-container {
            text-align: center;
            position: relative;
        }

        .header-img {
            position: absolute;
            top: 0;
            right: 20px; /* Adjust distance from the right edge */
            width: 90px; /* Adjust image width */
            height: auto;
        }

        .logout-container {
            position: absolute;
            top: 20px;
            left: 20px; /* Adjust distance from the left edge */
            text-align: center;
        }

        .logout-container img {
            width: 40px; /* Adjust image size */
            height: auto;
            display: block;
        }

        .logout-container span {
            display: block;
            color: white;
            font-size: 14px;
        }

        body {
            background-color: black;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h1>Music as a Language</h1>
        <h1>Educating the Artists of Tomorrow</h1>
        <img class="header-img" src="logo.webp" alt="Music Icon">
    </div>

    <div class="logout-container">
        <a href="logout.php">
            <img src="logout.png" alt="Logout">
            <span>Logout</span>
        </a>
    </div>
    
    <br><br>

    <a class="i" href="flute.php" target="_self">
        <img src="images.jpeg" alt="Music School" width="150" height="160">
        <span>Pan Flute</span>
    </a>
    
    <a class="o" href="solo violin main.html" target="_self">
        <img src="images (1).jpeg" alt="Music School" width="150" height="160">
        <span>Solo Violin</span>
    </a>

    <a class="n" href="tenor saxophone main.html" target="_self">
        <img src="images (3).jpeg" alt="Music School" width="150" height="160">
        <span>Tenor Saxophone</span>
    </a>

    <a class="j" href="accordion main.php" target="_self">
        <img src="accordion.avif" alt="Music School" width="150" height="160">
        <span>Accordion</span>
    </a>

    <a class="l" href="drums main.html" target="_self">
        <img src="image4.webp" alt="Music School" width="150" height="160">
        <span>Drums</span>
    </a>
    <a class="k" href="guitar main.html" target="_self">
        <img src="images (4).jpeg" alt="Music School" width="150" height="160">
        <span>Guitar</span>
    </a>
    <a class="p" href="keyboard main.html" target="_self">
        <img src="image 6.jpg" alt="Music School" width="150" height="160">
        <span>Keyboard</span>
    </a>
    <a class="s" href="piano.html" target="_self">
        <img src="piano.webp" alt="Music School" width="100" height="90">
        <span>Piano Instrument</span>
    </a>
    <a class="x" href="event.html" target="_self">
        <img src="event.avif" alt="Music School" width="150" height="160">
        <span>Event</span>
    </a>
    <a class="a" href="file upload.php" target="_self">
        <img src="fup.avif" alt="Music School" width="150" height="160">
        <span>File Upload</span>
    </a>
 <a class="r" href="Flute Playing.html" target="_self">
        <img src="flute.png" alt="Music School" width="100" height="90">
        <span>Flute Instrument</span>
    </a>
    <a class="m" href="index.php" target="_self">
        <img src="attendance.png" alt="Music School" width="120" height="110">
        <span>Attendance</span>
    </a>
</body>
</html>
