<?php 
include 'header.php'; 
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>

<h2>📁 Cotton Tables</h2>

<a href="manage_tables.php">➕ Create Table</a><br><br>

<?php
$res = $conn->query("SHOW TABLES");

while($row = $res->fetch_array()){
    $table = $row[0];

    // Show only purchase tables
    if(strpos($table, "purchase_") === 0){

        // Format date nicely (optional)
        $display = str_replace("purchase_","",$table);
        if(strlen($display) == 8){
            $date = DateTime::createFromFormat('Ymd', $display);
            if($date){
                $display = $date->format('d M Y');
            }
        }

        echo "<div style='background:#fff;padding:12px;margin:8px 0;border-radius:10px;box-shadow:0 2px 5px #ccc;'>
        
        📅 <b>$display</b><br>
        <small>$table</small><br><br>

        <a href='purchase.php?table=$table'>➡ Open</a> |
        <a href='?rename=$table'>✏️ Rename</a> |
        <a href='table_action.php?action=archive&table=$table'>📦 Archive</a> |
        <a href='table_action.php?action=delete&table=$table' onclick=\"return confirm('Delete this table?')\">❌ Delete</a>

        </div>";
    }
}
?>

<?php
// Rename form
if(isset($_GET['rename'])){
    $old = $_GET['rename'];

    echo "<div style='background:#fff;padding:10px;border-radius:10px;margin-top:10px;'>
    <h3>✏️ Rename Table</h3>

    <form method='POST' action='table_action.php?action=rename&table=$old'>
    <input name='new_name' placeholder='Enter new name (example: 20260503)' required>
    <button>Rename</button>
    </form>

    </div>";
}
?>

<hr>

<h2>📦 Archived Tables</h2>

<?php
$res = $conn->query("SHOW TABLES");

while($row = $res->fetch_array()){
    $table = $row[0];

    if(strpos($table, "archive_") === 0){

        echo "<div style='background:#eee;padding:10px;margin:6px;border-radius:8px;'>
        $table 
        <a href='table_action.php?action=restore&table=$table'>🔄 Restore</a>
        </div>";
    }
}
?>

<br>
<a href="report.php">📊 Reports</a><br>
<a href="logout.php">🚪 Logout</a><br>
<a href="change_password.php">🔐 Change Password</a>
<?php include 'footer.php'; ?>
