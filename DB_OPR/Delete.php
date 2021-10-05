<?php
    include "DB.php";
    $conn = DB_Connect();

    $table = $_REQUEST['table'];
    $id = $_REQUEST['id'];
    $page = $_REQUEST['page'];

    $query = "DELETE FROM `{$table}` WHERE `{$table}`.`id` = {$id}";
    if ($conn->query($query) === TRUE) {
        echo "PG is deleted";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    echo "<script> window.location.href = '../{$page}.php'; </script>";
    
?>