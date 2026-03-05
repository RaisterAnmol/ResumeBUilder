<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$user_id=$_SESSION['user_id'];
$result=$conn->query("SELECT * FROM resumes WHERE user_id=$user_id");
?>

<h2>Dashboard</h2>
<a href="newCv.php">Create Resume</a> |
<a href="logout.php">Logout</a>

<hr>

<?php while($row=$result->fetch_assoc()){ ?>
    <h3><?php echo $row['full_name']; ?></h3>
    <a href="theme1.php?id=<?php echo $row['id']; ?>">View</a> |
    <a href="download_pdf.php?id=<?php echo $row['id']; ?>">PDF</a> |
    <a href="ats_score.php?id=<?php echo $row['id']; ?>">ATS Score</a> |
    <a href="deleteCv.php?id=<?php echo $row['id']; ?>">Delete</a>
    <hr>
<?php } ?>