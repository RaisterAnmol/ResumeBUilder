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

/* Basic required sections */
if (!empty($data['full_name'])) $score += 5;
if (!empty($data['email'])) $score += 5;
if (!empty($data['phone'])) $score += 5;

/* Career objective */
if (!empty($data['objective']) && strlen($data['objective']) > 50) {
    $score += 10;
}

/* Skills */
if (!empty($data['skills']) && strlen($data['skills']) > 20) {
    $score += 15;
}

/* Experience */
if (!empty($data['experience']) && strlen($data['experience']) > 50) {
    $score += 15;
}

/* Education */
if (!empty($data['education']) && strlen($data['education']) > 30) {
    $score += 10;
}

/* Projects */
if (!empty($data['projects']) && strlen($data['projects']) > 40) {
    $score += 15;
}

/* Certifications */
if (!empty($data['certifications'])) {
    $score += 10;
}

/* Links */
if (!empty($data['github'])) $score += 5;
if (!empty($data['linkedin'])) $score += 5;

/* Important ATS keywords */
$keywords = ["PHP", "Java", "Python", "MySQL", "JavaScript", "HTML", "CSS", "React", "Laravel"];

foreach ($keywords as $keyword) {
    if (stripos($data['skills'], $keyword) !== false) {
        $score += 2;
    }
}

/* Cap at 100 */
if ($score > 100) $score = 100;

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