<?php
require_once __DIR__ . "/includes/db.php";
$page_title = "Contact Us | Cyborg Gaming Club";
$inline_style = ".contact-section { padding: 60px 0; } .contact-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 50px; } .contact-info-panel { background-color: var(--bg-card); border: 1px solid var(--border-color); padding: 40px; border-radius: 8px; } .contact-info-title { font-size: 1.5rem; margin-bottom: 25px; text-transform: uppercase; color: var(--color-primary); } .info-detail-item { margin-bottom: 25px; } .info-detail-label { font-size: 0.8rem; text-transform: uppercase; color: var(--color-secondary); margin-bottom: 5px; } .info-detail-value { font-size: 1.1rem; color: var(--color-text-white); font-weight: 500; } @media(max-width: 992px) { .contact-grid { grid-template-columns: 1fr; gap: 40px; } }";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {
        $_SESSION["message"] = "Please fill in all contact fields.";
        $_SESSION["message_type"] = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["message"] = "Please enter a valid email address.";
        $_SESSION["message_type"] = "error";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO contact_messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
        $saved = mysqli_stmt_execute($stmt);
        $_SESSION["message"] = $saved ? "Message submitted successfully." : "Message submission failed.";
        $_SESSION["message_type"] = $saved ? "success" : "error";
        header("Location: contact.php");
        exit();
    }
}

include __DIR__ . "/includes/header.php";
?>
<main class="container contact-section">
    <div class="section-header"><span class="section-tag">Reach Out</span><h2 class="section-title">Contact The Club</h2></div>
    <div class="contact-grid" style="margin-top: 40px;">
        <div class="form-container" style="max-width: 100%; margin: 0;">
            <h3 class="form-title" style="text-align: left; padding-bottom: 15px; margin-bottom: 25px; font-size: 1.4rem;">Send Us A Message</h3>
            <?php flash_message(); ?>
            <form id="contactForm" action="contact.php" method="POST">
                <div class="form-group"><label for="name" class="form-label">Full Name</label><input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name"></div>
                <div class="form-group"><label for="email" class="form-label">Email Address</label><input type="email" id="email" name="email" class="form-control" placeholder="Enter your student email"></div>
                <div class="form-group"><label for="message" class="form-label">Your Message</label><textarea id="message" name="message" class="form-control" placeholder="Type your inquiry, feedback, or suggestion here..."></textarea></div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Submit Message</button>
            </form>
        </div>
        <div class="contact-info-panel">
            <h3 class="contact-info-title">Club Details</h3>
            <div class="info-detail-item"><div class="info-detail-label">Office Location</div><div class="info-detail-value">Room 304, Student Activities Building, Main Campus</div></div>
            <div class="info-detail-item"><div class="info-detail-label">Email Support</div><div class="info-detail-value">info@cyborgclub.com<br>support@cyborgclub.com</div></div>
            <div class="info-detail-item"><div class="info-detail-label">Facebook Page</div><div class="info-detail-value"><a href="#" style="color: var(--color-primary);">facebook.com/cyborggamingclub</a></div></div>
            <div class="info-detail-item"><div class="info-detail-label">Discord Community</div><div class="info-detail-value"><a href="#" style="color: var(--color-secondary);">discord.gg/cyborgcampus</a></div></div>
        </div>
    </div>
</main>
<?php include __DIR__ . "/includes/footer.php"; ?>
