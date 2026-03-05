<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ATS Resume Score</title>

<link rel="stylesheet" href="style1.css">

</head>

<body>

<?php

include("config.php");

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM resumes WHERE id=$id");

$data = $res->fetch_assoc();

$score = 0;

if(strlen($data['skills']) > 20) $score += 30;
if(strlen($data['experience']) > 50) $score += 30;
if(strlen($data['education']) > 30) $score += 20;

if(strpos($data['skills'],"Java") !== false) $score += 10;
if(strpos($data['skills'],"Python") !== false) $score += 10;

?>

<div class="container">

<div class="ats-card">

<h2>ATS Resume Score</h2>

<div class="gauge-box">

<svg viewBox="0 0 200 120" class="gauge">

<path d="M20 100 A80 80 0 0 1 180 100"
class="gauge-bg"/>

<path d="M20 100 A80 80 0 0 1 180 100"
class="gauge-progress"
id="gaugeProgress"/>

<line x1="100" y1="100" x2="100" y2="35"
id="needle"
class="needle"/>

<circle cx="100" cy="100" r="6" class="center"/>

</svg>

<div class="score-text">

<span id="score">0</span>%
<p id="status">Analyzing...</p>

</div>

</div>

</div>

</div>

<script src="script.js"></script>

<script>
window.onload = function(){
setATSScore(<?php echo $score; ?>);
}
</script>

</body>
</html>