<?php
session_start();
include("config.php");

if(isset($_POST['save'])){
    $user_id=$_SESSION['user_id'];
    $full_name=$_POST['full_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $skills=$_POST['skills'];
    $education=$_POST['education'];
    $experience=$_POST['experience'];

    $photo=$_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'],"uploads/".$photo);

    $stmt=$conn->prepare("INSERT INTO resumes(user_id,full_name,email,phone,skills,education,experience,photo)
    VALUES(?,?,?,?,?,?,?,?)");

    $stmt->bind_param("isssssss",$user_id,$full_name,$email,$phone,$skills,$education,$experience,$photo);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>