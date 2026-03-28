<?php
session_start();
include("config.php");

$error = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Please fill all fields.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="login-card">

    <div class="left-panel">
        <h1>Resume Builder</h1>
        <p>
            Create stunning ATS-friendly resumes, download PDFs,
            and boost your job applications with smart scoring.
        </p>
    </div>

    <div class="right-panel">
        <form method="POST">

            <h2>Welcome Back 👋</h2>
            <p class="subtitle">Login to continue your journey</p>

            <?php if (!empty($error)) { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit" name="login">Login</button>

            <p class="register-text">
                Don’t have an account?
                <a href="register.php">Register</a>
            </p>

        </form>
    </div>

</div>

</body>
</html>