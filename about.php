<?php
require_once __DIR__ . "/includes/db.php";
$page_title = "About | Cyborg Gaming Club";
$extra_css = ["dashboard.css"];
include __DIR__ . "/includes/header.php";
?>
<main class="container" style="padding: 60px 0;">
    <div class="section-header">
        <span class="section-tag">About Us</span>
        <h2 class="section-title">Cyborg Gaming Club</h2>
    </div>
    <div class="db-grid" style="margin-top: 40px;">
        <div class="db-panel">
            <h3 class="db-panel-title">About The Club</h3>
            <p>Cyborg Gaming Club is a university gaming community for tournaments, casual matches, esports teamwork, and campus gaming culture.</p>
        </div>
        <div class="db-panel">
            <h3 class="db-panel-title">Mission</h3>
            <p>To create a friendly, competitive, and responsible gaming environment for students.</p>
        </div>
        <div class="db-panel">
            <h3 class="db-panel-title">Vision</h3>
            <p>To become a leading university esports club and represent our campus in inter-university competitions.</p>
        </div>
        <div class="db-panel">
            <h3 class="db-panel-title">Activities</h3>
            <p>Esports tournaments, friendly matches, gaming nights, inter-university competitions, and team competitions.</p>
        </div>
    </div>
    <!-- <div class="features-grid" style="margin-top: 30px;">
        <?php foreach (["Valorant", "PUBG Mobile", "FIFA/eFootball", "Mobile Legends", "CS2"] as $game): ?>
            <div class="feature-card"><h3><?php echo h($game); ?></h3><p>Supported game for club events and community matches.</p></div>
        <?php endforeach; ?>
    </div> -->
</main>
<?php include __DIR__ . "/includes/footer.php"; ?>
