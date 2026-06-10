<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "View Messages | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";
$messages = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY created_at DESC");
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content">
    <div class="db-header"><div><h1 class="db-title">Contact Messages</h1><p class="db-subtitle">Messages submitted from the contact form.</p></div></div>
    <div class="db-panel"><div class="table-responsive" style="margin-top:0;border:none;"><table class="data-table"><thead><tr><th>Name</th><th>Email</th><th>Message</th><th>Submitted</th></tr></thead><tbody>
    <?php while ($message = mysqli_fetch_assoc($messages)): ?><tr><td><?php echo h($message["name"]); ?></td><td><?php echo h($message["email"]); ?></td><td><?php echo h($message["message"]); ?></td><td><?php echo h($message["created_at"]); ?></td></tr><?php endwhile; ?>
    </tbody></table></div></div>
</main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
