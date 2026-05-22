<aside class="db-sidebar">
    <div class="db-profile-card">
        <div class="db-profile-avatar"><?php echo h(strtoupper(substr($_SESSION["full_name"] ?? "U", 0, 1))); ?></div>
        <div class="db-profile-name"><?php echo h($_SESSION["full_name"] ?? "User"); ?></div>
        <div class="db-profile-role">Registered User</div>
    </div>
    <ul class="db-menu">
        <li class="db-menu-item"><a href="<?php echo url_path('user/dashboard.php'); ?>"><i>*</i> Dashboard</a></li>
        <li class="db-menu-item"><a href="<?php echo url_path('user/profile.php'); ?>"><i>*</i> My Profile</a></li>
        <li class="db-menu-item"><a href="<?php echo url_path('user/my_events.php'); ?>"><i>*</i> Enrolled Events</a></li>
        <li class="db-menu-item"><a href="<?php echo url_path('user/fixture.php'); ?>"><i>*</i> View Fixtures</a></li>
        <li class="db-menu-item" style="margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 15px;"><a href="<?php echo url_path('logout.php'); ?>"><i>*</i> Logout</a></li>
    </ul>
</aside>
