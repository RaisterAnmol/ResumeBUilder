<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM resumes WHERE user_id=$user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* BODY */
body {
    display: flex;
     background: #eef2f7; 
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    background: #1e293b;
    color: #fff;
    padding: 20px;
    position: fixed;
}

.sidebar h2 {
    margin-bottom: 30px;
}

.sidebar a {
    display: block;
    color: #cbd5e1;
    text-decoration: none;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #334155;
    color: #fff;
}

/* MAIN */
.main {
    margin-left: 240px;
    width: 100%;
    padding: 20px;
}

/* TOPBAR */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.topbar h1 {
    color: #1e293b;
}

/* BUTTON */
.create-btn {
    background: #2563eb;
    color: #fff;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
}

.create-btn:hover {
    background: #1d4ed8;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    row-gap: 40px;     /* vertical space */
    column-gap: 30px;  /* horizontal space */
}

/* CARD */
.card {
    background: #fff;
    padding: 25px;
    border-radius: 15px;

    border: 1px solid #e5e7eb;   /* 👈 separation line */
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);  /* stronger shadow */
    
    transition: 0.3s;
}
.card:hover {
    transform: translateY(-5px);
}

/* NAME */
.card h3 {
    margin-bottom: 10px;
    color: #111;
}

/* ACTIONS */
.actions a {
    display: inline-block;
    margin: 5px 5px 0 0;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    text-decoration: none;
    color: #fff;
}

/* COLORS */
.view { background: #10b981; }
.pdf { background: #6366f1; }
.ats { background: #f59e0b; }
.delete { background: #ef4444; }

/* HOVER */
.actions a:hover {
    opacity: 0.8;
}

/* RESPONSIVE */
@media(max-width: 768px){
    .sidebar {
        display: none;
    }
    .main {
        margin-left: 0;
    }
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Resume Builder</h2>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="newCv.php">➕ Create Resume</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <h1>Your Resumes</h1>
        <a href="newCv.php" class="create-btn">+ New Resume</a>
    </div>

    <!-- CARDS -->
    <div class="grid">

        <?php while($row=$result->fetch_assoc()){ ?>
        <div class="card">
            <h3><?php echo $row['full_name']; ?></h3>

            <div class="actions">
                <a class="view" href="theme1.php?id=<?php echo $row['id']; ?>">View</a>
                <a class="pdf" href="download_pdf.php?id=<?php echo $row['id']; ?>">PDF</a>
                <a class="ats" href="ats_score.php?id=<?php echo $row['id']; ?>">ATS</a>
                <a class="delete" href="deleteCv.php?id=<?php echo $row['id']; ?>">Delete</a>
            </div>
        </div>
        <?php } ?>

    </div>

</div>

</body>
</html>