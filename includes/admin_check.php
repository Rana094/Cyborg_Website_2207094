<?php
require_once __DIR__ . "/db.php";
require_once __DIR__ . "/helpers.php";

if (empty($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") {
    header("Location: " . url_path("login.php"));
    exit();
}
?>
