<?php

    $username = $_POST["username"];
    $password = $_POST["password"];
    $valid = 1;

    if(strlen($username)==0){
        $valid=0;
        $error='Username cannot be left empty!';
    }else if(strlen($password)==0){
        $valid=0;
        $error='Password cannot be left empty!';
    }

    $con = mysqli_connect('localhost', 'root', '', 'febryan', 3306);
    if ($con->error){
        echo $con->error;
    }
    else{
        if($valid==1){
            $result = $con->query("SELECT * FROM users WHERE `username`='$username' AND `password`='$password'");
            if($result->num_rows == 1){
                $dataresult = $result->fetch_assoc();
                session_start();
                $_SESSION["UserisLogin"] = true;
                $_SESSION["username"] = $dataresult["username"];
                $_SESSION["id"] = $dataresult["id"];
                header("Location: ../home.php");
                die();
            }else{
                $error ='Wrong Username and Pasword!';
                header("Location: ../login.php?error=".$error);
            }
        }else{
            header("Location: ../login.php?error=".$error);
        }
    }
?>