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
  <link rel="stylesheet" href="./css/style.css">
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

  <section id="main">
    <div class="container">
      <article id="main-col">
        <br><br>
        <h1 class="page-title"> </h1>
        <ul id="services">
          <li>
            <h3> ROAD TRAVEL MADE EASY !</h3>
            <p class="dark">A connecting site for Bike Owners and Travellers. Sign up and meet drivers, who are travelling in the same direction. Get in touch with them to reach the common destination at the same time, through the same ride. Post your travel need and find fastest and easiest way for reaching your destination.
            </p>
          </li>
        </ul>
      </article>

      <?php

      include('configure.php');

      if (isset($_POST['submit'])) {

        $email = ($_POST['email']);
        $password  = ($_POST['password']);

        $email_search = "select * from registration where email ='$email' and status='active'";

        $query = mysqli_query($con, $email_search);
        $email_count = mysqli_num_rows($query);

        if ($email_count) {
          $email_pass = mysqli_fetch_assoc($query);
          $db_pass = $email_pass['password'];
          $_SESSION['username'] = $email_pass['username'];
          $pass_decode = password_verify($password, $db_pass);
          if ($pass_decode) {
      ?>
            <script>
              location.replace('index.php');
              alert ("Login successful");
            </script>
      <?php
          } else {
            echo ("password incorrect");
          }
        } else {
          echo ("invalid email");
        }
      }
      ?>

      <aside id="sidebar">
        <div class="dark">
          <h2> SIGN IN TO BIKEPOOLING</h2>
          <hr><br>
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="quote">

            <ul>
              <button class="loginBtn loginBtn--facebook"><a href="https://www.facebook.com">
                  Login </a>
              </button>

              <button class="loginBtn loginBtn--google"><a href="https://www.gmail.com">
                  Login </a>
              </button><br><br>
            </ul>
            <div>
              <p><?php
                  echo $_SESSION['msg']; ?></p>
            </div>

            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email address*"> <br><br>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password*"><br><br>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Login" class="btn btn-block">
            </div>
          </form>
          <p>Dont have a account? <a href="registration.php">Register Here</a></p>
        </div>
      </aside>
    </div>
  </section> <br>

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
                    <li> <a href="co-rider.php">Post your ride</a></li>
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