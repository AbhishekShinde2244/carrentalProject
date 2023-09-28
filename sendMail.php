<?php
$to = 'recipient@example.com';
$subject = 'Test Email';
$message = 'This is a test email sent from PHP.';
$headers =
    'From: yourname@example.com' .
    "\r\n" .
    'Reply-To: yourname@example.com' .
    "\r\n" .
    'X-Mailer: PHP/' .
    phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully.';
} else {
    echo 'Email sending failed.';
}
?>
