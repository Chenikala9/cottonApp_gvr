<?php
include 'header.php';
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>

<h2>📊 Reports Dashboard</h2>

<?php
/* =========================
   GRAND TOTAL (ALL TABLES)
   ========================= */

$tables = $conn->query("SHOW TABLES");

$grand_amount = 0;
$grand_kg = 0;

while($row = $tables->fetch_array()){
    $table = $row[0];

    if(strpos($table, "purchase_") === 0){

        $res = $conn->query("
            SELECT 
                SUM(total) AS amount,
                SUM(weight) AS kg
            FROM `$table`
        ")->fetch_assoc();

        $grand_amount += $res['amount'] ?? 0;
        $grand_kg += $res['kg'] ?? 0;
    }
}
?>

<!-- GRAND TOTAL UI -->
<div style="background:#dff3ff;padding:15px;border-radius:10px;margin-bottom:15px;box-shadow:0 2px 5px #ccc;">
    <h3>💰 Grand Total (All Tables)</h3>

    💰 Total Amount: ₹ <?= number_format($grand_amount,2) ?><br>
    ⚖️ Total Cotton: <?= number_format($grand_kg,2) ?> kg
</div>

<!-- EXPORT ALL BUTTONS (OPTIONAL) -->
<div style="margin-bottom:15px;">
    <a href="export_excel.php" style="background:green;color:white;padding:8px 12px;border-radius:6px;text-decoration:none;">📥 Excel (All)</a>
    <a href="export_pdf.php" style="background:red;color:white;padding:8px 12px;border-radius:6px;text-decoration:none;">📄 PDF (All)</a>
</div>

<h3>📁 Active Tables</h3>

<?php
/* =========================
   TABLE WISE DATA
   ========================= */

$tables = $conn->query("SHOW TABLES");

while($row = $tables->fetch_array()){
    $table = $row[0];

    if(strpos($table, "purchase_") === 0){

        $data = $conn->query("
            SELECT 
                SUM(total) AS amount,
                SUM(weight) AS kg
            FROM `$table`
        ")->fetch_assoc();

        $amount = $data['amount'] ?? 0;
        $kg = $data['kg'] ?? 0;

        echo "
        <div style='background:#fff;padding:12px;margin:10px 0;border-radius:10px;box-shadow:0 2px 5px #ddd;'>

            📁 <b>$table</b><br><br>

            💰 ₹ ".number_format($amount,2)."<br>
            ⚖️ ".number_format($kg,2)." kg<br><br>

            <a href='export_excel.php?table=$table' style='background:green;color:white;padding:6px 10px;border-radius:5px;text-decoration:none;'>📥 Excel</a>

            <a href='export_pdf.php?table=$table' style='background:red;color:white;padding:6px 10px;border-radius:5px;text-decoration:none;'>📄 PDF</a>

        </div>";
    }
}
?>

<h3>📦 Archived Tables</h3>

<?php
$tables = $conn->query("SHOW TABLES");

while($row = $tables->fetch_array()){
    $table = $row[0];

    if(strpos($table, "archive_") === 0){
        echo "<div style='background:#eee;padding:8px;margin:5px;border-radius:6px;'>📦 $table</div>";
    }
}
?>

<br>

<!-- BACK BUTTON -->
<a href="dashboard.php" 
style="display:block;text-align:center;background:#2d89ef;color:white;padding:12px;border-radius:10px;text-decoration:none;">
⬅ Back to Dashboard
</a>

<?php include 'footer.php'; ?>
