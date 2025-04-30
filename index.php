<?php
include 'db.php';
$pageTitle = "Contact Form";
include 'header.php'; // Include the header

$message = ""; // Feedback message for user

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Honeypot check
    if (!empty($_POST['phone'])) {
        $message = "<p class='error'>Bot detected.</p>";
    } else {
        // Sanitize input
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $content = htmlspecialchars($_POST['message']);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "<p class='error'>Invalid email format.</p>";
        } else {
            // Validate email domain exists (MX record check)
            $domain = substr(strrchr($email, "@"), 1);
            if (!checkdnsrr($domain, "MX")) {
                $message = "<p class='error'>Invalid email domain.</p>";
            } else {
                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO contacts (name, email, message, date_submitted) VALUES (?, ?, ?, NOW())");
                $stmt->bind_param("sss", $name, $email, $content);

                if ($stmt->execute()) {
                    $message = "<p class='success'>Message sent successfully.</p>";
                } else {
                    $message = "<p class='error'>Error: " . htmlspecialchars($stmt->error) . "</p>";
                }

                $stmt->close();
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Contact Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form method="POST" action="">

            <div class="contact-info">
                <div class="field">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
            </div>

            <div class="field">
                <label>Message</label>
                <textarea name="message" required></textarea>
            </div>

            <!-- Honeypot field (hidden from real users) -->
            <input type="text" name="phone" style="display:none">

            <button type="submit">Submit</button>
        </form>
        <?php if (!empty($message)) {
            echo $message;
        } ?>
    </div>
</body>

</html>