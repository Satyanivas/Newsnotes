<?php
    global $con;
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $email= $_POST['email'];
        $password = $_POST['password'];
        $query = $con->prepare("SELECT * FROM newslogin WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p>No email found..!</p>';
            echo '<a href=../login.html>Login</a>';
        } else {
            if ($password==$result['password']) {
                $_SESSION['email'] = $result['email'];
               // $_SESSION['loggedin'] = true;
                header( 'Location:../newspage.php' );
            } else {
                echo '<p>Username password combination is wrong!</p>';
                echo '<a href=../login.html>Login</a>';
            }
        }
    }
?>