<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'testing';
    $conn = new mysqli($server, $user, $password, $db);
    if($conn->connect_error) {
        die('Connection Error : ' . $conn->connect_error);
    } else {
        // echo 'Successful Connection<br>';
    }
?>