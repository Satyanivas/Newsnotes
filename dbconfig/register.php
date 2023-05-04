<?php

include("config.php");
global $con;
ob_start();

if(isset($_POST['register'])){
    $email=$_POST['email'];
    $password=($_POST['password']);
    $cpassword=($_POST['cpassword']);
  
    if($password==$cpassword){
        $query = $con->prepare("SELECT * FROM newslogin WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() == 0) {
            $query = $con->prepare("INSERT INTO newslogin(email,password) VALUES (:email,:password)");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("password", $password, PDO::PARAM_STR);
            $result = $query->execute();
            echo '<p class="error">Registered.. SUCCESSFULLY.... move to login page</p>';
            echo '<a href=../login.html>Login</a>';
        }else{
            echo '<p class="error">*************email already exist***********</p>';
            echo '<a href=../register.html>Register</a>';
           
        }
    }else{
        echo '<p class="error">passwords combination is wrong!</p>';
        echo '<a href=../register.html>Register</a>';
    }

}

?>