<?php
session_start();

if(!isset($_SESSION['username'])){
 echo "(you are not logged in)";
}
else{
 echo '<a  href="logout.php" style="color:orangered;">Logout</a>';
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

    <section id="showcase">
        <aside id="sidebar">
            <div class="row">
            <div class="dark">
                <h2> AVAILABLE RIDES</h2>
                <hr> <br>
                <form method="POST" id="searchform" action="index.php" class="quote">
                    <input type="text" placeholder="From" name="source" id="source" class="form-control" required>
                   <br> <br>
                    <input type="text" placeholder="To" name="destination" id="destination" class="form-control" />
                    <br> <br>
                    <input type="date" placeholder="DD/MM/YYYY" id="journey_date" class="form-control" name="date"> <br>
                        <br>
                    <input type="submit" value="SEARCH" name="search_by_source" class="btn btn-block" /> <br> <br>
                </form>
            </div>
         </div>
        </aside>

        <div class="rapper">
            <div class="static-txt">SHARE YOUR</div>
            <ul class="dynamic-txts">
                <li><span>RIDE</span></li>
                <li><span>MONEY</span></li>
                <li><span>JOURNEY</span></li>
                <li><span>TIME</span></li>
            </ul>
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

    <section class="show">
        <h1 class="title">BIKE-RIDER REQUEST :</h1>
        <div class="papper">
            <div class="grid">
                <div class="card">
                    <?php
                    include('configure.php');

                    if(isset($_POST['search_by_source']))
                    {
                       $source = $_POST['source'];
                       $query = "SELECT * FROM rider WHERE source='$source'";
                       $destination = $_POST['destination'];
                       $query = "SELECT * FROM rider WHERE destination='$destination'";
                       $date = $_POST['date'];
                       $query = "SELECT * FROM rider WHERE date='$date'";
                       $query_run = mysqli_query($con, $query)   
                                 
                 ?> 
                    <?php
                         if($row =mysqli_fetch_array($query_run))
                         {
                            ?>   
                            <h4><?php echo $row['name'];?></h4>  <hr><br>
                            <div class="img-area">
                        <div class="inner-area">
                            <img src="<?php echo $row ['img']; ?>">
                        </div>
                    </div>
                    <div class="price"><?php echo $row ['fare']; ?><span>₹</span></div>
                    <ul class="test">
                   
                        <li>BIKE : <?php echo $row ['bike']; ?></li>
                        <li>BIKE NO: <?php echo $row ['bikeno']; ?></li>
                        <li>SOURCE: <?php echo $row ['source']; ?></li>
                        <li>DESTINATION :<?php echo $row ['destination']; ?> </li>
                        <li>DATE : <?php echo $row ['date']; ?></li>
                        <li>CONDITIONS : <?php echo $row ['conditions']; ?></li>
                    </ul><br>
                    <a href="message1.php" class="btn">MESSAGE</a>
                </div>
               
                <div class="card">
                    <?php
                    if($row =mysqli_fetch_array($query_run))
                         ?>     
                            <h4><?php echo $row['name'];?></h4>  <hr><br>
                            <div class="img-area">
                        <div class="inner-area">
                            <img src="<?php echo $row ['img']; ?>">
                        </div>
                    </div>
                    <div class="price"><?php echo $row ['fare']; ?><span>₹</span></div> 
                    <ul class="test">
                   
                        <li>BIKE : <?php echo $row ['bike']; ?></li>
                        <li>BIKE NO: <?php echo $row ['bikeno']; ?></li>
                        <li>SOURCE: <?php echo $row ['source']; ?></li>
                        <li>DESTINATION :<?php echo $row ['destination']; ?> </li>
                        <li>DATE : <?php echo $row ['date']; ?></li>
                        <li>CONDITIONS : <?php echo $row ['conditions']; ?></li>
                    </ul><br>
                    <a href="message1.php" class="btn">MESSAGE</a>
                </div>
                <div class="card">
                    <?php
                    if($row =mysqli_fetch_array($query_run))
                         {
                            ?>   
                            <h4><?php echo $row['name'];?></h4>  <hr><br>
                            <div class="img-area">
                        <div class="inner-area">
                            <img src="<?php echo $row ['img']; ?>">
                        </div>
                    </div>
                    <div class="price"><?php echo $row ['fare']; ?><span>₹</span></div> 
                   
                    <ul class="test">
                        <li>BIKE : <?php echo $row ['bike']; ?></li>
                        <li>BIKE NO: <?php echo $row ['bikeno']; ?></li>
                        <li>SOURCE: <?php echo $row ['source']; ?></li>
                        <li>DESTINATION :<?php echo $row ['destination']; ?> </li>
                        <li>DATE : <?php echo $row ['date']; ?></li>
                        <li>CONDITIONS : <?php echo $row ['conditions']; ?></li>
                    </ul><br>
                    <a href="message1.php" class="btn">MESSAGE</a>
                </div>
            </div>
            <?php
                         }
                        }  
                    }
                        
                        else{
                            ?>
                            <script>
                            alert("NO RIDERS ARE AVAILABLE");   </script>
                              <?php 
                        }

                ?>

                <?php
                    
                ?>
        </div><br><br>
        </section>

        <section class="show">
        <h1 class="title">CO-PASSENGERS REQUEST : </h1>
        <div class="papper">
            <div class="grid">
                <div class="card">
                    <?php
                    include('configure.php');

                    if(isset($_POST['search_by_source']))
                    {
                        $source = $_POST['source'];
                        $query = "SELECT * FROM corider WHERE source='$source'";
                        $destination = $_POST['destination'];
                        $query = "SELECT * FROM corider WHERE destination='$destination'";
                        $date = $_POST['date'];
                        $query = "SELECT * FROM corider WHERE date='$date'";
                        $query_run = mysqli_query($con, $query)      
                                 
                 ?>
                    <?php
                    
                         if($row =mysqli_fetch_array($query_run))
                         {
                            ?>   
                            <h4><?php echo $row['name'];?></h4>  <hr><br>
                            <div class="img-area">
                        <div class="inner-area">
                            <img src="<?php echo $row['img']; ?>">
                        </div>
                    </div>
                    <div class="price"><?php echo $row ['fare']; ?><span>₹</span></div> <br>
                    <ul class="test">
                        <li>BIKE PREFERENCE :<?php echo $row ['bikepref']; ?></li>               
                        <li>SOURCE: <?php echo $row ['source']; ?></li>
                        <li>DESTINATION :<?php echo $row ['destination']; ?> </li>
                        <li>DATE : <?php echo $row ['date']; ?></li>
                        <li>SUGGESTION : <?php echo $row ['conditions']; ?></li>
                    </ul><br>
                     
                    <a href="message2.php" class="btn">MESSAGE</a>
                </div>

                <div class="card">
                    <?php
                    
                    if($row =mysqli_fetch_array($query_run)){
                        ?>   
                        <h4><?php echo $row['name'];?></h4>  <hr><br>
                        <div class="img-area">
                    <div class="inner-area">
                        <img src="<?php echo $row ['img']; ?>">
                    </div>
                </div>
               <div class="price"><?php echo $row ['fare']; ?><span>₹</span></div> <br>
               <ul class="test">
                   <li>BIKE PREFERENCE :<?php echo $row ['bikepref']; ?></li>               
                   <li>SOURCE: <?php echo $row ['source']; ?></li>
                   <li>DESTINATION :<?php echo $row ['destination']; ?> </li>
                   <li>DATE : <?php echo $row ['date']; ?></li>
                   <li>SUGGESTION : <?php echo $row ['conditions']; ?></li>
               </ul><br>
               <a href="message2.php" class="btn">MESSAGE</a>
           </div>

                <div class="card">
                <?php
 
 $query =("SELECT *  FROM registration order by id DESC");
$sql = mysqli_query($con, $query);
if(mysqli_num_rows($sql)>0){
while($row = mysqli_fetch_assoc($sql)){

        $username = $row['username'];                     
        ?> 
<h4><?php echo $row['username'];?></h4>
 <?php }}?>
                    <hr><br>
                    <?php
                    
                    if($row =mysqli_fetch_array($query_run))
                    {
                       ?>   
                       <div class="img-area">
                   <div class="inner-area">
                       <img <?php echo $row ['img']; ?>>
                   </div>
               </div>
               <div class="price"><?php echo $row ['fare']; ?><span>₹</span></div> <br>
               <ul class="test">
                   <li>BIKE PREFERENCE :<?php echo $row ['bikepref']; ?></li>               
                   <li>SOURCE: <?php echo $row ['source']; ?></li>
                   <li>DESTINATION :<?php echo $row ['destination']; ?> </li>
                   <li>DATE : <?php echo $row ['date']; ?></li>
                   <li>SUGGESTION : <?php echo $row ['conditions']; ?></li>
               </ul><br>
               <a href="message2.php" class="btn">MESSAGE</a>
           </div>
           <?php
                         }
                        }  
                    }
                        
                        else{
                            ?>
                            <script>
                            alert("NO CO-RIDERS ARE AVAILABLE");   </script>
                              <?php 
                        }

                ?>

                <?php
                    }
                ?>
            </div><br><br>
        </div> <br>
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