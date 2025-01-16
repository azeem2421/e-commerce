<?php
// Calculate the date range for the last 28 days
$endDate = date('Y-m-d H:i:s'); // Today's date and time
$startDate = date('Y-m-d', strtotime('-27 days', strtotime($endDate))); // Date only for 27 days ago

// Generate an array of dates for the last 28 days
$dateRange = [];
$currentDate = strtotime($endDate);

while ($currentDate >= strtotime($startDate)) {
    $dateRange[] = date('Y-m-d', $currentDate);
    $currentDate = strtotime('-1 day', $currentDate);
}

// Fetch login counts for each date in the date range
$sql = "SELECT DATE(login_datetime) AS login_date, COUNT(*) AS login_count
        FROM tbl_userlog
        WHERE login_datetime >= '$startDate' AND login_datetime <= '$endDate'
        GROUP BY login_date";
$res = mysqli_query($conn, $sql);

// Prepare the data for the chart
$loginData = [];
while ($row = mysqli_fetch_assoc($res)) {
    $loginData[$row['login_date']] = $row['login_count'];
}

// Generate an array with all dates in the date range
$completeDateRange = array_reverse($dateRange);
foreach ($completeDateRange as $date) {
    if (!isset($loginData[$date])) {
        $loginData[$date] = 0; // Assign a count of 0 for dates without login records
    }
}

// Sort the login data array by keys (dates)
ksort($loginData);

// Generate a random color
$loginColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
?>

<!-- Render the chart -->
<script>
window.onload = function() {
  // Assuming you have a div with the ID 'chartcontainer' where the chart will be rendered
  var ctx = document.getElementById('chartcontainer').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode(array_values($completeDateRange)); ?>, // Complete date range for the X-axis
      datasets: [
        {
          label: 'Login',
          data: <?php echo json_encode(array_values($loginData)); ?>, // Login count values for the Y-axis
          backgroundColor: '<?php echo $loginColor; ?>',
          borderColor: '<?php echo $loginColor; ?>',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Date'
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Count'
          }
        }
      }
    }
  });
};
</script>
