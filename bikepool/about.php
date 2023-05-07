<?php
session_start();

if(!isset($_SESSION['username'])){
 echo "(you are not logged in)";
}
else{
 echo '<a href="logout.php">Logout</a>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="bikepool">
    <meta name="keywords" content="bikepool ">
    <meta name="author" content="AMOGH">
    <link rel="stylesheet" href= "./css/style.css">
    <title> WELCOME </title>
</head>
<body>
    <header> 
        <div class="container">
        <div id="branding">
            <h1> <span class="highlight"> BIKE </span> POOL </h1>
        </div>
        <nav>
            <ul>
                 <li class="current"> <a href="index.php">home</a></li>
                 <li> <a href="">Post your ride</a><i class="fa fa-angle-down"></i>
                        <div class="menu">
                            <ul><hr>
                                <li> <a href="rider.php">Rider </a></li><hr>
                                <li> <a href="co-rider.php">Co-rider</a></li><hr>
                            </ul>
                        </div>
                    </li>
                <li> <a href="registration.php">register</a></li>
                <li> <a href="login.php">login</a></li>
                <li> <a href="about.php">About us</a></li>
                <li> <a href="contact.php">contact us</a></li>
            </ul>
        </nav>
        </div>
    </header>
    
    <?php

include('configure.php');

   if (isset($_POST['submit'])) {

    $email       = mysqli_real_escape_string($con, $_POST['email']);

    $emailquery = " select * from subscribe where email='$email' ";
    $query = mysqli_query($con, $emailquery);

    $emailcount = mysqli_num_rows($query);

    if ($emailcount > 0) {
      echo ("email already exists");
    } else {
       $insertquery = "insert into subscribe (email) values('$email')";
       $iquery = mysqli_query($con, $insertquery);
            if($iquery){ ?>
                <script>
                 alert("subscribed successfully"); 
                </script>
          <?php        
            } else{
                ?>
                <script>
                alert ("subscribing failed"); 
                </script>
          <?php      
            }
           }
       }
?>
    <section id="newsletter">
        <div class="container">
            <h1> SUBSCRIBE TO OUR PAGE </h1>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="subscribe">

                <input type="email" name="email" placeholder="Enter Your Email :">

                <input type="submit" value="Subscribe" name="submit" class=button_1>

            </form>
        </div>
    </section>

    <section id="main">
        <div class="container">
          <article id="main-col">
          <br> <h1 class="page-title">About Us</h1><br>
            <p>
                Bike sharing online system is basically used for sharing vacant seat in the bike on a regular basis with individuals commuting on the same route on a regular basis. Bike sharing is supported to reduce the number of vehicles used for commuting from the workplace thereby reducing the traffic and pollution on the roads.
            </p><br>
            <p class="dark">
                The backbone of the application, it allows the users to add a new ride and also search for available rides using the source and the destination. it will use location provided by the user and that will help the driver to pick up other passengers easily. This location will act as a picking point and driver can find the intersection between its route and the user’s path 
            </p>
          </article>
  
          <br> <aside id="sidebar">
            <div class="dark">
              <h3>What do We Do</h3>
              <p> We basically connect two strangers who are commuting to the same destination and wish to reduce their travelling charges , in this website both the rider and the passenger can add request according to their own needs .</p>
            </div>
          </aside>
        </div>
      </section><br><br>


<footer>
<div class="contain">
            <div class="footer-content">
                <div class="items">
                    <a href="#" class="logo">BIKEPOOL</a>  
                    <p> Bikepool is a user to user end website ,where the user doesnt have to wait for confirmation from the administrator and can easily book ther ride by directly communicating with the other user .</p>
                   
                   <div class="social">
                   <a href="https://www.facebook.com">f<i class="fab fa-facebook"></i></a>
                        <a href="https://www.twitter.com"><i class="fa fa-twitter">t</i></a>
                        <a href="https://www.youtube.com"><i class="fa fa-youtube-play">Y</i></a>
                        <a href="https://www.github.com"><i class="fa fa-github">g</i></a>
                    </div>
                </div>
                <div class="items">
                    <h3>Quick links</h3>
                    <ul>
                    <li> <a href="index.php">home</a></li>
                    <li> <a href="rider.php">Post your ride</a></li>
                    <li> <a href="registration.php">register</a></li>
                    <li> <a href="login.php">login</a></li>
                    <li> <a href="about.php">About us</a></li>
                    <li> <a href="contact.php">contact us</a></li>
                    </ul>                          
                </div>

                <div class="items">
                    <h3>Legal</h3>
                <ul>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">GDPR Compliance</a></li>
                </ul>
                </div>
                <div class="items">
                    <h3>Contact us</h3>
                    <ul>
                        <li><a href="#">Mail : bikepool2@gmail.com</a></li>
                        <li><a href="#">No : 8660199288</a></li>
                    </ul>
                </div>

            </div>
            <hr>
            <p class="end">Copyright © 2020 by BIKEPOOL , All rights reserved.</p>
        </div>
  </footer>
 </body>
</html>