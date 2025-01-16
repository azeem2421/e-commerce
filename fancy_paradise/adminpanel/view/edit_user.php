<!--------------------------Start Navigation-------------------------->
<?php
include "index.php";
?>
<style>
  <?php include "css/edit_user.css"; ?>
</style>

<!--------------------------End Navigation-------------------------->

<main>
  <h1 class="sticky">EDIT USER</h1>

  <?php
  $id = $_GET['adminuser_id'];

  $sql = "SELECT * FROM tbl_adminuser WHERE adminuser_id = $id";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
      $row = mysqli_fetch_assoc($res);

      $title = $row['title'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $nic_number = $row['nic_number'];
      $dob = $row['dob'];
      $tel_number = $row['tel_number'];
      $email = $row['email'];
      $address = $row['address'];
      $gender = $row['gender'];
      $role_id = $row['role_id'];
    } else {
      header('location: ' . SITEURL . 'adminpanel/view/users.php');
      exit();
    }
  }
  ?>

  <!------------------------------ Edit User Form starts ------------------------------>
  <div>
    <form action="" method="POST">
      <table>
        <tr>
          <td>Title:</td>
          <td>
            <select name="title" required>
              <option value="">Select Title</option>
              <option value="Mr." <?php if ($title == 'Mr.') echo 'selected'; ?>>Mr.</option>
              <option value="Ms." <?php if ($title == 'Ms.') echo 'selected'; ?>>Ms.</option>
              <option value="Mrs." <?php if ($title == 'Mrs.') echo 'selected'; ?>>Mrs.</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>First Name:</td>
          <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" required></td>
        </tr>
        <tr>
          <td>Last Name:</td>
          <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" required></td>
        </tr>
        <tr>
          <td>NIC No:</td>
          <td><input type="text" name="nic_number" value="<?php echo $nic_number; ?>" required></td>
        </tr>
        <tr>
          <td>Date of Birth:</td>
          <td><input type="date" name="dob" value="<?php echo $dob; ?>" required></td>
        </tr>
        <tr>
          <td>Phone Number:</td>
          <td><input type="text" name="tel_number" value="<?php echo $tel_number; ?>" required></td>
        </tr>
        <tr>
          <td>Email Address:</td>
          <td><input type="email" name="email" value="<?php echo $email; ?>" required></td>
        </tr>
        <tr>
          <td>Gender:</td>
          <td>
            <select name="gender" required>
              <option value="">Select Gender</option>
              <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
              <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Address:</td>
          <td><textarea name="address" rows="5" required><?php echo $address; ?></textarea></td>
        </tr>
        <tr>
          <td>Role:</td>
          <td>
            <select name="role_id" required>
              <option value="">Please Select a Role</option>
              <?php
              $roleSql = "SELECT * FROM tbl_role";
              $roleResult = mysqli_query($conn, $roleSql);
              while ($roleRow = mysqli_fetch_assoc($roleResult)) {
                $roleOption = '<option value="' . $roleRow['role_id'] . '"';
                if ($roleRow['role_id'] == $role_id) {
                  $roleOption .= ' selected';
                }
                $roleOption .= '>' . $roleRow['role_name'] . '</option>';
                echo $roleOption;
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="adminuser_id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update User" class="savebtn">
          </td>
        </tr>
      </table>
    </form>
  </div>

  <!------------------------------ Edit User Form Ends ------------------------------>
</main>

<!------------------------------ Button Click Functionality Starts ------------------------------>
<?php
if (isset($_POST['submit'])) {
  $id = $_POST['adminuser_id'];
  $title = $_POST['title'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $nic_number = $_POST['nic_number'];
  $dob = $_POST['dob'];
  $tel_number = $_POST['tel_number'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  $role_id = $_POST['role_id'];

  $sql = "UPDATE tbl_adminuser SET
          title = '$title',
          firstname = '$firstname',
          lastname = '$lastname',
          nic_number = '$nic_number',
          dob = '$dob',
          tel_number = '$tel_number',
          email = '$email',
          address = '$address',
          gender = '$gender',
          role_id = '$role_id'
          WHERE adminuser_id = '$id'";

  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    echo '<script type="text/javascript">';
    echo 'alert("USER DETAILS UPDATED SUCCESSFULLY");';
    echo 'window.location.href = "../view/users.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("FAILED TO UPDATE USER DETAILS");';
    echo 'window.location.href = "../view/users.php";';
    echo '</script>';
  }
}
?>
<!------------------------------ Button Click Functionality Ends ------------------------------>

</body>
</html>
