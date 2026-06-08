<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "localhost";
$username = "root";
$password = "";
$database = "cyborg_gaming_club";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

$committee_section_check = @mysqli_query($conn, "SHOW COLUMNS FROM committee LIKE 'section'");
if ($committee_section_check && mysqli_num_rows($committee_section_check) === 0) {
    @mysqli_query($conn, "ALTER TABLE committee ADD section VARCHAR(50) NOT NULL DEFAULT 'additional' AFTER position");
    @mysqli_query($conn, "UPDATE committee SET section = 'executive' WHERE LOWER(position) IN ('president', 'vice president')");
    @mysqli_query($conn, "UPDATE committee SET section = 'secretariat' WHERE LOWER(position) IN ('general secretary', 'treasurer')");
    @mysqli_query($conn, "UPDATE committee SET section = 'coordinators' WHERE LOWER(position) IN ('event coordinator', 'media lead', 'technical lead')");
}
?>
