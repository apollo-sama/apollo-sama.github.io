<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mail Test</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

if(isset($_POST['submit']))
{

    $name=$_POST['name'];
    $email=$_POST['email'];
    $feedback=$_POST['feedback'];

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'example@gmail.com';                     //SMTP username
        $mail->Password   = 'example';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($_POST['email'],$_POST['name']);
        $mail->addAddress('example@gmail.com');     //Add a recipient 
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Customer Feedback';
        $mail->Body    = "Name: $name <br> Email: $email <br> Feedback: $feedback";
    
        $mail->send();
        echo "<script>alert('Message has been sent')</script>";

    } catch (Exception $e) {
        echo "<script>alert('Message could not be send: Mail report {$mail->ErrorInfo}')</sciprt>";
    }
}
?>
<div class="container">
    <form action="" method="post">
        <br>
        <h2>Test send email</h2>
        <br>
        <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <br>
        <div>
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
        <br>
        <div>
            <label for="feedback" class="form-label">Feedback</label>
            <input type="text" name="feedback" class="form-control" placeholder="Write Anything">
        </div>
        <br>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </form>
</div>
</body>
</html>