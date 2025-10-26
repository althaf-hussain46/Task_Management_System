<?php
session_start();

$hostName = "localhost:3306";
$userName = "root";
$userPassword = "root123";
$database = "tms";

$con  = mysqli_connect($hostName, $userName, $userPassword, $database);

if ($con) {
    return $con;
} else {
    echo "failed to connect with tms";
}