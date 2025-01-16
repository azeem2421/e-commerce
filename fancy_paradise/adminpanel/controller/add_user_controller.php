<?php
include('../model/connection.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $response = array();

  // Get form data
  $title = $_POST['title'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $nic_number = $_POST['nic_number'];
  $dob = $_POST['dob'];
  $tel_number = $_POST['tel_number'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $role_id = $_POST['role_id'];

  // Check if NIC number already exists in tbl_adminuser
  $sql = "SELECT * FROM tbl_adminuser WHERE nic_number = '$nic_number'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $response['error'] = 'NIC number already exists. Please try a new NIC number.';
  } else {
    // Insert user into tbl_adminuser table
    $adminuser_id = $_SESSION['adminuser_id'];
    $sql2 = "INSERT INTO tbl_adminuser (title, firstname, lastname, nic_number, dob, tel_number, email, gender, address, role_id, created_date_time, created_by) 
            VALUES ('$title', '$firstname', '$lastname', '$nic_number', '$dob', '$tel_number', '$email', '$gender', '$address', '$role_id', NOW(), '$adminuser_id')";

    if (mysqli_query($conn, $sql2)) {
      $user_id = mysqli_insert_id($conn); // Get the auto-generated user ID
	  $nic_numberen = sha1($nic_number);

      // Insert user details into tbl_adminlogin table
      $sql3 = "INSERT INTO tbl_adminlogin (adminuser_id, username, password ,status) 
              VALUES ('$user_id', '$email', '$nic_numberen', 'Active')";

      if (mysqli_query($conn, $sql3)) {
        $response['message'] = 'User added successfully.';
        $response['resetForm'] = true;
      } else {
        $response['error'] = 'Failed to add user.';
      }
    } else {
      $response['error'] = 'Failed to add user.';
    }
  }

  // Send the response as JSON
  header('Content-Type: application/json');
  echo json_encode($response);
}

mysqli_close($conn);
?>
