<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Add Event | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = mysqli_prepare($conn, "INSERT INTO events (event_name, game_name, event_date, event_time, venue, description, rules, prize, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    mysqli_stmt_bind_param($stmt, "sssssssss", $_POST["event_name"], $_POST["game_name"], $_POST["event_date"], $_POST["event_time"], $_POST["venue"], $_POST["description"], $_POST["rules"], $_POST["prize"], $_POST["status"]);
    $_SESSION["message"] = mysqli_stmt_execute($stmt) ? "Event added successfully." : "Event add failed.";
    $_SESSION["message_type"] = "success";
    header("Location: manage_events.php");
    exit();
}
include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content"><div class="db-header"><div><h1 class="db-title">Add Event</h1></div></div><?php include __DIR__ . "/event_form.php"; ?></main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
