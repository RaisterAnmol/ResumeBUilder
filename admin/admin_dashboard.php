<?php
session_start();
include("../config.php");

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}

$result=$conn->query("SELECT * FROM users");

echo "<h2>All Users</h2>";

while($row=$result->fetch_assoc()){
    echo $row['username']." - ".$row['email']."<br>";
}
?>