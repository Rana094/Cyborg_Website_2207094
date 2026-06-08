<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Edit Committee Member | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = mysqli_prepare($conn, "UPDATE committee SET name=?, position=?, section=?, department=?, favorite_game=?, image=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssssssi", $_POST["name"], $_POST["position"], $_POST["section"], $_POST["department"], $_POST["favorite_game"], $_POST["image"], $id);
    $_SESSION["message"] = mysqli_stmt_execute($stmt) ? "Committee member updated." : "Committee update failed.";
    $_SESSION["message_type"] = "success";
    header("Location: manage_committee.php");
    exit();
}
$stmt = mysqli_prepare($conn, "SELECT * FROM committee WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$member = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
include __DIR__ . "/../includes/header.php";
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content"><div class="db-header"><div><h1 class="db-title">Edit Committee Member</h1></div></div><?php include __DIR__ . "/committee_form.php"; ?></main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
