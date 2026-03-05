<?php
$conn = new mysqli("localhost","root","","resume_builder");
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}
?>