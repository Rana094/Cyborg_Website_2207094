<?php
require_once __DIR__ . "/helpers.php";
$page_title = $page_title ?? "Cyborg Gaming Club";
$extra_css = $extra_css ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($page_title); ?></title>
    <link rel="stylesheet" href="<?php echo url_path('assets/css/main.css'); ?>">
    <?php foreach ($extra_css as $css_file): ?>
        <link rel="stylesheet" href="<?php echo url_path('assets/css/' . $css_file); ?>">
    <?php endforeach; ?>
    <?php if (!empty($inline_style)): ?>
        <style><?php echo $inline_style; ?></style>
    <?php endif; ?>
</head>
<body>
<header>
    <div class="container navbar">
        <a href="<?php echo url_path('index.php'); ?>" class="nav-brand">
            <img src="<?php echo url_path('assets/images/logo.png'); ?>" alt="Cyborg Gaming Club Logo" class="nav-logo">
            <span class="nav-title">Cyborg</span>
        </a>

        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="<?php echo url_path('index.php'); ?>">Home</a></li>
            <li class="nav-item"><a href="<?php echo url_path('about.php'); ?>">About</a></li>
            <li class="nav-item"><a href="<?php echo url_path('events.php'); ?>">Events</a></li>
            <li class="nav-item"><a href="<?php echo url_path('committee.php'); ?>">Committee</a></li>
            <li class="nav-item"><a href="<?php echo url_path('contact.php'); ?>">Contact</a></li>
            <li class="nav-auth-mobile">
                <?php if (!empty($_SESSION["user_id"]) && ($_SESSION["role"] ?? "") === "admin"): ?>
                    <a href="<?php echo url_path('admin/dashboard.php'); ?>" class="btn btn-secondary">Admin Dashboard</a>
                    <a href="<?php echo url_path('logout.php'); ?>" class="btn btn-primary">Logout</a>
                <?php elseif (!empty($_SESSION["user_id"])): ?>
                    <a href="<?php echo url_path('user/dashboard.php'); ?>" class="btn btn-secondary">Dashboard</a>
                    <a href="<?php echo url_path('user/my_events.php'); ?>" class="btn btn-secondary">My Events</a>
                    <a href="<?php echo url_path('logout.php'); ?>" class="btn btn-primary">Logout</a>
                <?php else: ?>
                    <a href="<?php echo url_path('login.php'); ?>" class="btn btn-secondary">Login</a>
                    <a href="<?php echo url_path('signup.php'); ?>" class="btn btn-primary">Signup</a>
                <?php endif; ?>
            </li>
        </ul>

        <div class="nav-auth">
            <?php if (!empty($_SESSION["user_id"]) && ($_SESSION["role"] ?? "") === "admin"): ?>
                <a href="<?php echo url_path('admin/dashboard.php'); ?>" class="btn btn-secondary btn-sm">Admin Dashboard</a>
                <a href="<?php echo url_path('logout.php'); ?>" class="btn btn-primary btn-sm">Logout</a>
            <?php elseif (!empty($_SESSION["user_id"])): ?>
                <a href="<?php echo url_path('user/dashboard.php'); ?>" class="btn btn-secondary btn-sm">Dashboard</a>
                <a href="<?php echo url_path('user/my_events.php'); ?>" class="btn btn-secondary btn-sm">My Events</a>
                <a href="<?php echo url_path('logout.php'); ?>" class="btn btn-primary btn-sm">Logout</a>
            <?php else: ?>
                <a href="<?php echo url_path('login.php'); ?>" class="btn btn-secondary btn-sm">Login</a>
                <a href="<?php echo url_path('signup.php'); ?>" class="btn btn-primary btn-sm">Signup</a>
            <?php endif; ?>
        </div>
    </div>
</header>
