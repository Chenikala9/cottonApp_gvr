<?php
include 'db.php';

$action = $_GET['action'];
$table = $_GET['table'];

if($action == "delete"){
    $conn->query("DROP TABLE `$table`");
    header("Location: dashboard.php");
}

/* RENAME */
if($action == "rename" && isset($_POST['new_name'])){
    $new = "purchase_" . preg_replace("/[^a-zA-Z0-9_]/","",$_POST['new_name']);
    $conn->query("RENAME TABLE `$table` TO `$new`");
    header("Location: dashboard.php");
}

/* ARCHIVE */
if($action == "archive"){
    $new = str_replace("purchase_","archive_",$table);
    $conn->query("RENAME TABLE `$table` TO `$new`");
    header("Location: dashboard.php");
}

/* RESTORE */
if($action == "restore"){
    $new = str_replace("archive_","purchase_",$table);
    $conn->query("RENAME TABLE `$table` TO `$new`");
    header("Location: dashboard.php");
}
?>
