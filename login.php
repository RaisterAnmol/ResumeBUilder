<?php
session_start();
include("config.php");

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();
    $user=$result->fetch_assoc();

    if($user && password_verify($password,$user['password'])){
        $_SESSION['user_id']=$user['id'];
        header("Location: dashboard.php");
    } else {
        echo "Invalid Login";
    }
}
?>

<form method="POST">
<h2>Login</h2>
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<button name="login">Login</button>
</form>