<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Add Fixture | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = mysqli_prepare($conn, "INSERT INTO fixtures (event_id, round_name, team_one, team_two, match_date, match_time, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "issssss", $_POST["event_id"], $_POST["round_name"], $_POST["team_one"], $_POST["team_two"], $_POST["match_date"], $_POST["match_time"], $_POST["status"]);
    $_SESSION["message"] = mysqli_stmt_execute($stmt) ? "Fixture added." : "Fixture add failed.";
    $_SESSION["message_type"] = "success";
    header("Location: manage_fixtures.php");
    exit();
}
include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content"><div class="db-header"><div><h1 class="db-title">Add Fixture</h1></div></div><?php include __DIR__ . "/fixture_form.php"; ?></main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
