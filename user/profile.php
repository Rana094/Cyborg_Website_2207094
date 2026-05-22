<?php
require_once __DIR__ . "/../includes/auth_check.php";
$page_title = "My Profile | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
$inline_style = ".profile-info-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:16px; } .info-card { border:1px solid var(--border-color); border-radius:6px; padding:18px; background:rgba(255,255,255,0.03); } .info-card span { display:block; color:var(--color-secondary); font-size:.75rem; text-transform:uppercase; margin-bottom:8px; } .info-card strong { color:var(--color-text-white); }";
include __DIR__ . "/../includes/header.php";

$stmt = mysqli_prepare($conn, "SELECT full_name, student_id, department, email, phone, favorite_game, created_at FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/user_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header"><div><h1 class="db-title">My Profile</h1><p class="db-subtitle">Your account information.</p></div></div>
        <div class="db-panel">
            <div class="profile-info-grid">
                <?php foreach (["Full Name" => "full_name", "Student ID" => "student_id", "Department" => "department", "Email" => "email", "Phone" => "phone", "Favorite Game" => "favorite_game"] as $label => $key): ?>
                    <div class="info-card"><span><?php echo h($label); ?></span><strong><?php echo h($user[$key]); ?></strong></div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
