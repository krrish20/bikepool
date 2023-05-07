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
          <li class="current"> <a href="index.php"><i class="fas fa-home"></i>Home</a></li>
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
        <br> <br>
        <h1 class="page-title"> FOR BIKE CO-RIDERS : </h1><br>
        <ul id="services">
          <li>
            <h3>LIFE IS ALL ABOUT THE JOURNEY</h3>
            <p> </p>
          </li>
          <li>
            <h3> BIKEPOOL EASILY IN FUN , COOL , ECONOMICAL WAY </h3>
            <p></p>
          </li>
          <li>
            <h3> HELP EACHOTHER BY SHARING RIDES</h3>
            <p></p>
          </li>
        </ul>
      </article>
          
      <?php

include('configure.php');


if (isset($_POST['submited'])) {
$name= mysqli_real_escape_string($con, $_POST['name']);   
$img   = $_FILES ['img'];
//print_r($img);
$imgname = $img['name'];
$imgpath = $img['tmp_name'];
$imgerror = $img['error'];
       if($imgerror == 0){
         $destfile = 'uploads2/' .$imgname;
         //echo "$destfile" ;
         move_uploaded_file($imgpath , $destfile);
       }  
  $bikepref       = mysqli_real_escape_string($con, $_POST['bikepref']);
  $fare    = mysqli_real_escape_string($con, $_POST['fare']);
  $conditions         = mysqli_real_escape_string($con, $_POST['conditions']);
  $source    = mysqli_real_escape_string($con, $_POST['source']);
  $destination   = mysqli_real_escape_string($con, $_POST['destination']);
  $date   = mysqli_real_escape_string($con, $_POST['date']);
   

   
      $insertquery = "Insert into corider (name , img , bikepref, fare, conditions, source, destination, date) values ( '$name','$destfile', '$bikepref', '$fare','$conditions', '$source', '$destination', '$date')";
      $iquery = mysqli_query($con, $insertquery);

      if ($iquery) 
      {
       echo " <script>
          alert('Posted successful');
        </script>";
      }
     else {
     
      echo "<script>
        alert('Posting was unsuccessful');
      </script>";

    }
   }
?>

      <aside id="sidebar">
        <div class="dark">
          <h2> POST YOUR TRIP HERE</h2>
          <hr><br>
          <form method="POST"  enctype="multipart/form-data"  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="quote">
             <input type="file"  name="img"  class="find" required="required" />
             <br> <br>
             <input type="text" placeholder="Your forename" name="name" class="find" required="required"/>
             <br> <br>
             <input type="text" placeholder="Bike-preference" name="bikepref" class="find"  required="required" />
             <br> <br>
             <input type="number" placeholder="Fare-₹" name="fare" class="find" />
             <br> <br>
             <input type="place" placeholder="Source" name="source" id="source" class="FIND"required="required"/>
            <br> <br>
            <input type="text" placeholder="Destination" name="destination" id="destination" class="find" required="required"/>
             <br> <br>
            <input type="date"  id="journey_date" class="find"  name="date" required="required"/>
             <br><br>
             <input type="text" placeholder="Your suggestion for the rider" name="conditions" class="find" required="required"/>
             <br> <br>
            <input type="submit" value="POST" name="submited" class="btn btn-block"  /> <br> <br>
          </form>
        </div>
      </aside>
    </div>
  </section> <br>
  
  <?php

include('configure.php');

   if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);

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

  <section id="boxes">
    <div class="container">
      <div class="box">
        <img src="./imgs/img1.png">
        <hr>
        <h3> BIKE OWNERS</h3>
        <hr>
        <p>
        <h4 class="dark">Find Travellers :</h4>
        Offer a ride to people, who are in need of a ride.

        <h4 class="dark"> Contact bike co-passengers :</h4>
        Get in touch with the bike Travellers once they have booked a ride with you.

        <h4 class="dark"> Find a Perfect Mate for the best Ride :</h4>
        Easily find Co-Travellers at your comfort zone and you can travel your mutual distance or you can drop them off on your destination. <br> <br>
        </p>

      </div>
      <div class="box">
        <img src="./imgs/img2.png">
        <hr>
        <h3> CO-PASSENGERS</h3>
        <hr>
        <p>
        <h4 class="dark"> Find Perfect Trips :</h4>
        Post by mentioning the starting and ending points.

        <h4 class="dark"> Contact bike Owners:</h4>
        Directly contact the bike Owner, once they have accepted your trip request.

        <h4 class="dark"> Hire with Confidence :</h4>
        Find a Bike Owner who, can satisfy your daily travel need. <br><br><br>

        </p>
      </div>
      <div class="box">
        <img src="./imgs/img3.png">
        <hr>
        <h3> TO REQUEST OR ADD RIDE </h3>
        <hr>
        <p>
        <h4 class="dark"><a href="registration.php"> Register or login :</a></h4>
        Then search for your ride or add Ride

        <h4 class="dark"> Bike owners can :</h4>
        They can add ride and also choose request from co-passengers <br>

        <h4 class="dark"> Bike co-passengers can :</h4>
        They can request ride and also choose request from bike owner and the co-passenger can also request the amount for the ride <br> <br>
        </p>
      </div>
    </div><br>
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