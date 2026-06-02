<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Admin Dashboard | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";

function table_count($conn, $table) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM $table");
    return (int)mysqli_fetch_assoc($result)["total"];
}
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/admin_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header"><div><h1 class="db-title">Admin Dashboard</h1><p class="db-subtitle">Overview of the club portal.</p></div></div>
        <div class="stats-grid">
            <div class="stat-card"><div class="stat-card-icon">*</div><div class="stat-card-info"><div class="stat-card-number"><?php echo table_count($conn, "users"); ?></div><div class="stat-card-label">Total Users</div></div></div>
            <div class="stat-card"><div class="stat-card-icon">*</div><div class="stat-card-info"><div class="stat-card-number"><?php echo table_count($conn, "events"); ?></div><div class="stat-card-label">Total Events</div></div></div>
            <div class="stat-card"><div class="stat-card-icon">*</div><div class="stat-card-info"><div class="stat-card-number"><?php echo table_count($conn, "enrollments"); ?></div><div class="stat-card-label">Enrollments</div></div></div>
            <div class="stat-card"><div class="stat-card-icon">*</div><div class="stat-card-info"><div class="stat-card-number"><?php echo table_count($conn, "contact_messages"); ?></div><div class="stat-card-label">Messages</div></div></div>
        </div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
