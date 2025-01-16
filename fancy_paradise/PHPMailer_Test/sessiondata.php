<?php

session_start();



?>

<html>
<head>
<title> Session Test </title>
</head>

<body>

<h2> PHP session Demo </h2>

<p> Current Session id is: <?php echo session_id();  ?> </p>

<p> Cuustomer Order Date is: <?php echo $_SESSION["cus_date"];  ?>  </p>

<p> Cuustomer Order Time is: <?php echo $_SESSION["cus_time"];  ?>  </p>

<p> Cuustomer Order Address is: <?php echo $_SESSION["cus_address"];  ?>  </p>

<p> Cuustomer Order City is: <?php echo $_SESSION["cus_city"];  ?>  </p>

</body>

</html>