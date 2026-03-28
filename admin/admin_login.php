<?php
session_start();
if($_POST){
    if($_POST['username']=="admin" && $_POST['password']=="admin123"){
        $_SESSION['admin']=true;
        header("Location: admin_dashboard.php");
    }
}
?>

<form method="POST">
<h2>Admin Login</h2>
<input type="text" name="username"><br>
<input type="password" name="password"><br>
<button>Login</button>
</form>