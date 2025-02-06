<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

include 'conf.php';

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $newEmail = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $profileImage = $_FILES['profileImage'];

    if ($profileImage['size'] > 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($profileImage["name"]);
        move_uploaded_file($profileImage["tmp_name"], $targetFile);
    } else {
        $targetFile = $_SESSION['profileImage'];
    }

    $stmt = $conn->prepare("UPDATE UserProfile SET FullName = ?, Email = ?, PhoneNo = ?, Address = ?, ProfilePicture = ? WHERE Email = ?");
    $stmt->bind_param("ssssss", $fullName, $newEmail, $phone, $address, $targetFile, $email);
    $stmt->execute();

    $_SESSION['fullName'] = $fullName;
    $_SESSION['email'] = $newEmail;
    $_SESSION['phone'] = $phone;
    $_SESSION['address'] = $address;
    $_SESSION['profileImage'] = $targetFile;

    header("Location: profile.php");
    exit();
}
?>