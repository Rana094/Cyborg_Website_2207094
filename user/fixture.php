<?php
require_once __DIR__ . "/../includes/auth_check.php";
$page_title = "Fixtures | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
$event_id = (int)($_GET["event_id"] ?? 0);

if ($event_id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT f.*, e.event_name FROM fixtures f JOIN events e ON f.event_id = e.id JOIN enrollments en ON en.event_id = e.id WHERE en.user_id = ? AND e.id = ? ORDER BY f.match_date ASC, f.match_time ASC");
    mysqli_stmt_bind_param($stmt, "ii", $_SESSION["user_id"], $event_id);
} else {
    $stmt = mysqli_prepare($conn, "SELECT f.*, e.event_name FROM fixtures f JOIN events e ON f.event_id = e.id JOIN enrollments en ON en.event_id = e.id WHERE en.user_id = ? ORDER BY f.match_date ASC, f.match_time ASC");
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
}
mysqli_stmt_execute($stmt);
$fixtures = mysqli_stmt_get_result($stmt);

include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/user_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header"><div><h1 class="db-title">Fixture Schedule</h1><p class="db-subtitle">Fixtures for events you are enrolled in.</p></div></div>
        <div class="db-panel">
            <div class="table-responsive" style="margin-top: 0; border: none;">
                <table class="data-table">
                    <thead><tr><th>Event</th><th>Round</th><th>Team One</th><th>Team Two</th><th>Date</th><th>Time</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php if (mysqli_num_rows($fixtures) === 0): ?><tr><td colspan="7">No fixtures available for your enrolled events.</td></tr><?php endif; ?>
                    <?php while ($fixture = mysqli_fetch_assoc($fixtures)): ?>
                        <tr><td><?php echo h($fixture["event_name"]); ?></td><td><?php echo h($fixture["round_name"]); ?></td><td><?php echo h($fixture["team_one"]); ?></td><td><?php echo h($fixture["team_two"]); ?></td><td><?php echo h(format_date_value($fixture["match_date"])); ?></td><td><?php echo h(format_time_value($fixture["match_time"])); ?></td><td><span class="badge <?php echo badge_class($fixture["status"]); ?>"><?php echo h($fixture["status"]); ?></span></td></tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
