<?php
include 'db.php';

$table = $_GET['table'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$table.xls");

echo "Name\tWeight\tRate\tTotal\tStatus\tDate\n";

$res = $conn->query("SELECT * FROM `$table`");

while($row = $res->fetch_assoc()){
    echo "{$row['farmer_name']}\t{$row['weight']}\t{$row['rate']}\t{$row['total']}\t{$row['paid_status']}\t{$row['created_at']}\n";
}
?>
