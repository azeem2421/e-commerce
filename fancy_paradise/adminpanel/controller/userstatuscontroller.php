<?php
include '../model/connection.php';

if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];


        $sql="SELECT * FROM tbl_adminlogin WHERE admin_id='$admin_id'";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
    

    if ($row['status']==='Active') {
        // Update the status in the database
             $sql2 = "UPDATE tbl_adminlogin SET status = 'Deactive' WHERE admin_id = '$admin_id'";
             $res2 = mysqli_query($conn, $sql2);
        echo '<script type="text/javascript">alert("Deactivated User"); window.location.href="../view/users.php";</script>';
    } else {
            $sql3 = "UPDATE tbl_adminlogin SET status = 'Active' WHERE admin_id = '$admin_id'";
            $res3 = mysqli_query($conn, $sql3);
            echo '<script type="text/javascript">alert("Activated User"); window.location.href="../view/users.php";</script>';
    }
}else{
    echo '<script type="text/javascript">alert("Failed to update status."); window.location.href="../view/users.php";</script>';
}
?>
