<?php
include "index.php";
?>
<style>
    <?php include "css/settings.css"; ?>
</style>

<main>
    <h1 class="sticky"><i class="fa fa-cogs"></i> Settings</h1>

    <form method="POST" action="../controller/settingscontroller.php" class="settingform">

  

        <?php
        // retrieve the list of roles
        $sql = "SELECT * FROM tbl_role";
        $res = mysqli_query($conn, $sql);

        
        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $role_id = $row['role_id'];
                $role_name = $row['role_name'];

                // Display the role name
                echo '<h2>' . $role_name . '</h2>';

                //  retrieve the list of all modules
                $sql2 = "SELECT * FROM tbl_module";
                $res2 = mysqli_query($conn, $sql2);

                // Check if the query was successful
                if ($res2 && mysqli_num_rows($res2) > 0) {
                    echo '<div class="module-list">';

                    
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $module_id = $row2['module_id'];
                        $module_name = $row2['name'];

                        //  tbl_module_role table to check if the role has access to the module
                        $sql3 = "SELECT * FROM tbl_module_role WHERE role_id = $role_id AND module_id = $module_id";
                        $res3 = mysqli_query($conn, $sql3);

                        
                        if ($res3 && mysqli_num_rows($res3) > 0) {
                            $checked = true;
                        } else {
                            $checked = false;
                        }

                        //  the checkbox 
                        echo '<label>';
                        echo '<input type="checkbox" name="module_privileges[' . $role_id . '][]" value="' . $module_id . '" ' . ($checked ? 'checked' : '') . '>';
                        echo $module_name;
                        echo '</label>';
                    }

                    echo '</div>';
                }
            }
        }
        ?>
    
        <input type="submit" name="save_settings" value="Save Settings" class="savesettingsbtn">
    </form>
</main>
</div>

</body>

</html>

