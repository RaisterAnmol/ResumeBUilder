<?php
include("config.php");

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_raw = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password_raw)) {
        $error = "Please fill all fields.";
    } elseif (strlen($password_raw) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check duplicate email
        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $password = password_hash($password_raw, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();

            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="register-card">

    <div class="left-panel">
        <h1>Resume Builder</h1>
        <p>
            Build ATS-friendly resumes, add projects,
            certifications, LinkedIn, and download
            beautifully designed PDFs instantly.
        </p>
    </div>

    <div class="right-panel">
        <form method="POST">

            <h2>Create Account 🚀</h2>
            <p class="subtitle">Join Resume Builder today</p>

            <?php if (!empty($error)) { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit" name="register">Register</button>

            <p class="login-text">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </form>
    </div>

</div>
</body>
</html>