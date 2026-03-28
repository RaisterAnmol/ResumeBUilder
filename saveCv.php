<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['save'])){
    $user_id = $_SESSION['user_id'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $skills = $_POST['skills'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];

    // 🔥 Image upload (FIXED)
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];

    $path = "uploads/" . time() . "_" . $photo;

    move_uploaded_file($tmp, $path);

    $stmt = $conn->prepare("INSERT INTO resumes(user_id,full_name,email,phone,skills,education,experience,photo) VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssss",$user_id,$name,$email,$phone,$skills,$education,$experience,$path);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>