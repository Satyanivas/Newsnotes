<?php
/*
include "dbconfig/config.php";
session_start();

if(isset($_SESSION['email']))
{
   $email_news=$_SESSION['email'];
   $email_verify= $pdo->prepare("SELECT email FROM newssaved WHERE email='$email_news'");
   $sql="";
   if(isset($_POST['savedcontent'])){
    $date_field= date("d-m-Y");
    $textareafill=$_POST['textareafill'];
    if($email_verify){
    $sql=" INSERT INTO newssaved (email_news ,saved) 
    VALUES('$email_news',('$date_field:','\n''$textareafill'))";
   }else{
    $change= "SELECT saved FROM newssaved WHERE email='$email_news'";
    $sql="UPDATE newssaved SET saved=CONCAT(saved,'\n','$date_field:','\n','$textareafill') WHERE email_news='$email_news'";
   }
   $res=$conn->prepare($sql);
   $exec=$res->execute();
  } 
}*/

//'\n','$date_field:','\n',-->



include('config.php');
global $con;

session_start();

    if(isset($_POST['savedcontent'])){

      $datefield= date("d-m-Y");
      $saved=$_POST['saved']."\n";
      $check=$_POST['saved'];
      $email=$_SESSION['email'];
     
      try{
        if(empty($saved)){
          echo '<p style="color:red">enter something..!</p>';
        }else{  
          $query = $con->prepare("SELECT email FROM newssaved WHERE email=:email");
          $query->bindParam("email", $email, PDO::PARAM_STR);
          $query->execute();
          if ($query->rowCount()!=0) {
            $query=$con->prepare("UPDATE newssaved SET saved=CONCAT(:saved,saved) WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("saved", $saved, PDO::PARAM_STR);
            $result=$query->execute();
            if ($result) {
              header("location:../newspage.php");
              echo '<script>alert("Your updation was successful!")</script>';
            }
              
      }else{
        $query = $con->prepare("INSERT INTO newssaved(email,saved) VALUES (:email,:saved)");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("saved", $saved, PDO::PARAM_STR);
        $result=$query->execute();
        if ($result) {
          header("location:../newspage.php");
          echo '<script>alert("Your updation was successful!")</script>';
        }
    }      
    }
  }catch(Exception $e){
      echo "<script>alert('some prblm.....')</script>";
    }

  
  }

?>