<?php
ob_start();

require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$conn = new mysqli("localhost", "root", "", "resume_builder");

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM resumes WHERE id=$id");
$data = $result->fetch_assoc();

/* Image */
$base64 = "";
if (!empty($data['photo'])) {
    $imagePath = __DIR__ . "/uploads/" . $data['photo'];

    if (file_exists($imagePath)) {
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $imageData = file_get_contents($imagePath);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
    }
}

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$html = '
<style>
body{
    font-family: DejaVu Sans, Arial, sans-serif;
    margin:0;
    padding:0;
    font-size:11px;
    line-height:1.4;
    color:#2d2d2d;
}

.resume{
    width:100%;
}

.header{
    background:#111827;
    color:white;
    padding:18px 22px;
}

.header h1{
    margin:0;
    font-size:22px;
}

.header p{
    margin:4px 0 0;
    font-size:10px;
}

.resume-body{
    display:table;
    width:100%;
}

.sidebar{
    display:table-cell;
    width:30%;
    background:#f3f4f6;
    vertical-align:top;
    padding:15px;
}

.content{
    display:table-cell;
    width:70%;
    vertical-align:top;
    padding:15px;
}

.profile{
    width:85px;
    height:100px;
    display:block;
    margin:0 auto 10px;
    border:1px solid #111827;
}

.section{
    margin-bottom:12px;
}

.section h2{
    font-size:11px;
    margin:0 0 5px 0;
    border-bottom:1px solid #d1d5db;
    padding-bottom:3px;
    color:#111827;
    text-transform:uppercase;
}

.skill-box{
    display:inline-block;
    background:#111827;
    color:white;
    padding:3px 6px;
    margin:2px;
    border-radius:6px;
    font-size:9px;
}

.card{
    background:#fafafa;
    padding:8px;
    border-left:3px solid #111827;
}

p{
    margin:0;
}
</style>

<div class="resume">

    <div class="header">
        <h1>' . htmlspecialchars($data["full_name"] ?? "") . '</h1>
        <p>'
            . htmlspecialchars($data["email"] ?? "") . ' | '
            . htmlspecialchars($data["phone"] ?? "") .
        '</p>
    </div>

    <div class="resume-body">

        <div class="sidebar">

            ' . (!empty($base64) ? '<img src="' . $base64 . '" class="profile">' : '') . '

            <div class="section">
                <h2>Career Objective</h2>
                <p>' . nl2br(htmlspecialchars($data["objective"] ?? "")) . '</p>
            </div>

            <div class="section">
                <h2>Skills</h2>
                ' . implode("", array_map(
                    fn($s) => "<span class=\"skill-box\">" . htmlspecialchars(trim($s)) . "</span>",
                    explode(",", $data["skills"] ?? "")
                )) . '
            </div>

            <div class="section">
                <h2>Languages</h2>
                <p>' . nl2br(htmlspecialchars($data["languages"] ?? "")) . '</p>
            </div>

            <div class="section">
                <h2>Links</h2>
                <p><strong>GitHub:</strong> ' . htmlspecialchars($data["github"] ?? "") . '</p>
                <p><strong>LinkedIn:</strong> ' . htmlspecialchars($data["linkedin"] ?? "") . '</p>
            </div>

            <div class="section">
                <h2>Certifications</h2>
                <p>' . nl2br(htmlspecialchars($data["certifications"] ?? "")) . '</p>
            </div>

        </div>

        <div class="content">

            <div class="section">
                <h2>Profile Summary</h2>
                <div class="card">
                    <p>' . nl2br(htmlspecialchars($data["summary"] ?? "")) . '</p>
                </div>
            </div>

            <div class="section">
                <h2>Projects</h2>
                <div class="card">
                    <p>' . nl2br(htmlspecialchars($data["projects"] ?? "")) . '</p>
                </div>
            </div>

            <div class="section">
                <h2>Experience</h2>
                <div class="card">
                    <p>' . nl2br(htmlspecialchars($data["experience"] ?? "")) . '</p>
                </div>
            </div>

            <div class="section">
                <h2>Education</h2>
                <div class="card">
                    <p>' . nl2br(htmlspecialchars($data["education"] ?? "")) . '</p>
                </div>
            </div>

        </div>
    </div>
</div>
';

$dompdf->loadHtml($html);
$dompdf->render();

ob_end_clean();
$dompdf->stream("resume.pdf", ["Attachment" => true]);
exit();
?>