<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPass = $_POST['password-repeat'];

if(!empty($username) && !empty($email) && !empty($password) && !empty($confirmPass)){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "etmp";
    $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{
        $queryUsername = mysqli_query($con, "SELECT * FROM user_information WHERE username = '$username'");
        $queryEmail = "SELECT * FROM user_information WHERE email_address = '$email'";
        if(mysqli_num_rows($queryUsername) > 0){
            echo "Username already exists!";
        }else{
            if(strlen($username) > 30 ){
                echo "Maximum character for Username is 30";
                die;
            }
            if(strlen($password) > 12 ){
                echo "Maximum character for Password is 12";
                die;
            }
            if(mysqli_num_rows($queryEmail) > 0){
                echo "The email address has been used!";
            }else{
                if($password == $confirmPass){
                    $query = "INSERT INTO user_information (username, email_address, password) VALUES ('$username', '$email', '$password')";
                    mysqli_query($con, $query);
                    echo "You have successfully registered!\nYou will be directed to Login page";
                    
                }else{
                    echo "Password does not match!";
                }
            }
        }
        $con->close();
    }
}else{
    echo "Please enter some valid information!";
    die();
}
    

?>