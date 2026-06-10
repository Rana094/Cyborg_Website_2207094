<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "View Users | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";
$users = mysqli_query($conn, "SELECT id, full_name, student_id, department, email, phone, favorite_game, role, created_at FROM users ORDER BY created_at DESC");
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content">
    <div class="db-header"><div><h1 class="db-title">Registered Users</h1><p class="db-subtitle">All club accounts.</p></div></div>
    <div class="db-panel"><div class="table-responsive" style="margin-top:0;border:none;"><table class="data-table"><thead><tr><th>Name</th><th>Student ID</th><th>Department</th><th>Email</th><th>Phone</th><th>Favorite Game</th><th>Role</th></tr></thead><tbody>
    <?php while ($user = mysqli_fetch_assoc($users)): ?><tr><td><?php echo h($user["full_name"]); ?></td><td><?php echo h($user["student_id"]); ?></td><td><?php echo h($user["department"]); ?></td><td><?php echo h($user["email"]); ?></td><td><?php echo h($user["phone"]); ?></td><td><?php echo h($user["favorite_game"]); ?></td><td><?php echo h($user["role"]); ?></td></tr><?php endwhile; ?>
    </tbody></table></div></div>
</main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
