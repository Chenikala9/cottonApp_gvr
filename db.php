<?php
$conn = new mysqli("localhost","cotton","gova","cotton_db");

if($conn->connect_error){
    die("Database Error: ".$conn->connect_error);
}

session_start();
?>
