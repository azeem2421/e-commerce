<?php
include('../../adminpanel/model/connection.php');
?>
<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {    
    
    // Retrieve the module_privileges from the form submission
    $module_privileges = $_POST['module_privileges'];

    
    foreach ($module_privileges as $role_id => $module_ids) {
        // Delete existing module privileges for the selected role
        $sql = "DELETE FROM tbl_module_role WHERE role_id = $role_id";
        $res = mysqli_query($conn, $sql);

        if (!$res) {
            $error = mysqli_error($conn);
            echo '<script>
                alert("Error occurred while deleting existing privileges: '.$error.'");
                window.location.href = "../view/settings.php";
            </script>';
            exit;
        }

        // Insert the updated module privileges into the tbl_modulerole table
        foreach ($module_ids as $module_id) {
            $sql2 = "INSERT INTO tbl_module_role (role_id, module_id) VALUES ($role_id, $module_id)";
            $res2 = mysqli_query($conn, $sql2);

            if (!$res2) {
                $error = mysqli_error($conn);
                echo '<script>
                    alert("Error occurred while updating privileges: '.$error.'");
                    window.location.href = "../view/settings.php";
                </script>';
                exit;
            }
        }
    }

    echo '<script>
        alert("Privileges updated successfully!");
        window.location.href = "../view/settings.php";
    </script>';
    exit;
}
?>
