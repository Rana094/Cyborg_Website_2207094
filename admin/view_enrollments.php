<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "View Enrollments | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";
$enrollments = mysqli_query($conn, "SELECT en.*, u.full_name, u.student_id, e.event_name, e.game_name FROM enrollments en JOIN users u ON en.user_id=u.id JOIN events e ON en.event_id=e.id ORDER BY en.enrolled_at DESC");
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content">
    <div class="db-header"><div><h1 class="db-title">Event Enrollments</h1><p class="db-subtitle">Who enrolled in which event.</p></div></div>
    <div class="db-panel"><div class="table-responsive" style="margin-top:0;border:none;"><table class="data-table"><thead><tr><th>User</th><th>Student ID</th><th>Event</th><th>Game</th><th>Game Username</th><th>Team</th><th>Members</th><th>Enrolled At</th></tr></thead><tbody>
    <?php while ($row = mysqli_fetch_assoc($enrollments)): ?><tr><td><?php echo h($row["full_name"]); ?></td><td><?php echo h($row["student_id"]); ?></td><td><?php echo h($row["event_name"]); ?></td><td><?php echo h($row["game_name"]); ?></td><td><?php echo h($row["game_username"]); ?></td><td><?php echo h($row["team_name"]); ?></td><td><?php echo h($row["team_members"]); ?></td><td><?php echo h($row["enrolled_at"]); ?></td></tr><?php endwhile; ?>
    </tbody></table></div></div>
</main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
