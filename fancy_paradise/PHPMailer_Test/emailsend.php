<html>
<head>
</head>

<body>
<h3> Sample for Email Sending with PHP Mailer </h3>
</body>
</html>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.ceylondev.lk';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'testemail@ceylondev.lk';                     //SMTP username
    $mail->Password   = 'TeSt@2022';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@ceylondev.lk', 'JFC');
    $mail->addAddress('kdtrangana@gmail.com', 'K.D. T.Rangana');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('sales@ceylondev.lk', 'More Information');
  

    //Attachments
    $mail->addAttachment('module_image/user.png');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	
	$html="<table border='1' width='500' align='center'><tr><th colspan='4'>"
        . "<h4><img src='../system/images/rangalogo.jpg' width='150' height='auto' /> &nbsp; Ranga Shoppimg Centre </h4>"
        . "</th></tr>"
        . "<tr><th colspan='4'>Invoice </th></tr>"
        . "<tr><td>Order Reference Id:</td><td colspan='4'></td></tr>"
        . "<tr><td>Customer Name</td><td></td>"
        . "<td>Customer NIC</td><td></td></tr>"
        . "<tr><td>Order Date </td><td></td>"
        . "<td>Order Amount</td><td></td></tr>"           
        . "<tr><td>Product Image </td><td> Model Number</td>"
        . "<td>Quantity</td><td> Price</td></tr>";          
        

        
        $html.= "</table>";

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your Order has been Completed';
    $mail->Body    = $html;
    //$mail->AltBody = $html;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}