<?php
    include 'DB.php';
    
    session_destroy();
    $page = 'index.php';
    echo "<script>window.location.href = '{$page}';</script>";
?>