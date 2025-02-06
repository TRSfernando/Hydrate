<?php
include 'conf.php';
session_start();
session_destroy();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $psw = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM UserProfile WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $psw);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the user is an admin
        if ($email == "admin@gmail.com") {
            header("Location: admin.html");
            exit();
        }

        header("Location: profile.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href = 'login.html';</script>";
        exit();
    }
}
?>