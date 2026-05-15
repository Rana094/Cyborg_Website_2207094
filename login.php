<?php
require_once __DIR__ . "/includes/db.php";
$page_title = "Login | Cyborg Gaming Club";
$inline_style = ".login-section { padding: 60px 0; }";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = mysqli_prepare($conn, "SELECT id, full_name, email, password, role FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["full_name"] = $user["full_name"];
        $_SESSION["role"] = $user["role"];

        if ($user["role"] === "admin") {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: user/dashboard.php");
        }
        exit();
    }

    $_SESSION["message"] = "Invalid email or password.";
    $_SESSION["message_type"] = "error";
}

include __DIR__ . "/includes/header.php";
?>
<main class="container login-section">
    <div class="form-container">
        <h2 class="form-title">Account Login</h2>
        <?php flash_message(); ?>
        <form id="loginForm" action="login.php" method="POST">
            <div class="form-group"><label for="email" class="form-label">Email Address</label><input type="email" id="email" name="email" class="form-control" placeholder="Enter your registered email"></div>
            <div class="form-group"><label for="password" class="form-label">Password</label><input type="password" id="password" name="password" class="form-control" placeholder="Enter your password"></div>
            <div style="margin-top: 25px;"><button type="submit" class="btn btn-primary" style="width: 100%;">Log In</button></div>
            <div class="form-footer"><p>Don't have an account? <a href="signup.php">Register here</a></p></div>
        </form>
    </div>
</main>
<?php include __DIR__ . "/includes/footer.php"; ?>
