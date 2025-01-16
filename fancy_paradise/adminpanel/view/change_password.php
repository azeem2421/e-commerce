<!--------------------------Start Navigation-------------------------->
<?php
include "index.php";
?>
<style>
  <?php include "css/change_password.css"; ?>
</style>

<!--------------------------End Navigation-------------------------->

<main>
  <h1 class="sticky">CHANGE PASSWORD</h1>

  <?php
  if (isset($_GET['adminuser_id'])) {
    $id = $_GET['adminuser_id'];
  }
  ?>

  <!------------------------------ Change Password Form Starts ------------------------------>
  <div>
    <form action="" method="POST">
      <table>
        <tr>
          <td>Current Password: </td>
          <td>
            <input type="password" name="current_password" required>
          </td>
        </tr>

        <tr>
          <td>New Password: </td>
          <td>
            <input type="password" name="new_password" required>
          </td>
        </tr>

        <tr>
          <td>Confirm New Password: </td>
          <td>
            <input type="password" name="confirm_password" required>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="adminuser_id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Change Password" class="savebtn">
          </td>
        </tr>
      </table>
    </form>
  </div>

  <!------------------------------ Change Password Form Ends ------------------------------>
</main>
</div>

<!------------------------------ Button Click Functionality Starts ------------------------------>
<?php
if (isset($_POST['submit'])) {
  $id = $_POST['adminuser_id'];
  $current_password = sha1($_POST['current_password']);
  $new_password = sha1($_POST['new_password']);
  $confirm_password = sha1($_POST['confirm_password']);

  $sql = "SELECT * FROM tbl_adminlogin WHERE adminuser_id=$id";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
      $row = mysqli_fetch_assoc($res);
      $stored_password = $row['password'];

      if ($current_password == $stored_password) {
        if ($new_password == $confirm_password) {
          $update_sql = "UPDATE tbl_adminlogin SET password='$new_password' WHERE admin_id=$id";
          $update_res = mysqli_query($conn, $update_sql);

          if ($update_res == true) {
            echo '<script type="text/javascript">';
            echo 'alert("PASSWORD CHANGED SUCCESSFULLY");';
            echo 'window.location.href = "../view/users.php";';
            echo '</script>';
          } else {
            echo '<script type="text/javascript">';
            echo 'alert("FAILED TO UPDATE PASSWORD");';
            echo 'window.location.href = "../view/users.php";';
            echo '</script>';
          }
        } else {
          echo '<script type="text/javascript">';
          echo 'alert("NEW PASSWORD DID NOT MATCH");';
          echo '</script>';
        }
      } else {
        echo '<script type="text/javascript">';
        echo 'alert("INCORRECT CURRENT PASSWORD");';
        echo '</script>';
      }
    } else {
      echo '<script type="text/javascript">';
      echo 'alert("USER NOT FOUND");';
      echo '</script>';
    }
  }
}
?>
<!------------------------------ Button Click Functionality Ends ------------------------------>

</body>
</html>
