<?php 
include 'header.php'; 
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>

<h2>📊 Reports</h2>

<!-- ACTIVE TABLES -->
<h3>📁 Active Tables</h3>

<?php
$res = $conn->query("SHOW TABLES");

while($row = $res->fetch_array()){
    $table = $row[0];

    if(strpos($table, "purchase_") === 0){

        $sum = $conn->query("SELECT SUM(total) s FROM `$table`")->fetch_assoc()['s'];

        echo "<div style='background:#fff;padding:10px;margin:8px 0;border-radius:10px;box-shadow:0 2px 5px #ccc;'>
        <b>$table</b><br>
        Total: ₹ ".($sum ?? 0)."
        </div>";
    }
}
?>

<!-- ARCHIVED TABLES -->
<h3>📦 Archived Tables</h3>

<?php
$res = $conn->query("SHOW TABLES");

while($row = $res->fetch_array()){
    $table = $row[0];

    if(strpos($table, "archive_") === 0){

        echo "<div style='background:#eee;padding:10px;margin:6px;border-radius:8px;'>
        $table
        </div>";
    }
}
?>

<!-- BACK BUTTON -->
<br><br>
<a href="dashboard.php" 
style="display:block;text-align:center;background:#2d89ef;color:white;padding:12px;border-radius:10px;text-decoration:none;">
⬅ Back to Dashboard
</a>

<?php include 'footer.php'; ?>
