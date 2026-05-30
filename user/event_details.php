<?php
require_once __DIR__ . "/../includes/auth_check.php";
$page_title = "Event Details | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
$event_id = (int)($_GET["id"] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT e.* FROM events e JOIN enrollments en ON en.event_id = e.id WHERE e.id = ? AND en.user_id = ?");
mysqli_stmt_bind_param($stmt, "ii", $event_id, $_SESSION["user_id"]);
mysqli_stmt_execute($stmt);
$event = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$event) {
    $_SESSION["message"] = "You can only view details for your enrolled events.";
    $_SESSION["message_type"] = "error";
    header("Location: ../events.php");
    exit();
}

include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper">
    <?php include __DIR__ . "/../includes/user_sidebar.php"; ?>
    <main class="db-content">
        <div class="db-header"><div><h1 class="db-title"><?php echo h($event["event_name"]); ?></h1><p class="db-subtitle"><?php echo h($event["game_name"]); ?></p></div><a href="fixture.php?event_id=<?php echo (int)$event["id"]; ?>" class="btn btn-primary btn-sm">View Fixture</a></div>
        <div class="db-panel">
            <p><strong>Date:</strong> <?php echo h(format_date_value($event["event_date"]) . " at " . format_time_value($event["event_time"])); ?></p>
            <p><strong>Venue:</strong> <?php echo h($event["venue"]); ?></p>
            <p><strong>Status:</strong> <span class="badge <?php echo badge_class($event["status"]); ?>"><?php echo h($event["status"]); ?></span></p>
            <p><strong>Prize:</strong> <?php echo h($event["prize"]); ?></p>
            <h3 class="db-panel-title" style="margin-top: 25px;">Description</h3><p><?php echo nl2br(h($event["description"])); ?></p>
            <h3 class="db-panel-title" style="margin-top: 25px;">Rules</h3><p><?php echo nl2br(h($event["rules"])); ?></p>
        </div>
    </main>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
