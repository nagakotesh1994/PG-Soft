
<?php
    
    include "DB.php";
    $conn = DB_Connect();

    $table = $_REQUEST['table'];
    $id = $_REQUEST['id'];
    $page = $_REQUEST['page'];
    $status = $_REQUEST['status'];

    $query="UPDATE `{$table}` SET `status` = '{$status}' WHERE `{$table}`.`id` = {$id}";
    if ($conn->query($query) === TRUE) {
        echo "PG Status Updated successful";
    } else {
        echo "Error: PG Status Update: " . $conn->error;
    }


    echo "<script> window.location.href = '../{$page}.php'; </script>";
?>