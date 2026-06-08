<?php
require_once __DIR__ . "/../includes/admin_check.php";
$page_title = "Manage Committee | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/../includes/header.php";
$members = mysqli_query($conn, "SELECT * FROM committee ORDER BY id ASC");
?>
<div class="dashboard-wrapper"><?php include __DIR__ . "/../includes/admin_sidebar.php"; ?><main class="db-content">
    <div class="db-header"><div><h1 class="db-title">Manage Committee</h1></div><a href="add_committee.php" class="btn btn-primary btn-sm">Add Member</a></div>
    <?php flash_message(); ?>
    <div class="db-panel"><div class="table-responsive" style="margin-top:0;border:none;"><table class="data-table"><thead><tr><th>Name</th><th>Position</th><th>Section</th><th>Department</th><th>Favorite Game</th><th>Image</th><th>Actions</th></tr></thead><tbody>
    <?php while ($member = mysqli_fetch_assoc($members)): ?><tr><td><?php echo h($member["name"]); ?></td><td><?php echo h($member["position"]); ?></td><td><?php echo h(ucfirst($member["section"] ?? "additional")); ?></td><td><?php echo h($member["department"]); ?></td><td><?php echo h($member["favorite_game"]); ?></td><td><?php echo h($member["image"]); ?></td><td><div class="table-actions"><a class="btn btn-secondary btn-sm" href="edit_committee.php?id=<?php echo (int)$member["id"]; ?>">Edit</a><a class="btn btn-danger btn-sm" href="delete_committee.php?id=<?php echo (int)$member["id"]; ?>" onclick="return confirm('Delete this member?');">Delete</a></div></td></tr><?php endwhile; ?>
    </tbody></table></div></div>
</main></div><?php include __DIR__ . "/../includes/footer.php"; ?>
