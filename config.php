<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
$conn = new mysqli("localhost","root","","resume_builder");
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}
?>
<script src="js/app.js"></script>
</body>
</html>
