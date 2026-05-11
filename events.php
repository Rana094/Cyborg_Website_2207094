<?php
require_once __DIR__ . "/includes/db.php";
$page_title = "Club Events | Cyborg Gaming Club";
$extra_css = ["home_styles.css"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["event_id"])) {
    if (empty($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "user") {
        header("Location: login.php");
        exit();
    }

    $event_id = (int)$_POST["event_id"];
    $user_id = (int)$_SESSION["user_id"];
    $game_username = trim($_POST["game_username"] ?? "");
    $team_name = trim($_POST["team_name"] ?? "");
    $team_members = trim($_POST["team_members"] ?? "");

    $check = mysqli_prepare($conn, "SELECT id FROM enrollments WHERE user_id = ? AND event_id = ?");
    mysqli_stmt_bind_param($check, "ii", $user_id, $event_id);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        $_SESSION["message"] = "You are already enrolled in this event.";
        $_SESSION["message_type"] = "error";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO enrollments (user_id, event_id, game_username, team_name, team_members, enrolled_at) VALUES (?, ?, ?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "iisss", $user_id, $event_id, $game_username, $team_name, $team_members);
        $saved = mysqli_stmt_execute($stmt);
        $_SESSION["message"] = $saved ? "Event enrollment successful." : "Enrollment failed.";
        $_SESSION["message_type"] = $saved ? "success" : "error";
    }
    header("Location: events.php");
    exit();
}

include __DIR__ . "/includes/header.php";
$events = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date ASC");
?>
<main class="container">
    <section style="padding: 40px 0;">
        <div class="section-header">
            <span class="section-tag">Tournaments & Scrims</span>
            <h2 class="section-title">All Club Events</h2>
            <p style="margin-top: 15px; max-width: 600px; margin-left: auto; margin-right: auto;">Explore our roster of tournaments, gaming nights, and casual student meetups.</p>
        </div>
        <?php flash_message(); ?>
        <div class="events-grid" style="margin-top: 40px;">
            <?php while ($event = mysqli_fetch_assoc($events)): ?>
                <div class="event-card">
                    <div class="event-img-wrapper">
                        <div class="member-avatar-placeholder" style="border-radius: 0; font-size: 3rem;"><?php echo h(substr($event["game_name"], 0, 4)); ?></div>
                        <span class="event-badge badge <?php echo badge_class($event["status"]); ?>"><?php echo h(ucfirst($event["status"])); ?></span>
                    </div>
                    <div class="event-body">
                        <span class="event-game"><?php echo h($event["game_name"]); ?></span>
                        <h3 class="event-title"><?php echo h($event["event_name"]); ?></h3>
                        <ul class="event-meta">
                            <li><i>*</i> <?php echo h(format_date_value($event["event_date"])); ?></li>
                            <li><i>*</i> <?php echo h(format_time_value($event["event_time"])); ?></li>
                            <li><i>*</i> <?php echo h($event["venue"]); ?></li>
                        </ul>
                        <p style="font-size: 0.85rem; color: var(--color-text-gray); margin-bottom: 20px;"><?php echo h($event["description"]); ?></p>
                        <div class="event-footer">
                            <div class="event-prize">Prize Pool<span><?php echo h($event["prize"]); ?></span></div>
                            <?php if (empty($_SESSION["user_id"])): ?>
                                <a href="login.php" class="btn btn-primary btn-sm">Login to Enroll</a>
                            <?php elseif (($_SESSION["role"] ?? "") === "user" && strtolower($event["status"]) === "open"): ?>
                                <form action="events.php" method="POST" style="display: grid; gap: 8px;">
                                    <input type="hidden" name="event_id" value="<?php echo (int)$event["id"]; ?>">
                                    <input type="text" name="game_username" class="form-control" placeholder="Game username">
                                    <input type="text" name="team_name" class="form-control" placeholder="Team name">
                                    <textarea name="team_members" class="form-control" placeholder="Team members"></textarea>
                                    <button type="submit" class="btn btn-primary btn-sm">Enroll</button>
                                </form>
                            <?php elseif (($_SESSION["role"] ?? "") === "admin"): ?>
                                <a href="admin/manage_events.php" class="btn btn-secondary btn-sm">Manage</a>
                            <?php else: ?>
                                <a href="user/event_details.php?id=<?php echo (int)$event["id"]; ?>" class="btn btn-secondary btn-sm">Details</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>
<?php include __DIR__ . "/includes/footer.php"; ?>
