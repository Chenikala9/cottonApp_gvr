<?php 
include 'header.php'; 
include 'db.php';

$keyword = $_GET['q'] ?? '';
?>

<h2>🔍 Search All Tables</h2>

<form method="GET">
<input name="q" placeholder="Enter farmer name" value="<?= $keyword ?>" required>
<button>Search</button>
</form>

<?php
if($keyword != ""){

    echo "<h3>Results for: <b>$keyword</b></h3>";

    // get all tables
    $tables = $conn->query("SHOW TABLES");

    $found = false;

    while($row = $tables->fetch_array()){
        $table = $row[0];

        // only purchase tables
        if(strpos($table, "purchase_") === 0){

            $res = $conn->query("SELECT * FROM `$table` WHERE farmer_name LIKE '%$keyword%'");

            while($data = $res->fetch_assoc()){
                $found = true;

                $color = ($data['paid_status']=="Paid") ? "green" : "red";

                echo "<div style='background:#fff;padding:10px;margin:8px 0;border-radius:10px;box-shadow:0 2px 5px #ccc;'>
                
                📁 <b>$table</b><br>
                👤 {$data['farmer_name']}<br>
                ⚖️ {$data['weight']} kg<br>
                💰 ₹ {$data['total']}<br>
                📅 {$data['created_at']}<br>
                <span style='color:$color;'>{$data['paid_status']}</span>

                </div>";
            }
        }
    }

    if(!$found){
        echo "<div style='margin-top:10px;'>❌ No records found</div>";
    }
}
?>

<br><br>
<a href="dashboard.php" 
style="display:block;text-align:center;background:#2d89ef;color:white;padding:12px;border-radius:10px;text-decoration:none;">
⬅ Back to Dashboard
</a>

<?php include 'footer.php'; ?>
