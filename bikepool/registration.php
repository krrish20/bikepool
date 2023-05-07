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
<html lang="en">

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
          <a href="logout.php">LogOut</a>
        </ul>
      </nav>
    </div>
  </header>

  <section id="main">
    <div class="container">
      <article id="main-col">
        <br>
        <h1 class="page-title"> </h1>
        <ul id="services">
          <li>
            <h3>WELCOME TO BIKE POOLING</h3>
            <p class="dark">Find a bike with an empty seat travelling towards your destination.</p>
          </li>
          <li>
            <h3>FIND A RIDE AND SHARE A RIDE</h3>
            <p class="dark">Find a perfect ride based on your travel needs and share a ride with drivers travelling towards same destination.</p>
          </li>
          <li>
            <h3>SAVE FUEL , MONEY AND ENVIRONMENT</h3>
            <p class="dark">Don't bring another bike on the road. Get on to a bike which is on the road. Avoid road congestion, save money and fuel, and become environment friendly.</p>
          </li>
        </ul>
      </article>

      <?php

      include('configure.php');

      if (isset($_POST['submit'])) {

        $username     = mysqli_real_escape_string($con, $_POST['username']);
        $email       = mysqli_real_escape_string($con, $_POST['email']);
        $mobile          = mysqli_real_escape_string($con, $_POST['mobile']);
        $password     = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword     = mysqli_real_escape_string($con, $_POST['cpassword']);

        $pass = password_hash($password, PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

        $token = bin2hex(random_bytes(15));
        $mobile=$_POST['mobile'];


        if(empty($mobile)){
             ?><script>alert("Mobile Number field Empty...!!!!!!");</script>; <?php
      
      
          }elseif(!preg_match("/^\d{10}+$/", $mobile)){
        
            ?><script>alert("Only Numbers with 10 Digits required");</script>;<?php
          }
       
        $emailquery = " select * from registration where email='$email' ";
        $query = mysqli_query($con, $emailquery);

        $emailcount = mysqli_num_rows($query);

        if ($emailcount > 0) {
          echo ("email already exists");
        } else {
          if ($password === $cpassword && $mobile >= 10 ) {
            $insertquery = "insert into registration ( username, email, mobile , password , cpassword ,token , status) values('$username','$email', '$mobile' , '$pass' ,'$cpass','$token','inactive')";
            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
              $subject = "BIKEPOOL ACCOUNT ACTIVATION ";
              $body = "Hello, $username . click here to activate your account : http://localhost/bikepool/emailverify.php?token=$token";
              $sender_email = "From: bikepool2@gmail.com";

              if (mail($email, $subject, $body, $sender_email)) {
                $_SESSION['msg'] = " CHECK YOUR MAIL TO ACTIVATE YOUR ACCOUNT $email";
                header('location:login.php');
              } else {
                ?>
                <script>
                  alert("Email sending failed");
                </script>
              <?php
              }
            } else {
      ?>
              <script>
                alert("Signup not successful");
              </script>
            <?php

            }
          } else {
            ?>
            <script>
              alert("password not matching");
            </script>
      <?php
          }
        }
      }
      ?>

      <aside id="sidebar">
        <div class="dark">
          <div class= "row" >
          <h2> JOIN BIKEPOOL </h2>
          <hr><br>
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="signup" class="quote">
            <ul class="register">
              <button class="loginBtn loginBtn--facebook"><a href="https://www.facebook.com">
                  Login </a>
              </button>

              <button class="loginBtn loginBtn--google"><a href="https://www.gmail.com">
                  Login </a>
              </button>
            </ul><br>

            <div class="form-group">
              <input type="text" name="username" placeholder="Full Name" required="required"><br><br>
            </div>
            <div class="form-group">
              <input type="email" name="email" placeholder="Email Address" required="required"><br><br>
              <span id="user-availability-status" style="font-size:12px;"></span>
            </div>
            <div class="form-group">
              <input type="number" name="mobile" placeholder="Mobile Number" maxlength="10" required="required"><br><br>
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" required="required"><br><br>
            </div>
            <div class="form-group">
              <input type="password" name="cpassword" placeholder="Confirm Password" required="required"><br><br>
            </div>
            <div>

              <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
            </div>
            <div class="form-group">
              <input type="submit" value="Sign Up" name="submit" class="btn btn-block"><br>
            </div>
          </form> 
          <p>Already got an account? <a href="login.php">Login Here</a></p>
        </div>
      </aside>
    </div>
    </div>
  </section>

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

  <footer><hr><br>
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