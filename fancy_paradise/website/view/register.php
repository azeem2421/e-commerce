<?php include('../../adminpanel/model/connection.php'); ?>

<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $telephone_no = $_POST['telephone_no'];
    $email = $_POST['email'];
    $telephone_no = $_POST['telephone_no'];
    $password = $_POST['password'];

    // Check if the customer already exists with the given phone number and email address
    $sql = "SELECT * FROM tbl_customer WHERE telephone_no = '$telephone_no' AND email = '$email'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 0) {
        // Prepare and execute the SQL statement to insert values into the customer table
        $sql2 = "INSERT INTO tbl_customer (title, first_name, last_name, address, telephone_no, email, status, added_datetime)
                  VALUES ('$title', '$first_name', '$last_name', '$address', '$telephone_no', '$email', 'Active', NOW())";

        if (mysqli_query($conn, $sql2)) {
            echo '<script>alert("Registration successful!");</script>';
            echo '<script>window.location.href = "user_login.php";</script>';
            exit();
        } else {
            echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
            echo '<script>window.location.href = "user_login.php";</script>';
        }
    } else {
        // Customer already exists
        echo '<script>alert("User already exists. Please login.");</script>';
        echo '<script>window.location.href = "user_login.php";</script>';
    }
}
?>
