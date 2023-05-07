<?php
session_start();
include('configure.php');



  if(isset($_GET['token']))
  {

      $token = $_GET['token'];
      $updatequery = "update registration set status ='active' where token='$token'";
      $query = mysqli_query($con,$updatequery);
  }

       if($query){
        if (isset( $_SESSION['msg'])){
            $_SESSION['msg']="YOU'RE ACCOUNT IS ACTIVATED";
            header('location:login.php');
        }
       else{ 
           $_SESSION['msg']="YOU ARE LOGGED OUT";
        header('location:index.php');
         }
        }else{ 
            $_SESSION['msg']="ACCOUNT NOT UPDATED ";
         header('location:registration.php');
          }
?>