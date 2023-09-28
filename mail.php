

<?php
$connect = mysqli_connect('localhost', 'root', '');
mysqli_select_db($connect, 'reg');
$email = $_REQUEST['email'];
$query = mysqli_query($connect, "select * from register where email='$email'");
$row = mysqli_fetch_array($query);

require 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer();

//Enable SMTP debugging.
$mail->SMTPDebug = 1;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = 'smtp.gmail.com';
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
    ],
];
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = 'abhis.webdesigns@gmail.com';
$mail->Password = 'tbfpkagfqwwdppyl';
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = 'false';
$mail->Port = 587;
//Set TCP port to connect to

$mail->From = 'phptutorial03@gmail.com';
$mail->FromName = 'jignesh';

$mail->addAddress('abhis.webdesigns@gmail.com');

$mail->isHTML(true);

$mail->Subject = 'test mail';
$mail->Body = '<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Car Rental</title>
  <style>
    body {
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
    }
    .container {
      width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 5px;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .message {
      font-size: 16px;
      line-height: 1.5;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4caf50;
      color: #ffffff;
      text-decoration: none;
      border-radius: 3px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Welcome to Car Rental</h1>
    </div>
    <div class="message">
      <p>Dear Customer,</p>
      <p>Thank you for choosing our car rental services. We are delighted to have you as our valued customer.</p>
      <p>With our wide range of vehicles and competitive prices, we strive to provide you with the best car rental experience.</p>
      <p>Click the button below to browse our available cars and make a reservation:</p>
      <p><a href="#" class="button">Browse Cars</a></p>
      <p>If you have any questions or need assistance, please don`t hesitate to contact our friendly customer support team.</p>
      <p>We look forward to serving you!</p>
      <p>Best regards,</p>
      <p>The Car Rental Team</p>
    </div>
  </div>
</body>
</html>';
$mail->AltBody = 'This is the plain text version of the email content';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent successfully';
}

