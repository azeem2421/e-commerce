<?php
include('../model/connection.php');
$conn->set_charset("utf8");


if(isset($_POST['backup'])){
    $tables = array();
    $sql = "SHOW TABLES";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
    $sqlScript = "";
    foreach ($tables as $table) {
        $query = "SHOW CREATE TABLE $table";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
        $query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $query);
        $columnCount = mysqli_num_fields($result);
        for ($i = 0; $i < $columnCount; $i ++) {
            while ($row = mysqli_fetch_row($result)) {
                $sqlScript .= "INSERT INTO $table VALUES(";
                for ($j = 0; $j < $columnCount; $j ++) {
                    $row[$j] = $row[$j];           
                    if (isset($row[$j])) {
                        $sqlScript .= '"' . mysqli_real_escape_string($conn,$row[$j]) . '"';
                    } else {
                        $sqlScript .= '""';
                    }
                    if ($j < ($columnCount - 1)) {
                        $sqlScript .= ',';
                    }
                }
                $sqlScript .= ");\n";
            }
        }   
        $sqlScript .= "\n"; 
    }
    if(!empty($sqlScript))
    {
        $backup_file_name =  __DIR__.'/Backups/_backup_.sql';
        $fileHandler = fopen($backup_file_name, 'w+');
        $number_of_lines = fwrite($fileHandler, $sqlScript);
        fclose($fileHandler);
        $message = "Backup Created Successfully";
        // Add an alert and redirect
    echo '<script>alert("' . $message . '"); window.location.href = "../view/backup.php";</script>';
    }
}
if(isset($_POST['restore'])){
    $sql = '';
    $error = '';
    if (file_exists(__DIR__.'/Backups/_backup_.sql')) {
        // Deleting starts here
        $query_disable_checks = 'SET foreign_key_checks = 0';
        mysqli_query($conn, $query_disable_checks);
        $show_query = 'Show tables';
        $query_result = mysqli_query($conn, $show_query);
        $row = mysqli_fetch_array($query_result);
        while ($row) {
            $query = 'DROP TABLE IF EXISTS ' . $row[0];
            $query_result = mysqli_query($conn, $query);
            $show_query = 'Show tables';
            $query_result = mysqli_query($conn, $show_query);
            $row = mysqli_fetch_array($query_result);
        }
        $query_enable_checks = 'SET foreign_key_checks = 1';
        mysqli_query($conn, $query_enable_checks);
        // Deleting ends here
        $lines = file(__DIR__.'/Backups/_backup_.sql');
        foreach ($lines as $line) {
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            $sql .= $line;
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        }
        if ($error) {
            $message = $error;
        } else {
            $message = "Database restored successfully";
            // Add an alert and redirect
        echo '<script>alert("' . $message . '"); window.location.href = "../view/backup.php";</script>';
        }
    }else{
        $message = "Uh Oh! No backup file found on the current directory!";
        // Add an alert and redirect
        echo '<script>alert("' . $message . '"); window.location.href = "../view/backup.php";</script>';
    }
}
?>