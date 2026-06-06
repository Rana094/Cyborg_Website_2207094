<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Manage Fixtures | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";
$fixtures = mysqli_query($conn, "SELECT f.*, e.event_name FROM fixtures f JOIN events e ON f.event_id=e.id ORDER BY f.match_date DESC");
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/admin_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header"><div><h1 class="db-title">Manage Fixtures</h1></div><a href="add_fixture.php" class="btn btn-primary btn-sm">Add Fixture</a></div>
        <?php flash_message(); ?>
        <div class="db-panel"><div class="table-responsive" style="margin-top:0;border:none;"><table class="data-table"><thead><tr><th>Event</th><th>Round</th><th>Team One</th><th>Team Two</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead><tbody>
        <?php while ($fixture = mysqli_fetch_assoc($fixtures)): ?>
            <tr><td><?php echo h($fixture["event_name"]); ?></td><td><?php echo h($fixture["round_name"]); ?></td><td><?php echo h($fixture["team_one"]); ?></td><td><?php echo h($fixture["team_two"]); ?></td><td><?php echo h($fixture["match_date"]); ?></td><td><span class="badge <?php echo badge_class($fixture["status"]); ?>"><?php echo h($fixture["status"]); ?></span></td><td><div class="table-actions"><a class="btn btn-secondary btn-sm" href="edit_fixture.php?id=<?php echo (int)$fixture["id"]; ?>">Edit</a><a class="btn btn-danger btn-sm" href="delete_fixture.php?id=<?php echo (int)$fixture["id"]; ?>" onclick="return confirm('Delete this fixture?');">Delete</a></div></td></tr>
        <?php endwhile; ?>
        </tbody></table></div></div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
