<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="bikepool">
    <meta name="keywords" content="bikepool ">
    <meta name="author" content="AMOGH">
    <link rel="stylesheet" href='./css/style.css'>
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

   if (isset($_POST['sub'])) {
    $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  if(!empty($email) && !empty($message)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $receiver = "amoghkrrish1068@gmail.com"; 
      $subject = "From: $email";
      $body = "topic: $name\nMessage:\n$message\n\nRegards,\n$name";
      $sender = "From: $email";
      if(mail($receiver, $subject, $body, $sender)){
         echo "Your message has been sent";
         location.replace('index.php');
      }else{
         echo "Sorry, failed to send your message!";
      }
    }else{
      echo "Enter a valid email address!";
    }
  }else{
    echo "Email and message field is required!";
  }
}
?>  
         <section class="msg">
    <br><div class="dark">
    <h1>Send your Message</h1><br>
    <form action="message1.php" method="POST" >
    <div class="dbl-field">
    <div class="field">
          YOUR NAME :  <input type="text" name="name" placeholder="Enter your name" required="required">
          <i class='fas fa-envelope'></i>
</div></div>
      <div class="dbl-field">
        <div class="field">
          YOUR MAIL : <input type="email" name="email" placeholder="Enter your email" required="required">
          <i class='fas fa-user'></i>
        </div>
      </div>
      <div class="message">
        YOUR MESSAGE : <textarea placeholder="Write your message" name="message" required="required"></textarea>
        <i class="material-icons"></i>
      </div>
      
      <center><input type="submit" name="sub" value="Send" class="btn btn-block"/></center>
        <span></span>
      
    </form>
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

                <input type="email" name="email" placeholder="Enter Your Email :" required>

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