<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Edit Event | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = mysqli_prepare($conn, "UPDATE events SET event_name=?, game_name=?, event_date=?, event_time=?, venue=?, description=?, rules=?, prize=?, status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssssssssi", $_POST["event_name"], $_POST["game_name"], $_POST["event_date"], $_POST["event_time"], $_POST["venue"], $_POST["description"], $_POST["rules"], $_POST["prize"], $_POST["status"], $id);
    $_SESSION["message"] = mysqli_stmt_execute($stmt) ? "Event updated successfully." : "Event update failed.";
    $_SESSION["message_type"] = "success";
    header("Location: manage_events.php");
    exit();
}
$stmt = mysqli_prepare($conn, "SELECT * FROM events WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$event = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content"><div class="db-header"><div><h1 class="db-title">Edit Event</h1></div></div><?php include __DIR__ . "/event_form.php"; ?></main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
