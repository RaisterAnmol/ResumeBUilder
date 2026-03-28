<?php
include("config.php");

if(!isset($_GET['id'])){
    die("No Resume ID!");
}

$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM resumes WHERE id=$id");

if($res->num_rows == 0){
    die("Resume not found!");
}

$data = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Professional Resume</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    padding: 30px;
}

/* Main container */
.container{
    width: 1100px;
    max-width: 95%;
    margin: auto;
    background: #ffffff;
    display: flex;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

/* LEFT SIDEBAR */
.left{
    width: 32%;
    background: #f8fafc;
    padding: 35px 28px;
    border-right: 1px solid #d1d5db;
}

/* RIGHT CONTENT */
.right{
    width: 68%;
    padding: 35px;
    overflow-wrap: break-word;
    word-wrap: break-word;
}

/* Header */
.top-header{
    width: 100%;
    background: #0f172a;
    color: white;
    padding: 25px 35px;
    margin-bottom: 25px;
    border-radius: 14px;
}

.top-header h1{
    font-size: 34px;
    font-weight: 800;
    margin-bottom: 6px;
}

.top-header p{
    font-size: 16px;
    opacity: 0.95;
}

/* Profile Image */
.profile{
    text-align: center;
    margin-bottom: 25px;
}

.profile img {
    width: 170px;
    height: 170px;
    object-fit: cover;
    
    border: 4px solid #0f172a;
}

/* Sidebar sections */
.left h3{
    font-size: 22px;
    font-weight: 700;
    color: #111827;
    margin-top: 22px;
    margin-bottom: 12px;
    border-bottom: 2px solid #d1d5db;
    padding-bottom: 6px;
}

.left p{
    font-size: 15px;
    line-height: 1.8;
    color: #374151;
    word-break: break-word;
}

/* Skills tags */
.skill-box{
    display:inline-block;
    background:#0f172a;
    color:white;
    padding:6px 12px;
    margin:4px 4px 4px 0;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
}

/* Main sections */
.section{
    margin-bottom: 28px;
}

.section h2{
    font-size: 24px;
    font-weight: 800;
    color: #111827;
    border-bottom: 2px solid #d1d5db;
    padding-bottom: 8px;
    margin-bottom: 12px;
    letter-spacing: 0.4px;
}

/* Cards */
.card{
    width: 100%;
    background: #fafafa;
    padding: 18px 20px;
    border-left: 4px solid #0f172a;
    border-radius: 10px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    margin-top: 8px;
}

.card p{
    font-size: 15px;
    line-height: 1.9;
    color: #374151;
    word-break: break-word;
}

/* Links */
.links p,
.links a{
    font-size:15px;
    line-height:1.7;
    word-break: break-word;
    overflow-wrap: break-word;
}

/* Download button */
.btn{
    display:inline-block;
    margin-top:20px;
    padding:14px 22px;
    background:#0f172a;
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-size:16px;
    font-weight:700;
    transition:0.3s;
}

.btn:hover{
    background:#1e293b;
}
</style>
</head>
<body>

<div class="container">

    <!-- LEFT SIDEBAR -->
    <div class="left">

        <?php if(!empty($data['photo'])){ ?>
            <div class="profile">
                <img src="uploads/<?php echo htmlspecialchars($data['photo']); ?>" alt="Profile">
            </div>
        <?php } ?>

        <div class="section">
            <h2>Career Objective</h2>
            <div class="card">
                <?php echo nl2br(htmlspecialchars($data['objective'] ?? 'Seeking opportunities to grow and contribute.')); ?>
            </div>
        </div>

        <div class="section">
            <h2>Skills</h2>
            <div class="card">
                <?php
                $skills = explode(",", $data['skills'] ?? '');
                foreach($skills as $skill){
                    if(trim($skill) != ""){
                        echo "<span class='skill-box'>" . htmlspecialchars(trim($skill)) . "</span>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="section">
            <h2>Languages</h2>
            <div class="card">
                <?php echo nl2br(htmlspecialchars($data['languages'] ?? 'English, Hindi')); ?>
            </div>
        </div>

        <div class="section links">
            <h2>Links</h2>
            <div class="card">
                <p><strong>GitHub:</strong><br>
                <?php echo htmlspecialchars($data['github'] ?? '-'); ?></p>

                <br>

                <p><strong>LinkedIn:</strong><br>
                <?php echo htmlspecialchars($data['linkedin'] ?? '-'); ?></p>
            </div>
        </div>

    </div>

    <!-- RIGHT CONTENT -->
    <div class="right">

        <div class="top-header">
            <h1><?php echo htmlspecialchars($data['full_name']); ?></h1>
            <p>
                <?php echo htmlspecialchars($data['email']); ?> |
                <?php echo htmlspecialchars($data['phone']); ?>
            </p>
        </div>

        <div class="section">
            <h2>Profile Summary</h2>
            <div class="card">
                <p><?php echo nl2br(htmlspecialchars($data['summary'] ?? 'Passionate developer with hands-on project experience.')); ?></p>
            </div>
        </div>

        <div class="section">
            <h2>Projects</h2>
            <div class="card">
                <p><?php echo nl2br(htmlspecialchars($data['projects'] ?? 'Resume Builder Web App')); ?></p>
            </div>
        </div>

        <div class="section">
            <h2>Experience</h2>
            <div class="card">
                <p><?php echo nl2br(htmlspecialchars($data['experience'] ?? '')); ?></p>
            </div>
        </div>

        <div class="section">
            <h2>Education</h2>
            <div class="card">
                <p><?php echo nl2br(htmlspecialchars($data['education'] ?? '')); ?></p>
            </div>
        </div>

        <a href="download_pdf.php?id=<?php echo $id; ?>" class="btn">
            📄 Download PDF
        </a>

    </div>

</div>

</body>
</html>