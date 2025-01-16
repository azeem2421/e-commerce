<?php
require_once '../../adminpanel/model/connection.php';
session_start();

$email = $_POST["email"];
$password = $_POST["password"];



$sql = "SELECT * FROM tbl_cuslogin WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

if (mysqli_num_rows($result) == 1) {
    // Login successful
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['user_id'] = $user_id;

    ?>
    <script>
        alert('Login Success');
        window.location.href = 'index.php'; // Redirect to the desired page
    </script>
    <?php
} else {
    ?>
    <script>
        alert('Login Failed');
        window.location.href = 'index.php'; // Redirect to the login page
    </script>
    <?php
}
?>
