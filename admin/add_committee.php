<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Add Committee Member | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = mysqli_prepare($conn, "INSERT INTO committee (name, position, section, department, favorite_game, image) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $_POST["name"], $_POST["position"], $_POST["section"], $_POST["department"], $_POST["favorite_game"], $_POST["image"]);
    $_SESSION["message"] = mysqli_stmt_execute($stmt) ? "Committee member added." : "Committee add failed.";
    $_SESSION["message_type"] = "success";
    header("Location: manage_committee.php");
    exit();
}
include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content"><div class="db-header"><div><h1 class="db-title">Add Committee Member</h1></div></div><?php include __DIR__ . "/committee_form.php"; ?></main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
