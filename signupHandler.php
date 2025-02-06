<?php

include 'conf.php';

if($_SERVER["REQUEST_METHOD"]== "POST"){

    $username = $_POST['username'];
    $psw = $_POST['password'];
    $cnfm_psw = $_POST['confirmPassword'];
    $email = $_POST['email'];
    $contact_no = $_POST['phoneNumber'];

    if($psw != $cnfm_psw){
        echo "<script>alert('Passwords do not match!'); window.location.href = 'login.html';</script>";
        exit();
    }

    $sql = "INSERT INTO UserProfile (Username, Password, Email, PhoneNo) VALUES ('$username', '$psw', '$email', '$contact_no')";
    $result = mysqli_query($conn, $sql);

    if($result == true){
        echo "<script>alert('User added successfully!'); window.location.href = 'login.html';</script>";
        exit();
        header("Location: login.html");
    }else{
        echo "<script>alert('Error: ' .$sql. '<br>' .mysqli_error($conn)); window.location.href = 'login.html';</script>";
        exit();
    }
}

?>