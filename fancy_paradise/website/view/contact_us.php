<?php
require '../../PHPMailer_Test/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>

<!-- Header Section Starts Here -->
<?php include('header.php'); ?>
<!-- Header Section Ends Here -->

<style>
    <?php
    include('css/style.css');
    include('css/header.css');
    include('css/footer.css');
    ?>
</style>
<!-- Navbar Section Ends Here -->

<!-- Contact us Section Starts here -->
<section class="container">
    <h2 class="text-center">Contact Us</h2>
    <div class="contact_us">
        <div class="map_container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.3081941638666!2d79.86330317587844!3d6.8536132192373325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25bcb56bccf2f%3A0x8bf52342a90d9513!2sFancy%20Paradise!5e0!3m2!1sen!2slk!4v1686080240511!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="contactus_form">
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="phone">Phone Number:</label><br>
                <input type="tel" id="phone" name="phone" required><br><br>

                <label for="message">Message:</label><br>
                <textarea id="message" name="address" rows="5" required></textarea><br><br>

                <input type="submit" value="Submit" class="submitInquiry">
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Contact us Section Ends here -->

<!-- Footer Section Starts Here -->
<?php include('footer.php'); ?>
<!-- Footer Section Ends Here -->

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Prepare the SQL statement
    $sql = "INSERT INTO tbl_messages (name, email, phone, message, date, time, message_status) VALUES ('$name', '$email', '$phone', '$message', NOW(), NOW(), 'Pending')";
    $res = mysqli_query($conn, $sql);
    // Execute the SQL statement
    if ($res === TRUE) {
        // Send email confirmation
        $mail = new PHPMailer(true); // Pass true to enable exceptions

        try {
            // Enable verbose debugging (optional)
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to SMTP::DEBUG_SERVER for detailed debugging

            // Set the mailer to use SMTP
            $mail->isSMTP();

            // SMTP settings
            $mail->isSMTP();
            $mail->Host       = 'mail.ceylondev.lk';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'testemail@ceylondev.lk';
            $mail->Password   = 'TeSt@2022';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('info@ceylondev.lk', 'Fancy Paradise');
            $mail->addAddress($email, $name);
            $mail->addReplyTo('fancyparadiseofficial@gmail.com', 'More Information');

            // Set email content
            $mail->isHTML(true); // Set to true for HTML email content
            $mail->Subject = 'Thanks For Your Inquiry';

            $mail->Body = "Dear $name,<br><br>";
            $mail->Body .= "Thank you for your inquiry. We have received your message and will get back to you soon.<br><br>";
            $mail->Body .= '<img src="cid:logo" alt="Company Logo" style="display:block; max-width: 200px;" border="0">';
            $mail->Body .= "<br><br>Best regards,<br>Fancy Paradise";

            $logoPath = '../view/assets/logo.jpg';
            $mail->addEmbeddedImage($logoPath, 'logo');

            // Send the email
            $mail->send();

            // Set success flag in session
            $_SESSION['inquiry_success'] = true;

        } catch (Exception $e) {
            // Log error or handle it as needed
            error_log("Email sending failed: " . $mail->ErrorInfo);
            
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<script>
    <?php
    // Check if success flag is set in session
    if (isset($_SESSION['inquiry_success']) && $_SESSION['inquiry_success']) {
        // Display success message using Swal.fire
        echo 'Swal.fire("Good job!", "Inquiry submitted successfully!", "success");';

        // Unset the success flag in session
        unset($_SESSION['inquiry_success']);
    }
    ?>
</script>
