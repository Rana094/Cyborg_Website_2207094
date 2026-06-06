<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Edit Fixture | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = mysqli_prepare($conn, "UPDATE fixtures SET event_id=?, round_name=?, team_one=?, team_two=?, match_date=?, match_time=?, status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "issssssi", $_POST["event_id"], $_POST["round_name"], $_POST["team_one"], $_POST["team_two"], $_POST["match_date"], $_POST["match_time"], $_POST["status"], $id);
    $_SESSION["message"] = mysqli_stmt_execute($stmt) ? "Fixture updated." : "Fixture update failed.";
    $_SESSION["message_type"] = "success";
    header("Location: manage_fixtures.php");
    exit();
}
$stmt = mysqli_prepare($conn, "SELECT * FROM fixtures WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$fixture = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content"><div class="db-header"><div><h1 class="db-title">Edit Fixture</h1></div></div><?php include __DIR__ . "/fixture_form.php"; ?></main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
