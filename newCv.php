<?php
session_start();
include("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save'])) {
    $user_id = $_SESSION['user_id'];

    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $objective = $_POST['objective'];
    $skills = $_POST['skills'];
    $languages = $_POST['languages'];
    $summary = $_POST['summary'];
    $projects = $_POST['projects'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $github = $_POST['github'];
    $linkedin = $_POST['linkedin'];
    $certifications = $_POST['certifications'];

    $photoName = "";

    if (!empty($_FILES['photo']['name'])) {
        $photoName = time() . "_" . $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];
        move_uploaded_file($tmp, "uploads/" . $photoName);
    }

    $stmt = $conn->prepare("
        INSERT INTO resumes
        (user_id, full_name, email, phone, skills, education, experience, photo, objective, languages, summary, projects, github, linkedin, certifications)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "issssssssssssss",
        $user_id,
        $name,
        $email,
        $phone,
        $skills,
        $education,
        $experience,
        $photoName,
        $objective,
        $languages,
        $summary,
        $projects,
        $github,
        $linkedin,
        $certifications
    );

    $stmt->execute();

    $success = "Resume Created Successfully!";
    header("refresh:2;url=dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Resume</title>

<style>
body{
    margin:0;
    font-family:Segoe UI, sans-serif;
    background:linear-gradient(135deg,#e2e8f0,#f8fafc);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

.container{
    width:100%;
    max-width:850px;
    background:white;
    padding:35px;
    border-radius:16px;
    box-shadow:0 20px 50px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    margin-bottom:25px;
    color:#111827;
    font-size:28px;
}

.row{
    display:flex;
    gap:15px;
}

input, textarea{
    width:100%;
    padding:14px;
    margin-bottom:15px;
    border:1px solid #d1d5db;
    border-radius:10px;
    font-size:14px;
    box-sizing:border-box;
}

textarea{
    min-height:90px;
    resize:vertical;
}

button{
    width:100%;
    padding:14px;
    background:#111827;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
}

button:hover{
    background:#1f2937;
}
</style>
</head>
<body>

<div class="container">
<form method="POST" enctype="multipart/form-data">

    <h2>🚀 Create Professional Resume</h2>

    <div class="row">
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
    </div>

    <input type="text" name="phone" placeholder="Phone Number" required>
    <textarea name="objective" placeholder="Career Objective"></textarea>
    <textarea name="skills" placeholder="Skills (comma separated)"></textarea>
    <textarea name="languages" placeholder="Languages"></textarea>
    <textarea name="summary" placeholder="Profile Summary"></textarea>
    <textarea name="projects" placeholder="Projects"></textarea>
    <textarea name="education" placeholder="Education"></textarea>
    <textarea name="experience" placeholder="Experience"></textarea>
    <textarea name="github" placeholder="GitHub Profile Link"></textarea>
    <textarea name="linkedin" placeholder="LinkedIn Profile Link"></textarea>
    <textarea name="certifications" placeholder="Certifications"></textarea>

    <input type="file" name="photo" required>

    <button name="save">✨ Create Resume</button>

</form>
</div>

</body>
</html>