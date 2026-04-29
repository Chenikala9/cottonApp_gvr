<?php
include 'db.php';

$id=$_GET['id'];
$table=$_GET['table'];

$r=$conn->query("SELECT paid_status FROM `$table` WHERE id=$id")->fetch_assoc();

$new = ($r['paid_status']=="Paid") ? "Not Paid" : "Paid";

$conn->query("UPDATE `$table` SET paid_status='$new' WHERE id=$id");

header("Location: purchase.php?table=$table");
?>
