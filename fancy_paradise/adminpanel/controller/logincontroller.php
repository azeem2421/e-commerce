<?php
include('../model/connection.php');
if (!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set("Asia/Colombo");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are not empty
    if (empty($username) || empty($password)) {
        echo '<script type="text/javascript">';
        echo 'alert("USERNAME OR PASSWORD FIELD IS EMPTY");';
        echo 'window.location.href = "../view/admin_login.php";';
        echo '</script>';
        exit();
    }
    
    
  $sql = "SELECT ul.*, u.adminuser_id, u.firstname, u.lastname, r.role_id
        FROM tbl_adminlogin ul
        INNER JOIN tbl_adminuser u ON u.adminuser_id = ul.admin_id
        INNER JOIN tbl_role r ON r.role_id = u.role_id
        WHERE ul.username = '$username' AND ul.password = SHA1('$password')";


    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);

    if ($count == 0) {
        $errorMessage = 'USERNAME OR PASSWORD DID NOT MATCH.';

        echo '<script type="text/javascript">';
        echo 'alert("' . $errorMessage . '");';
        echo 'window.location.href = "../view/admin_login.php";';
        echo '</script>';
        exit();
    } elseif ($row['status'] == 'Deactive') {
        echo '<script type="text/javascript">';
        echo 'alert("Your Account has been DEACTIVATED. Please Contact System Administrator");';
        echo 'window.location.href = "../view/admin_login.php";';
        echo '</script>';
        exit();
    } elseif ($count == 1) {
        $_SESSION['adminuser_id'] = $row['adminuser_id'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['role_id'] = $row['role_id'];

        // Fetch module IDs
        $moduleSql = "SELECT module_id FROM tbl_module_role WHERE role_id = " . $row['role_id'];
        $moduleRes = mysqli_query($conn, $moduleSql);

        $module_ids = array();
        while ($module_row = mysqli_fetch_assoc($moduleRes)) {
            $module_ids[] = $module_row['module_id'];
        }
        $_SESSION['module_ids'] = $module_ids;

        // Insert user log into the database
        $login_datetime = date('Y-m-d H:i:s');
        $login_ip = $_SERVER['REMOTE_ADDR'];
        $login_status = 'Logged In';
        $login_user_id = $row['adminuser_id'];

        $log_sql = "INSERT INTO tbl_userlog (login_datetime, login_ip, login_status, adminuser_id) 
                    VALUES ('$login_datetime', '$login_ip', '$login_status', '$login_user_id')";

        mysqli_query($conn, $log_sql);

        echo '<script type="text/javascript">';
        echo 'alert("WELCOME");';
        echo 'window.location.href = "../view/dashboard.php";';                        
        echo '</script>';
        exit();
    }
}
?>
