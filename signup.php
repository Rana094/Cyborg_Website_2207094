<?php
require_once __DIR__ . "/includes/db.php";
$page_title = "Register | Cyborg Gaming Club";
$inline_style = ".signup-section { padding: 60px 0; } .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; } @media(max-width: 576px) { .form-grid { grid-template-columns: 1fr; gap: 0; } }";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $student_id = trim($_POST["student_id"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";
    $favorite_game = trim($_POST["favorite_game"] ?? "");

    if ($full_name === "" || $student_id === "" || $department === "" || $email === "" || $phone === "" || $password === "" || $favorite_game === "") {
        $_SESSION["message"] = "Please fill in all signup fields.";
        $_SESSION["message_type"] = "error";
    } elseif (!ctype_digit($student_id)) {
        $_SESSION["message"] = "Student ID must contain numbers only.";
        $_SESSION["message_type"] = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["message"] = "Please enter a valid email address.";
        $_SESSION["message_type"] = "error";
    } elseif (strlen($password) < 6) {
        $_SESSION["message"] = "Password must be at least 6 characters.";
        $_SESSION["message_type"] = "error";
    } elseif ($password !== $confirm_password) {
        $_SESSION["message"] = "Password and confirm password do not match.";
        $_SESSION["message_type"] = "error";
    } else {
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? OR student_id = ?");
        mysqli_stmt_bind_param($check, "ss", $email, $student_id);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $_SESSION["message"] = "Email or student ID already exists.";
            $_SESSION["message_type"] = "error";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = "user";
            $stmt = mysqli_prepare($conn, "INSERT INTO users (full_name, student_id, department, email, phone, password, favorite_game, role, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            mysqli_stmt_bind_param($stmt, "ssssssss", $full_name, $student_id, $department, $email, $phone, $hashed_password, $favorite_game, $role);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION["message"] = "Signup successful. Please login.";
                $_SESSION["message_type"] = "success";
                header("Location: login.php");
                exit();
            }
            $_SESSION["message"] = "Signup failed. Please try again.";
            $_SESSION["message_type"] = "error";
        }
    }
}

include __DIR__ . "/includes/header.php";
?>
<main class="container signup-section">
    <div class="form-container" style="max-width: 750px;">
        <h2 class="form-title">Create Account</h2>
        <?php flash_message(); ?>
        <form id="signupForm" action="signup.php" method="POST">
            <div class="form-grid">
                <div>
                    <div class="form-group"><label for="fullName" class="form-label">Full Name</label><input type="text" id="fullName" name="full_name" class="form-control" placeholder="Enter your full name"></div>
                    <div class="form-group"><label for="studentId" class="form-label">Student ID</label><input type="text" id="studentId" name="student_id" class="form-control" placeholder="e.g. 2207094"></div>
                    <div class="form-group"><label for="department" class="form-label">Department</label><select id="department" name="department" class="form-control"><option value="">Select Department</option><option value="CSE">CSE</option><option value="EEE">EEE</option><option value="BBA">BBA</option><option value="Civil">Civil Engineering</option><option value="Pharmacy">Pharmacy</option><option value="English">English Literature</option></select></div>
                    <div class="form-group"><label for="favoriteGame" class="form-label">Favorite Game</label><select id="favoriteGame" name="favorite_game" class="form-control"><option value="">Select Favorite Game</option><option value="Valorant">Valorant</option><option value="PUBG Mobile">PUBG Mobile</option><option value="FIFA">FIFA / eFootball</option><option value="Mobile Legends">Mobile Legends</option><option value="CS2">CS2</option><option value="Other">Other Game</option></select></div>
                </div>
                <div>
                    <div class="form-group"><label for="email" class="form-label">Email Address</label><input type="email" id="email" name="email" class="form-control" placeholder="username@stud.kuet.ac.bd"></div>
                    <div class="form-group"><label for="phone" class="form-label">Phone Number</label><input type="text" id="phone" name="phone" class="form-control" placeholder="e.g. 01712345678"></div>
                    <div class="form-group"><label for="password" class="form-label">Password</label><input type="password" id="password" name="password" class="form-control" placeholder="Min 6 characters"></div>
                    <div class="form-group"><label for="confirmPassword" class="form-label">Confirm Password</label><input type="password" id="confirmPassword" name="confirm_password" class="form-control" placeholder="Repeat your password"></div>
                </div>
            </div>
            <div style="margin-top: 15px;"><button type="submit" class="btn btn-primary" style="width: 100%;">Register Account</button></div>
            <div class="form-footer"><p>Already have an account? <a href="login.php">Login here</a></p></div>
        </form>
    </div>
</main>
<?php include __DIR__ . "/includes/footer.php"; ?>
