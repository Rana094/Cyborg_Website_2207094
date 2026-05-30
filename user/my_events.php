<?php
require_once __DIR__ . "/../includes/auth_check.php";
$page_title = "My Events | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";

$stmt = mysqli_prepare($conn, "SELECT e.*, en.game_username, en.team_name, en.enrolled_at FROM enrollments en JOIN events e ON en.event_id = e.id WHERE en.user_id = ? ORDER BY e.event_date ASC");
mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
mysqli_stmt_execute($stmt);
$events = mysqli_stmt_get_result($stmt);
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/user_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header"><div><h1 class="db-title">My Enrolled Events</h1><p class="db-subtitle">Events you registered for.</p></div><a href="<?php echo url_path('events.php'); ?>" class="btn btn-primary btn-sm">Browse Events</a></div>
        <div class="db-panel">
            <div class="table-responsive" style="margin-top: 0; border: none;">
                <table class="data-table">
                    <thead><tr><th>Event</th><th>Game</th><th>Date</th><th>Venue</th><th>Team</th><th>Actions</th></tr></thead>
                    <tbody>
                    <?php if (mysqli_num_rows($events) === 0): ?><tr><td colspan="6">No enrolled events found.</td></tr><?php endif; ?>
                    <?php while ($event = mysqli_fetch_assoc($events)): ?>
                        <tr>
                            <td><?php echo h($event["event_name"]); ?></td><td><?php echo h($event["game_name"]); ?></td><td><?php echo h(format_date_value($event["event_date"])); ?></td><td><?php echo h($event["venue"]); ?></td><td><?php echo h($event["team_name"]); ?></td>
                            <td><div class="table-actions"><a class="btn btn-secondary btn-sm" href="event_details.php?id=<?php echo (int)$event["id"]; ?>">Details</a><a class="btn btn-primary btn-sm" href="fixture.php?event_id=<?php echo (int)$event["id"]; ?>">Fixture</a></div></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
