<!-- Success and Error Message Section Starts Here -->
<?php
if (isset($_GET['success']) && isset($_GET['message'])) {
    $success = $_GET['success'];
    $message = $_GET['message'];

    if ($success == 1) {
        echo '<div class="success-message" style="background-color: green; color: white; padding: 10px;">' . $message . '</div>';
    } else {
        echo '<div class="error-message" style="background-color: red; color: white; padding: 10px;">' . $message . '</div>';
    }

    // Remove the query parameters from the URL
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    echo "<script>window.location.href='$url';</script>";
}
?>
<!-- Success and Error Message Section Ends Here -->
