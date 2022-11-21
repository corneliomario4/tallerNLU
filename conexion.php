<?php
    $server = '195.179.238.154';
    $port = '3306';
    $user = 'u994772232_admin';
    $db_name = 'u994772232_lunabar';
    $pwd = 'Ent3rpris3@12';

    $conn = mysqli_connect($server, $user, $pwd, $db_name);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
