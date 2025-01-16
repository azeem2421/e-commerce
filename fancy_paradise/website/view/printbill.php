<?php
require '../../PHPMailer_Test/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('../../adminpanel/model/connection.php');

$pagelink = $_SERVER['REQUEST_URI'];

error_reporting(E_ERROR | E_WARNING | E_PARSE); // Error Handling

session_start();

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

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'mail.ceylondev.lk';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'testemail@ceylondev.lk';
    $mail->Password   = 'TeSt@2022';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('info@ceylondev.lk', 'Fancy Paradise');
    $mail->addAddress('gmahawewa@gmail.com', 'Gihan Mahawewa');
    $mail->addReplyTo('fancyparadiseofficial@gmail.com', 'More Information');
    $logoPath = '../view/assets/logo.jpg';
    $mail->addEmbeddedImage($logoPath, 'logo');

    $html = "<table border='1' width='500' align='center'>
                <tr>
                    <th colspan='4'>
                        <h4>
                            Fancy Paradise
                        </h4>
                    </th>
                </tr>
                <tr>
                    <th colspan='4'>Invoice</th>
                </tr>";
    $order_id = $_SESSION['order_id'];

    $sql3 = "SELECT * FROM tbl_order o
            INNER JOIN tbl_customer c ON o.customer_id = c.customer_id
            WHERE o.order_id = '$order_id'";

    $res3 = mysqli_query($conn, $sql3);
    if ($res3 && mysqli_num_rows($res3) > 0) {
        $row3 = mysqli_fetch_assoc($res3);

        
        $customerName = $row3['first_name'] . ' ' . $row3['last_name'];
        $orderDate = $row3['order_datetime'];
        $orderAmount = $row3['order_total'];
        $order_id_full = str_pad($order_id, 6, '0', STR_PAD_LEFT);

        $html .= "<tr>
                        <td>Order Reference Id:</td>
                        <td colspan='3'>" . $order_id_full . "</td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td colspan='3' align='center'>" . $customerName . "</td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td>" . $orderDate . "</td>
                        <td>Order Amount</td>
                        <td>" . $orderAmount . "</td>
                    </tr>
                    <tr>
                        <td colspan='2' align='center'>Product Details</td>
                        <td>Quantity</td>
                        <td>Price</td>
                    </tr>";

        $sql4 = "SELECT od.*, p.product_title, p.product_price
                FROM tbl_order o, tbl_customer c, tbl_orderdetails od, tbl_products p
                WHERE o.customer_id = c.customer_id
                AND o.order_id = od.order_id
                AND od.product_id = p.product_id
                AND o.order_id = '$order_id'";

        $res4 = mysqli_query($conn, $sql4);
        if ($res4 && mysqli_num_rows($res4) > 0) {
            while ($row = mysqli_fetch_assoc($res4)) {
                $productTitle = $row['product_title'];
                $cartProductPrice = $row['product_price'];
                $cartQty = $row['order_quantity'];

                $html .= "<tr>
                                <td colspan='2' align='center'>" . $productTitle . "</td>
                                <td>" . $cartQty . "</td>
                                <td>" . $cartProductPrice . "</td>
                            </tr>";
            }
        }
    }

    $html .= "</table>";

    $mail->isHTML(true);
    $mail->Subject = 'Your Order has been Completed';
    $mail->Body    = $html;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Clear cart items for the session
$sql5 = "DELETE FROM tbl_cart WHERE session_id = '$s_id'";
$res = mysqli_query($conn, $sql5);

if ($res) {
    // Cart items deleted successfully
    echo '<script>alert("Order placed successfully. Check email for Order Details"); 
            window.location.href = "index.php";
        </script>';
    exit();
}

// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>
