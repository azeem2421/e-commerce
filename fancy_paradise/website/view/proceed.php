<?php
ob_start(); // Start output buffering
?>

<!-- Header Section Starts Here -->
<?php include('header.php') ?>

<style>
    <?php
    include('css/style.css');
    include('css/header.css');
    ?>
</style>

<?php
$pagelink = $_SERVER['REQUEST_URI'];

error_reporting(E_ERROR | E_WARNING | E_PARSE); // Error Handling

if (!isset($_SESSION['s_id'])) {
    // To get IP address
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $_SESSION['s_id'] = time() . "_" . $ip;
}

$s_id = $_SESSION['s_id'];

$title = '';
$first_name = '';
$last_name = '';
$email = '';
$telephone_no = '';
$address = '';
$city_id = '';

if (isset($_SESSION['user_id'])) {
    // User is logged in, retrieve details from tbl_customer
    $user_id = $_SESSION['user_id'];

    // Query the database to get user details
    $query = "SELECT * FROM tbl_customer c, tbl_cuslogin cl, tbl_city ct WHERE c.customer_id=cl.customer_id AND user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // User details found, fetch the data
        $row = mysqli_fetch_assoc($result);

        // Assign user details to variables
        $title = $row['title'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $telephone_no = $row['telephone_no'];
        $address = $row['address'];
        $city_id = $row['city_id'];
    }
}
?>

<!-- customer details Section Starts Here -->
<section class="container">
    <h2 class="text-center">Customer Details</h2>
    <div class="proceed_details">

        <div class="proceed_des">
            <p>Provide your details to Proceed the order <span class="material-icons-outlined" style="font-size: 60px;">north_east</span></p>
        </div>

        <div class="proceed_details_form">
            <form method="POST" action="">
                <table>
                    <tr>
                        <td><label for="title">Title:</label></td>
                        <td>
                            <select class="text-center" name="title">
                                <option <?php if ($title == 'Mr.') echo 'selected'; ?>>Mr.</option>
                                <option <?php if ($title == 'Ms') echo 'selected'; ?>>Ms</option>
                                <option <?php if ($title == 'Mrs') echo 'selected'; ?>>Mrs</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="first_name">First Name:</label></td>
                        <td><input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required></td>
                    </tr>

                    <tr>
                        <td><label for="last_name">Last Name:</label></td>
                        <td><input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required></td>
                    </tr>

                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" value="<?php echo $email; ?>" required></td>
                    </tr>

                    <tr>
                        <td><label for="telephone_no">Phone Number: </label></td>
                        <td><input type="tel" id="telephone_no" name="telephone_no" value="<?php echo $telephone_no; ?>" required></td>
                    </tr>

                    <tr>
                        <td><label for="address">Address:</label></td>
                        <td><textarea id="address" name="address" rows="5" cols="40" required><?php echo $address; ?></textarea></td>
                    </tr>

                    <tr>
                        <td><label for="phone">City: </label></td>
                        <td>
                            <select class="text-center" name="city_name">
                                <option value="" selected disabled>Select a city</option>
                                <?php
                                $sql = "SELECT * FROM tbl_city";
                                $res = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $city_id = $row['city_id'];
                                        $city_name = $row['city_name'];
                                        $city_amount = $row['city_amount'];

                                        $selected = ($city_id == $selected_city_id) ? 'selected' : '';

                                        echo '<option value="' . $city_id . '"' . $selected . '>' . $city_name . ' | Rs.' .  number_format($city_amount, 2) . '</option>';
                                    }
                                } else {
                                    echo '<option>No cities found</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Submit" name="submit" class="submitDetails">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="clearfix"></div>
    </div>
</section>

<!-- Footer Section Starts Here -->
<?php include('footer.php') ?>

<style>
    <?php
    include('css/footer.css');
    ?>
</style>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $s_id = $_SESSION['s_id'];
    $email = $_POST['email'];
    $telephone_no = $_POST['telephone_no'];
    $address = $_POST['address'];
    $city_id = $_POST['city_name'];

    // Assign form values to session variables
    $_SESSION['title'] = $title;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['telephone_no'] = $telephone_no;
    $_SESSION['address'] = $address;
    $_SESSION['city_id'] = $city_id;

    if ($s_id != "") {
        $status = 1;
        header("Location: payment.php?status=$status");
        exit;
    }
}
?>

<?php include('footer.php') ?>
