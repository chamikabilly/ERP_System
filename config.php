<?php

// Connecting to the Database 

$connect = mysqli_connect('localhost', 'root','','erp_system');

// Checking for connection 

if($connect === false){
    die('ERROR: Could not connect to the database'.mysqli_connect_error());
}




?>