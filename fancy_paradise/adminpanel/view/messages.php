

	<!--------------------------Start Navigation-------------------------->
			<?php
				include "index.php";
			?>
			<style>
      		<?php include "css/messages.css"; ?>
        	</style>
		
	<!--------------------------End Navigation-------------------------->

	<main>
        <h1 class="sticky"><i class="fa fa-envelope" aria-hidden="true"></i> MESSAGES</h1>

    <table class="message-table hover order-colomn cell-border message-display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
                <th>Time</th>
                <th>Message Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $sql = "SELECT * FROM tbl_messages ORDER BY `date` DESC, `time` DESC";
                    $res = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($res)) 
                    {
            ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td class="<?php echo ($row['message_status'] == 'Pending') ? 'pending' : 'replied';?>">
                                            <?php echo $row['message_status']; ?>
                            </td>

                            <td>
                                <form method="POST" action="../controller/update_messagestatus.php">
                                    <input type="hidden" name="message_id" value="<?php echo $row['message_id']; ?>">

                                  <?php if($row['message_status']=='Pending') 
                                  {?>  
                                        <button type="submit" class="right-button">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    <?php }else{
                                        echo "Done";
                                    } ?>
                                </form>
                            </td>
                        </tr>
                <?php } ?>
        </tbody>
    </table>
</main>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('.message-table').DataTable();
});
</script>

</body>
</html>