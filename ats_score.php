<?php
include("config.php");
$id=$_GET['id'];
$res=$conn->query("SELECT * FROM resumes WHERE id=$id");
$data=$res->fetch_assoc();

$score=0;

if(strlen($data['skills'])>20) $score+=30;
if(strlen($data['experience'])>50) $score+=30;
if(strlen($data['education'])>30) $score+=20;
if(strpos($data['skills'],"Java")!==false) $score+=10;
if(strpos($data['skills'],"Python")!==false) $score+=10;

echo "<h2>ATS Score: $score / 100</h2>";
?>