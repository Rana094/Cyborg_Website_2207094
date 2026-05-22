<?php
require_once __DIR__ . "/../includes/auth_check.php";
$page_title = "User Dashboard | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";

$user_id = (int)$_SESSION["user_id"];
$count_stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM enrollments WHERE user_id = ?");
mysqli_stmt_bind_param($count_stmt, "i", $user_id);
mysqli_stmt_execute($count_stmt);
$total_enrolled = mysqli_fetch_assoc(mysqli_stmt_get_result($count_stmt))["total"];

$user_stmt = mysqli_prepare($conn, "SELECT favorite_game FROM users WHERE id = ?");
mysqli_stmt_bind_param($user_stmt, "i", $user_id);
mysqli_stmt_execute($user_stmt);
$profile = mysqli_fetch_assoc(mysqli_stmt_get_result($user_stmt));

$fixtures_stmt = mysqli_prepare($conn, "SELECT e.event_name, f.round_name, f.team_one, f.team_two, f.match_date, f.match_time, f.status FROM fixtures f JOIN events e ON f.event_id = e.id JOIN enrollments en ON en.event_id = e.id WHERE en.user_id = ? ORDER BY f.match_date ASC, f.match_time ASC LIMIT 5");
mysqli_stmt_bind_param($fixtures_stmt, "i", $user_id);
mysqli_stmt_execute($fixtures_stmt);
$fixtures = mysqli_stmt_get_result($fixtures_stmt);
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/user_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header">
            <div><h1 class="db-title">Welcome Back, <?php echo h($_SESSION["full_name"]); ?>!</h1><p class="db-subtitle">Here is what is happening in your cyborg gaming portal today.</p></div>
            <a href="<?php echo url_path('events.php'); ?>" class="btn btn-primary btn-sm">Browse Tournaments</a>
        </div>
        <div class="stats-grid">
            <div class="stat-card"><div class="stat-card-icon">*</div><div class="stat-card-info"><div class="stat-card-number"><?php echo (int)$total_enrolled; ?></div><div class="stat-card-label">Enrolled Events</div></div></div>
            <div class="stat-card"><div class="stat-card-icon">*</div><div class="stat-card-info"><div class="stat-card-number"><?php echo mysqli_num_rows($fixtures); ?></div><div class="stat-card-label">Upcoming Fixtures</div></div></div>
            <div class="stat-card"><div class="stat-card-icon">*</div><div class="stat-card-info"><div class="stat-card-number"><?php echo h($profile["favorite_game"] ?? "N/A"); ?></div><div class="stat-card-label">Favorite Game</div></div></div>
        </div>
        <div class="db-panel">
            <div class="db-panel-header"><h3 class="db-panel-title">My Match Schedule</h3><a href="<?php echo url_path('user/fixture.php'); ?>" style="font-size: 0.8rem; color: var(--color-primary);">See Full Fixtures</a></div>
            <div class="table-responsive" style="margin-top: 0; border: none;">
                <table class="data-table">
                    <thead><tr><th>Event Name</th><th>Round</th><th>Matchup</th><th>Date & Time</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php if (mysqli_num_rows($fixtures) === 0): ?>
                        <tr><td colspan="5">No fixtures yet.</td></tr>
                    <?php endif; ?>
                    <?php mysqli_data_seek($fixtures, 0); while ($fixture = mysqli_fetch_assoc($fixtures)): ?>
                        <tr><td><?php echo h($fixture["event_name"]); ?></td><td><?php echo h($fixture["round_name"]); ?></td><td><?php echo h($fixture["team_one"] . " vs " . $fixture["team_two"]); ?></td><td><?php echo h(format_date_value($fixture["match_date"]) . " " . format_time_value($fixture["match_time"])); ?></td><td><span class="badge <?php echo badge_class($fixture["status"]); ?>"><?php echo h($fixture["status"]); ?></span></td></tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
