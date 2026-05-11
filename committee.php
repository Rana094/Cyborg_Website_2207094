<?php
require_once __DIR__ . "/includes/db.php";
$page_title = "Committee | Cyborg Gaming Club";
$extra_css = ["committee.css"];
include __DIR__ . "/includes/header.php";
$members_result = mysqli_query($conn, "SELECT * FROM committee ORDER BY id ASC");
$tiers = [
    "Executive Board" => [],
    "Secretariat & Treasury" => [],
    "Coordinators & Leads" => [],
    "Additional Members" => []
];

while ($member = mysqli_fetch_assoc($members_result)) {
    $section = strtolower($member["section"] ?? "");
    $position = strtolower($member["position"] ?? "");

    if ($section === "executive" || ($section === "" && ($position === "president" || $position === "vice president"))) {
        $tiers["Executive Board"][] = $member;
    } elseif ($section === "secretariat" || ($section === "" && ($position === "general secretary" || $position === "treasurer"))) {
        $tiers["Secretariat & Treasury"][] = $member;
    } elseif ($section === "coordinators" || ($section === "" && ($position === "event coordinator" || $position === "media lead" || $position === "technical lead"))) {
        $tiers["Coordinators & Leads"][] = $member;
    } else {
        $tiers["Additional Members"][] = $member;
    }
}

function render_committee_card($member) {
    ?>
    <div class="committee-member-card">
        <div class="member-avatar">
            <img src="<?php echo url_path('assets/images/' . h($member["image"])); ?>" alt="<?php echo h($member["name"]); ?>">
        </div>
        <h3 class="member-name"><?php echo h($member["name"]); ?></h3>
        <p class="member-position"><?php echo h($member["position"]); ?></p>
        <ul class="member-info-list">
            <li>Department: <span><?php echo h($member["department"]); ?></span></li>
            <li>Favorite Game: <span><?php echo h($member["favorite_game"]); ?></span></li>
        </ul>
    </div>
    <?php
}
?>
<main class="container committee-container">
    <div class="section-header">
        <span class="section-tag">Club Leaders</span>
        <h2 class="section-title">Committee Members</h2>
    </div>

    <section class="committee-tier" style="margin-top: 40px;">
        <h3 class="tier-title">Executive Board</h3>
        <div class="tier-1-grid">
            <?php foreach ($tiers["Executive Board"] as $member): ?>
                <?php render_committee_card($member); ?>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="committee-tier">
        <h3 class="tier-title">Secretariat & Treasury</h3>
        <div class="tier-2-grid">
            <?php foreach ($tiers["Secretariat & Treasury"] as $member): ?>
                <?php render_committee_card($member); ?>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="committee-tier">
        <h3 class="tier-title">Coordinators & Leads</h3>
        <div class="tier-3-grid">
            <?php foreach ($tiers["Coordinators & Leads"] as $member): ?>
                <?php render_committee_card($member); ?>
            <?php endforeach; ?>
        </div>
    </section>

    <?php if (count($tiers["Additional Members"]) > 0): ?>
        <section class="committee-tier">
            <h3 class="tier-title">Additional Members</h3>
            <div class="tier-4-grid">
                <?php foreach ($tiers["Additional Members"] as $member): ?>
                    <?php render_committee_card($member); ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php include __DIR__ . "/includes/footer.php"; ?>
