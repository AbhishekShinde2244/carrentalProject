<?php
error_reporting();
require './PHPMailer-master/PHPMailerAutoload.php';

if (isset($_POST['signup'])) {
    $fname = $_POST['fullname'];
    $email = $_POST['emailid'];
    $mobile = $_POST['mobileno'];
    $password = md5($_POST['password']);
    $sql =
        'INSERT INTO  tblusers(FullName,EmailId,ContactNo,Password) VALUES(:fname,:email,:mobile,:password)';
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Registration successfull. Now you can login');</script>";

        $mail = new PHPMailer();
        //Enable SMTP debugging.
        $mail->SMTPDebug = 0;
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

        $mail->From = 'team@carrental.com';
        $mail->FromName = 'Shamal';

        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = 'Welcome';
        $mail->Body =
            '<!DOCTYPE html>
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
      <p>Dear ' .
            $fname .
            ',</p>
      <p>Thank you for choosing our car rental services. We are delighted to have you as our valued customer.</p>
      <p>With our wide range of vehicles and competitive prices, we strive to provide you with the best car rental experience.</p>
      <p>Click the button below to browse our available cars and make a reservation:</p>
      <p><a href="localhost/carrental" class="button">Browse Cars</a></p>
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
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
?>


<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>