<?php	
	include('../controller/login_check.php');
	include('../model/connection.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageId = $_POST['message_id'];
    
    $sql = "UPDATE tbl_messages SET message_status = 'Replied' WHERE message_id = '$messageId'";
    $res = mysqli_query($conn, $sql);
    
    if ($res) {
        echo '<script>alert("Success"); window.location.href = "../view/messages.php";</script>';

    } else {
        echo '<script>alert("Error"); window.location.href = "../view/messages.php";</script>';
    }
}
?>
