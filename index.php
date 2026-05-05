<?php
require_once __DIR__ . "/includes/db.php";
$page_title = "Home | Cyborg Gaming Club";
$extra_css = ["home_styles.css"];
include __DIR__ . "/includes/header.php";

$featured = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date ASC LIMIT 3");
$committee_preview = mysqli_query($conn, "SELECT * FROM committee ORDER BY id ASC LIMIT 3");
?>
<main>
    <section class="hero">
        <div class="container hero-content">
            <span class="hero-subtitle">University Esports Hub</span>
            <h1 class="hero-title">Level Up Your Campus<br><span>Gaming Experience</span></h1>
            <p class="hero-description">Cyborg Gaming Club is a university-based gaming community where students can join tournaments, meet gamers, compete in esports events, and build teamwork through gaming.</p>
            <div class="hero-actions">
                <a href="<?php echo url_path('signup.php'); ?>" class="btn btn-primary">Join Now</a>
                <a href="<?php echo url_path('events.php'); ?>" class="btn btn-secondary">View Events</a>
            </div>
        </div>
    </section>

    <section class="intro-section">
        <div class="container intro-grid">
            <div class="intro-text">
                <span class="section-tag">Who We Are</span>
                <h3 style="font-family: var(--font-heading); color: var(--color-text-white); font-size: 1.8rem; margin-bottom: 20px;">Welcome to Cyborg Gaming Club</h3>
                <p>Founded with a passion for gaming, the Cyborg Gaming Club is the official hub for collegiate esports and casual gaming on campus.</p>
                <p>Whether you are a competitive player or a casual gamer looking to de-stress after classes, we have a place for you.</p>
                <div class="intro-stats">
                    <div class="stat-item"><span class="stat-number">500+</span><span class="stat-label">Active Members</span></div>
                    <div class="stat-item"><span class="stat-number">12+</span><span class="stat-label">Tournaments Yearly</span></div>
                    <div class="stat-item"><span class="stat-number">$5k+</span><span class="stat-label">Prize Pools Distributed</span></div>
                </div>
            </div>
            <div class="intro-media">
                <div class="intro-img-wrapper">
                    <img src="<?php echo url_path('assets/images/logo.png'); ?>" alt="Gaming Setup" class="intro-img" style="padding: 40px; background-color: var(--bg-card); width: 400px;">
                </div>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <div class="section-header"><span class="section-tag">Benefits</span><h2 class="section-title">Why Join Cyborg?</h2></div>
            <div class="features-grid">
                <div class="feature-card"><div class="feature-icon">*</div><h3>Esports Tournaments</h3><p>Compete in organized tournaments across popular games with prizes and trophies.</p></div>
                <div class="feature-card"><div class="feature-icon">*</div><h3>Active Community</h3><p>Meet gaming enthusiasts, find teammates, and attend local gaming nights.</p></div>
                <div class="feature-card"><div class="feature-icon">*</div><h3>Skill Growth</h3><p>Participate in scrims, learn strategies, and represent the university.</p></div>
            </div>
        </div>
    </section>

    <section class="events-section">
        <div class="container">
            <div class="section-header"><span class="section-tag">Get Active</span><h2 class="section-title">Featured Tournaments</h2></div>
            <div class="events-grid">
                <?php while ($event = mysqli_fetch_assoc($featured)): ?>
                    <div class="event-card">
                        <div class="event-img-wrapper">
                            <div class="member-avatar-placeholder" style="border-radius: 0; font-size: 3rem;"><?php echo h(substr($event["game_name"], 0, 4)); ?></div>
                            <span class="event-badge badge <?php echo badge_class($event["status"]); ?>"><?php echo h(ucfirst($event["status"])); ?></span>
                        </div>
                        <div class="event-body">
                            <span class="event-game"><?php echo h($event["game_name"]); ?></span>
                            <h3 class="event-title"><?php echo h($event["event_name"]); ?></h3>
                            <ul class="event-meta">
                                <li><i>*</i> <?php echo h(format_date_value($event["event_date"])); ?></li>
                                <li><i>*</i> <?php echo h(format_time_value($event["event_time"])); ?></li>
                                <li><i>*</i> <?php echo h($event["venue"]); ?></li>
                            </ul>
                            <div class="event-footer">
                                <div class="event-prize">Prize Pool<span><?php echo h($event["prize"]); ?></span></div>
                                <a href="<?php echo url_path('events.php'); ?>" class="btn btn-primary btn-sm">Enroll / Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <section class="committee-section">
        <div class="container">
            <div class="section-header"><span class="section-tag">Leaders</span><h2 class="section-title">Committee Preview</h2></div>
            <div class="committee-preview-grid">
                <?php while ($member = mysqli_fetch_assoc($committee_preview)): ?>
                    <div class="committee-card">
                        <div class="committee-avatar"><img src="<?php echo url_path('assets/images/' . h($member["image"])); ?>" alt="<?php echo h($member["name"]); ?>"></div>
                        <h3 class="committee-name"><?php echo h($member["name"]); ?></h3>
                        <div class="committee-position"><?php echo h($member["position"]); ?></div>
                        <p class="committee-dept"><?php echo h($member["department"]); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</main>
<?php include __DIR__ . "/includes/footer.php"; ?>
