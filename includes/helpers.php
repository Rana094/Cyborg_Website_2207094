<?php
function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

function url_path($path = "") {
    $script_dir = str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"] ?? ""));
    if (preg_match("#/(user|admin)$#", $script_dir)) {
        $script_dir = dirname($script_dir);
    }
    $base = rtrim($script_dir, "/");
    return $base . "/" . ltrim($path, "/");
}

function badge_class($status) {
    $status = strtolower((string)$status);
    if ($status === "open" || $status === "active") {
        return "badge-active";
    }
    if ($status === "finished" || $status === "closed" || $status === "completed") {
        return "badge-finished";
    }
    return "badge-upcoming";
}

function format_date_value($date) {
    if (!$date) {
        return "";
    }
    return date("F d, Y", strtotime($date));
}

function format_time_value($time) {
    if (!$time) {
        return "";
    }
    return date("h:i A", strtotime($time));
}

function flash_message() {
    if (!empty($_SESSION["message"])) {
        $type = !empty($_SESSION["message_type"]) ? $_SESSION["message_type"] : "success";
        $color = $type === "error" ? "#ff4d6d" : "var(--color-primary)";
        echo '<div style="border:1px solid ' . $color . '; color:' . $color . '; padding:12px; border-radius:6px; margin-bottom:20px; background:rgba(255,255,255,0.03);">' . h($_SESSION["message"]) . '</div>';
        unset($_SESSION["message"], $_SESSION["message_type"]);
    }
}
?>
