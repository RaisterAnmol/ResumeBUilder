<?php
include("config.php");
$id=$_GET['id'];
$res=$conn->query("SELECT * FROM resumes WHERE id=$id");
$data=$res->fetch_assoc();
?>

<h1><?php echo $data['full_name']; ?></h1>
<img src="uploads/<?php echo $data['photo']; ?>" width="120"><br>

<b>Email:</b> <?php echo $data['email']; ?><br>
<b>Phone:</b> <?php echo $data['phone']; ?><br>

<h3>Skills</h3>
<p><?php echo $data['skills']; ?></p>

<h3>Education</h3>
<p><?php echo $data['education']; ?></p>

<h3>Experience</h3>
<p><?php echo $data['experience']; ?></p>