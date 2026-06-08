<?php
require_once __DIR__ . "/../includes/admin_check.php";
$id = (int)($_GET["id"] ?? 0);
$stmt = mysqli_prepare($conn, "DELETE FROM committee WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$_SESSION["message"] = "Committee member deleted.";
$_SESSION["message_type"] = "success";
header("Location: manage_committee.php");
exit();
?>
