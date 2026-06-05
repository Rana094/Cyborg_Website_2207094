<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Manage Events | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";
$events = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC");
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/admin_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header"><div><h1 class="db-title">Manage Gaming Events</h1><p class="db-subtitle">Create, modify, and delete tournaments.</p></div><a href="add_event.php" class="btn btn-primary btn-sm">Add New Event</a></div>
        <?php flash_message(); ?>
        <div class="db-panel">
            <div class="table-responsive" style="margin-top: 0; border: none;">
                <table class="data-table">
                    <thead><tr><th>Event Name</th><th>Game</th><th>Date</th><th>Venue</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                    <?php while ($event = mysqli_fetch_assoc($events)): ?>
                        <tr><td><?php echo h($event["event_name"]); ?></td><td><?php echo h($event["game_name"]); ?></td><td><?php echo h($event["event_date"]); ?></td><td><?php echo h($event["venue"]); ?></td><td><span class="badge <?php echo badge_class($event["status"]); ?>"><?php echo h($event["status"]); ?></span></td><td><div class="table-actions"><a class="btn btn-secondary btn-sm" href="edit_event.php?id=<?php echo (int)$event["id"]; ?>">Edit</a><a class="btn btn-danger btn-sm" href="delete_event.php?id=<?php echo (int)$event["id"]; ?>" onclick="return confirm('Delete this event?');">Delete</a></div></td></tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
