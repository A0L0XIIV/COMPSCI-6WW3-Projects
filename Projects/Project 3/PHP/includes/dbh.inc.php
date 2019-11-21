<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "root@localhost";
$dbName = "parkrater";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: ".mysqli_conenct_error());
}