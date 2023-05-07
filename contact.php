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
          <br>  <h1 class="page-title">HOW CAN WE HELP ! </h1><br>
            <ul id="services">
              <li>
                <h3>FOR BIKE OWNERS</h3>
                <p class="dark">The bike owners have to upload their driving license and details about bike , if you face any problems related to the website you can contact us </p>
                            <p class="dark">There wont be any online transactions from either side in bikepool </p>
              </li>
              <li>
                <h3> FOR BIKE CO-PASSENGERS</h3>
                <p class="dark">The passengers doesnt have to upload anything but if you face any problems related to the website you can contact us</p>
                            <p class="dark">The passenger can also add for how much amount they are willing to bikepool</p>
              </li>
            </ul>
          </article>  <br>
              
          <?php

                 include('configure.php');

                    if (isset($_POST['submit'])) {

                     $name     = mysqli_real_escape_string($con, $_POST['name']);
                     $email       = mysqli_real_escape_string($con, $_POST['email']);
                     $message         = mysqli_real_escape_string($con, $_POST['message']);

                     $emailquery = " select * from contactus where email='$email' ";
                     $query = mysqli_query($con, $emailquery);
             
                     $emailcount = mysqli_num_rows($query);
             
                     if ($emailcount > 0) {
                       echo ("email already exists");
                     } else {
                        $insertquery = "insert into contactus ( name, email, message ) values('$name','$email', '$message')";
                        $iquery = mysqli_query($con, $insertquery);
                             if($iquery){
                               echo ("Sent successfully"); 
                                       
                             } else{
                                 echo ("Sending failed");
                             }
                            }
                        }
              ?>

        <br> <aside id="sidebar">
            <div class="dark">
              <h3>FOR ENQUIRES :</h3>
              <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="contactus" class="quote">
                            <div>
                                <label>Name :</label><br>
                                <input type="text" name="name" placeholder="Name">
                            </div><br>
                            <div>
                                <label>Email :</label><br>
                                <input type="email" name="email" placeholder="Email Address">
                            </div><br>
                            <div class="message">
                                <label>Message :</label><br>
                                <textarea placeholder="Write your message" name="message"></textarea>
                            </div> <br> 
                            <input type="submit" value="Send" name="submit" class="btn btn-block">
                      </form>
            </div>
          </aside>
        </div>
      </section> <br>


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
                    <li> <a href="find.php">Post your ride</a></li>
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