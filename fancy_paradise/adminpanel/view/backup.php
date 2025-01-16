<!--------------------------Start Navigation-------------------------->
<?php
    include "index.php";
?>
<style>
    <?php include "css/backup.css"; ?>
</style>
<!--------------------------End Navigation-------------------------->

<main>
        <h1 class="sticky"><i class="fa fa-bars" aria-hidden="true"></i> BACKUP</h1>
        <form action="../controller/backupcontroller.php" method="POST" class="blogdesire-form">
        <button name="backup" class="blogdesire-button">
            Backup
        </button>
        <button name="restore" class="blogdesire-button">
            Restore
        </button>
        <?php  if(@$message): ?>
            <p><?php echo $message;?></p>
        <?php  endif; ?>
    </form>


        </div>
    </main>
</body>
</html>
